import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/js/allTweetDelete.js',
                'resources/js/scheduleDelete.js',
                'resources/js/scheduleDetail.js',
                'resources/css/app.css', //これを追加
            ],
            refresh: true,
        }),
    ],
});
