<?php

// app/Http/Controllers/Customer/CustomerTicketController.php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\PoolTicket;
use App\Models\User;
use App\Notifications\AdminNewTicketNotification;
use App\Notifications\TicketNotification;
use App\Services\PromoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CustomerTicketController extends Controller
{
    protected $promoService;

    public function __construct(PromoService $promoService)
    {
        $this->promoService = $promoService;
    }

    public function index()
    {
        $tickets = PoolTicket::where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('customer.tickets', compact('tickets'));
    }

    public function show($ticketCode)
    {
        $ticket = PoolTicket::where('ticket_code', $ticketCode)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('customer.ticket-show', compact('ticket'));
    }

    public function create()
    {
        $ticketPrices = [
            'adult' => 35000,
            'child' => 25000,
            'family' => 100000,
        ];

        return view('reservation.ticket.create', compact('ticketPrices'));
    }

    public function calculate(Request $request)
    {
        $validated = $request->validate([
            'ticket_type' => 'required|in:adult,child,family',
            'number_of_tickets' => 'required|integer|min:1',
            'visit_date' => 'required|date|after_or_equal:today',
        ]);

        $prices = [
            'adult' => 35000,
            'child' => 25000,
            'family' => 100000,
        ];

        $pricePerTicket = $prices[$validated['ticket_type']];
        $total = $pricePerTicket * $validated['number_of_tickets'];
        $capacity = PoolTicket::checkCapacity($validated['visit_date']);

        return response()->json([
            'price_per_ticket' => $pricePerTicket,
            'total' => $total,
            'capacity' => $capacity,
        ]);
    }

    public function store(Request $request)
    {
        try {
            Log::info('Ticket purchase request', $request->all());

            $validated = $request->validate([
                'customer_name' => 'required|string|max:255',
                'customer_email' => 'required|email|max:255',
                'customer_phone' => ['required', 'string', 'max:20', 'regex:/^[0-9+\-\s()]+$/'],
                'visit_date' => 'required|date|after_or_equal:today',
                'visit_time' => 'nullable',
                'ticket_type' => 'required|in:adult,child,family',
                'number_of_tickets' => 'required|integer|min:1',
                'promo_code' => 'nullable|string',
            ]);

            $capacity = PoolTicket::checkCapacity($validated['visit_date']);

            if ($capacity['available'] < $validated['number_of_tickets']) {
                return back()->withInput()->with('error', 'Maaf, tiket tidak tersedia untuk tanggal tersebut. Sisa tiket: '.$capacity['available']);
            }

            $prices = [
                'adult' => 35000,
                'child' => 25000,
                'family' => 100000,
            ];

            $pricePerTicket = $prices[$validated['ticket_type']];
            $totalAmount = $pricePerTicket * $validated['number_of_tickets'];
            $discountAmount = 0;
            $promo = null;

            DB::beginTransaction();

            if ($request->filled('promo_code')) {
                $result = $this->promoService->validatePromo(
                    $validated['promo_code'], $totalAmount, 'ticket', lockForUpdate: true
                );

                if (! $result['valid']) {
                    DB::rollBack();

                    return back()->withInput()->with('error', $result['message']);
                }

                $promo = $result['promo'];
                $discountAmount = $result['discount_amount'];
                $totalAmount = $result['final_amount'];
            }

            $ticketCode = 'TKT-'.strtoupper(uniqid());
            while (PoolTicket::where('ticket_code', $ticketCode)->exists()) {
                $ticketCode = 'TKT-'.strtoupper(uniqid());
            }

            $userId = Auth::check() ? Auth::id() : null;
            if (! $userId) {
                $existingUser = User::where('email', $validated['customer_email'])->first();
                if ($existingUser) {
                    $userId = $existingUser->id;
                }
            }

            $ticket = PoolTicket::create([
                'ticket_code' => $ticketCode,
                'customer_name' => $validated['customer_name'],
                'customer_email' => $validated['customer_email'],
                'customer_phone' => $validated['customer_phone'],
                'visit_date' => $validated['visit_date'],
                'visit_time' => $validated['visit_time'] ?? null,
                'ticket_type' => $validated['ticket_type'],
                'number_of_tickets' => $validated['number_of_tickets'],
                'price_per_ticket' => $pricePerTicket,
                'total_amount' => $totalAmount,
                'payment_status' => 'unpaid',
                'status' => 'pending',
                'user_id' => $userId,
            ]);

            if ($promo) {
                $promo->usePromo();
            }

            DB::commit();

            // Notifikasi ke customer
            $customer = Auth::user() ?: User::where('email', $validated['customer_email'])->first();
            if ($customer && method_exists($customer, 'notify')) {
                try {
                    $customer->notify(new TicketNotification($ticket, 'purchased'));
                } catch (\Throwable $e) {
                    Log::error('Failed sending customer ticket notification', [
                        'ticket_code' => $ticketCode,
                        'error' => $e->getMessage(),
                    ]);
                }
            }

            // Notifikasi ke admin
            $admins = User::where('role', 'admin')->get();
            foreach ($admins as $admin) {
                if (method_exists($admin, 'notify')) {
                    try {
                        $admin->notify(new AdminNewTicketNotification($ticket));
                    } catch (\Throwable $e) {
                        Log::error('Failed sending admin ticket notification', [
                            'ticket_code' => $ticketCode,
                            'error' => $e->getMessage(),
                        ]);
                    }
                }
            }

            Log::info('Ticket created successfully', ['ticket_code' => $ticketCode]);

            return redirect()->route('reservation.ticket.success', $ticket->ticket_code)
                ->with('success', 'Tiket berhasil dipesan! Silakan lakukan pembayaran.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withInput()->withErrors($e->errors());

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Ticket purchase error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return back()->withInput()->with('error', 'Gagal memesan tiket: '.$e->getMessage());
        }
    }

    public function success($ticketCode)
    {
        $ticket = PoolTicket::where('ticket_code', $ticketCode)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('reservation.ticket.success', compact('ticket'));
    }

    public function view($ticketCode)
    {
        $ticket = PoolTicket::where('ticket_code', $ticketCode)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('reservation.ticket.view', compact('ticket'));
    }

    public function uploadPayment(Request $request, $ticketCode)
    {
        $request->validate([
            'payment_proof' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'bank_name' => 'required|string',
            'account_name' => 'required|string',
        ]);

        $ticket = PoolTicket::where('ticket_code', $ticketCode)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($request->hasFile('payment_proof')) {
            $path = $request->file('payment_proof')->store('payment_proofs', 'public');
            $ticket->payment_proof = $path;
        }

        $ticket->payment_status = 'payment_verified';
        $ticket->status = 'pending';
        $ticket->save();

        return redirect()->route('customer.tickets')->with('success', 'Bukti pembayaran diupload, menunggu verifikasi admin.');
    }
}
