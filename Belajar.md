# Belajar Laravel Lewat Project Rental MSI

Dokumen ini dibuat untuk kamu yang baru mulai belajar Laravel.
Daripada belajar dari teori kosong, di sini kita bedah langsung project
nyata: aplikasi **rental alat berat MSI**. Jadi setiap konsep Laravel yang
dijelaskan, langsung ditunjukkan di mana letaknya di project ini.

Baca dari atas ke bawah. Jangan buru-buru. Kalau ada istilah yang belum
ngerti, biasanya dijelaskan di bagian setelahnya.

---

## 1. Project ini aplikasi apa?

Ini aplikasi untuk menyewakan alat berat. Ada dua sisi:

1. **Sisi pengunjung (publik)** — orang bisa lihat katalog alat berat,
   masuk ke detail, masukkan unit ke keranjang, lalu checkout (mengisi
   form pemesanan). Tidak perlu login.
2. **Sisi admin (harus login)** — mengelola data tipe, barang, unit,
   harga, spesifikasi, serta melihat dan mengubah status pemesanan yang
   masuk.

Istilah penting yang dipakai di project ini:

- **Tipe** — kategori alat berat (misalnya Excavator, Bulldozer).
- **Barang** — model/jenis alat (misalnya "Excavator Komatsu PC200").
  Satu barang punya satu tipe.
- **Unit** — wujud fisik barang yang bisa disewa. Satu barang bisa punya
  banyak unit (misalnya ada 3 unit Excavator PC200 dengan kode berbeda).
  Unit inilah yang punya status: `available`, `booked`, atau
  `maintenance`.
- **Spesifikasi** — detail teknis barang (key–value, contoh:
  "Tenaga" → "150 HP").
- **Harga Barang** — harga sewa per satuan waktu (per jam, hari, dll).
- **Pemesanan** — data pesanan dari customer setelah checkout.

---

## 2. Apa itu Laravel?

Laravel adalah **framework** PHP. Framework artinya kumpulan kode dan
aturan yang sudah disiapkan supaya kamu tidak menulis aplikasi dari nol.

Laravel memakai pola **MVC**:

- **Model** — mewakili data / tabel di database. Contoh: `Barang`, `Unit`.
- **View** — tampilan yang dilihat user (file HTML, di Laravel namanya
  Blade). Contoh: halaman katalog.
- **Controller** — "otak" yang menghubungkan keduanya. Dia menerima
  permintaan dari user, mengambil data lewat Model, lalu mengirimnya ke
  View.

Alur sederhananya:

```
User buka URL  ->  Route  ->  Controller  ->  Model (ambil data dari DB)
                                  |
                                  v
                          View (tampilan)  ->  dikirim balik ke browser User
```

Semua bagian itu ada di project ini, dan akan kita bahas satu per satu.

---

## 3. Struktur folder dan file

Saat pertama buka project, foldernya banyak dan bikin pusing. Tenang,
tidak semua perlu kamu sentuh. Ini yang penting:

```
rental-msi/
├── app/                  <- KODE UTAMA aplikasi (paling sering diedit)
│   ├── Http/
│   │   ├── Controllers/  <- Controller (logika tiap halaman/fitur)
│   │   └── Middleware/    <- "penjaga pintu" sebelum request masuk
│   ├── Models/           <- Model (perwakilan tabel database)
│   ├── Mail/             <- Class untuk kirim email
│   └── Providers/        <- Konfigurasi awal saat aplikasi start
│
├── routes/
│   ├── web.php           <- Daftar URL untuk web (PALING SERING dibuka)
│   ├── api.php           <- URL untuk API (tidak banyak dipakai di sini)
│   └── console.php       <- Perintah custom artisan
│
├── resources/
│   └── views/            <- File tampilan (Blade), ini "HTML"-nya Laravel
│
├── database/
│   ├── migrations/       <- "Cetakan" struktur tabel database
│   ├── seeders/          <- Pengisi data awal/contoh ke database
│   └── factories/        <- Pembuat data palsu untuk testing
│
├── public/               <- Pintu masuk web; file yang bisa diakses umum
│   ├── index.php         <- File pertama yang dijalankan browser
│   └── images/           <- Tempat menyimpan gambar barang yang diupload
│
├── config/               <- File pengaturan (database, mail, dll)
├── storage/              <- File hasil generate: log, cache, upload
├── vendor/               <- Library pihak ketiga (JANGAN diedit manual)
│
├── .env                  <- Pengaturan rahasia (database, dll) - PENTING
├── .env.example          <- Contoh .env untuk dicontek teman setim
├── composer.json         <- Daftar library PHP yang dipakai
├── package.json          <- Daftar library JavaScript (CSS/JS)
└── artisan               <- Alat baris perintah Laravel
```

Yang paling sering kamu sentuh saat ngoding fitur baru:
**`routes/web.php` → `app/Http/Controllers/` → `app/Models/` →
`resources/views/`**. Empat folder itu dulu yang dikuasai.

Folder seperti `vendor/`, `bootstrap/cache/`, dan `storage/` umumnya
tidak diedit tangan. `vendor/` isinya kode orang lain yang di-download
otomatis lewat Composer.

---

## 4. File `.env` itu apa?

`.env` (singkatan dari *environment*) adalah file **pengaturan rahasia**.
Isinya hal-hal yang beda di tiap komputer/server, misalnya:

- nama dan password database,
- alamat aplikasi,
- pengaturan email,
- kunci enkripsi aplikasi.

Kenapa dipisah ke file sendiri dan tidak ditulis langsung di kode?

