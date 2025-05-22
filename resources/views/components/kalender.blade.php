<!-- resources/views/components/kalender.blade.php -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<!-- Kalender Trigger -->
<input id="datepicker" type="text" class="hidden" />
<button id="openCalendar" type="button" style="border: 2px solid #F58220;"
    class="px-4 py-1.5 rounded text-[#333] relative z-10">
    <i class="fas fa-calendar-alt mr-2"></i>Kalender
</button>

<!-- Script dan Style Kalender -->
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
