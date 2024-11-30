import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/store.css',
                'resources/js/app.js',
                'resources/js/Homepage.js',
                'resources/js/bootstrap.js',
            ],
            refresh: true,
        }),
    ],
    build: {
        outDir: 'public/build',
    },
});
