<template>
    <div class="app">
        <div class="container mb-2">
            <div class="row">
                <div class="col-12">
                    <h2 class="mb-0">
                        <img class="mt-n2" :src="'chrome-extension://'+$chrome.i18n.getMessage('@@extension_id')+'/icons/icon-32.png'"/>
                        {{ $chrome.i18n.getMessage('extName') + ' - ' + this.$chrome.i18n.getMessage('options') }}
                        <span class="version">v{{$chrome.runtime.getManifest().version}}</span>
                    </h2>
                </div>
                <div class="col-12 text-muted">
                    {{ $chrome.i18n.getMessage('extDescription') }}
                </div>
            </div>
        </div>
        <div class="container mt-3">
            <b-card title="Card Title" no-body>
                <b-card-header header-tag="nav">
                    <b-nav card-header tabs>
                        <router-link to="/" v-slot="{ href, route, navigate, isActive, isExactActive }">
                            <b-nav-item :active="isExactActive" :href="href" @click="navigate">{{ $chrome.i18n.getMessage('options_general') }}</b-nav-item>
                        </router-link>
                        <router-link to="api" v-slot="{ href, route, navigate, isActive, isExactActive }">
                            <b-nav-item :active="isExactActive" :href="href" @click="navigate">{{ $chrome.i18n.getMessage('options_api') }}</b-nav-item>
                        </router-link>
                    </b-nav>
                </b-card-header>
                <b-card-body>
                    <router-view></router-view>
                </b-card-body>
            </b-card>
        </div>
        <div class="developer">
            <router-link to="developer" v-slot="{ href, route, navigate, isActive, isExactActive }">
                <a :href="href" @click="navigate">{{ $_.upperFirst($chrome.i18n.getMessage('developer')) }}</a>
            </router-link>
        </div>
    </div>
</template>
<script>

export default {
    name: "App",
    created() {
        document.title = this.$chrome.i18n.getMessage('extName') + ' - ' + this.$chrome.i18n.getMessage('options');
    }
};
</script>

<style lang='stylus' scoped>
.developer
    position absolute
    top 100%
    right 7px
    margin-top -20px
    font-size 11px
    opacity 0

    &:hover
        opacity 1
.version
    font-size 12px
</style>
