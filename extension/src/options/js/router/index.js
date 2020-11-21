import Vue from 'vue'
import Router from 'vue-router'
import General from '../../components/General/General.vue'
import API from '../../components/API/API.vue'
import Developer from '../../components/Developer/Developer.vue'

Vue.use(Router)

export default new Router({
    mode: 'hash',
    base: '/options/options.html',
    routes: [
        { name: 'General', path: '/', component: General },
        { name: 'API', path: '/api', component: API },
        { name: 'Developer', path: '/developer', component: Developer },
        { path: '*', component: Developer }
    ],
})