1. **Keamanan.** Password tidak boleh ikut masuk ke Git (makanya `.env`
   masuk ke `.gitignore`, tidak ikut di-upload ke GitHub).
2. **Fleksibel.** Di laptopmu pakai database `rental_dev`, di server
   pakai `rental_produksi`. Kodenya sama, cukup `.env`-nya yang beda.

Contoh isi penting di project ini (lihat file `.env.example`):

```env
APP_NAME=Laravel          # nama aplikasi
APP_ENV=local             # sedang di mode lokal (development)
APP_KEY=                  # kunci enkripsi, diisi otomatis (lihat bawah)
APP_DEBUG=true            # true = error ditampilkan lengkap (untuk ngoding)
APP_URL=http://localhost  # alamat aplikasi

DB_CONNECTION=mysql       # jenis database yang dipakai
DB_HOST=127.0.0.1         # alamat database (di komputer sendiri)
DB_PORT=3306              # port MySQL
DB_DATABASE=laravel       # nama database
DB_USERNAME=root          # user database
DB_PASSWORD=              # password database (kosong di XAMPP default)

MAIL_MAILER=smtp          # pengaturan pengirim email
MAIL_HOST=mailpit
...
```

**Cara pakai untuk pemula:**

1. Saat pertama clone project ini, file `.env` mungkin belum ada.
   Copy dari contohnya:
   - Windows (Command Prompt): `copy .env.example .env`
   - Git Bash / Linux / Mac: `cp .env.example .env`
2. Sesuaikan bagian `DB_*` dengan database di komputermu.
3. Buat `APP_KEY` dengan perintah: `php artisan key:generate`.
   Tanpa key ini aplikasi akan error.

Cara membaca nilai `.env` di dalam kode Laravel: lewat fungsi `env()`
atau lebih disarankan lewat `config()`. Contoh nyata di project ini ada
di `CartController.php`:

```php
$adminEmail = config('mail.admin_address');
```

Itu mengambil nilai dari file `config/mail.php`, yang isinya menarik nilai
dari `.env`.

---

## 5. Routes — daftar URL aplikasi

File: `routes/web.php`

Route adalah "buku alamat" aplikasi. Dia menentukan: kalau user membuka
URL tertentu, fungsi controller mana yang dijalankan.

Bentuk dasarnya:

```php
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
```

Cara baca baris itu:

- `Route::get` — menangani permintaan dengan method **GET** (membuka
  halaman biasa). Selain `get`, ada `post` (kirim form), `put`/`patch`
  (update data), dan `delete` (hapus data).
- `'/login'` — URL yang ditangani.
- `[LoginController::class, 'showLoginForm']` — controller dan nama
  fungsi (method) yang dijalankan.
- `->name('login')` — memberi nama pada route. Berguna supaya di tempat
  lain kita bisa panggil `route('login')` daripada menulis URL `/login`
  manual. Kalau URL berubah, cukup ubah di sini.

### Route yang menarik di project ini

**Redirect halaman depan:**

```php
Route::redirect('/', '/katalog');
```

Saat user buka halaman utama `/`, langsung dilempar ke `/katalog`.

**Route yang butuh login (dikelompokkan):**

```php
Route::middleware(['auth'])->group(function () {
    Route::resource('tipes', TipeController::class);
    Route::resource('barangs', BarangController::class);
    // ... dan seterusnya
});
```

Semua route di dalam `group` ini dilindungi **middleware `auth`**.
Artinya: kalau belum login, tidak bisa masuk (otomatis dilempar ke
halaman login). Ini yang memisahkan area admin dari area publik.

**`Route::resource` — jalan pintas 7 route sekaligus:**

```php
Route::resource('barangs', BarangController::class);
```

Satu baris ini otomatis membuat 7 route standar untuk operasi CRUD
(Create, Read, Update, Delete):

| Method | URL                  | Fungsi controller | Gunanya                    |
|--------|----------------------|-------------------|----------------------------|
| GET    | /barangs             | index             | tampil semua data          |
| GET    | /barangs/create      | create            | tampil form tambah         |
| POST   | /barangs             | store             | simpan data baru           |
| GET    | /barangs/{id}        | show              | tampil 1 data              |
| GET    | /barangs/{id}/edit   | edit              | tampil form edit           |
| PUT    | /barangs/{id}        | update            | simpan perubahan           |
| DELETE | /barangs/{id}        | destroy           | hapus data                 |

Jadi kamu cukup membuat method-method itu di `BarangController`, dan
route-nya sudah jadi otomatis. Ini sangat menghemat penulisan.

**Route publik (tanpa login)**, ada di bagian bawah `web.php`:
katalog, detail katalog, keranjang, dan checkout. Sengaja diletakkan di
luar `group(['auth'])` supaya pengunjung biasa bisa mengaksesnya.

---

## 6. Controller — otak tiap fitur

Folder: `app/Http/Controllers/`

Controller menerima request, memprosesnya, lalu mengembalikan response
(biasanya sebuah View). Mari bedah controller yang ada.

### Contoh paling rapi: `BarangController.php`

Ini contoh CRUD standar. Perhatikan tiap method:

```php
public function index()
{
    $barangs = Barang::with('tipe')->get();
    return view('barangs.index', compact('barangs'));
}
```

- `Barang::with('tipe')->get()` — ambil semua barang dari database,
  sekalian ambil data tipe-nya (penjelasan `with` ada di bagian Model).
- `return view('barangs.index', compact('barangs'))` — tampilkan file
  view `resources/views/barangs/index.blade.php`, sambil mengirim
  variabel `$barangs` ke sana.
