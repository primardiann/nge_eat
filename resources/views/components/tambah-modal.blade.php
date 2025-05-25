<div id="transactionTambahModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
  <div class="bg-white rounded-md shadow-md p-6 w-full max-w-xl">
    <h2 class="text-xl font-semibold mb-4 border-b pb-2" style="border-color: #F58220;">Tambah Transaksi</h2>

    <div class="grid grid-cols-2 gap-x-6 gap-y-4 text-sm text-gray-700">
      <div>
        <p class="mb-1">Tanggal</p>
        <input type="date" placeholder="" class="border rounded-sm px-2 py-1 w-full bg-white shadow-sm" style="border-color: #F58220;">
      </div>
      <div>
        <p class="mb-1">Waktu</p>
        <input type="text" placeholder="" class="border rounded-sm px-2 py-1 w-full bg-white shadow-sm" style="border-color: #F58220;">
      </div>
      <div>
        <p class="mb-1">ID Pesanan</p>
        <input type="text" placeholder="" class="border rounded-sm px-2 py-1 w-full bg-white shadow-sm" style="border-color: #F58220;">
      </div>
      <div>
        <p class="mb-1">Nama Pelanggan</p>
        <input type="text" placeholder="" class="border rounded-sm px-2 py-1 w-full bg-white shadow-sm" style="border-color: #F58220;">
      </div>
      <div class="col-span-2">
        <p class="mb-1">Item Pesanan</p>
        <textarea rows="2" placeholder="Contoh: 1 Ayam geprek, 1 teh manis" class="border rounded-sm px-2 py-1 w-full bg-white shadow-sm" style="border-color: #F58220;"></textarea>
      </div>
      <div>
        <p class="mb-1">Total</p>
        <input type="text" placeholder="" class="border rounded-sm px-2 py-1 w-full bg-white shadow-sm" style="border-color: #F58220;">
      </div>
      <div>
        <p class="mb-1">Metode Pembayaran</p>
        <input type="text" placeholder="" class="border rounded-sm px-2 py-1 w-full bg-white shadow-sm" style="border-color: #F58220;">
      </div>
      <div class="col-span-2">
        <label class="inline-flex items-center space-x-2 mt-2">
          <input type="checkbox" class="form-checkbox text-green-600" />
          <span>Sukses / Berhasil</span>
        </label>
      </div>
    </div>

    <div class="mt-6 flex justify-between items-center">
      <a href="#" onclick="resetTambahTransaksiModal()" class="text-sm text-blue-600 underline">Atur Ulang</a>
      <div>
        <button onclick="closeTambahModal()" class="bg-red-700 hover:bg-red-800 text-white px-4 py-1.5 rounded shadow mr-2">Batal</button>
        <button onclick="showBerhasilTambah()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-1.5 rounded shadow">Tambah</button>
      </div>
    </div>
  </div>
</div>

<script> 

  function resetTambahTransaksiModal() {
    const modal = document.getElementById("transactionTambahModal");
    const inputs = modal.querySelectorAll("input[type='text'], textarea");
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

