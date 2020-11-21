<template>
  <div class="app">
      <div class="container mb-2">
          <div class="row">
              <div class="col-8">
                  <h2 class="mb-0"><img class="mt-n2" :src="'chrome-extension://'+$chrome.i18n.getMessage('@@extension_id')+'/icons/icon-32.png'"/> {{$chrome.i18n.getMessage('extName')}}
                      <span class="version">v{{$chrome.runtime.getManifest().version}}</span>
                  </h2>
              </div>
              <div class="col-4">
                  <b-button class="btn-block" size="sm" variant="outline-secondary" @click="handleOptions">
                      {{$_.upperFirst($chrome.i18n.getMessage('options'))}}
                  </b-button>
              </div>
              <div class="col-12 text-muted">
                  {{$chrome.i18n.getMessage('extDescription')}}
              </div>
          </div>
      </div>
      <router-view></router-view>
  </div>
</template>
<script>

export default {
  name: "app",
    methods:{
        handleOptions(){
            this.$chrome.tabs.create({ url: 'chrome-extension://'+ this.$chrome.i18n.getMessage('@@extension_id')+ '/options/options.html'});
        }
    }
};
</script>

<style lang='stylus'>
.app
    min-width 420px
.version
    font-size 12px
</style>
