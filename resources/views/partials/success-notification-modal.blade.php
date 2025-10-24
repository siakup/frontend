@if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            successToast("{{ session('success') ?? 'Berhasil disimpan' }}");
            setTimeout(() => {
                window.location.href = "{{ $route }}";
            }, 3000);
        })
    </script>
@elseif($errors->has('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            successToast("{{ json_encode($errors->first('error')) ?? 'Gagal menyimpan data' }}");
        })
    </script>
@endif