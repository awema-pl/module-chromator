<template>
    <div class="container mb-3">
        <div class="row">
            <div class="col-12">
                <b-button v-if="isAccess" class="btn-block" size="sm" variant="outline-primary" @click="handleDeactivate">
                    {{ $_.upperFirst($chrome.i18n.getMessage('turnOffExtension')) }}
                </b-button>
                <b-button v-if="!isAccess" class="btn-block" size="sm" variant="outline-danger" @click="handleActivate">
                    {{ $_.upperFirst($chrome.i18n.getMessage('turnOnExtension')) }}
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
    name: "Active",
    data() {
        return {};
    },
    computed: {
        ...mapGetters({
            isAccess: 'isAccess',
            isSubscribed: 'isSubscribed',
        }),
    },
    methods: {
        ...mapActions({
            setActive: 'setActive'
        }),
        handleActivate(){
            if (!this.isSubscribed){
                this.$bvToast.toast(this.$chrome.i18n.getMessage('noActiveSubscription'), {
                    title: this.$_.upperFirst(this.$chrome.i18n.getMessage('warning')),
                    variant: 'warning',
                    toaster: 'b-toaster-bottom-right',
                    autoHideDelay: 3000,
                    appendToast: true,
                })
            }else {
                this.setActive(true)
            }

        },
        handleDeactivate(){
            this.setActive(false)
        },
    },
};
</script>

<style lang="stylus" scoped>

</style>
