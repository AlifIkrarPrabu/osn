import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

// ========== Tambahkan Kode Alpine.js untuk Password Toggle di sini ==========
document.addEventListener('alpine:init', () => {
    Alpine.data('passwordToggle', (initialType = 'password') => ({
        type: initialType,
        toggleVisibility() {
            this.type = (this.type === 'password') ? 'text' : 'password';
        }
    }));
});
// ===========================================================================


window.Alpine = Alpine;
Alpine.start();
