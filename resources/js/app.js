import '../css/app.css';
//import './bootstrap';
import axios from 'axios';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createApp, h } from 'vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import AOS from 'aos';
import 'aos/dist/aos.css';

const appName = import.meta.env.VITE_APP_NAME || 'Neutron';
window.axios = axios;
axios.defaults.withCredentials = true;
axios.defaults.withXSRFToken = true;
createInertiaApp({
    title: (title) => `${title} - ${appName}`,

    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue'),
        ),

    setup({ el, App, props, plugin }) {
        const app = createApp({
            render: () => h(App, props),
        });

        app
            .use(plugin)
            .use(ZiggyVue)
            .mount(el);

        setTimeout(() => {
            AOS.init({
                duration: 800,
                once: true,
            });
        }, 100);

        return app;
    },

    progress: {
        color: '#EF4444',
    },
});
