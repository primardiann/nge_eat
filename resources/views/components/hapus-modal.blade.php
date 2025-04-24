<div id="openHapusModal" class="modal fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
  <div class="bg-white rounded-md shadow-md p-6 w-full max-w-xl items-center">
    <div class="text-center">
        <i class="fas fa-exclamation-circle text-5xl"></i>
    </div>
    <h2 class="text-xl text-center font-semibold mt-2">Lanjutkan Hapus?</h2>

    <div class="mt-2 text-center">
      <h2 class="text-base text-center mb-4 ">Anda akan menghapus transaksi ini</h2>
      <button onclick="closeHapusModal()" class="bg-red-600 hover:bg-red-700 text-white px-4 py-1 mr-4 rounded">Tutup</button>

      <button id ="openBerhasilHapusModal" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-1 rounded">Hapus</button>
    </div>
  </div>
</div>

<script>
    // Modal Berhasil Download
    document.getElementById('openBerhasilHapusModal').addEventListener('click', function () {
      document.getElementById('BerhasilHapusModal').classList.remove('hidden');
    });
</script>
