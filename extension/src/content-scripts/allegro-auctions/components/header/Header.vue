<template>
    <div class="p-4" v-if="isAccess">
        <h2 class="text-center">
            <div class="text-center"><img :src="'chrome-extension://'+$chrome.i18n.getMessage('@@extension_id')+'/icons/icon-32.png'"/></div>
            {{$chrome.i18n.getMessage('extName')}} {{$chrome.i18n.getMessage('injected')}} <span class="version">v{{$chrome.runtime.getManifest().version}}</span>
        </h2>
        <Update/>
        <div class="text-center">{{$_.upperFirst($chrome.i18n.getMessage('counter'))}}: {{counter}}</div>
        <div class="text-center">
            <button class="btn btn-primary" @click="incrementCounter">+</button>
        </div>
    </div>
</template>

<script>

import {mapActions, mapGetters} from "vuex";
import Update from './../../../../options/components/General/Update/Update.vue'

export default {
    components: {Update},
    computed: {
        ...mapGetters({
            isAccess:  'isAccess',
        }),
        ...mapGetters('allegroAuctions', {
            counter:  'counter',
        }),
    },
    methods: {
        ...mapActions('allegroAuctions',{
            incrementCounter: 'incrementCounter',
        }),
    }
};

</script>

<style lang="stylus" scoped>
.version
    font-size 12px
</style>
