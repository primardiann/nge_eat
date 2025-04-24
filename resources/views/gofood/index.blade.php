@extends('layouts.navigation')

@section('content')
    <!-- Flatpickr CSS & JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <!-- Custom Style Flatpickr -->
    <style>
        .flatpickr-calendar {
            border-radius: 20px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            font-family: 'Poppins', sans-serif;
        }

        .flatpickr-months {
            padding: 8px 0;
        }

        .flatpickr-current-month {
            font-size: 1.25rem;
            font-weight: 600;
        }

        .flatpickr-weekday {
            color: #999;
            font-weight: 500;
        }

        .flatpickr-day {
            border-radius: 8px;
            line-height: 2.5rem;
            height: 2.5rem;
            width: 2.5rem;
            margin: 2px;
        }

        .flatpickr-day.selected {
            background: #4F9CF9;
            color: white;
        }

        .flatpickr-day.today {
            border: 1px solid #4F9CF9;
        }

        .flatpickr-footer {
            display: flex;
            justify-content: end;
            gap: 10px;
            padding: 10px 15px;
        }

        .flatpickr-btn {
            padding: 6px 14px;
            border-radius: 8px;
            font-weight: 500;
            border: 1px solid #4F9CF9;
            background: white;
            color: #4F9CF9;
            cursor: pointer;
            transition: 0.2s;
        }

        .flatpickr-btn.apply {
            background: #4F9CF9;
            color: white;
        }

        .flatpickr-btn:hover {
            opacity: 0.9;
        }
    </style>

    <div class="flex min-h-screen bg-[#FAFAFA] text-sm">
        <main class="flex-1 px-8 py-6">
            <!-- Breadcrumb -->
            <div class="text-gray-500 mb-4">
                <span class="text-black font-semibold">Dashboard</span> &gt;
                <span class="text-[#888]">Transaksi GoFood</span>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col items-end space-y-3 mb-6 relative">
                <input id="datepicker" type="text" class="hidden" />
                <button id="openCalendar" type="button" style="border: 2px solid #F58220;"
                    class="px-4 py-1.5 rounded text-[#333] relative z-10">
                    <i class="fas fa-calendar-alt mr-2"></i>Hari Ini
                </button>

                <div class="flex space-x-3">
                    <button style="border: 2px solid #F58220;"
                        class="flex items-center text-orange-500 px-4 py-1.5 rounded hover:bg-orange-50 transition">
                        <i class="fas fa-download mr-2"></i> Unduh
                    </button>
                    <button style="border: 2px solid #F58220;"
                        class="flex items-center text-orange-500 px-4 py-1.5 rounded hover:bg-orange-50 transition">
                        <i class="fas fa-filter mr-2"></i> Filter
                    </button>
                </div>
            </div>

            <!-- Table -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <table class="min-w-full">
                    <thead style="background-color: #FFE5D0;" class="text-gray-700 text-left text-sm">
                        <tr>
                            <th class="px-6 py-3 font-medium">Tanggal</th>
                            <th class="px-6 py-3 font-medium">Waktu</th>
                            <th class="px-6 py-3 font-medium">ID pesanan</th>
                            <th class="px-6 py-3 font-medium">Status</th>
                            <th class="px-6 py-3 font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white text-gray-700 text-sm">
                        @for ($i = 0; $i < 5; $i++)
                            <tr class="border-t hover:bg-gray-50">
                                <td class="px-6 py-3">10-02-2025</td>
                                <td class="px-6 py-3">13.40</td>
                                <td class="px-6 py-3 truncate max-w-[120px]">5-GF123ASD...</td>
                                <td class="px-6 py-3 text-green-600 font-medium">Sukses</td>
                                <td class="px-6 py-3">
                                    <div class="flex space-x-3">
                                        <button title="Lihat" class="text-gray-600 hover:text-black transition">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button title="Hapus" class="text-gray-600 hover:text-red-500 transition">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <!-- Flatpickr Script + Footer Button -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const calendar = flatpickr("#datepicker", {
                appendTo: document.body,
                positionElement: document.getElementById("openCalendar"),
                position: "below",
                clickOpens: false,
                allowInput: false,
                onReady: function (selectedDates, dateStr, instance) {
                    const footer = document.createElement("div");
                    footer.className = "flatpickr-footer";

                    const cancelBtn = document.createElement("button");
                    cancelBtn.className = "flatpickr-btn cancel";
                    cancelBtn.textContent = "Batal";
                    cancelBtn.onclick = () => instance.close();

                    const applyBtn = document.createElement("button");
                    applyBtn.className = "flatpickr-btn apply";
                    applyBtn.textContent = "Terapkan";
                    applyBtn.onclick = () => {
                        console.log("Tanggal dipilih:", instance.input.value);
                        instance.close();
                    };

                    footer.appendChild(cancelBtn);
                    footer.appendChild(applyBtn);
                    instance.calendarContainer.appendChild(footer);
                }
            });

            document.getElementById("openCalendar").addEventListener("click", () => {
                calendar.open();
            });
        });
    </script>
@endsection
