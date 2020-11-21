<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <label class="mb-0" for="baseUrl">{{$_.upperFirst($chrome.i18n.getMessage('plugin_serverUrl'))}}</label>
            </div>
        </div>
        <div class="row">
            <div class="col-8 pr-0">
                <b-form-input size="sm" v-model="newBaseUrl"
                              :placeholder="$chrome.i18n.getMessage('plugin_serverUrl')"></b-form-input>
            </div>
            <div class="col-4">
                <b-button class="btn-block" size="sm" variant="outline-primary" @click="handleUpdateBaseUrl">
                    {{$_.upperFirst($chrome.i18n.getMessage('save'))}}
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
    name: "Server",
    data() {
        return {
            saveBaseUrl: ''
        };
    },
    computed: {
        ...mapGetters({
            baseUrl: 'baseUrl',
        }),
        newBaseUrl: {
            get: function () {
                this.saveBaseUrl = this.baseUrl
                return this.baseUrl
            },
            set: function (baseUrl) {
                this.saveBaseUrl = baseUrl;
            }
        }
    },
    methods: {
        ...mapActions({
            updateBaseUrl: 'updateBaseUrl',
        }),
        handleUpdateBaseUrl() {
            this.updateBaseUrl(this.saveBaseUrl);
            this.$bvToast.toast(this.$chrome.i18n.getMessage('successfullySaved'), {
                title: this.$_.upperFirst(this.$chrome.i18n.getMessage('message')),
                variant: 'success',
                toaster: 'b-toaster-bottom-right',
                autoHideDelay: 3000,
                appendToast: true,
            })
        },
    },
};
</script>

<style lang="stylus" scoped>

</style>
