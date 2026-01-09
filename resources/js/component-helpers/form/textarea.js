window.onInputTextArea = function(element, maxChar) {
    const container = element.closest('.textarea-container');
    const display = container ? container.querySelector('.textarea-maxchar') : null;
    if (!display || !maxChar) return;

    let text = element.value || '';

    if (text.length > maxChar) {
        text = text.slice(0, maxChar);
        element.value = text;
    }

    const isLimitReached = text.length >= maxChar;

    display.textContent = `${text.length}/${maxChar}`;
    display.classList.toggle('text-red-500', isLimitReached);
    display.classList.toggle('text-gray-600', !isLimitReached);

    element.classList.toggle('border-red-500', isLimitReached);
    element.classList.toggle('border-gray-400', !isLimitReached);

}

window.clearTextArea = function(element) {
    if (!element) return;
    element.value = '';
    element.dispatchEvent(new InputEvent('input', { bubbles: true }));
    element.dispatchEvent(new Event('change', { bubbles: true }));
    // remove focus to avoid scrolling/interaction issues
    try { element.blur(); } catch (e) { /* ignore */ }
    const maxCharAttr = element.getAttribute('data-maxchar');
    const maxChar = maxCharAttr ? parseInt(maxCharAttr, 10) : null;
    if (typeof window.onInputTextArea === 'function') {
        window.onInputTextArea(element, maxChar);
    }
}

// Documentation helpers
// Returns the Alpine data object used by the textarea documentation page.
window.textareaDocs = function() {
    return {
        form: {
            basic: '',
            description: '',
            limited: '',
            helper: '',
            custom: '',
            with_label: '',
            error_state: '',
            disabled: 'Ini adalah data yang tidak dapat diubah',
            no_resize: '',
            with_clear: 'ini textarea yang bisa dihapus',
            preview: ''
        }
    };
};