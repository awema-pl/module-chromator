import Vue from 'vue';
import store from './../../../background/js/store'
import Header from './../components/header/Header.vue'


import './../css/main.styl';

var wrapper = document.createElement('div');
wrapper.id = 'chromator-allegro-auctions';
document.querySelector('body').prepend(wrapper);

new Vue({
    el: '#' + 'chromator-allegro-auctions',
    store,
    render: h => h(Header),
});
