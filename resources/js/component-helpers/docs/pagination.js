// Docs helper for pagination component – provides `paginationDocs()` used in documentation pages.
window.paginationDocs = function () {
  function setDemoPagination(container, data) {
    if (!container) return;
    const info = container.querySelector('.paginate-info');
    const result = container.querySelector('.paginate-result');
    if (info || result) {
      if (data.totalItems) {
        const txt = `Menampilkan halaman ${data.currentPage} dari ${data.last} (Total: ${data.totalItems} data)`;
        if (info) info.textContent = txt;
        if (result) result.textContent = `Hasil: ${data.currentPage} dari ${data.last} (Total: ${data.totalItems})`;
      } else {
        const txt = `Halaman ${data.currentPage} dari ${data.last}`;
        if (info) info.textContent = txt;
        if (result) result.textContent = `Hasil: ${data.currentPage} dari ${data.last}`;
      }
    }

    // set active page button
    const pageButtons = container.querySelectorAll('.paginate-page[data-page]');
    pageButtons.forEach(btn => {
      const page = Number(btn.getAttribute('data-page'));
      if (page === Number(data.currentPage)) btn.classList.add('paginate-current'); else btn.classList.remove('paginate-current');
    });

    // set last button
    const lastBtn = container.querySelector('.paginate-last');
    if (lastBtn) {
      lastBtn.setAttribute('data-page', data.last);
      lastBtn.textContent = data.last;
    }

    // set select value
    const sel = container.querySelector('.paginate-limit-select');
    if (sel) sel.value = data.limit || sel.value;
  }

  return {
    initDemo(root, options = {}) {
      try {
        const container = root.querySelector('.pagination-container') || root;
        const demo = Object.assign({ currentPage: 1, last: 5, totalItems: null, limit: 10 }, options);
        setDemoPagination(container, demo);

        // if options.part specified, hide other parts so each doc shows a single part
        if (options.part) {
          const parts = ['left', 'center', 'right'];
          parts.forEach(p => {
            const el = container.querySelector('.paginate-' + p);
            if (!el) return;
            if (p === options.part) el.classList.remove('hidden'); else el.classList.add('hidden');
          });
        }

        // wire simple local interactions for demo: clicking page buttons updates local state
        container.querySelectorAll('.paginate-page[data-page]').forEach(btn => {
          btn.addEventListener('click', (e) => {
            demo.currentPage = Number(btn.getAttribute('data-page'));
            setDemoPagination(container, demo);
          });
        });

        const prev = container.querySelector('.paginate-prev');
        if (prev) prev.addEventListener('click', () => {
          demo.currentPage = Math.max(1, demo.currentPage - 1);
          setDemoPagination(container, demo);
        });
        const next = container.querySelector('.paginate-next');
        if (next) next.addEventListener('click', () => {
          demo.currentPage = Math.min(demo.last, demo.currentPage + 1);
          setDemoPagination(container, demo);
        });

        const select = container.querySelector('.paginate-limit-select');
        if (select) select.addEventListener('change', (e) => {
          demo.limit = Number(e.target.value);
          demo.currentPage = 1;
          setDemoPagination(container, demo);
        });

        return container;
      } catch (err) {
        console.error('paginationDocs.initDemo error', err);
      }
    }
  };
};

// Also register as Alpine data provider for safe x-data usage in docs
document.addEventListener('alpine:init', () => {
  if (typeof Alpine !== 'undefined' && Alpine && typeof Alpine.data === 'function') {
    Alpine.data('paginationDocs', () => {
      return paginationDocs();
    });
  }
});
