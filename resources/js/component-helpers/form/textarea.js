window.onInputTextArea = function(element, maxChar) {
    const display = element.parentElement.querySelector('.length-display');
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

    element.style.height = 'auto';
    element.style.height = element.scrollHeight + 'px';
}

window.clearTextArea = function(element) {
    if (!element) return;
    element.value = '';
    element.dispatchEvent(new InputEvent('input', { bubbles: true }));
    element.focus();
    const maxCharAttr = element.getAttribute('data-maxchar');
    const maxChar = maxCharAttr ? parseInt(maxCharAttr, 10) : null;
    if (typeof window.onInputTextArea === 'function') {
        window.onInputTextArea(element, maxChar);
    }
}