- `compact('barangs')` itu cara singkat menulis
  `['barangs' => $barangs]`.

```php
public function create()
{
    $tipes = Tipe::all();
    return view('barangs.create', compact('tipes'));
}
```

Menampilkan form tambah barang. Dia mengirim daftar `$tipes` supaya form
bisa menampilkan pilihan tipe (dropdown).

```php
public function store(Request $request)
{
    $validated = $request->validate([
        'nama_barang' => 'required|string|max:255',
        'tipe_id'     => 'required|exists:tipes,id',
        'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
    ]);

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images'), $filename);
        $validated['image'] = $filename;
    }

    Barang::create($validated);
    return redirect()->route('barangs.index');
}
```

Ini bagian penting, banyak konsep di sini:

- **`$request`** — objek berisi semua data yang dikirim user dari form.
- **Validasi** (`$request->validate([...])`) — memastikan data benar
  sebelum disimpan. Kalau gagal, Laravel otomatis kembali ke form dan
  menampilkan pesan error.
  - `required` = wajib diisi.
  - `string`, `max:255` = harus teks, maksimal 255 karakter.
  - `exists:tipes,id` = nilainya harus ada di tabel `tipes` kolom `id`
    (mencegah memilih tipe yang tidak ada).
  - `nullable` = boleh kosong.
  - `image|mimes:jpg,...|max:3072` = harus gambar, format tertentu,
    maksimal 3072 KB (3 MB).
- **Upload gambar**: kalau ada file dikirim, dibuatkan nama unik pakai
  `time()` dan `uniqid()` (supaya tidak bentrok dengan file lain), lalu
  dipindah ke folder `public/images`. Nama filenya disimpan ke database.
- **`Barang::create($validated)`** — menyimpan data baru ke database.
- **`redirect()->route('barangs.index')`** — setelah simpan, pindah ke
  halaman daftar barang.

Method `update()` mirip, bedanya: kalau ada gambar baru diupload, gambar
lama dihapus dulu dengan `unlink()` supaya tidak menumpuk sampah file.

```php
public function destroy(Barang $barang)
{
    if ($barang->image && file_exists(public_path('images/' . $barang->image))) {
        unlink(public_path('images/' . $barang->image));
    }
    $barang->delete();
    return back();
}
```

Perhatikan parameter `Barang $barang`. Ini namanya **Route Model
Binding**: Laravel otomatis mencari barang berdasarkan id di URL dan
langsung memberikannya sebagai objek. Kamu tidak perlu menulis
`Barang::find($id)` sendiri. `back()` artinya kembali ke halaman
sebelumnya.

### Logika bisnis nyata: `CartController.php`

Controller ini lebih kompleks dan menunjukkan banyak konsep Laravel di
dunia nyata.

**Keranjang disimpan di Session, bukan database:**

```php
public function addToCart(Request $request)
{
    $request->validate([
        'barang_id' => 'required|exists:barangs,id',
        'units'     => 'required|array',
        'units.*'   => 'exists:units,id'
    ]);

    $cart = session()->get('cart', []);
    // ... tambahkan unit ke $cart ...
    session()->put('cart', $cart);

    return back()->with('success', 'Unit berhasil ditambahkan ke keranjang!');
}
```

- **Session** adalah tempat menyimpan data sementara milik tiap
  pengunjung selama dia membuka website (mirip catatan yang nempel di
  pengunjung itu). Keranjang belanja cocok disimpan di sini karena belum
  perlu masuk database sampai user benar-benar checkout.
- `session()->get('cart', [])` — ambil isi keranjang, kalau belum ada
  pakai array kosong.
- `session()->put('cart', $cart)` — simpan kembali keranjang.
- `->with('success', '...')` — menitipkan pesan sukses yang akan tampil
  satu kali di halaman berikutnya (namanya *flash message*).
- `units.*` di validasi artinya "setiap elemen di dalam array units".

**Proses checkout dengan Database Transaction:**

```php
public function processCheckout(Request $request)
{
    $request->validate([
        'nama_pemesan'    => 'required|string|max:255',
        'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        'emails'          => 'required|email|max:255',
        // ...
    ]);

    DB::beginTransaction();
    try {
        $pemesanan = Pemesanan::create([... ]);

        foreach ($cartSession as $barangId => $cartData) {
            $detail = PemesananDetail::create([... ]);
            foreach ($cartData['units'] as $unitId) {
                PemesananUnit::create([... ]);
            }
        }

        DB::commit();
        // kirim email ke admin, kosongkan keranjang, redirect sukses
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('error', '... ' . $e->getMessage());
    }
}
```

Konsep penting di sini: **Database Transaction**.

Saat checkout, ada banyak data yang ditulis: 1 pemesanan, beberapa
detail, dan beberapa unit. Bayangkan kalau di tengah jalan terjadi error
(misalnya listrik mati). Bisa-bisa pemesanan tersimpan tapi detailnya
tidak — datanya jadi rusak/setengah jadi.

Transaction mencegah itu dengan prinsip "semua atau tidak sama sekali":

- `DB::beginTransaction()` — mulai transaksi.
- `DB::commit()` — kalau semua berhasil, simpan permanen.
- `DB::rollBack()` — kalau ada error (ditangkap oleh `catch`), batalkan
  SEMUA perubahan seakan tidak pernah terjadi.

Setelah berhasil, kode mengirim email notifikasi ke admin dan
mengosongkan keranjang dengan `session()->forget('cart')`.

