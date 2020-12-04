<template>
    <div class="container">
        <div class="row" v-if="!isApiConnected">
            <div class="col-12">
                <small>{{ $chrome.i18n.getMessage('plugin_connectWithApi') }}</small>
            </div>
            <div class="col-12">
                <div class="alert alert-danger text-center" role="alert">
                    {{ $chrome.i18n.getMessage('connectWithApi') }}
                </div>
            </div>
            <div class="col-8 pr-0">
                <b-form-input :disabled="connectingApi" size="sm" v-model="apiKey"
                              :placeholder="$chrome.i18n.getMessage('plugin_apiKey')"></b-form-input>
            </div>
            <div class="col-4">
                <b-button :disabled="connectingApi" class="btn-block" size="sm" variant="outline-primary" @click="handleConnectApi">
                    {{ $chrome.i18n.getMessage('plugin_connect') }}
                    <b-icon-arrow-clockwise v-if="connectingApi" class="ml-1" animation="spin"></b-icon-arrow-clockwise>
                </b-button>
            </div>
        </div>
        <div class="row" v-if="isApiConnected">
            <div class="col-12">
                <div class="alert text-center mb-0"
                     v-bind:class="[isSubscribed ? 'alert-success' : 'alert-warning']" role="alert">
                    {{ $chrome.i18n.getMessage('apiConnectionIsActive') }}
                    <div class="subscription mt-1">
                        <div v-if="subscriptionExpiresAt">
                            <div>
                                <small>{{$_.upperFirst($chrome.i18n.getMessage('yourSubscription'))}} "{{subscriptionOptionName}}",</small>
                            </div>
                            <small>
                                <template v-if="isSubscribed">
                                    {{$chrome.i18n.getMessage('expiresOn')}}
                                </template>
                            </small>
                            <template v-if="!isSubscribed">
                                <span class="badge badge-danger">{{$chrome.i18n.getMessage('expiredOn')}}</span>
                            </template>
                            <small>
                                {{getExpiresAt.format('YYYY-MM-DD HH:mm:ss')}}
                            </small>
                        </div>
                        <div v-if="!subscriptionExpiresAt">
                            <span class="badge badge-danger">{{$chrome.i18n.getMessage('subscriptionExpired')}}</span>
                        </div>
                        <div>
                            <small>{{ $_.upperFirst($chrome.i18n.getMessage('user')) }}: {{subscriptionUserEmail}}.</small>
                        </div>
                    </div>
                </div>
                <b-button v-if="!fromPlugin" class="btn-block mt-3" size="sm" variant="outline-primary" @click="handleDisconnectApi">
                    {{ $chrome.i18n.getMessage('plugin_disconnect') }}
                </b-button>
            </div>
        </div>
    </div>
</template>

<script>
import {mapState} from 'vuex'
import {mapGetters} from 'vuex'
import {mapActions} from 'vuex'

export default {
    name: "Connection",
    props: {
        fromPlugin: Boolean,
    },
    data() {
        return {
            apiKey: '',
        };
    },
    computed: {
        ...mapGetters({
            connectingApi: 'connectingApi',
            subscriptionUserEmail: 'subscriptionUserEmail',
            subscriptionOptionName: 'subscriptionOptionName',
            subscriptionExpiresAt: 'subscriptionExpiresAt',
            getExpiresAt: 'getExpiresAt',
            isSubscribed: 'isSubscribed',
            isApiConnected: 'isApiConnected',
        }),
        isApiConnected (){
            return this.$store.getters.apiKey;
        },
    },
    methods: {
        ...mapActions({
            connectApi: 'connectApi',
            disconnectApi: 'disconnectApi',
        }),
        handleConnectApi(){
            this.connectApi(this.apiKey)
        },
        handleDisconnectApi(){
            this.disconnectApi()
            this.apiKey = ''
        },
    }
};
</script>

<style lang="stylus" scoped>
.subscription
    line-height 18px
</style>
