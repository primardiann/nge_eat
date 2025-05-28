<div id="transactionTambahModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
  <div class="bg-white rounded-md shadow-md p-6 w-full max-w-xl">
    <h2 class="text-xl font-semibold mb-4 border-b pb-2" style="border-color: #F58220;">Tambah Transaksi</h2>

    <form action="{{ route('gofood.store') }}" method="POST">
      @csrf

      <div class="grid grid-cols-2 gap-x-6 gap-y-4 text-sm text-gray-700">
        <div>
          <label for="tanggal" class="mb-1 block">Tanggal</label>
          <input id="tanggal" name="tanggal" type="date" class="border rounded-sm px-2 py-1 w-full bg-white shadow-sm" style="border-color: #F58220;">
        </div>
        <div>
          <label for="waktu" class="mb-1 block">Waktu</label>
          <input id="waktu" name="waktu" type="time" class="border rounded-sm px-2 py-1 w-full bg-white shadow-sm" style="border-color: #F58220;">
        </div>
        <div>
          <label for="id_pesanan" class="mb-1 block">ID Pesanan</label>
          <input id="id_pesanan" name="id_pesanan" type="text" class="border rounded-sm px-2 py-1 w-full bg-white shadow-sm" style="border-color: #F58220;">
        </div>
        <div>
          <label for="nama_pelanggan" class="mb-1 block">Nama Pelanggan</label>
          <input id="nama_pelanggan" name="nama_pelanggan" type="text" class="border rounded-sm px-2 py-1 w-full bg-white shadow-sm" style="border-color: #F58220;">
        </div>
        <div class="col-span-2">
          <label for="item_pesanan" class="mb-1 block">Item Pesanan</label>
          <textarea id="item_pesanan" name="item_pesanan" rows="2" placeholder="Contoh: 1 Ayam geprek, 1 teh manis" class="border rounded-sm px-2 py-1 w-full bg-white shadow-sm" style="border-color: #F58220;"></textarea>
        </div>
        <div>
          <label for="total" class="mb-1 block">Total</label>
          <input id="total" name="total" type="number" class="border rounded-sm px-2 py-1 w-full bg-white shadow-sm" style="border-color: #F58220;">
        </div>
        <div>
          <label for="metode_pembayaran" class="mb-1 block">Metode Pembayaran</label>
          <input id="metode_pembayaran" name="metode_pembayaran" type="text" class="border rounded-sm px-2 py-1 w-full bg-white shadow-sm" style="border-color: #F58220;">
        </div>
        <div class="col-span-2">
          <label class="inline-flex items-center space-x-2 mt-2">
            <input type="checkbox" name="status" class="form-checkbox text-green-600" />
            <span>Sukses / Berhasil</span>
          </label>
        </div>
      </div>

      <div class="mt-6 flex justify-between items-center">
        <a href="#" onclick="resetTambahTransaksiModal()" class="text-sm text-blue-600 underline">Atur Ulang</a>
        <div>
          <button type="button" onclick="closeTambahModal()" class="bg-red-700 hover:bg-red-800 text-white px-4 py-1.5 rounded shadow mr-2">Batal</button>
          <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-1.5 rounded shadow">Tambah</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
  function resetTambahTransaksiModal() {
    const modal = document.getElementById("transactionTambahModal");
    const inputs = modal.querySelectorAll("input[type='text'], input[type='date'], input[type='time'], input[type='number'], textarea");
    const checkboxes = modal.querySelectorAll("input[type='checkbox']");

    inputs.forEach(input => input.value = "");
    checkboxes.forEach(checkbox => checkbox.checked = false);
  }

  function showBerhasilTambah() {
    // Sembunyikan modal tambah
    closeTambahModal();
    // Tampilkan modal berhasil
    document.getElementById("BerhasilTambahModal").classList.remove("hidden");
  }
</script>
