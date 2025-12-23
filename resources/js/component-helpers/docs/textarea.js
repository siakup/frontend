document.addEventListener('alpine:init', () => {
  Alpine.data('textareaDocs', () => ({
    form: {
      basic: '',
      description: '',
      limited: '',
      helper: '',
      custom: '',
      error: '',
      preview: '',
      with_clear: 'Klik icon X untuk menghapus teks ini'
    }
  }))
})
