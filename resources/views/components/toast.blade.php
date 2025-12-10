<div 
    x-data="{
        toasts: [],
        add(event) {
            const detail = event.detail || event; 
            const id = Date.now();
            
            // Mapping tipe (misal 'gagal' jadi 'error')
            let type = detail.type || 'success';
            if (type === 'gagal') type = 'error';

            const toast = {
                id: id,
                type: type, 
                size: detail.size || 'md', // Default size: Medium
                message: detail.message || detail.title || 'Notification',
                timeout: detail.timeout || 3000,
                timer: null,
                remaining: detail.timeout || 3000,
                start: Date.now()
            };

            this.toasts.push(toast);
            this.startTimer(toast);
        },
        remove(id) {
            const index = this.toasts.findIndex(t => t.id === id);
            if (index > -1) {
                this.toasts.splice(index, 1);
            }
        },
        // BEST PRACTICE: Pause timer saat mouse di atas toast
        startTimer(toast) {
            toast.start = Date.now();
            toast.timer = setTimeout(() => {
                this.remove(toast.id);
            }, toast.remaining);
        },
        pauseTimer(toast) {
            if (toast.timer) {
                clearTimeout(toast.timer);
                toast.timer = null;
                toast.remaining -= Date.now() - toast.start;
            }
        },
        resumeTimer(toast) {
            if (!toast.timer && toast.remaining > 0) {
                this.startTimer(toast);
            }
        },
        init() {
            // Auto-detect Session Laravel
            @if (session('success'))
                this.add({ type: 'success', message: '{{ addslashes(session('success')) }}' });
            @endif
            @if (session('error'))
                this.add({ type: 'error', message: '{{ addslashes(session('error')) }}' });
            @endif
            @if (session('gagal'))
                this.add({ type: 'error', message: '{{ addslashes(session('gagal')) }}' });
            @endif
            @if (session('info'))
                this.add({ type: 'info', message: '{{ addslashes(session('info')) }}' });
            @endif
            @if ($errors->any())
                this.add({ type: 'error', message: '{{ addslashes($errors->first()) }}' });
            @endif
        }
    }"
    @toast-show.window="add($event)"
    class="toast-container"
    role="region" 
    aria-live="polite" 
    aria-label="Notifikasi"
>
    <template x-for="toast in toasts" :key="toast.id">
        <div class="toast-item"
             :class="{
                 'toast-success': toast.type === 'success',
                 'toast-error': toast.type === 'error',
                 'toast-pending': toast.type === 'pending',
                 'toast-neutral': !['success', 'error', 'pending'].includes(toast.type),
                 
                 // Dynamic Size
                 'toast-sm': toast.size === 'sm',
                 'toast-md': toast.size === 'md',
                 'toast-lg': toast.size === 'lg',
             }"
             x-show="true"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="toast-enter-start"
             x-transition:enter-end="translate-x-0 opacity-100"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="translate-x-0 opacity-100"
             x-transition:leave-end="toast-leave-end"
             
             @mouseenter="pauseTimer(toast)"
             @mouseleave="resumeTimer(toast)"
             role="alert"
        >
            {{-- Message --}}
            <span class="toast-message" x-text="toast.message"></span>

            {{-- Action Button (Oke) --}}
            <button @click="remove(toast.id)" class="toast-action-btn">
                Oke
            </button>
        </div>
    </template>
</div>