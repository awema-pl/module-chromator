import store from './store'

const intervalRefreshInformation = localStorage.getItem('debug') === 'true' ? 5000 : 6 * 1000;

const loopRefreshInformation = function(){
    store.dispatch('refreshInformations')
    setInterval(()=>{
        store.dispatch('refreshInformations')
    }, intervalRefreshInformation)
}

//store.dispatch('setUpdate', true) // test information about update extension

chrome.runtime.onUpdateAvailable.addListener(function(details) {
    store.dispatch('setUpdate', true)
});

chrome.runtime.requestUpdateCheck(function(status) {
    if (status == "update_available") {
        store.dispatch('setUpdate', true)
    }
});

setTimeout(()=>{
    loopRefreshInformation();
},1000);

if (localStorage.getItem('debug') === 'true'){
    chrome.tabs.create({ url: 'chrome-extension://'+ chrome.i18n.getMessage('@@extension_id')+ '/options/options.html'});
}
