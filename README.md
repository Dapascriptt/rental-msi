# Rental System (MSI)

Sistem manajemen rental barang berbasis web yang dibangun menggunakan Laravel 10. Aplikasi ini menyediakan fitur lengkap untuk mengelola data barang, unit, spesifikasi, harga, serta pemesanan/booking.

## Tech Stack

- **Backend:** Laravel 10.x (PHP 8.1+)
- **Frontend:** Tailwind CSS (CDN), Inter Font
- **Database:** MySQL/PostgreSQL (Eloquent ORM)
- **Authentication:** Laravel Sanctum
- **UI Theme:** Dark mode dengan yellow accent

## Fitur

### 1. Authentication

- Login & Logout
- Register user (akses admin)
- Protected routes dengan middleware auth

### 2. Master Data

- **Tipe** - Manajemen tipe barang (CRUD)
- **Barang** - Manajemen data barang dengan upload gambar (CRUD)
- **Unit** - Manajemen unit barang dengan fitur bulk delete (CRUD)
- **Harga Barang** - Pengaturan harga sewa barang (CRUD)
- **Spesifikasi** - Manajemen spesifikasi teknis barang (CRUD)

### 3. Katalog (Public)

- Halaman katalog publik untuk menampilkan barang
- Filter barang berdasarkan kategori
- Detail barang dengan spesifikasi lengkap
- Akses tanpa login

### 4. Pemesanan / Booking

- Manajemen data pemesanan
- Detail pemesanan
- Assign unit ke pemesanan

### 5. Informasi

- Halaman Tentang Kami

### 6. Email Notifications

- Sistem mengirim email notifikasi status pesanan kepada pelanggan menggunakan `OrderStatusMail`.
- Admin menerima email notifikasi checkout baru melalui `AdminCheckoutNotification`.
- Konfigurasi email diatur di `.env` dengan variabel `MAIL_ADMIN_ADDRESS`, `MAIL_FROM_ADDRESS`, dll.

## Struktur Database

| Tabel               | Deskripsi                      |
| ------------------- | ------------------------------ |
| `users`             | Data pengguna/admin            |
| `tipes`             | Data tipe barang               |
| `barangs`           | Data barang dengan gambar      |
| `spesifikasis`      | Data spesifikasi barang        |
| `units`             | Data unit barang yang tersedia |
| `harga_barangs`     | Data harga sewa                |
| `pemesanans`        | Data pemesanan/booking         |
| `pemesanan_details` | Detail item dalam pemesanan    |
| `pemesanan_units`   | Unit yang dipesan              |

## Instalasi

### Prasyarat

- PHP 8.1 atau lebih baru
- Composer
- MySQL/PostgreSQL
- Node.js & NPM (opsional, untuk asset compilation)

### Langkah-langkah

1. Clone repository

```bash
git clone https://github.com/zuLmeister/rental-msi.git
cd rental-msi
```

2. Install dependencies PHP

```bash
composer install
```

3. Copy file environment

```bash
cp .env.example .env
```

4. Konfigurasi database di file `.env`

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rental_msi
DB_USERNAME=root
DB_PASSWORD=
```

5. Generate application key

```bash
php artisan key:generate
```

6. Jalankan migrasi database

```bash
php artisan migrate
```

7. (Opsional) Jalankan seeder jika ada

```bash
php artisan db:seed
```

8. Link storage untuk gambar

```bash
php artisan storage:link
```

9. Jalankan aplikasi

```bash
php artisan serve
```

Akses aplikasi di `http://localhost:8000`

## Routing

### Public Routes

| Method | URI                 | Controller                     | Deskripsi              |
| ------ | ------------------- | ------------------------------ | ---------------------- |
| GET    | `/`                 | Redirect                       | Redirect ke katalog    |
| GET    | `/katalog`          | KatalogController@katalog      | Halaman katalog publik |
| GET    | `/katalog/{barang}` | KatalogController@showByBarang | Detail barang          |
| GET    | `/tentang-kami`     | View                           | Halaman tentang kami   |

### Auth Routes

| Method | URI         | Controller                              | Deskripsi       |
| ------ | ----------- | --------------------------------------- | --------------- |
| GET    | `/login`    | LoginController@showLoginForm           | Form login      |
| POST   | `/login`    | LoginController@login                   | Proses login    |
| POST   | `/logout`   | LoginController@logout                  | Logout          |
| GET    | `/register` | RegisterController@showRegistrationForm | Form register   |
| POST   | `/register` | RegisterController@register             | Proses register |

### Protected Routes (Auth Required)

| Method   | URI                  | Controller                | Deskripsi         |
| -------- | -------------------- | ------------------------- | ----------------- |
| GET/POST | `/tipes`             | TipeController            | CRUD Tipe         |
| GET/POST | `/barangs`           | BarangController          | CRUD Barang       |
| GET/POST | `/units`             | UnitController            | CRUD Unit         |
| POST     | `/units/bulk-delete` | UnitController@bulkDelete | Hapus banyak unit |
| GET/POST | `/harga-barangs`     | HargaBarangController     | CRUD Harga        |
| GET/POST | `/pemesanan`         | PemesananController       | CRUD Pemesanan    |
| GET/POST | `/spesifikasis`      | SpesifikasiController     | CRUD Spesifikasi  |

## Screenshot UI

Aplikasi menggunakan tema dark mode dengan sidebar navigasi, tabel data yang responsif, dan form input yang modern menggunakan Tailwind CSS.

## Kontribusi

1. Fork repository ini
2. Buat branch fitur (`git checkout -b feature/AmazingFeature`)
3. Commit perubahan (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

## Lisensi

Proyek ini menggunakan lisensi MIT.

## Developer

Dikembangkan oleh IT Leaps Team.
