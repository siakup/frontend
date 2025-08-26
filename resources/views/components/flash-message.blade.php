@props([
    'type' => 'success', // success | error | warning
    'message' => 'Berhasil disimpan',
    'redirect' => null, // optional redirect url
])

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.store('flashMessage', {
            show: false,
            type: 'success',
            message: '',
            redirect: null,
            trigger() {
                if (this.type === 'success') {
                    successToast(this.message);
                } else if (this.type === 'error') {
                    errorToast(this.message);
                }
                if (this.redirect) {
                    setTimeout(() => {
                        window.location.href = this.redirect;
                    }, 3000);
                }
            }
        })
    })
</script>
