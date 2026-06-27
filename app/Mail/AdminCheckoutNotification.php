<?php
namespace App\Mail;                              // alamat class email

use App\Models\Pemesanan;                         // model Pemesanan (datanya dikirim ke email)
use Illuminate\Bus\Queueable;                     // sifat agar email bisa diantrekan
use Illuminate\Contracts\Queue\ShouldQueue;       // (di-import; class ini tidak pakai antrean langsung)
use Illuminate\Mail\Mailable;                     // class dasar email
use Illuminate\Mail\Mailables\Content;            // untuk menentukan isi/view email
use Illuminate\Mail\Mailables\Envelope;           // untuk "amplop": subjek, dll
use Illuminate\Queue\SerializesModels;            // agar model aman dibawa proses email

// Email yang dikirim ke ADMIN setiap ada pesanan baru masuk (saat checkout).
class AdminCheckoutNotification extends Mailable
{
    use Queueable, SerializesModels;              // memakai dua sifat di atas

    public $pemesanan;                            // penampung data pemesanan

    public function __construct(Pemesanan $pemesanan) // dipanggil saat email dibuat
    {
        $pemesanan->load('details.barang');       // muat relasi detail + barang agar bisa ditampilkan di email

        $this->pemesanan = $pemesanan;            // simpan ke properti
    }

    public function envelope(): Envelope          // mengatur "amplop" email
    {
        return new Envelope(
            subject: 'Pesanan Baru Masuk - ' . $this->pemesanan->nama_pemesan, // subjek + nama pemesan
        );
    }

    public function content(): Content            // menentukan isi email
    {
        return new Content(
            view: 'emails.admin_checkout',        // pakai view resources/views/emails/admin_checkout.blade.php
        );
    }
}
