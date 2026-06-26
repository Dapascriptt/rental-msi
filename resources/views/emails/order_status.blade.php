<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Status Pesanan</title>
    <style>
        body { margin: 0; padding: 0; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #f8fafc; color: #475569; line-height: 1.6; }
        .wrapper { width: 100%; background-color: #f8fafc; padding: 40px 0; }
        .container { max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 1.5rem; overflow: hidden; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); }
        .header { background-color: #0f172a; padding: 40px; text-align: center; }
        .title { font-size: 24px; font-weight: bold; color: #ffffff; margin: 0; }
        .content { padding: 40px; }
        .greeting { font-size: 18px; color: #0f172a; font-weight: bold; margin-bottom: 16px; }
        
        /* Status Badge Style */
        .status-box { padding: 16px; border-radius: 0.75rem; text-align: center; margin-bottom: 24px; font-weight: bold; font-size: 18px; }
        .status-ongoing { background-color: #fff7ed; color: #ea580c; border: 1px solid #fed7aa; }
        .status-confirmed { background-color: #f0fdf4; color: #16a34a; border: 1px solid #bbf7d0; }
        .status-cancelled { background-color: #fef2f2; color: #dc2626; border: 1px solid #fecaca; }
        
        /* Notes Style */
        .note-box { background-color: #f1f5f9; border-left: 4px solid #3b82f6; padding: 16px; margin-bottom: 24px; border-radius: 0 0.5rem 0.5rem 0; }
        .note-title { font-size: 12px; font-weight: bold; text-transform: uppercase; color: #64748b; margin-bottom: 8px; }
        .note-content { margin: 0; color: #334155; font-size: 14px; }
        
        .footer { background-color: #f1f5f9; padding: 24px; text-align: center; }
        .footer p { color: #64748b; font-size: 12px; margin: 0; }
        .btn { display: inline-block; background-color: #ea580c; color: #ffffff; padding: 12px 24px; text-decoration: none; border-radius: 0.5rem; font-weight: bold; margin-top: 16px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="header">
                <h1 class="title">Informasi Pesanan</h1>
            </div>

            <div class="content">
                <div class="greeting">Halo, {{ $pemesanan->nama_pemesan }}</div>
                <p>Berikut adalah informasi terbaru mengenai permintaan penyewaan unit Anda pada tanggal {{ \Carbon\Carbon::parse($pemesanan->created_at)->translatedFormat('d F Y') }}.</p>

                @php
                    $statusClass = '';
                    $statusText = '';
                    if($newStatus == 'ongoing') { $statusClass = 'status-ongoing'; $statusText = 'Sedang Diproses'; }
                    elseif($newStatus == 'confirmed') { $statusClass = 'status-confirmed'; $statusText = 'Selesai / Dikonfirmasi'; }
                    elseif($newStatus == 'cancelled') { $statusClass = 'status-cancelled'; $statusText = 'Dibatalkan'; }
                @endphp

                <div class="status-box {{ $statusClass }}">
                    Status Saat Ini: {{ $statusText }}
                </div>

                @if(!empty($keterangan))
                <div class="note-box">
                    <div class="note-title">Pesan dari Tim Kami:</div>
                    <p class="note-content">{{ $keterangan }}</p>
                </div>
                @endif

                <p style="font-size: 14px;">Jika Anda memiliki pertanyaan lebih lanjut, silakan balas email ini atau hubungi tim *support* kami.</p>
                
                <div style="text-align: center;">
                    <a href="{{ url('/') }}" class="btn">Kembali ke Beranda</a>
                </div>
            </div>

            <div class="footer">
                <p>&copy; {{ date('Y') }} PT. Multiply Sarana Indotama. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>
</html>