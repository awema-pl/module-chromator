<template>
    <div class="container">
             <div class="row">
            <div class="col-8 pr-0">
                <div class="custom-control custom-checkbox mt-1">
                    <input type="checkbox" class="custom-control-input" id="debug" v-model="newDebug">
                    <label class="custom-control-label mb-0" for="debug">{{$_.upperFirst($chrome.i18n.getMessage('plugin_debug'))}}</label>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
import {mapState} from 'vuex'
import {mapGetters} from 'vuex'
import {mapActions} from 'vuex'

export default {
    name: "Debug",
    data() {
        return {};
    },
    computed: {
        ...mapGetters({
            debug: 'debug',
        }),
        newDebug: {
            get: function () {
                return this.debug
            },
            set: function (debug) {
                this.setDebug(debug);
                this.$bvToast.toast(this.$chrome.i18n.getMessage('successfullySaved'), {
                    title: this.$_.upperFirst(this.$chrome.i18n.getMessage('message')),
                    variant: 'success',
                    toaster: 'b-toaster-bottom-right',
                    autoHideDelay: 3000,
                    appendToast: true,
                })
            }
        }
    },
    methods: {
        ...mapActions({
            setDebug: 'setDebug',
        }),
    }
};
</script>

<style lang="stylus" scoped>

</style>