`after_or_equal:tanggal_mulai` di validasi adalah contoh aturan yang
membandingkan antar field: tanggal selesai tidak boleh sebelum tanggal
mulai.

### Query pencarian dan filter: `KatalogController.php`

```php
$barangs = Barang::with('tipe')
    ->when($request->tipe_id, function ($q) use ($request) {
        $q->where('tipe_id', $request->tipe_id);
    })
    ->when($request->search, function ($q) use ($request) {
        $q->where(function ($query) use ($request) {
            $query->where('nama_barang', 'like', '%' . $request->search . '%')
                  ->orWhereHas('units', function ($q2) use ($request) {
                      $q2->where('kode_unit', 'like', '%' . $request->search . '%');
                  });
        });
    })
    ->latest()
    ->get();
```

Ini contoh **query builder** Laravel yang sangat berguna:

- `->when($kondisi, fungsi)` — jalankan bagian query HANYA kalau kondisi
  terpenuhi. Jadi filter tipe hanya aktif kalau user memilih tipe, dan
  pencarian hanya aktif kalau user mengetik sesuatu. Rapi, tanpa banyak
  `if`.
- `where('nama_barang', 'like', '%...%')` — mencari barang yang namanya
  mengandung kata kunci.
- `orWhereHas('units', ...)` — atau, barang yang punya unit dengan kode
  tertentu. Mencari lewat tabel relasi.
- `->latest()` — urutkan dari yang terbaru.
- `->get()` — eksekusi dan ambil hasilnya.

### Mengubah status pesanan + efek ke unit: `PemesananController.php`

```php
public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status'     => 'required|in:ongoing,confirmed,cancelled',
        'keterangan' => 'nullable|string'
    ]);

    $pemesanan = Pemesanan::with('details.units.unit')->findOrFail($id);
    $pemesanan->update([...]);

    $unitStatus = null;
    if ($newStatus === 'ongoing')        $unitStatus = 'booked';
    elseif ($newStatus === 'confirmed' || $newStatus === 'cancelled')
                                          $unitStatus = 'available';

    if ($unitStatus) {
        foreach ($pemesanan->details as $detail) {
            foreach ($detail->units as $pemesananUnit) {
                if ($pemesananUnit->unit) {
                    $pemesananUnit->unit->update(['status' => $unitStatus]);
                }
            }
        }
    }

    if (!empty($pemesanan->emails)) {
        Mail::to($pemesanan->emails)->send(new OrderStatusMail(...));
    }
    return redirect()->back()->with('success', '...');
}
```

Yang menarik dipelajari di sini:

- `in:ongoing,confirmed,cancelled` — status hanya boleh salah satu dari
  tiga nilai itu.
- `findOrFail($id)` — cari data; kalau tidak ketemu, otomatis tampilkan
  halaman error 404. Lebih aman daripada `find()` yang bisa mengembalikan
  null.
- **Logika bisnis nyata**: saat pesanan jadi `ongoing`, semua unit di
  dalamnya ditandai `booked` (tidak bisa disewa orang lain). Saat
  `confirmed`/`cancelled`, unit dikembalikan jadi `available`.
- `Pemesanan::with('details.units.unit')` — mengambil pemesanan beserta
  relasi bertingkat sekaligus (detail → unit pemesanan → data unit asli),
  supaya tidak query berkali-kali di dalam loop.
- Di akhir, sistem mengirim email ke customer memberitahu perubahan
  status.

Method `destroy()` di sini juga punya aturan bisnis: pemesanan hanya
boleh dihapus kalau statusnya masih `pending`.

### Login dan keamanan: `Auth/LoginController.php`

```php
public function login(Request $request)
{
    $credentials = $request->validate([
        'email'    => ['required', 'email'],
        'password' => ['required'],
    ]);

    // Batasi percobaan login (anti brute-force)
    $throttleKey = Str::transliterate(Str::lower($request->input('email')).'|'.$request->ip());
    if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
        $seconds = RateLimiter::availableIn($throttleKey);
        return back()->withErrors([...]);
    }

    if (Auth::attempt($credentials, $request->boolean('remember'))) {
        RateLimiter::clear($throttleKey);
        $request->session()->regenerate();
        return redirect()->intended('/tipes');
    }

    RateLimiter::hit($throttleKey);
    return back()->withErrors(['email' => 'Email atau password salah.'])->onlyInput('email');
}
```

Hal yang bagus dipelajari:

- `Auth::attempt($credentials)` — Laravel mengecek email & password ke
  database. Kalau cocok, user langsung dianggap login. Password di
  database tersimpan dalam bentuk terenkripsi (hash), Laravel yang
  mengurus pencocokannya.
- `RateLimiter` — membatasi maksimal 5 kali percobaan login. Ini
  melindungi dari serangan tebak password (brute-force).
- `session()->regenerate()` — membuat ulang session setelah login demi
  keamanan (mencegah session hijacking).
- `redirect()->intended('/tipes')` — kembalikan user ke halaman yang
  tadi mau dia buka sebelum dipaksa login; kalau tidak ada, ke `/tipes`.
- `withErrors([...])->onlyInput('email')` — kembali dengan pesan error
  dan tetap mengisi field email (supaya user tidak ketik ulang).

---

## 7. Model — perwakilan tabel database

Folder: `app/Models/`

Satu Model = satu tabel. Lewat Model, kamu bisa ambil/simpan/ubah data
tanpa menulis perintah SQL mentah. Sistem ini namanya **Eloquent ORM**.

Contoh paling sederhana, `Tipe.php`:

```php
class Tipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_tipe'
    ];

    public function barangs()
    {
        return $this->hasMany(Barang::class);
    }
}
```

