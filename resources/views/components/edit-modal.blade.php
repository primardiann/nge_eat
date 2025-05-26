<div id="transactionEditModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
  <div class="bg-white rounded-md shadow-md p-6 w-full max-w-xl">
    <h2 class="text-xl font-semibold mb-4 border-b pb-2" style="border-color: #F58220;">Edit Transaksi</h2>

    <div class="grid grid-cols-2 gap-x-6 gap-y-4 text-sm text-gray-700">
      <div>
        <p class="mb-1">Tanggal</p>
        <input type="text" value="10-02-2025"  class="border rounded-sm px-2 py-1 w-full bg-white shadow-sm" style="border-color: #F58220;">
      </div>
      <div>
        <p class="mb-1">Waktu</p>
        <input type="text" value="13.40"  class="border rounded-sm px-2 py-1 w-full bg-white shadow-sm" style="border-color: #F58220;">
      </div>
      <div>
        <p class="mb-1">ID Pesanan</p>
        <input type="text" value="5-GF123ASD..."  class="border rounded-sm px-2 py-1 w-full bg-white shadow-sm" style="border-color: #F58220;">
      </div>
      <div>
        <p class="mb-1">Nama Pelanggan</p>
        <input type="text" value="Masda"  class="border rounded-sm px-2 py-1 w-full bg-white shadow-sm" style="border-color: #F58220;">
      </div>
      <div class="col-span-2">
        <p class="mb-1">Item Pesanan</p>
        <textarea  rows="2" class="border rounded-sm px-2 py-1 w-full bg-white shadow-sm" style="border-color: #F58220;">1 Rice Bowl</textarea>
      </div>
      <div>
        <p class="mb-1">Total</p>
        <input type="text" value="Rp.23.000"  class="border rounded-sm px-2 py-1 w-full bg-white shadow-sm" style="border-color: #F58220;">
      </div>
      <div>
        <p class="mb-1">Metode Pembayaran</p>
        <input type="text" value="Cash"  class="border rounded-sm px-2 py-1 w-full bg-white shadow-sm" style="border-color: #F58220;">
      </div>
      <div class="col-span-2">
        <label class="inline-flex items-center space-x-2 mt-2">
          <input type="checkbox" class="form-checkbox text-green-600" />
          <span>Sukses / Berhasil</span>
        </label>
      </div>
    </div>

    <div class="mt-6 flex justify-between items-center">
      <a href="#" onclick="resetEditTransaksiModal()" class="text-sm text-blue-600 underline">Atur Ulang</a>
      <div>
        <button onclick="closeEditModal()" class="bg-red-700 hover:bg-red-800 text-white px-4 py-1.5 rounded shadow mr-2">Batal</button>
        <button onclick="showBerhasilEdit()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-1.5 rounded shadow">Ubah</button>
      </div>
    </div>
  </div>
</div>

<script>
  function resetEditTransaksiModal() {
    const modal = document.getElementById("transactionEditModal");
    const inputs = modal.querySelectorAll("input[type='text'], textarea");
    const checkboxes = modal.querySelectorAll("input[type='checkbox']");

    inputs.forEach(input => input.value = "");
    checkboxes.forEach(checkbox => checkbox.checked = false);
  }

  function showBerhasilEdit() {
    // Sembunyikan modal tambah
    closeEditModal();
    // Tampilkan modal berhasil
    document.getElementById("BerhasilEditModal").classList.remove("hidden");
  }
</script>

