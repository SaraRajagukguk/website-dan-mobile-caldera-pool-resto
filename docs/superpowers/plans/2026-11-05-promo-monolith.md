# Promo Monolith Implementation Plan

> **For agentic workers:** Execute inline using executing-plans and test-driven-development. The user requested direct consolidation in PA2.

**Goal:** Promo berjalan sepenuhnya dalam satu aplikasi Laravel PA2.

**Architecture:** Eloquent untuk pembacaan/CRUD dan PromoService lokal untuk validasi diskon bersama. Pertahankan URL dan respons konsumen; hapus klien HTTP dan konfigurasi remote.

**Tech Stack:** PHP 8.3, Laravel 12, PostgreSQL; SQLite untuk tes.

**Spec:** `docs/superpowers/specs/2026-11-05-promo-monolith-design.md`

## Global Constraints

- Tidak menghapus atau menimpa data lama; tidak menambah paket.
- Tanggal admin mengikuti Asia/Jakarta dan penyimpanan zona waktu aplikasi.
- Tidak ada HTTP promo; autentikasi admin tetap berlaku.

## Review Focus

- Promo tanpa banner tetap dapat disimpan setelah migrasi tambahan.
- Judul sama memperoleh slug berbeda; kode promo duplikat ditolak.
- Minimum belanja, jenis transaksi, periode dan kuota berlaku pada pengecekan dan checkout.
- Penggunaan promo hanya bertambah ketika transaksi tiket berhasil, dengan penguncian baris.
- Semua hasil pagination dan detail konsisten walaupun promo berjumlah lebih dari 15.

### Task 1: Layanan lokal dan skema

Files: `app/Services/PromoService.php`, `app/Models/Promo.php`, migrasi nullable banner, `tests/Feature/PromoMonolithTest.php`.

- [x] Tulis tes perilaku validasi dan penyimpanan tanpa banner, jalankan dan amati kegagalan.
- [x] Implementasikan `validatePromo(string $promoCode, float $totalAmount, ?string $transactionType = null, bool $lockForUpdate = false): array`; batasi diskon dan total.
- [x] Jalankan tes terarah sampai lulus.

### Task 2: Semua konsumen memakai database PA2

Files: controller promo admin/branding/API/check, HomeController, CustomerTicketController, routes, config/services.php.

- [x] Tulis tes CRUD, pagination, detail dan checkout; jalankan pada perilaku lama.
- [x] Alihkan CRUD/read ke Eloquent, check/checkout ke PromoService. Validasi sebelum mutasi; gunakan transaksi dan row lock saat konsumsi promo.
- [x] Hapus PromoServiceClient, URL/config dan route debug microservice. Perbarui tampilan tanggal bila perlu.
- [x] Jalankan tes terarah dan seluruh suite, lint dan diff review.

### Task 3: Dokumentasi dan verifikasi akhir

- [x] Dokumentasikan operasi satu aplikasi dan pemindahan data terpisah di README.
- [x] Verifikasi PostgreSQL lokal setelah meninjau migrasi, tanpa seed ulang.
- [x] Catat hasil pengujian dan batasan deployment.

## Hasil pelaksanaan — 5 November 2026

- `php artisan test --compact`: 20 passed, 109 assertions. Tes regresi diamati gagal sebelum implementasi; temuan review perubahan tipe promo juga diverifikasi RED→GREEN.
- Review independen menemukan satu masalah applicability ketika admin mengubah tipe promo; sudah diperbaiki dengan sinkronisasi `applicable_for` saat menyimpan form.
- PostgreSQL lokal: migrasi banner diterapkan; 6 promo baru diimpor dari `caldera_promo_service` ke `caldera`, menghasilkan 12 promo total. Kode bentrok `TIKETMURAH` mempertahankan data lokal; database sumber tidak diubah.
- Cadangan tabel sumber dan tujuan: `storage/app/private/promo-imports/20261105-083443-ca234c7c-3cde-4c49-a9c0-a0c28a480beb.json`.
- Simulasi impor ulang: 0 tambahan, 7 kode dipertahankan. Tanggal sumber UTC dikonversi ke Asia/Jakarta; JSON applicability lama didukung.
- Smoke check database aktual: `/`, `/promos`, `/promos/test-microservice`, `/api/promos`, `/api/promos/test-microservice` semuanya 200 dengan HTTP eksternal diblokir. Validasi lokal TESTMS20 untuk 100000 menghasilkan 80000 tanpa mengonsumsi penggunaan.
- Proyek microservice lama dipertahankan sebagai arsip; aplikasi PA2 tidak memerlukannya lagi. Tidak ada commit/push atau perubahan pada state Git milik pengguna.
