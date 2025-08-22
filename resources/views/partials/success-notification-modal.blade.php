@if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            successToast("{{ session('success') ?? 'Berhasil disimpan' }}");
            setTimeout(() => {
                window.location.href = "{{ route('academics-event.index') }}";
            }, 3000);
        })
    </script>
@endif