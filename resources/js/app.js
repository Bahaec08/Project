import './bootstrap';
import "../css/app.css";
import AOS from './aos';





import { setupCalendar, Calendar, DatePicker } from 'v-calendar';
import 'v-calendar/style.css';


import { createApp, h } from "vue";
import { createInertiaApp, Link, Head } from "@inertiajs/inertia-vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/vue.m";
import { library } from '@fortawesome/fontawesome-svg-core';
import { faXmark, faList, faShop, faUserPen , faCirclePlus, faChartSimple, faCar, faHandshakeSimple, faEnvelope, faLock, faLocationDot, faEye, faListOl, faNoteSticky, faFilter, faClock, faRightFromBracket, faCalendar, faPlus} from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';


library.add([faXmark, faList, faShop, faUserPen, faPlus, faCirclePlus, faChartSimple, faCar, faHandshakeSimple, faEnvelope, faLock, faLocationDot, faEye, faListOl, faNoteSticky, faFilter, faClock, faRightFromBracket, faCalendar]);


createInertiaApp({
  resolve: (name) =>
    resolvePageComponent(
      `./Pages/${name}.vue`,
      import.meta.glob("./Pages/**/*.vue")
    ),
  setup({ el, app, props, plugin }) {
    return createApp({ render: () => h(app, props) })
      .use(plugin)
      .use(AOS)
      .use(ZiggyVue, Ziggy)
	    .use(setupCalendar)
      .component('font-awesome-icon', FontAwesomeIcon)
      .component("Link", Link)
	    .component('VCalendar', Calendar)
	    .component('VDatePicker', DatePicker)
      .component("Head", Head)
      .mount(el);
  },
});
