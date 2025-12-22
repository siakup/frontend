import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
  plugins: [
    tailwindcss(),
    laravel({
      input: [
        'resources/css/app.css', 
        'resources/js/app.js',
      ],
      refresh: true,
    }),
  ],
  server: {
    host: '127.0.0.1',       // <-- wajib supaya device lain bisa akses
    port: 5175,            // port tetap, jangan biar random
    strictPort: true,      // supaya kalau 5173 kepake, Vite error bukan pindah port
    // hmr: {
    //   host: '100.68.17.14', // IP laptop yg diakses via Tailscale
    // },
  },
});
