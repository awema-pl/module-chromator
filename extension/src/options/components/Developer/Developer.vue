<template>
   <div class="p-4">
       <div class="row justify-content-center">
           <div class="col-5">
               <Debug/>
           </div>
       </div>
       <div class="row justify-content-center mt-4">
           <div class="col-5">
               <Server/>
           </div>
       </div>
   </div>
</template>
<script>

import Server from './Server/Server.vue'
import Debug from './Debug/Debug.vue'

export default {
    name: "Developer",
    components:{Server, Debug},
};
</script>

<style lang="stylus">

</style>
