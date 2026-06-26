<form method="POST" action="{{ route('pemesanan.store') }}">
    @csrf

    <h3>Data Pemesan</h3>
    <input name="nama_pemesan" placeholder="Nama">
    <input name="no_hp" placeholder="No HP">

    <h3>Item</h3>

    <select name="items[0][barang_id]">
        @foreach($barangs as $barang)
            <option value="{{ $barang->id }}">{{ $barang->nama_barang }}</option>
        @endforeach
    </select>

    <input name="items[0][qty]" placeholder="Qty">
    <input name="items[0][harga]" placeholder="Harga">
    
    <select name="items[0][satuan]">
        <option value="hari">Hari</option>
        <option value="minggu">Minggu</option>
    </select>

    <input name="items[0][durasi]" placeholder="Durasi">

    <button type="submit">Simpan</button>
</form>