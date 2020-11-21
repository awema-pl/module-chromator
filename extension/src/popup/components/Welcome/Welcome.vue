<template>
    <div>
        <Update/>
       <div v-if="isSubscribed">
           <Active/>
       </div>
        <Connection from-plugin/>
    </div>
</template>

<script>
import {mapState} from 'vuex'
import {mapGetters} from 'vuex'
import {mapActions} from 'vuex'
import Connection from '../../../options/components/API/Connection/Connection.vue'
import Active from '../../../options/components/General/Active/Active.vue'
import Update from '../../../options/components/General/Update/Update.vue'

export default {
    name: "Welcome",
    components: {Connection, Active, Update},
    computed: {
        ...mapGetters({
            isSubscribed: 'isSubscribed',
        }),
    },
};
</script>

<style lang="stylus">

</style>
