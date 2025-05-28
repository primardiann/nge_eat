<div id="transactionDetailModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
  <div class="bg-white rounded-md shadow-md p-6 w-full max-w-xl">
    <h2 class="text-xl font-semibold mb-4 border-b pb-2" style="border-color: #F58220;">Detail Transaksi</h2>

    <div class="grid grid-cols-2 gap-x-6 gap-y-4 text-sm text-gray-700">
      <div>
        <p class="mb-1">Tanggal</p>
        <input type="text" id="detail-tanggal" value="10-02-2025" readonly
          class="border rounded-sm px-2 py-1 w-full bg-white shadow-sm" style="border-color: #F58220;">
      </div>
      <div>
        <p class="mb-1">Waktu</p>
        <input type="text" id="detail-waktu" value="13.40" readonly
          class="border rounded-sm px-2 py-1 w-full bg-white shadow-sm" style="border-color: #F58220;">
      </div>
      <div>
        <p class="mb-1">ID Pesanan</p>
        <input type="text" id="detail-id" value="5-GF123ASD..." readonly
          class="border rounded-sm px-2 py-1 w-full bg-white shadow-sm" style="border-color: #F58220;">
      </div>
      <div>
        <p class="mb-1">Status</p>
        <input type="text" id="detail-status" value="Sukses" readonly
          class="border rounded-sm px-2 py-1 w-full bg-white shadow-sm font-semibold text-green-600" style="border-color: #F58220;">
      </div>
      <div>
        <p class="mb-1">Nama Pelanggan</p>
        <input type="text" id="detail-nama" value="Masda Naswa" readonly
          class="border rounded-sm px-2 py-1 w-full bg-white shadow-sm" style="border-color: #F58220;">
      </div>
      <div>
        <p class="mb-1">Metode Pembayaran</p>
        <input type="text" id="detail-metode" value="Cash" readonly
          class="border rounded-sm px-2 py-1 w-full bg-white shadow-sm" style="border-color: #F58220;">
      </div>
    </div>

    <!-- Baris Item dan Total -->
    <div class="flex gap-4 mt-4">
      <div class="w-1/2">
        <p class="mb-1 font-medium">Item Pesanan</p>
        <ul class="list-disc list-inside text-gray-700" id="detail-item-list">
          <!-- Item pesanan akan ditambahkan lewat JS -->
        </ul>
      </div>
      <div class="w-1/2">
        <p class="mb-1 font-medium">Total</p>
        <p id="detail-total-value" class="text-base font-semibold text-gray-800">Rp 0</p>
      </div>
    </div>

    <div class="mt-6 text-right">
      <button onclick="closeDetailModal()" class="bg-red-700 hover:bg-red-800 text-white px-4 py-1.5 rounded shadow">
        Tutup
      </button>
    </div>
  </div>
</div>
</div>

<!-- Script untuk kontrol modal -->
  <script>
    function openTransactionModal() {
      const modal = document.getElementById('transactionDetailModal');
      modal.classList.remove('hidden');
    }

    function closeTransactionModal() {
      const modal = document.getElementById('transactionDetailModal');
      modal.classList.add('hidden');
    }
  </script>