### `$fillable` itu apa?

```php
protected $fillable = ['nama_tipe'];
```

`$fillable` adalah daftar kolom yang **boleh diisi secara massal** lewat
`create()` atau `update()`. Ini fitur keamanan bernama *mass assignment
protection*. Tujuannya: mencegah user nakal mengisi kolom yang tidak
seharusnya (misalnya mengubah kolom `is_admin` lewat form biasa).

Jadi kalau kamu menambah kolom baru di tabel tapi lupa memasukkannya ke
`$fillable`, data kolom itu tidak akan tersimpan walaupun dikirim. Ini
kesalahan yang sering bikin pemula bingung. Ingat-ingat ya.

### Relasi antar tabel

Ini kekuatan utama Eloquent. Di project ini relasinya begini:

```
Tipe  (1) ──< (banyak)  Barang
Barang (1) ──< (banyak)  Unit
Barang (1) ──< (banyak)  Spesifikasi
Barang (1) ──< (banyak)  HargaBarang

Pemesanan (1) ──< (banyak) PemesananDetail
PemesananDetail (1) ──< (banyak) PemesananUnit
PemesananUnit (banyak) >── (1) Unit
```

Diterjemahkan ke kode:

- Satu **Tipe** punya banyak **Barang** →
  `hasMany(Barang::class)` di model Tipe.
- Satu **Barang** dimiliki satu **Tipe** →
  `belongsTo(Tipe::class)` di model Barang.

```php
// Di Barang.php
public function tipe()    { return $this->belongsTo(Tipe::class); }   // 1 barang -> 1 tipe
public function units()   { return $this->hasMany(Unit::class); }     // 1 barang -> banyak unit
public function spesifikasis() { return $this->hasMany(Spesifikasi::class); }
public function hargaBarangs() { return $this->hasMany(HargaBarang::class); }
```

Dua aturan mudah mengingat mana `hasMany` mana `belongsTo`:

- Tabel yang **menyimpan kolom `xxx_id`** (foreign key) memakai
  `belongsTo`. Contoh: tabel `units` punya `barang_id`, jadi Unit
  `belongsTo` Barang.
- Tabel yang **dimiliki** memakai `hasMany`. Barang `hasMany` Unit.

Setelah relasi didefinisikan, kamu bisa mengaksesnya seperti properti
biasa:

```php
$barang->tipe->nama_tipe;   // nama tipe dari sebuah barang
$barang->units;             // koleksi semua unit milik barang itu
$tipe->barangs;             // semua barang dengan tipe itu
```

### `with()` dan masalah N+1

Di controller sering kamu lihat:

```php
Barang::with('tipe')->get();
$barang->load('tipe', 'units', 'spesifikasis', 'hargaBarangs');
```

`with()` namanya **eager loading**: mengambil data relasi sekaligus dalam
beberapa query saja. Tanpa ini, kalau kamu menampilkan 100 barang dan
mengakses `$barang->tipe` di tiap baris, Laravel akan menjalankan 1 query
untuk barang + 100 query untuk tipe (total 101 query). Ini disebut
**masalah N+1** dan bikin aplikasi lambat. `with('tipe')` membuatnya
cukup 2 query saja. Biasakan pakai `with()` saat akan menampilkan relasi
dalam jumlah banyak.

`load()` fungsinya sama, dipakai ketika objeknya sudah terlanjur diambil
(Route Model Binding) dan kamu mau menambahkan relasinya belakangan.

### `$casts`

Di `Pemesanan.php`:

```php
protected $casts = [
    'tanggal_mulai'  => 'date',
    'tanggal_selesai' => 'date',
];
```

`$casts` mengubah tipe data otomatis saat diambil dari database. `date`
membuat kolom tanggal jadi objek tanggal (Carbon), sehingga bisa
diformat mudah seperti `$pemesanan->tanggal_mulai->format('d/m/Y')`.

Di `User.php` ada `'password' => 'hashed'`, yang membuat password
otomatis dienkripsi saat disimpan.

---

## 8. Migration — membuat struktur tabel lewat kode

Folder: `database/migrations/`

Migration adalah cara membuat dan mengubah tabel database **lewat kode**,
bukan klik-klik di phpMyAdmin. Keuntungannya: struktur database ikut
tercatat di Git, jadi semua anggota tim punya struktur yang sama persis.

Contoh `create_units_table`:

```php
public function up(): void
{
    Schema::create('units', function (Blueprint $table) {
        $table->id();                                    // kolom id, auto increment
        $table->foreignId('barang_id')                   // kolom barang_id...
              ->constrained('barangs')                   // ...terhubung ke tabel barangs
              ->cascadeOnDelete();                        // kalau barang dihapus, unit ikut terhapus
        $table->string('kode_unit')->unique();           // teks, tidak boleh kembar
        $table->enum('status', ['available','booked','maintenance'])
              ->default('available');                     // pilihan terbatas, default available
        $table->timestamps();                            // kolom created_at & updated_at otomatis
    });
}

public function down(): void
{
    Schema::dropIfExists('units');                       // kebalikan dari up(): hapus tabel
}
```

Penjelasan:

- `up()` dijalankan saat migrasi diterapkan (membuat tabel).
- `down()` dijalankan saat migrasi dibatalkan (menghapus tabel).
- `foreignId(...)->constrained()` membuat **foreign key**, yaitu kolom
  yang menghubungkan ke tabel lain. Inilah yang membuat relasi Eloquent
  di bab sebelumnya bisa bekerja.
