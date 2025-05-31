@props(['categories', 'platforms'])

<div id="transactionTambahModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
  <div class="bg-white rounded-md shadow-md p-6 w-full max-w-3xl">
    <h2 class="text-xl font-semibold mb-4 border-b pb-2" style="border-color: #F58220;">Tambah Transaksi</h2>

    <form id="formTambahTransaksi" action="{{ route('gofood.store') }}" method="POST">
      @csrf

      <div class="grid grid-cols-2 gap-x-6 gap-y-4 text-sm text-gray-700">
        <div>
          <label for="tanggal" class="mb-1 block">Tanggal</label>
          <input id="tanggal" name="tanggal" type="date" class="border rounded-sm px-2 py-1 w-full bg-white shadow-sm" style="border-color: #F58220;" required>
        </div>
        <div>
          <label for="waktu" class="mb-1 block">Waktu</label>
          <input id="waktu" name="waktu" type="time" class="border rounded-sm px-2 py-1 w-full bg-white shadow-sm" style="border-color: #F58220;" required>
        </div>
        <div>
          <label for="id_pesanan" class="mb-1 block">ID Pesanan</label>
          <input id="id_pesanan" name="id_pesanan" type="text" placeholder="Contoh: GF-1234567" class="border rounded-sm px-2 py-1 w-full bg-white shadow-sm" style="border-color: #F58220;" required>
        </div>
        <div>
          <label for="nama_pelanggan" class="mb-1 block">Nama Pelanggan</label>
          <input id="nama_pelanggan" name="nama_pelanggan" type="text" class="border rounded-sm px-2 py-1 w-full bg-white shadow-sm" style="border-color: #F58220;" required>
        </div>
      </div>

      <!-- ========================== Dynamic Items ========================== -->
      <div class="mt-4 mb-2">
        <h3 class="font-medium mb-2">Detail Pesanan</h3>
        <div id="itemsContainer" class="space-y-4"></div>
        <button type="button" onclick="addItemRow()" class="mt-2 px-3 py-1.5 bg-blue-600 text-white rounded shadow hover:bg-blue-700">+ Tambah Item</button>
      </div>

      <div class="grid grid-cols-2 gap-4 mt-4">
        <div>
          <label for="metode_pembayaran" class="mb-1 block">Metode Pembayaran</label>
          <input id="metode_pembayaran" name="metode_pembayaran" type="text" class="border rounded-sm px-2 py-1 w-full bg-white shadow-sm" style="border-color: #F58220;" required>
        </div>
        <div>
          <label for="grand_total" class="mb-1 block">Total Semua</label>
          <input id="grand_total" name="total" type="number" class="border rounded-sm px-2 py-1 w-full bg-gray-100" style="border-color: #F58220;" readonly>
        </div>
      </div>

      <div class="mt-4">
        <label class="inline-flex items-center space-x-2 mt-2">
          <input type="checkbox" name="status" value="1" class="form-checkbox text-green-600" />
          <span>Sukses / Berhasil</span>
        </label>
      </div>

      <div class="mt-6 flex justify-between items-center">
        <a href="#" onclick="resetTambahTransaksiModal(); return false;" class="text-sm text-blue-600 underline">Atur Ulang</a>
        <div>
          <button type="button" onclick="closeTambahModal()" class="bg-red-700 hover:bg-red-800 text-white px-4 py-1.5 rounded shadow mr-2">Batal</button>
          <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-1.5 rounded shadow">Tambah</button>
        </div>
      </div>

      <!-- Input hidden untuk kirim item dalam bentuk JSON -->
      <input type="hidden" name="item_pesanan" id="item_pesanan_input">

    </form>
  </div>
</div>

