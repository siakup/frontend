@if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            successToast("{{ session('success') ?? 'Berhasil disimpan' }}");
            setTimeout(() => {
                window.location.href = "{{ $route }}";
            }, 3000);
        })
    </script>
@endif