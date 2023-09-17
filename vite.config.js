import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/credit.js',
                'resources/css/portfolio.css',
                'resources/css/post_admin.css',
                'resources/js/post_admin.js',
                'resources/templates/scss/post-landing.scss',
            ],
            refresh: true,
        }),
    ],
});
