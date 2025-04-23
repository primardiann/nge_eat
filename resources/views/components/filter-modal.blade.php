<!-- components/modal-filter.blade.php -->
<div id="filterModal" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
    <div class="bg-white rounded-md border-4 border-purple-400 shadow-lg p-6 w-full max-w-xl">
        <h2 class="text-xl font-semibold mb-2">Filter Transaksi</h2>
        <p class="text-sm text-gray-700 mb-4">Pilih informasi yang anda perlukan</p>

        <div class="grid grid-cols-2 gap-4 mb-4">
    <div>
        <label class="block text-sm mb-1">ID Pesanan</label>
        <input type="text" class="w-full border-2 rounded px-2 py-1" style="border-color: #F58220;">
    </div>
    <div>
        <label class="block text-sm mb-1">Harga</label>
        <input type="text" class="w-full border-2 rounded px-2 py-1" style="border-color: #F58220;">
    </div>
</div>

        <div class="mb-4">
            <label class="inline-flex items-center">
                <input type="checkbox" class="mr-2"> Semua tipe pembayaran
            </label>
            <div class="border-2 rounded p-4 mt-2 shadow-sm" style="border-color: #F58220;">
                <div class="grid grid-cols-2 gap-2">
                    <label><input type="checkbox" class="mr-2"> Gopay</label>
                    <label><input type="checkbox" class="mr-2"> Kartu Debit</label>
                    <label><input type="checkbox" class="mr-2"> GrabFood</label>
                    <label><input type="checkbox" class="mr-2"> Ovo</label>
                    <label><input type="checkbox" class="mr-2"> ShopeeFood</label>
                    <label><input type="checkbox" class="mr-2"> Qris</label>
                </div>
            </div>
        </div>

        <div class="mb-4">
            <label class="inline-flex items-center">
                <input type="checkbox" class="mr-2"> Semua status pembayaran
            </label>
        </div>

        <div class="flex justify-between items-center">
            <span class="font-bold text-gray-700 cursor-pointer hover:underline" id="resetFilters">Atur Ulang</span>
            <div class="space-x-2">
                <button id="closeFilterModal" class="bg-red-600 hover:bg-red-700 text-white px-4 py-1 rounded">Batal</button>
                <button id="applyFilters" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-1 rounded">Terapkan</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Function to open the modal
    function openModal() {
        document.getElementById('filterModal').classList.remove('hidden');
    }

    // Function to close the modal
    function closeModal() {
        document.getElementById('filterModal').classList.add('hidden');
    }

    // Event listener for closing the modal when clicking the "Batal" button
    document.getElementById('closeFilterModal').addEventListener('click', closeModal);

    // Event listener for opening the modal (you can trigger this from elsewhere)
    // openModal();

    // Optional: Reset filter values when clicking "Atur Ulang"
    document.getElementById('resetFilters').addEventListener('click', () => {
        // Reset all inputs and checkboxes to default values
        const inputs = document.querySelectorAll('input[type="text"], input[type="checkbox"]');
        inputs.forEach(input => {
            if (input.type === 'checkbox') {
                input.checked = false;
            } else {
                input.value = '';
            }
        });
    });

    // Optional: Apply the filters when clicking the "Terapkan" button
    document.getElementById('applyFilters').addEventListener('click', () => {
        // Get filter values and apply logic here (e.g., filtering data)
        const idPesanan = document.querySelector('input[type="text"]').value;
        const harga = document.querySelectorAll('input[type="text"]')[1].value;
        const checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
        const selectedPayments = Array.from(checkboxes).map(checkbox => checkbox.parentElement.textContent.trim());

        console.log('Applied filters:', { idPesanan, harga, selectedPayments });

        closeModal(); // Close the modal after applying filters
    });
</script>
