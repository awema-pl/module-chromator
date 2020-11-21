import types from './mutation-types';
import {get} from 'lodash';
import Vue from "vue";
import axios from 'axios/dist/axios.min.js';

export default{

    setActive: ({ state, commit }, payload) =>  {
        commit('SET_ACTIVE', payload);
    },

    setDebug: ({ state, commit }, payload) =>  {
        commit('SET_DEBUG', payload);
    },

    connectApi: ({ state, commit }, payload) =>  {
        commit('SET_CONNECTING', true);
        const http = axios.create({
            baseURL: state.baseUrl,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Authorization': 'Bearer '+payload
            }
        });
        http.get('api/chromator/information/informations')
            .then(function (response) {
                commit(types.CONNECT_API, payload)
                commit(types.SET_INFORMATION, response.data)
            })
            .catch(function (error) {
                let message = get(error, 'response.data.message', error)
                const status = get(error, 'response.status')
                if (get(error, 'message') === 'Network Error'){
                    message = chrome.i18n.getMessage('noConnectionToApiServer')
                } else if(get(error, 'response.status') === 401){
                    message = chrome.i18n.getMessage('noAccessToApi')
                }
                alert(message)
            })
            .then(function () {
                commit('SET_CONNECTING', false);
            });
    },

    refreshInformations: ({ state, commit, getters }) =>  {
        if (getters.isApiConnected){
            Vue.prototype.$http().get('api/chromator/information/informations')
                .then(function (response) {
                    commit(types.SET_INFORMATION, response.data)
                })
                .catch(function (error) {
                    const message = get(error, 'response.data.message', error)
                    console.error(message);
                })
        }
    },

    setUpdate: ({ state, commit }, payload) =>  {
        chrome.browserAction.setBadgeBackgroundColor({ color: [224, 168, 0, 255] });
        chrome.browserAction.setBadgeText ( { text: chrome.i18n.getMessage('badgeShortUpdate') } );
        commit(types.SET_UPDATE, payload)
    },

    updateExtension: ({ state, commit }) =>  {
        chrome.runtime.reload();
    },

    disconnectApi: ({ state, commit }) =>  {
        commit(types.DISCONNECT_API)
    },

    updateBaseUrl: ({ state, commit }, payload) =>  {
        commit(types.UPDATE_BASE_URL, payload)
    },

}
