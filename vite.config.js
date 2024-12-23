import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    build: {
        outDir: '../public_html/build', // Output langsung ke public_html/build
        emptyOutDir: true, // Membersihkan folder sebelum build baru
    },
});