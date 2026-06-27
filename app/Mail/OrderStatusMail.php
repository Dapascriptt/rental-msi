<?php
namespace App\Mail;                              // alamat class email

use App\Models\Pemesanan;                         // model Pemesanan, datanya dipakai di email
use Illuminate\Bus\Queueable;                     // sifat agar email bisa diantrekan
use Illuminate\Contracts\Queue\ShouldQueue;       // penanda email dikirim lewat antrean (queue)
use Illuminate\Mail\Mailable;                     // class dasar untuk email
use Illuminate\Mail\Mailables\Address;            // untuk menyusun alamat pengirim
use Illuminate\Mail\Mailables\Content;            // untuk menentukan isi/view email
use Illuminate\Mail\Mailables\Envelope;           // untuk "amplop": subjek, pengirim, dll
use Illuminate\Queue\SerializesModels;            // sifat agar model aman dibawa ke antrean

class OrderStatusMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;              // memakai dua sifat di atas

    public $pemesanan;                            // variabel penampung data pemesanan
    public $newStatus;                            // status baru pesanan
    public $keterangan;                           // catatan tambahan (opsional)

    // constructor: dipanggil saat email dibuat, mengisi variabel di atas
    public function __construct(Pemesanan $pemesanan, $newStatus, $keterangan = null)
    {
        $this->pemesanan = $pemesanan;            // simpan data pemesanan
        $this->newStatus = $newStatus;            // simpan status baru
        $this->keterangan = $keterangan;          // simpan keterangan
    }

    public function envelope(): Envelope          // mengatur "amplop" email
    {
        $statusId = match($this->newStatus) {     // ubah kode status jadi teks yang ramah dibaca
            'ongoing' => 'Sedang Diproses',
            'confirmed' => 'Selesai / Dikonfirmasi',
            'cancelled' => 'Dibatalkan',
            default => strtoupper($this->newStatus), // jika tak cocok, tampilkan huruf besar saja
        };

       return new Envelope(
            from: new Address(config('mail.address_reply'), 'MSI Support System'), // alamat pengirim (dari config/.env)
            replyTo: [
                new Address(config('mail.address_reply'), 'MSI Support'),          // alamat balasan
            ],
            subject: "Update Pesanan Anda: {$statusId}",                            // subjek email
        );
    }

    public function content(): Content            // menentukan isi email
    {
        return new Content(
            view: 'emails.order_status',          // pakai view resources/views/emails/order_status.blade.php
        );
    }
}
