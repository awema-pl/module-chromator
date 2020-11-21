import '../css/main.styl';
import Vue from 'vue'
import App from '../components/App/App.vue'
import store from './../../background/js/store'
import router from './router'

import {BButton, BFormInput, BForm, BIconArrowClockwise, BAlert} from 'bootstrap-vue'
Vue.component('b-button', BButton)
Vue.component('b-form-input', BFormInput)
Vue.component('b-form', BForm)
Vue.component('b-icon-arrow-clockwise', BIconArrowClockwise)
Vue.component('b-alert', BAlert)

const app = new Vue({
    el: '#app-chromator',
    store,
    router,
    render: h => h(App)
})
