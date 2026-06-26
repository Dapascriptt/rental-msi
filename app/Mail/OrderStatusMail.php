<?php
namespace App\Mail;

use App\Models\Pemesanan;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderStatusMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $pemesanan;
    public $newStatus;
    public $keterangan;

    public function __construct(Pemesanan $pemesanan, $newStatus, $keterangan = null)
    {
        $this->pemesanan = $pemesanan;
        $this->newStatus = $newStatus;
        $this->keterangan = $keterangan;
    }

    public function envelope(): Envelope
    {
        $statusId = match($this->newStatus) {
            'ongoing' => 'Sedang Diproses',
            'confirmed' => 'Selesai / Dikonfirmasi',
            'cancelled' => 'Dibatalkan',
            default => strtoupper($this->newStatus),
        };

       return new Envelope(
            from: new Address(config('mail.address_reply'), 'MSI Support System'),
            replyTo: [
                new Address(config('mail.address_reply'), 'MSI Support'),
            ],
            subject: "Update Pesanan Anda: {$statusId}",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.order_status', 
        );
    }
}