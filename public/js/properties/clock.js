var jamMulaiInput, jamAkhirInput;

jamMulaiInput = flatpickr("#jam-mulai", {
    enableTime: true,
    dateFormat: "H:i",
    time_24hr: true,
    noCalendar: true,
    onChange: (selectedTime) => {
        if (selectedTime.length > 0) {
            jamAkhirInput.set('minDate', selectedTime[0]);
        } else {
            jamAkhirInput.set('minDate', null);
        }
    }
});

jamAkhirInput = flatpickr("#jam-akhir", {
    enableTime: true,
    dateFormat: "H:i",
    time_24hr: true,
    noCalendar: true,
    onChange: (selectedTime) => {
        if (selectedTime.length > 0) {
            jamMulaiInput.set('maxDate', selectedTime[0]);
        } else {
            jamMulaiInput.set('maxDate', null);
        }
    }
});