- `cascadeOnDelete()` adalah aturan bisnis: hapus barang → unit-unitnya
  ikut terhapus otomatis.

Perhatikan nama file migration diawali tanggal
(`2026_04_30_003134_...`). Laravel menjalankan migration berurutan
berdasarkan tanggal itu. Penting: tabel `barangs` harus dibuat sebelum
`units`, karena `units` mengacu padanya.

Perintah menjalankan migration:

```bash
php artisan migrate          # jalankan semua migration yang belum dijalankan
php artisan migrate:fresh    # hapus semua tabel lalu buat ulang dari nol
php artisan migrate:fresh --seed   # buat ulang + isi data contoh (seeder)
```

Catatan: `migrate:fresh` menghapus SEMUA data. Aman dipakai saat masih
development, jangan dipakai di server produksi yang ada data aslinya.

---

## 9. Seeder — mengisi data awal

Folder: `database/seeders/`

Seeder mengisi database dengan data contoh supaya kamu tidak perlu input
manual saat sedang ngembangin. Project ini punya seeder untuk tipe,
barang, unit, harga, user, dan pemesanan.

Jalankan dengan:

```bash
php artisan db:seed
```

Biasanya `DatabaseSeeder.php` memanggil seeder-seeder lain secara
berurutan.

---

## 10. View / Blade — tampilan

Folder: `resources/views/`

Blade adalah template engine Laravel. File-nya berakhiran `.blade.php`.
Isinya HTML biasa, tapi bisa disisipi kode PHP dengan sintaks yang lebih
pendek dan rapi.

### Sintaks Blade yang dipakai di project ini

Ambil dari `layouts/app.blade.php`:

**Menampilkan data:**

```blade
{{ session('success') }}
{{ asset('images/logonobg.png') }}
```

`{{ }}` menampilkan nilai sekaligus mengamankannya dari serangan XSS
(otomatis di-escape). `asset(...)` menghasilkan URL lengkap menuju file
di folder `public`.

**Perulangan:**

```blade
@foreach ($navItems as $item)
    <a href="{{ url($item['url']) }}">{{ $item['label'] }}</a>
@endforeach
```

**Kondisi:**

```blade
@if (session('success'))
    <div>{{ session('success') }}</div>
@endif

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
@endif
```

`$errors` otomatis tersedia di semua view; isinya pesan error dari
validasi yang gagal. Inilah yang menampilkan peringatan saat form salah
isi.

**Blok PHP langsung:**

```blade
@php
    $navItems = [
        ['url' => '/tipes', 'label' => 'Tipe'],
        // ...
    ];
@endphp
```

**Komentar Blade** (tidak ikut tampil di HTML):

```blade
{{-- ini komentar --}}
```

### Layout dan `@yield` / `@extends`

Daripada menulis ulang sidebar dan header di setiap halaman, project ini
memakai satu file kerangka: `layouts/app.blade.php`. Di dalamnya ada:

```blade
@yield('content')
```

`@yield('content')` adalah "lubang" tempat isi tiap halaman dimasukkan.
Halaman lain cukup menulis:

```blade
@extends('layouts.app')

@section('content')
    ... isi khusus halaman ini ...
@endsection
```

`@extends` artinya "pakai kerangka ini", dan `@section('content')`
mengisi lubang `@yield('content')`. Dengan begini sidebar cukup ditulis
sekali.

Ada juga `@stack('scripts')` di layout, pasangannya `@push('scripts')`
di halaman anak, untuk menyisipkan JavaScript khusus per halaman.

### Komponen Blade

Folder `resources/views/components/` berisi potongan tampilan yang bisa
dipakai ulang (misalnya bagian hero, footer, fleet di landing page).
Komponen dipanggil dengan tag mirip HTML, contohnya
`<x-landing.hero />`.

### CSRF token — `@csrf`

Perhatikan di setiap form ada:

```blade
<form method="POST" action="{{ url('/logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>
```

`@csrf` menambahkan token rahasia ke form. Laravel menolak form POST yang
tidak punya token ini. Gunanya melindungi dari serangan **CSRF**
(orang lain memaksa browser-mu mengirim form tanpa sepengetahuanmu). Kalau
kamu bikin form POST tapi lupa `@csrf`, akan muncul error "419 Page
Expired". Ini juga jebakan klasik pemula.

Untuk method PUT, PATCH, atau DELETE, HTML form tidak mendukung langsung,
jadi dipakai `@method('PUT')` di dalam form.

---

## 11. Middleware — penjaga pintu

Folder: `app/Http/Middleware/`

Middleware adalah kode yang dijalankan **sebelum** request sampai ke
controller. Ibarat satpam yang memeriksa tamu sebelum masuk ruangan.

Yang paling terasa di project ini adalah middleware `auth`:

```php
Route::middleware(['auth'])->group(function () {
    // semua route admin di sini
});
```

Middleware `auth` mengecek "apakah user sudah login?". Kalau belum,
request ditolak dan user dilempar ke halaman login sebelum sempat masuk
ke controller. Berkat ini, kamu tidak perlu mengecek login berulang kali
di setiap method controller.

Selain `auth`, ada middleware lain yang bekerja diam-diam di latar:
`VerifyCsrfToken` (mengecek `@csrf` tadi), `TrimStrings` (menghapus spasi
berlebih di input), dan lainnya. Sebagai pemula, kamu cukup paham konsep
dan middleware `auth` dulu.

---

## 12. Mail — mengirim email

Folder: `app/Mail/`

Project ini mengirim email di dua momen:

