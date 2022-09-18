import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp, Link, Head } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import Layout from "@/Shared/Layout.vue";


const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    // title: (title) => `${title} - ${appName}`,
    resolve: (name) => {
       let page = resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue'))

        page.then((module) => {
            module.default.layout ??= Layout;
        });

        return page;
    },
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .component("Link", Link)
            .component("Head", Head )
            .mount(el);
    },
    title: title => `My App - ${title}`
});

InertiaProgress.init({
    color: '#f00c29' ,
    showSpinner: true
});
