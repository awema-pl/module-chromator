<template>
<div>
    <p>Translation key <code>CHROMATOR_EXAMPLE</code> from <code>chromator/resources/lang/**/js.php</code>: {{$lang.CHROMATOR_EXAMPLE}}</p>
    <button class="form-builder__send btn" @click="testDebug">Test console log for debug</button>
    <p>From config JS file: {{this.example_data}}</p>
    <p>Example function: {{this.exampleFromFunction}}</p>
    <p>
        <button class="form-builder__send btn" @click="testLoading">Test loading</button>
        <span v-if="isLoading">is loading...</span>
    </p>
</div>
</template>

<script>
import chromatorMixin from '../js/mixins/chromator'
import {consoleDebug} from '../js/modules/helpers'

let _uniqSectionId = 0;

export default {

    name: 'chromator',

    mixins: [ chromatorMixin ],

    props: {
        name: {
            type: String,
            default() {
                return `chromator-${ _uniqSectionId++ }`
            }
        },

        default: Object,

        storeData: String,
    },


    computed: {
        chromator() {
            return this.$store.state.chromator[this.name]
        },

        isLoading() {
            return this.chromator && this.chromator.isLoading
        },
    },

    created() {

        let data = this.storeData ? this.$store.state[this.storeData] : (this.default || {})

        this.$store.commit('chromator/create', {
            name: this.name,
            data
        })
    },

    mounted() {

    },

    methods: {
        testDebug(){
            consoleDebug('message', ['data1'], ['data2'])
        },

        testLoading(){
            if ( this.isLoading) return;

            AWEMA.emit(`chromator::${this.name}:before-test-loading`)

            this.$store.dispatch('chromator/testLoading', {
                name: this.name
            }).then( data => {
                consoleDebug('data', data);
                this.$emit('success', data.data)
                this.$store.$set(this.name, this.$get(data, 'data', {}))
            })
        }
    },


    beforeDestroy() {

    }
}
</script>
