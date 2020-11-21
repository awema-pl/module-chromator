<template>
    <div class="container mb-3" v-if="update">
        <div class="row">
            <div class="col-12">
                <div class="alert alert-warning text-center mb-0" role="alert">
                    <div> {{ $chrome.i18n.getMessage('newerVersionAvailable') }}</div>
                    <button type="button" class="btn btn-warning btn-sm mt-2" @click="updateExtension">{{ $_.upperFirst($chrome.i18n.getMessage('updateExtension')) }}</button>
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
    name: "Update",
    data() {
        return {};
    },
    computed: {
        ...mapGetters({
            update: 'update',
        }),
    },
    methods: {
        ...mapActions({
            updateExtension: 'updateExtension'
        }),
    },
};
</script>

<style lang="stylus" scoped>

</style>