<script>
  let itemIndex = 0;

  function addItemRow() {
    const container = document.getElementById('itemsContainer');
    const row = document.createElement('div');
    row.classList.add('grid', 'grid-cols-6', 'gap-2', 'items-end', 'item-row');

    row.innerHTML = `
      <div class="col-span-2">
        <label class="block text-xs mb-1">Kategori</label>
        <select name="items[${itemIndex}][category_id]" class="category_id border px-2 py-1 w-full rounded-sm" style="border-color: #F58220;" required>
          <option value="">-- Pilih Kategori --</option>
          @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="col-span-2">
        <label class="block text-xs mb-1">Menu</label>
        <select name="items[${itemIndex}][menu_id]" class="menu_id border px-2 py-1 w-full rounded-sm" style="border-color: #F58220;" required>
          <option value="">-- Pilih Menu --</option>
        </select>
      </div>

      <div>
        <label class="block text-xs mb-1">Platform</label>
        <select name="items[${itemIndex}][platform_id]" class="platform_id border px-2 py-1 w-full rounded-sm" style="border-color: #F58220;" required>
          <option value="">-- Pilih Platform --</option>
          @foreach($platforms as $platform)
            <option value="{{ $platform->id }}">{{ $platform->name }}</option>
          @endforeach
        </select>
      </div>

      <div>
        <label class="block text-xs mb-1">Jumlah</label>
        <input type="number" name="items[${itemIndex}][jumlah]" value="1" class="jumlah border px-2 py-1 w-full rounded-sm" style="border-color: #F58220;" min="1" required>
      </div>

      <input type="hidden" class="harga_item" name="items[${itemIndex}][harga]" value="">
      <input type="hidden" class="subtotal_item" name="items[${itemIndex}][subtotal]" value="">
    `;

    container.appendChild(row);
    attachEventsToRow(row);
    itemIndex++;
  }

  function attachEventsToRow(row) {
    const categorySelect = row.querySelector('.category_id');
    const menuSelect = row.querySelector('.menu_id');
    const platformSelect = row.querySelector('.platform_id');
    const jumlahInput = row.querySelector('.jumlah');

    categorySelect.addEventListener('change', function () {
      menuSelect.innerHTML = '<option>Memuat menu...</option>';
      fetch(`/get-menus/${this.value}`)
        .then(res => res.json())
        .then(data => {
          menuSelect.innerHTML = '<option value="">-- Pilih Menu --</option>';
          data.forEach(menu => {
            menuSelect.innerHTML += `<option value="${menu.id}">${menu.name}</option>`;
          });
          // Reset harga & subtotal saat menu berubah
          row.querySelector('.harga_item').value = '';
          row.querySelector('.subtotal_item').value = '';
          updateGrandTotal();
        });
    });

    const updateSubtotal = () => {
      const menuId = menuSelect.value;
      const platformId = platformSelect.value;
      const jumlah = parseInt(jumlahInput.value) || 1;
      const hargaInput = row.querySelector('.harga_item');
      const subtotalInput = row.querySelector('.subtotal_item');

      if (menuId && platformId) {
        fetch(`/get-price?menu_id=${menuId}&platform_id=${platformId}`)
          .then(res => res.json())
          .then(data => {
            const harga = data.price || 0;
            const subtotal = harga * jumlah;
            hargaInput.value = harga;
            subtotalInput.value = subtotal;
            updateGrandTotal();
          });
      } else {
        hargaInput.value = '';
        subtotalInput.value = '';
        updateGrandTotal();
      }
    };

    menuSelect.addEventListener('change', updateSubtotal);
    platformSelect.addEventListener('change', updateSubtotal);
    jumlahInput.addEventListener('input', updateSubtotal);
  }

  function updateGrandTotal() {
    const subtotalInputs = document.querySelectorAll('.subtotal_item');
    let grandTotal = 0;
    subtotalInputs.forEach(input => {
      grandTotal += parseFloat(input.value) || 0;
    });
    document.getElementById('grand_total').value = grandTotal;
  }

  function resetTambahTransaksiModal() {
    const form = document.getElementById('formTambahTransaksi');
    form.reset();
    document.getElementById('itemsContainer').innerHTML = '';
    document.getElementById('grand_total').value = '';
    itemIndex = 0;
  }

  function closeTambahModal() {
    resetTambahTransaksiModal();
    document.getElementById('transactionTambahModal').classList.add('hidden');
  }

  // Submit handler to set item_pesanan JSON before submit
  document.getElementById('formTambahTransaksi').addEventListener('submit', function(e) {
    const rows = document.querySelectorAll('.item-row');
    const items = [];

    rows.forEach(row => {
      const category = row.querySelector('.category_id')?.value || '';
      const menu = row.querySelector('.menu_id')?.value || '';
      const platform = row.querySelector('.platform_id')?.value || '';
      const jumlah = row.querySelector('.jumlah')?.value || '';
      const harga = row.querySelector('.harga_item')?.value || '';
      const subtotal = row.querySelector('.subtotal_item')?.value || '';

      if (category && menu && platform) {
        items.push({
          category_id: category,
          menu_id: menu,
          platform_id: platform,
          jumlah: parseInt(jumlah),
          harga: parseFloat(harga),
          subtotal: parseFloat(subtotal)
        });
      }
    });

    if(items.length === 0){
      e.preventDefault();
      alert('Harap tambahkan minimal satu item pesanan.');
      return false;
    }

    document.getElementById('item_pesanan_input').value = JSON.stringify(items);
  });

  // Init: otomatis tambahkan satu baris item saat modal dibuka
  document.addEventListener('DOMContentLoaded', () => {
    addItemRow();
  });
</script>
