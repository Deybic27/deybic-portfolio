import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/credit.js',
                'resources/css/detail-credit.css',
                'resources/css/portfolio.css',
                'resources/js/portfolio.js',
                'resources/css/post_admin.css',
                'resources/js/post_admin.js',
                'resources/scss/templates/post-landing.scss',
                'resources/js/post-landing.js',
                'resources/icons/css/all.min.css',
                'resources/scss/templates/home.scss',
                'resources/js/home.js',
            ],
            refresh: true,
        }),
    ],
});
