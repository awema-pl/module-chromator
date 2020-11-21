import types from './mutation-types';

export default {

    [types.SET_ACTIVE](state, payload) {
        state.active = payload;
    },

    [types.CONNECT_API](state, apiKey) {
        state.apiKey = apiKey;
    },

    [types.DISCONNECT_API](state) {
        state.apiKey = '';
    },

    [types.UPDATE_BASE_URL](state, payload) {
        state.baseUrl = payload;
    },
    
    [types.SET_CONNECTING](state, payload) {
        state.connectingApi = payload;
    },

    [types.SET_DEBUG](state, payload) {
        state.debug = payload;
        localStorage.setItem('debug',state.debug);
    },

    [types.SET_INFORMATION](state, payload) {
        state.subscriptionUserEmail = payload.membership.user.email;
        state.subscriptionOptionName = payload.membership.option.name;
        state.subscriptionExpiresAt = payload.membership.expires_at;
    },

    [types.SET_UPDATE](state, payload) {
        state.update = payload;
    },
};
