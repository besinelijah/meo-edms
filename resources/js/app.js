import './bootstrap';
import '../css/app.css';
import { createApp, h } from 'vue';
import { createInertiaApp, Head, Link } from '@inertiajs/inertia-vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import AuthenticatedLayout from './Admin/Layouts/AuthenticatedLayout.vue';
import { InertiaProgress } from '@inertiajs/progress';
import Toast from "vue-toastification";
import appConfig from "./config/app";

InertiaProgress.init({
  color: '#29d',
  showSpinner: true,
});
createInertiaApp({
  title: (title) => `${title} | MEO-EDMS`,
  setup({ el, App, props, plugin }) {
    return createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(ZiggyVue)
      .use(Toast, appConfig.toast)
      .component('Head', Head)
      .component('Link', Link)
      .mount(el);
  },
  resolve: name => {
    
    const page = resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue'));

    // Assign default layout if it is not defined in the component
    page.then(component => {
      component.default.layout = component.default.layout || AuthenticatedLayout;
    });

    return page;
  },
});