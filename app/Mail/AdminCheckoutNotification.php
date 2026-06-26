<?php
namespace App\Mail;

use App\Models\Pemesanan;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminCheckoutNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $pemesanan;

    public function __construct(Pemesanan $pemesanan)
    {
        $pemesanan->load('details.barang'); 
        
        $this->pemesanan = $pemesanan;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pesanan Baru Masuk - ' . $this->pemesanan->nama_pemesan,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.admin_checkout', 
        );
    }
}