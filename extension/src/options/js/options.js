import '../css/main.styl';

import Vue from 'vue'
import App from '../components/App/App.vue'
import store from './../../background/js/store'
import router from './router'

import { BVToastPlugin, BButton, BFormInput, BForm, BIconArrowClockwise, BCardText, BCard, BCardHeader, BCardBody, BNav, BNavItem} from 'bootstrap-vue'
Vue.use(BVToastPlugin)
Vue.component('b-button', BButton)
Vue.component('b-form-input', BFormInput)
Vue.component('b-form', BForm)
Vue.component('b-icon-arrow-clockwise', BIconArrowClockwise)
Vue.component('b-card', BCard)
Vue.component('b-card-header', BCardHeader)
Vue.component('b-card-body', BCardBody)
Vue.component('b-card-text', BCardText)
Vue.component('b-nav', BNav)
Vue.component('b-nav-item', BNavItem)

const app = new Vue({
    el: '#app-chromator',
    store,
    router,
    render: h => h(App)
})
