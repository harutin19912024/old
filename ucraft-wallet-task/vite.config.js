import { defineConfig, loadEnv } from 'vite';
import laravel from 'laravel-vite-plugin';
import { resolve } from 'path';
import { homedir } from 'os';
import fs from 'fs';

let appEnv = loadEnv('prod', process.cwd());
let host = appEnv.VITE_APP_URL || 'localhost';
let viteResolve = {};

if (process.env.NODE_ENV === 'production') {
    viteResolve = {
        alias: [
            {
                find: '../img',
                replacement: '',
                customResolver(updatedId, importer, resolveOptions) {
                    return `resources/img${updatedId}`;
                },
            },
        ],
    };
}

export default defineConfig({
    server: detectServerConfig(host),
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/invoices/pre-invoice.css',
                'resources/js/app.js',
                'resources/js/cookieconsent.js',
                'resources/js/cookieconsent-init.js',
                'resources/css/plugins/cookieconsent.css',
            ],
            refresh: [
                'resources/routes/**',
                'routes/**',
                'resources/views/**',
            ],
        }),
    ],
    css: {
        postcss: {
            plugins: [
                require('tailwindcss/nesting'),
                require('tailwindcss')({
                    config: 'tailwind.config.js',
                }),
            ],
        },
    },
    resolve: viteResolve,
});

function detectServerConfig(host) {
    const defaultConfig = {
        hmr: { host },
        // host,
    };

    let keyPath = resolve(homedir(), `.config/valet/Certificates/${host}.key`);
    let certificatePath = resolve(homedir(), `.config/valet/Certificates/${host}.crt`);

    if (!fs.existsSync(keyPath)) {
        return defaultConfig;
    }

    if (!fs.existsSync(certificatePath)) {
        return defaultConfig;
    }

    return {
        hmr: { host },
        host,
        https: {
            key: fs.readFileSync(keyPath),
            cert: fs.readFileSync(certificatePath),
        },
    };
}
