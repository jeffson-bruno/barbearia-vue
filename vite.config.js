import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import { VitePWA } from 'vite-plugin-pwa'

export default defineConfig({
    plugins: [
        laravel({
            input: 'resources/js/app.js',
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        VitePWA({
            registerType: 'autoUpdate',
            manifest: {
                name: 'Barbearia',
                short_name: 'Barber',
                start_url: '/',
                display: 'standalone',
                background_color: '#ffffff',
                theme_color: '#2563EB',
                icons: [
                { src: '/icons/pwa-192.png', sizes: '192x192', type: 'image/png' },
                { src: '/icons/pwa-512.png', sizes: '512x512', type: 'image/png' },
                { src: '/icons/maskable-512.png', sizes: '512x512', type: 'image/png', purpose: 'any maskable' },
                ],
            },
            workbox: { navigateFallback: '/index.html' },
        }),
    ],
});
