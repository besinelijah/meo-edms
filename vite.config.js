import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
            hmr: false,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    optimizeDeps: {
        include: [
            'object-assign',
            'concaveman',
            'rbush',
            'earcut',
            'geojson-rbush',
            'deep-equal',
            'geojson-equality',
            'density-clustering',
            'skmeans'
        ],
    },
});
