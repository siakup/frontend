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
});

// compute header height and expose as CSS variable --header-height
function setHeaderHeightVar() {
  const header = document.getElementById('app-header');
  const h = header ? header.offsetHeight : 0;
  document.documentElement.style.setProperty('--header-height', h + 'px');
}
window.addEventListener('load', setHeaderHeightVar);
window.addEventListener('resize', setHeaderHeightVar);
document.addEventListener('DOMContentLoaded', () => setTimeout(setHeaderHeightVar, 50));
// run after Alpine init in case header renders later
document.addEventListener('alpine:initialized', () => setTimeout(setHeaderHeightVar, 50));