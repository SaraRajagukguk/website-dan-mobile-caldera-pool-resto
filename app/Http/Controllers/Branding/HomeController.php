<?php

namespace App\Http\Controllers\Branding;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Menu;
use App\Models\Promo;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        $activePromos = Promo::active()
            ->where('promo_type', '!=', 'event')
            ->latest()->orderByDesc('id')->take(3)->get();

        $upcomingEvents = Promo::ofType('event')
            ->where('is_active', true)
            ->where('end_date', '>', now())
            ->latest()->orderByDesc('id')->take(3)->get();

        // 🔥 AMBIL MENU (dari database monolith)
        $recommendedMenus = Cache::remember('homepage_recommended_menus', 3600, function () {
            return Menu::where('is_available', true)
                ->where('is_recommended', true)
                ->latest()
                ->take(6)
                ->get();
        });

        // 🔥 AMBIL TESTIMONIAL (dari database monolith)
        $testimonials = Cache::remember('homepage_testimonials', 3600, function () {
            $testimonials = Testimonial::where('is_approved', true)
                ->where('is_featured', true)
                ->latest()
                ->take(3)
                ->get();

            if ($testimonials->count() < 3) {
                $moreTestimonials = Testimonial::where('is_approved', true)
                    ->whereNotIn('id', $testimonials->pluck('id'))
                    ->latest()
                    ->take(3 - $testimonials->count())
                    ->get();
                $testimonials = $testimonials->merge($moreTestimonials);
            }

            return $testimonials;
        });

        // 🔥 GALLERY (dari database monolith)
        $featuredGallery = Cache::remember('homepage_featured_gallery', 3600, function () {
            return Gallery::where('is_featured', true)
                ->where('type', 'image')
                ->take(8)
                ->get();
        });

        // Stats untuk home
        $stats = [
            [
                'id' => 'counter1',
                'value' => Testimonial::approved()->count() * 100 ?: 1500,
                'label' => 'Happy Clients',
                'icon' => 'fa-smile',
                'color' => 'primary',
            ],
            [
                'id' => 'counter2',
                'value' => Menu::available()->count() ?: 2500,
                'label' => 'Menu Variants',
                'icon' => 'fa-utensils',
                'color' => 'success',
            ],
            [
                'id' => 'counter3',
                'value' => $upcomingEvents->count() ?: 50,
                'label' => 'Events',
                'icon' => 'fa-calendar',
                'color' => 'info',
            ],
            [
                'id' => 'counter4',
                'value' => Testimonial::approved()->count() ?: 25,
                'label' => 'Testimonials',
                'icon' => 'fa-star',
                'color' => 'warning',
            ],
        ];

        $features = [
            [
                'icon' => 'fa-paint-brush',
                'gradient' => 'primary',
                'title' => 'Modern Design',
                'description' => 'Beautiful and intuitive interface with smooth animations and interactions.',
                'feature' => 'design',
            ],
            [
                'icon' => 'fa-code',
                'gradient' => 'success',
                'title' => 'Clean Code',
                'description' => 'Well-organized and documented code for easy customization and maintenance.',
                'feature' => 'code',
            ],
            [
                'icon' => 'fa-headset',
                'gradient' => 'info',
                'title' => '24/7 Support',
                'description' => 'Dedicated support team ready to help you with any questions or issues.',
                'feature' => 'support',
            ],
        ];

        $testimonialsData = [
            [
                'image' => 'https://randomuser.me/api/portraits/women/68.jpg',
                'quote' => 'The support team is amazing! They helped me customize everything I needed within hours.',
                'name' => 'Emily Rodriguez',
                'position' => 'Marketing Director',
                'rating' => 5,
            ],
            [
                'image' => 'https://randomuser.me/api/portraits/men/32.jpg',
                'quote' => 'Incredible attention to detail and the animations are buttery smooth. Highly recommended!',
                'name' => 'Michael Chen',
                'position' => 'Product Designer',
                'rating' => 5,
            ],
            [
                'image' => 'https://randomuser.me/api/portraits/women/44.jpg',
                'quote' => 'This is by far the best template I\'ve ever used. The design is stunning and the code is so clean!',
                'name' => 'Sarah Johnson',
                'position' => 'CEO, TechStart',
                'rating' => 5,
            ],
        ];

        return view('pages.home', compact(
            'stats',
            'features',
            'testimonialsData',
            'activePromos',
            'recommendedMenus',
            'upcomingEvents',
            'featuredGallery'
        ));
    }
}
