import {getExpiresAt, isSubscribed} from './methods/subcriptions'
import moment from 'moment';
import {isEmpty} from 'lodash'

export default {
    active: state => state.active,
    debug: state => state.debug,
    baseUrl: state => state.baseUrl,
    apiKey: state => state.apiKey,
    connectingApi: state => state.connectingApi,
    subscription: state => state.subscription,
    subscriptionUserEmail: state => state.subscriptionUserEmail,
    subscriptionOptionName: state => state.subscriptionOptionName,
    subscriptionExpiresAt: state => state.subscriptionExpiresAt,
    isApiConnected: state=> !isEmpty(state.apiKey),
    isSubscribed: state => isSubscribed(state),
    isAccess: state=>isSubscribed(state) && state.active,
    update: state => state.update,
};


 
