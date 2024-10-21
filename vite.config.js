import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/commonStyle.css',
                'resources/css/Homepage.css',
                'resources/css/about.css',
                'resources/css/contactus.css',
                'resources/css/men.css',
                'resources/css/women.css',
                'resources/css/cart.css',
                'resources/css/checkout.css',
                'resources/css/Login.css',
                'resources/js/app.js',
                'resources/js/Homepage.js',
                'resources/js/common.js',
                'resources/js/women.js',
                'resources/js/men.js',
                'resources/js/cart.js',
                'resources/js/checkout.js',
                'resources/js/Login.js'
            ],
            refresh: true, // Enables hot reloading when you make changes
        }),
    ],
});