1. `AdminCheckoutNotification` — saat ada checkout baru, admin diberi
   tahu (lihat `CartController::processCheckout`).
2. `OrderStatusMail` — saat status pesanan diubah, customer diberi tahu
   (lihat `PemesananController::updateStatus`).

Cara memanggilnya:

```php
Mail::to($pemesanan->emails)->send(new OrderStatusMail($pemesanan, $newStatus, $keterangan));
```

Isi/tampilan email-nya ada di `resources/views/emails/`. Pengaturan
server email (host, port, dll) diambil dari `.env` bagian `MAIL_*`. Saat
development, biasanya dipakai Mailpit atau Mailtrap supaya email tidak
benar-benar terkirim ke orang asli.

---

## 13. Artisan — asisten baris perintah

`artisan` adalah alat command line bawaan Laravel. Dijalankan dari
terminal di dalam folder project dengan awalan `php artisan`.

Perintah yang paling sering dipakai pemula:

```bash
php artisan serve                 # menjalankan aplikasi di http://localhost:8000
php artisan migrate               # menjalankan migration
php artisan migrate:fresh --seed  # reset database + isi data contoh
php artisan db:seed               # isi data contoh saja
php artisan key:generate          # membuat APP_KEY di .env

# Membuat file otomatis (biar tidak ketik manual):
php artisan make:controller NamaController
php artisan make:model NamaModel
php artisan make:migration create_nama_table

php artisan route:list            # melihat semua route yang terdaftar
php artisan tinker                # ruang coba-coba menjalankan kode Laravel
```

`route:list` sangat membantu untuk melihat semua URL aplikasi beserta
controller-nya dalam satu tabel.

---

## 14. Install Laravel dari nol (membuat project baru)

Bagian ini berbeda dengan bab berikutnya. Di sini kita bahas cara membuat
project Laravel **baru dari kosong** (misalnya kamu mau bikin aplikasi
sendiri untuk latihan). Sedangkan Bab 15 membahas cara menjalankan
project rental MSI ini yang sudah jadi.

Inti yang perlu dipahami dulu: Laravel itu **tidak di-install seperti
aplikasi biasa** (tidak ada file installer .exe yang tinggal next-next).
Laravel "diunduh dan dirakit" oleh sebuah alat bernama **Composer**. Jadi
sebelum bisa bikin Laravel, komputermu harus punya beberapa alat dulu.

### Langkah 1: Siapkan alat yang dibutuhkan (prasyarat)

Laravel butuh tiga hal ini terpasang di komputer:

1. **PHP** (versi 8.1 ke atas untuk project ini) — bahasa pemrogramannya.
2. **Composer** — pengatur library PHP. Ini yang akan mengunduh Laravel.
3. **Database** — umumnya MySQL.

Cara paling mudah untuk pemula (Windows): install **Laragon** atau
**XAMPP**. Sekali install, kamu langsung dapat PHP + MySQL sekaligus.
Laragon lebih disarankan karena lebih ringan dan sudah include Composer.

Untuk bagian frontend (CSS/JS) nantinya juga butuh **Node.js**, tapi itu
bisa menyusul.

**Cek apakah alatnya sudah ada.** Buka terminal (CMD / PowerShell /
Git Bash) lalu ketik satu per satu:

```bash
php -v          # harus muncul versi PHP, misal PHP 8.2.x
composer -V     # harus muncul versi Composer
node -v         # harus muncul versi Node (opsional, untuk aset frontend)
```

Kalau perintahnya tidak dikenali ("not recognized"), berarti alat itu
belum terpasang atau belum masuk ke PATH. Selesaikan ini dulu sebelum
lanjut. Tanpa PHP dan Composer, Laravel tidak bisa dibuat.

> Catatan soal Composer: kalau belum punya, unduh installer-nya di
> https://getcomposer.org/download. Saat install, dia akan minta lokasi
> php.exe — arahkan ke PHP milik Laragon/XAMPP (contoh:
> `C:\laragon\bin\php\php-8.2\php.exe`).

### Langkah 2: Buat project Laravel baru

Ada dua cara. Keduanya menghasilkan hasil yang sama, pilih salah satu.

**Cara A — pakai Composer langsung (paling umum, tidak perlu setup
tambahan):**

```bash
composer create-project laravel/laravel nama-project-ku
```

Ganti `nama-project-ku` dengan nama yang kamu mau. Composer akan mengunduh
kerangka Laravel beserta semua library-nya ke dalam folder itu. Proses ini
butuh koneksi internet dan agak lama saat pertama kali (mengunduh isi
folder `vendor/`).

Untuk membuat versi Laravel yang sama persis dengan project ini (Laravel
10), tambahkan versinya:

```bash
composer create-project laravel/laravel:^10.0 nama-project-ku
```

**Cara B — pakai Laravel Installer:**

```bash
composer global require laravel/installer   # cukup sekali seumur hidup
laravel new nama-project-ku
```

Cara B butuh sedikit setup PATH tambahan, jadi untuk pemula Cara A
biasanya lebih bebas masalah.

### Langkah 3: Masuk ke folder dan cek isinya

```bash
cd nama-project-ku
```

Saat ini kamu sudah punya struktur folder Laravel yang sama persis seperti
yang dijelaskan di Bab 3 (ada `app/`, `routes/`, `resources/`, dan
seterusnya). Yang membedakan project ini dengan project barumu hanyalah
isi controller, model, dan view-nya. Kerangkanya identik.

Beberapa hal yang **sudah otomatis dilakukan** saat `create-project`:

- File `.env` sudah dibuatkan otomatis (disalin dari `.env.example`).
- `APP_KEY` sudah otomatis di-generate.

