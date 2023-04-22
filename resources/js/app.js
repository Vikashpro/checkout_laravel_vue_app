import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import MainLayout from './Layouts/MainLayout.vue'
import '../css/app.css'
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faTrash, faCartShopping } from '@fortawesome/free-solid-svg-icons'
library.add(faTrash, faCartShopping)


createInertiaApp({
  resolve: async (name) => {
    const pages = import.meta.glob('./Pages/**/*.vue')

    const page = await pages[`./Pages/${name}.vue`]()

    page.default.layout = page.default.layout || MainLayout
    return page;
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .component('font-awesome-icon', FontAwesomeIcon)
      .mount(el)
  },
})