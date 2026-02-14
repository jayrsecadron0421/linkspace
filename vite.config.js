import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css',
                'resources/css/feed.css',
                'resources/css/profile.css',
                'resources/css/settings.css',
                'resources/css/admin/dashboard.css',
                'resources/css/admin/users.css',
                'resources/css/admin/settings.css',
                 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
