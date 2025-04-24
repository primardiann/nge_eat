<div id="DownloadModal" class="modal fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
  <div class="bg-white rounded-md shadow-md p-6 w-full max-w-xl">
    <h2 class="text-xl text-center font-semibold mb-4 border-b pb-2" style="border-color: #C0C0C0;">Unduh Transaksi</h2>

    <div class="mt-6 text-center">
      <button id="closeDownloadModal" class="bg-red-600 hover:bg-red-700 text-white px-4 py-1 mr-4 rounded">Tutup</button>

      <button id ="openBerhasilModal" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-1 rounded">Unduh .CSV File</button>
    </div>

  </div>
</div>

<script>
    // Function to open the modal
    function openModal() {
        document.getElementById('DownloadModal').classList.remove('hidden');
    }

    // Function to close the modal
    function closeModal() {
        document.getElementById('DownloadModal').classList.add('hidden');
    }

    // Event listener for closing the modal when clicking the "Batal" button
    document.getElementById('closeDownloadModal').addEventListener('click', closeModal);

    // Modal Berhasil Download
    document.getElementById('openBerhasilModal').addEventListener('click', function () {
      document.getElementById('BerhasilModal').classList.remove('hidden');
    });
</script>
