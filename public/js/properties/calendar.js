document.addEventListener('DOMContentLoaded', () => {
    let tanggalMulaiInput, tanggalAkhirInput;
    tanggalMulaiInput = flatpickr("#tanggal-mulai", {
        locale: 'id',
        enableTime: true,
        dateFormat: "d-m-Y, H:i",
        time_24hr: true,
        onChange: (selectedDates) => {
            if (selectedDates.length > 0) {
                tanggalAkhirInput.set('minDate', selectedDates[0]);
            } else {
                tanggalAkhirInput.set('minDate', null);
            }
        }
    });

    tanggalAkhirInput = flatpickr("#tanggal-akhir", {
        locale: 'id',
        enableTime: true,
        dateFormat: "d-m-Y, H:i",
        time_24hr: true,
        onChange: (selectedDates) => {
            if (selectedDates.length > 0) {
                tanggalMulaiInput.set('maxDate', selectedDates[0]);
            } else {
                tanggalMulaiInput.set('maxDate', null);
            }
        }
    });
});