Jadi untuk project baru, dua langkah itu tidak perlu kamu lakukan manual.

### Langkah 4: Atur database

Buka file `.env`, sesuaikan bagian database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database_ku   # buat database kosong ini dulu di phpMyAdmin
DB_USERNAME=root
DB_PASSWORD=                    # kosong kalau pakai XAMPP/Laragon default
```

Lalu buat database kosong dengan nama yang sama lewat phpMyAdmin (atau
Adminer di Laragon). Setelah itu jalankan migration untuk membuat tabel
bawaan:

```bash
php artisan migrate
```

Kalau muncul pertanyaan konfirmasi membuat database, jawab yes.

### Langkah 5: Jalankan (serve)

```bash
php artisan serve
```

Akan muncul pesan seperti:

```
INFO  Server running on [http://127.0.0.1:8000].
```

Buka alamat itu di browser. Kalau muncul halaman selamat datang Laravel,
berarti instalasi berhasil. Selamat, kamu sudah punya aplikasi Laravel
yang berjalan.

Untuk menghentikan server, tekan `Ctrl + C` di terminal.

### Ringkasan urutan untuk project baru

```bash
composer create-project laravel/laravel nama-project-ku
cd nama-project-ku
# atur DB di file .env, lalu buat database kosongnya
php artisan migrate
php artisan serve
```

Itu saja. Dari sinilah semua project Laravel bermula, termasuk project
rental MSI ini. Bedanya, project ini sudah diisi banyak controller, model,
dan view oleh pembuatnya. Cara menjalankan project yang sudah jadi seperti
ini ada di bab berikutnya.

---

## 15. Cara menjalankan project ini dari nol

Bab sebelumnya membuat project Laravel **baru**. Bab ini berbeda: kamu
sudah dapat project rental MSI ini (misalnya hasil clone dari Git atau
diberi temanmu), tinggal menjalankannya. Karena folder `vendor/` dan file
`.env` biasanya tidak ikut dibagikan (sengaja, lihat Bab 4), ada beberapa
langkah yang harus kamu lakukan sendiri.

Langkah-langkahnya:

```bash
# 1. Masuk ke folder project
cd rental-msi

# 2. Install library PHP (folder vendor akan dibuat)
composer install

# 3. Siapkan file .env
copy .env.example .env        # Windows
# cp .env.example .env        # Mac/Linux/Git Bash

# 4. Buat kunci aplikasi
php artisan key:generate

# 5. Atur DB_DATABASE, DB_USERNAME, DB_PASSWORD di .env
#    lalu buat database kosong dengan nama yang sama lewat phpMyAdmin

# 6. Buat tabel + isi data contoh
php artisan migrate:fresh --seed

# 7. (opsional) Install & build aset frontend
npm install
npm run dev

# 8. Jalankan aplikasi
php artisan serve
```

Lalu buka `http://localhost:8000` di browser. Halaman utama akan otomatis
diarahkan ke `/katalog`.

Untuk masuk ke area admin, buka `/login`. Cek `database/seeders/UserSeeder.php`
untuk mengetahui email & password admin yang sudah disiapkan.

---

## 16. Ringkasan alur satu fitur (biar nyambung semua)

Supaya semua konsep di atas terhubung, ikuti alur saat pengunjung
menyewa alat:

1. Pengunjung buka `/katalog`.
   → **Route** `units.katalog` memanggil `KatalogController@katalog`.
2. Controller mengambil data lewat **Model** `Barang` dan `Tipe`
   (pakai `with()` agar efisien), mendukung **filter & pencarian**.
3. Data dikirim ke **View** `landing-page/katalog/katalog.blade.php`
   untuk ditampilkan.
4. Pengunjung klik salah satu barang → `KatalogController@showByBarang`
   menampilkan detail beserta unit, spesifikasi, dan harga (relasi).
5. Pengunjung memilih unit dan menekan "tambah ke keranjang"
   → `CartController@addToCart` menyimpannya ke **Session**.
6. Pengunjung checkout, mengisi form → `CartController@processCheckout`
   memvalidasi data, lalu menyimpan ke database dalam satu
   **Transaction** (Pemesanan + Detail + Unit), mengirim **email** ke
   admin, dan mengosongkan keranjang.
7. Admin login (**middleware auth**), membuka daftar pemesanan, dan
   mengubah statusnya → `PemesananController@updateStatus` ikut mengubah
   status unit (`booked`/`available`) dan mengirim email ke customer.

Kalau kamu sudah paham alur ini dari ujung ke ujung, berarti kamu sudah
menguasai inti cara kerja Laravel. Sisanya tinggal memperbanyak latihan.

---

## 17. Saran belajar lanjutan

- Coba tambah satu fitur kecil sendiri, misalnya kolom baru di tabel
  barang. Latihan: buat migration → tambah ke `$fillable` → tambah di
  form view → tambah di validasi controller. Empat langkah ini adalah
  pola yang akan terus kamu ulang.
- Saat error, baca pesan errornya pelan-pelan. Karena `APP_DEBUG=true`,
  Laravel menampilkan error dengan sangat detail termasuk baris yang
  bermasalah.
- Buka dokumentasi resmi di https://laravel.com/docs — pilih versi 10
  (sesuai project ini, lihat `composer.json`).
- Jangan hafal, tapi pahami alurnya. Setiap kali bingung, balik lagi ke
  bagan di Bab 2 dan Bab 15.

Selamat belajar. Pelan-pelan saja, yang penting paham, bukan cepat.
