<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Baru Masuk</title>
    <style>
        body { margin: 0; padding: 0; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #f8fafc; color: #475569; line-height: 1.6; -webkit-font-smoothing: antialiased; }
        .wrapper { width: 100%; background-color: #f8fafc; padding: 40px 0; }
        .container { max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 1.5rem; overflow: hidden; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); }
        
        .header { background-color: #0f172a; padding: 40px; text-align: left; }
        .badge { color: #ea580c; font-weight: bold; text-transform: uppercase; letter-spacing: 0.3em; font-size: 12px; margin-bottom: 12px; display: block; }
        .title { font-size: 28px; font-weight: bold; color: #ffffff; margin: 0; line-height: 1.3; }
        .title span { color: #94a3b8; }
        
        .content { padding: 40px; }
        .intro { font-size: 16px; margin-bottom: 32px; color: #334155; }
        
        .card { background-color: #f8fafc; border: 1px solid #f1f5f9; border-radius: 1rem; padding: 24px; margin-bottom: 24px; }
        .card:hover { border-color: #fed7aa; }
        .card-title { font-size: 14px; font-weight: bold; color: #0f172a; margin-bottom: 16px; text-transform: uppercase; border-bottom: 2px solid #ea580c; padding-bottom: 8px; display: inline-block; }
        
        .row { margin-bottom: 12px; font-size: 14px; display: block; }
        .label { font-weight: 600; color: #0f172a; display: inline-block; width: 140px; vertical-align: top; }
        .value { color: #475569; display: inline-block; width: calc(100% - 150px); vertical-align: top; }
        
        .item-list { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .item-list th { text-align: left; padding: 12px; background-color: #f1f5f9; color: #0f172a; font-size: 12px; text-transform: uppercase; border-radius: 8px 8px 0 0; }
        .item-list td { padding: 16px 12px; border-bottom: 1px solid #f1f5f9; font-size: 14px; color: #475569; }
        .item-list td strong { color: #0f172a; }
        
        .footer { background-color: #0f172a; padding: 24px; text-align: center; }
        .footer p { color: #94a3b8; font-size: 12px; margin: 0; }
        .footer .highlight { color: #fb923c; font-weight: bold; letter-spacing: 0.1em; text-transform: uppercase; margin-bottom: 8px; display: block; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <!-- Header -->
            <div class="header">
                <span class="badge">Notification System</span>
                <h1 class="title">Pesanan <span>Baru</span><br>Telah Masuk</h1>
            </div>

            <!-- Content -->
            <div class="content">
                <p class="intro">
                    Sistem mendeteksi adanya permintaan penyewaan unit baru. Berikut adalah rincian data klien dan pesanan yang memerlukan tindak lanjut:
                </p>

                <!-- Informasi Klien -->
                <div class="card">
                    <div class="card-title">Informasi Klien</div>
                    <div class="row">
                        <span class="label">Nama Pemesan</span>
                        <span class="value">{{ $pemesanan->nama_pemesan }}</span>
                    </div>
                    <div class="row">
                        <span class="label">Perusahaan</span>
                        <span class="value">{{ $pemesanan->perusahaan ?? '-' }}</span>
                    </div>
                    <div class="row">
                        <span class="label">No. Handphone</span>
                        <span class="value"><strong>{{ $pemesanan->no_hp }}</strong></span>
                    </div>
                    <div class="row">
                        <span class="label">Alamat</span>
                        <span class="value">{{ $pemesanan->alamat }}</span>
                    </div>
                     <div class="row">
                        <span class="label">Email</span>
                        <span class="value">{{ $pemesanan->emails }}</span>
                    </div>
                </div>

                <!-- Informasi Durasi -->
                <div class="card">
                    <div class="card-title">Durasi Sewa</div>
                    <div class="row">
                        <span class="label">Tanggal Mulai</span>
                        <span class="value">{{ \Carbon\Carbon::parse($pemesanan->tanggal_mulai)->translatedFormat('d F Y') }}</span>
                    </div>
                    <div class="row">
                        <span class="label">Tanggal Selesai</span>
                        <span class="value">{{ \Carbon\Carbon::parse($pemesanan->tanggal_selesai)->translatedFormat('d F Y') }}</span>
                    </div>
                </div>

                <!-- Rincian Unit  -->
                @if($pemesanan->relationLoaded('details') && $pemesanan->details->count() > 0)
                <div class="card" style="padding-bottom: 8px;">
                    <div class="card-title">Rincian Unit</div>
                    <table class="item-list">
                        <tr>
                            <th>Item / Barang</th>
                            <th>Qty</th>
                        </tr>
                        @foreach($pemesanan->details as $detail)
                        <tr>
                            <td>
                                <strong>{{ $detail->barang->nama_barang ?? 'Unknown Item' }}</strong><br>
                                <span style="font-size: 12px; color: #94a3b8;">{{ $detail->satuan }}</span>
                            </td>
                            <td>{{ $detail->qty }} Unit</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                @endif
                
            </div>

            <!-- Footer -->
            <div class="footer">
                <span class="highlight">Reliable. Accountable.</span>
                <p>Internal Notification System &copy; {{ date('Y') }}</p>
            </div>
        </div>
    </div>
</body>
</html>