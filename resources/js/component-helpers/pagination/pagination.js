// Pagination helper: initializes .pagination-container elements and handles CSR requests.
// Exposes initPagination to window and auto-inits on DOMContentLoaded.
(function () {
  function parseJSONAttr(el, name) {
    const v = el.getAttribute(name);
    if (!v) return null;
    try { return JSON.parse(v); } catch (e) { return null; }
  }

  function setInfo(el, pagination) {
    const info = el.querySelector('.paginate-info');
    const result = el.querySelector('.paginate-result');
    if (!info && !result) return;
    if (!pagination) {
      if (info) info.textContent = 'Menampilkan halaman 1 dari 1';
      if (result) result.textContent = 'Hasil: 1 dari 1';
      return;
    }
    const totalItems = pagination.totalItems ?? null;
    if (totalItems) {
      const txt = `Menampilkan halaman ${pagination.currentPage} dari ${pagination.last} (Total: ${totalItems} data)`;
      if (info) info.textContent = txt;
      if (result) result.textContent = `Hasil: ${pagination.currentPage} dari ${pagination.last} (Total: ${totalItems})`;
    } else {
      const txt = `Halaman ${pagination.currentPage} dari ${pagination.last}`;
      if (info) info.textContent = txt;
      if (result) result.textContent = `Hasil: ${pagination.currentPage} dari ${pagination.last}`;
    }
  }

  function updateActive(el, pagination) {
    const pageButtons = el.querySelectorAll('.paginate-page[data-page]');
    pageButtons.forEach(btn => {
      const page = Number(btn.getAttribute('data-page'));
      if (page === Number(pagination.currentPage)) {
        btn.classList.add('paginate-current');
      } else {
        btn.classList.remove('paginate-current');
      }
    });
  }

  async function fetchPage(el, page, limit, requestData = {}) {
    const route = el.dataset.requestRoute || '';
    const responsePaginationKey = el.dataset.responseKeyPagination || 'pagination';
    if (!route) return;
    if (!window.api || !window.api.requestGetData) {
      console.warn('window.api.requestGetData not found; cannot perform CSR request');
      return;
    }

    await window.api.requestGetData(route, { page, limit, display: 'false', ...requestData }, (response) => {
      const pagination = response?.data?.[responsePaginationKey] ?? null;
      if (!pagination) return;
      // update info and active state
      setInfo(el, pagination);
      updateActive(el, pagination);
      // update last page button text if present
      const lastBtn = el.querySelector('.paginate-last');
      if (lastBtn) {
        lastBtn.setAttribute('data-page', pagination.last);
        lastBtn.textContent = pagination.last;
      }
      // if storeName/storeKey provided, try to update global $store
      const storeName = el.dataset.storeName;
      const storeKey = el.dataset.storeKey;
      if (storeName && storeKey && window.$store && window.$store[storeName]) {
        window.$store[storeName][storeKey] = response?.data ?? window.$store[storeName][storeKey];
        window.$store[storeName].paginationData = pagination;
      }
    });
  }

  function initContainer(el) {
    if (!el) return;
    const defaultOptions = parseJSONAttr(el, 'data-default-per-page-options') || [10, 25, 50, 100];

    // Find the limit selector (could be select or input, or wrapper)
    let selectContainer = el.querySelector('.paginate-limit-select, .pagination-limit-select');
    let select = selectContainer;

    // If it's a wrapper (like x-form.input root), find the inner input/select
    if (select && (select.tagName === 'DIV' || select.tagName === 'SPAN')) {
      select = select.querySelector('input, select');
    }

    const prev = el.querySelector('.paginate-prev');
    const next = el.querySelector('.paginate-next');
    const search = el.querySelector('.paginate-search');
    const pageButtons = el.querySelectorAll('.paginate-page[data-page]');

    // attach select/input change
    if (select) {
      // Use 'change' for both select and input (on enter/blur)
      select.addEventListener('change', (e) => {
        const limit = Number(e.target.value);
        // on limit change, go to page 1
        fetchPage(el, 1, limit);
      });
    }

    // attach click to page buttons
    pageButtons.forEach(btn => {
      btn.addEventListener('click', (e) => {
        const page = Number(btn.getAttribute('data-page'));
        const limit = Number(select?.value || defaultOptions[0]);
        fetchPage(el, page, limit);
      });
    });

    if (prev) {
      prev.addEventListener('click', (e) => {
        // compute current active page
        const current = el.querySelector('.paginate-page.paginate-current') || el.querySelector('.paginate-page[data-page].paginate-current');
        let page = 1;
        if (current) page = Number(current.getAttribute('data-page')) - 1;
        const limit = Number(select?.value || defaultOptions[0]);
        fetchPage(el, Math.max(page, 1), limit);
      });
    }
    if (next) {
      next.addEventListener('click', (e) => {
        const current = el.querySelector('.paginate-page.paginate-current');
        let page = 1;
        if (current) page = Number(current.getAttribute('data-page')) + 1;
        const limit = Number(select?.value || defaultOptions[0]);
        fetchPage(el, page, limit);
      });
    }
  }

  function initAll() {
    const containers = document.querySelectorAll('.pagination-container');
    containers.forEach(initContainer);
  }

  window.initPagination = function (root) {
    if (!root) return;
    initContainer(root);
  };

  document.addEventListener('DOMContentLoaded', initAll);
})();


/**
 * Alpine.js Logic for Pagination Component
 * Used in resources/views/components/pagination.blade.php
 */
window.paginationLogic = function (config = {}) {
  return {
    page: 1,
    limit: config.defaultLimit || 10,
    total: 100,
    searchPage: '',

    init() {
      if (config.initialPage) this.page = config.initialPage;
      if (config.initialTotal) this.total = config.initialTotal;

      this.$watch('limit', () => {
        this.page = 1;
        this.$dispatch('pagination-change', { page: this.page, limit: this.limit, total: this.total });
      });
    },

    get totalPages() {
      return Math.ceil(this.total / this.limit) || 1;
    },

    get paginationRange() {
      const total = this.totalPages;
      const current = this.page;
      const delta = 1;
      const range = [];

      for (let i = Math.max(2, current - delta); i <= Math.min(total - 1, current + delta); i++) {
        range.push(i);
      }

      if (current - delta > 2) {
        range.unshift('...');
      }

      if (current + delta < total - 1) {
        range.push('...');
      }

      range.unshift(1);
      if (total > 1) {
        range.push(total);
      }

      return range;
    },

    setPage(p) {
      if (p === '...') return;
      p = parseInt(p);
      if (isNaN(p)) return;

      if (p < 1) p = 1;
      if (p > this.totalPages) p = this.totalPages;
      this.page = p;
      this.$dispatch('pagination-change', { page: this.page, limit: this.limit, total: this.total });
    },

    handleSearch() {
      if (this.searchPage) {
        this.setPage(this.searchPage);
        this.searchPage = ''; // Clear search after go
      }
    }
  };
};

/**
 * Alpine.js Logic for Synchronizing External Pagination Components
 * (e.g., Result Text, status displays)
 */
document.addEventListener('alpine:init', () => {
  if (typeof Alpine !== 'undefined' && Alpine && typeof Alpine.data === 'function') {
    Alpine.data('paginationSync', () => ({
      limit: 10,
      page: 1,
      total: 100,
      get start() { return (this.page - 1) * this.limit + 1; },
      get end() { return Math.min(this.page * this.limit, this.total); },
      onPaginationChange(detail) {
        this.page = detail.page;
        this.limit = detail.limit;
        this.total = detail.total;
      }
    }));
  }
});
