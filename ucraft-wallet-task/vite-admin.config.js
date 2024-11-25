import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    build: {
        outDir: 'public/build-admin',
    },
    plugins: [
        laravel([
            'resources/css/admin.css',
        ]),
    ],
    css: {
        postcss: {
            plugins: [
                require('tailwindcss/nesting'),
                require('tailwindcss')({
                    config: 'tailwind-admin.config.js',
                }),
            ],
        },
    },
});
