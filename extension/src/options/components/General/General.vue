<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-5">
                <Update/>
            </div>
        </div>
        <div class="row justify-content-center mb-n3">
            <div class="col-5">
                <Active/>
            </div>
        </div>
    </div>
</template>

<script>
import Active from './Active/Active.vue'
import Update from './Update/Update.vue'
import {mapState} from 'vuex'
import {mapGetters} from 'vuex'
import {mapActions} from 'vuex'

export default {
    name: "General",
    components:{Active, Update},
    data() {
        return {};
    },
};
</script>

<style lang="stylus">

</style>
