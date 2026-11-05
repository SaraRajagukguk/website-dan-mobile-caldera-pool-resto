# Promo dalam Laravel PA2

Permintaan: seluruh fitur promo menjadi bagian proyek Laravel PA2, tanpa proses atau HTTP microservice promo.

Gunakan model `Promo`, tabel `promos`, autentikasi admin, URL web dan format respons API yang sudah tersedia. CRUD admin menggunakan Eloquent; validasi kode promo dibagi melalui `App\Services\PromoService`. Halaman publik memakai pagination database dan detail berdasarkan slug. Beranda mengambil promo/event promo langsung dari tabel yang sama. Pembelian tiket memvalidasi ulang dan menghitung diskon di server, dengan pencatatan penggunaan di transaksi database yang sama.

Pilihan implementasi: mengganti klien HTTP dengan layanan lokal dipilih karena mempertahankan aturan diskon terpusat. Menyalin seluruh aplikasi microservice akan menggandakan konfigurasi dan autentikasi. Memanggil API internal melalui HTTP masih menambah ketergantungan yang ingin dihapus.

Pertahankan data dan proyek microservice lama sebagai sumber pemulihan. Tidak menghapus database atau menjalankan seed ulang. Banner menjadi opsional melalui migrasi tambahan. Tanggal input admin mengikuti zona waktu aplikasi Asia/Jakarta. Kode unik dan slug unik ditegakkan di database. Validasi meliputi status, periode, jenis transaksi, minimum pembelian, kuota, batas diskon, dan total akhir tidak negatif. Memeriksa promo tidak menambah penggunaan; hanya pemesanan berhasil yang menambahkannya.

Data yang hanya ada di database microservice terpisah harus diimpor dengan prosedur terdokumentasi; tidak menimpa promo lokal otomatis. Tidak menambah dependensi paket. Tes memakai SQLite terisolasi dan mencegah permintaan HTTP promo.
