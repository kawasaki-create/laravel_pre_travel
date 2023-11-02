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
                'resources/js/newDetail.js',
                'resources/js/todoAddSelect.js',
                'resources/css/app.css', //これを追加
                'resources/css/newSchedule.css',
                'resources/css/homeNav.css',
            ],
            refresh: true,
        }),
    ],
});
