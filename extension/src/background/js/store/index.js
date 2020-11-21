import Vue from "vue"
import Vuex from "vuex"
import VuexWebExtensions from 'vuex-webextensions';

import state from './state';
import getters from './getters';
import mutations from './mutations';
import actions from './actions';
import _ from 'lodash';
import modulePopup from "./../../../popup/js/store";
import moduleOptions from "./../../../options/js/store";
import moduleAllegroAuctions from "./../../../content-scripts/allegro-auctions/js/store"
import moment from 'moment';
import axios from 'axios/dist/axios.min.js';

Vue.prototype.$chrome = chrome;
Vue.prototype.$_ = _;
Vue.prototype.$moment = moment;

Vue.use(Vuex)

const store = new Vuex.Store({
    state,
    getters,
    mutations,
    actions,
    modules: {
        popup: modulePopup,
        options: moduleOptions,
        allegroAuctions: moduleAllegroAuctions,
    },
    plugins: [VuexWebExtensions({
        persistentStates: ['active','debug','baseUrl','apiKey', 'subscriptionUserEmail','subscriptionOptionName', 'subscriptionExpiresAt', 'counter'],
        ignoredMutations: ['SET_CONNECTING','INCREMENT_STATE_50', 'allegroAuctions/INCREMENT_COUNTER'], // not synchronize (not save in background)
        ignoredActions: ['connectApi', 'disconnectApi', 'updateBaseUrl', 'refreshInformations', 'setUpdate', 'setDebug', 'setActive', 'allegroAuctions/incrementCounter'],
        syncActions: true,
        loggerLevel: localStorage.getItem('debug') === 'true' ? 'debug' : 'warning',
    })]
})

Vue.prototype.$http = function(){
    return axios.create({
        baseURL: store.getters.baseUrl,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Authorization': 'Bearer '+ store.getters.apiKey
        }
    });
}

export default store
