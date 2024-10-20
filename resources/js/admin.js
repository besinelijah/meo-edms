import './bootstrap';
import '../css/app.css';

import { createApp, h, ref } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Admin/Pages/${name}.vue`, import.meta.glob('./Admin/Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .component('Head', Head)
            .component('Link', Link)
            .component('ref', ref)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
