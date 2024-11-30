import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    base: 'https://www.nexiswear.me/',
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/store.css',
                'resources/js/app.js',
                'resources/js/Homepage.js',
                'resources/js/bootstrap.js',
                'resources/js/particles-config.js'
            ],
            refresh: true,
        }),
    ],
    build: {
        outDir: 'public/build',
    },
});
