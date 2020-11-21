import Vue from 'vue'
import Router from 'vue-router'
import Welcome from '../../components/Welcome/Welcome.vue'

Vue.use(Router)

export default new Router({
    mode: 'history',
    base: '/popup/popup.html',
    routes: [
        { name: 'Welcome', path: '/', component: Welcome }
    ]
})
