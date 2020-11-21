/**
 * Bundle of AWEMA chromator transpiled and polyfilled
 * Generated: 2020-11-09 12:54:48
 * Version: 1.0.0
 */

!function(){"use strict";function t(t,...e){!0===AWEMA_CONFIG.dev&&console.debug(t,e)}var e={example_data:"example-data-from-config"},a={props:{example_data:{type:String,default(){return this._config.example_data}}},inject:{},computed:{exampleFromFunction:()=>"example-function"},beforeCreate(){this._config=Object.assign(e,AWEMA.utils.object.get(AWEMA_CONFIG,"chromator",{}))}};let o=0;var s=function(t,e,a,o,s,n,i,r,d,c){"boolean"!=typeof i&&(d=r,r=i,i=!1);var m,_="function"==typeof a?a.options:a;if(t&&t.render&&(_.render=t.render,_.staticRenderFns=t.staticRenderFns,_._compiled=!0,s&&(_.functional=!0)),o&&(_._scopeId=o),n?(m=function(t){(t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),e&&e.call(this,d(t)),t&&t._registeredComponents&&t._registeredComponents.add(n)},_._ssrRegister=m):e&&(m=i?function(){e.call(this,c(this.$root.$options.shadowRoot))}:function(t){e.call(this,r(t))}),m)if(_.functional){var l=_.render;_.render=function(t,e){return m.call(e),l(t,e)}}else{var h=_.beforeCreate;_.beforeCreate=h?[].concat(h,m):[m]}return a}({render:function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[a("p",[t._v("Translation key "),a("code",[t._v("CHROMATOR_EXAMPLE")]),t._v(" from "),a("code",[t._v("chromator/resources/lang/**/js.php")]),t._v(": "+t._s(t.$lang.CHROMATOR_EXAMPLE))]),t._v(" "),a("button",{staticClass:"form-builder__send btn",on:{click:t.testDebug}},[t._v("Test console log for debug")]),t._v(" "),a("p",[t._v("From config JS file: "+t._s(this.example_data))]),t._v(" "),a("p",[t._v("Example function: "+t._s(this.exampleFromFunction))]),t._v(" "),a("p",[a("button",{staticClass:"form-builder__send btn",on:{click:t.testLoading}},[t._v("Test loading")]),t._v(" "),t.isLoading?a("span",[t._v("is loading...")]):t._e()])])},staticRenderFns:[]},void 0,{name:"chromator",mixins:[a],props:{name:{type:String,default:()=>`chromator-${o++}`},default:Object,storeData:String},computed:{chromator(){return this.$store.state.chromator[this.name]},isLoading(){return this.chromator&&this.chromator.isLoading}},created(){let t=this.storeData?this.$store.state[this.storeData]:this.default||{};this.$store.commit("chromator/create",{name:this.name,data:t})},mounted(){},methods:{testDebug(){t("message",["data1"],["data2"])},testLoading(){this.isLoading||(AWEMA.emit(`chromator::${this.name}:before-test-loading`),this.$store.dispatch("chromator/testLoading",{name:this.name}).then(e=>{t("data",e),this.$emit("success",e.data),this.$store.$set(this.name,this.$get(e,"data",{}))}))}},beforeDestroy(){}},void 0,!1,void 0,void 0,void 0);var n={installed:!1,install:function(t){this.installed||(this.installed=!0/t.component("chromator",s))}},i={CHROMATOR_EXAMPLE:"chromator example"};var r={state:()=>({}),getters:{chromator:t=>e=>t[e],isLoading:(t,e)=>t=>{const a=e.chromator(t);return a&&a.isLoading}},mutations:{create(t,{name:e,data:a}){Vue.set(t,e,{isLoading:!1,data:a})},setLoading(t,{name:e,status:a}){Vue.set(t[e],"isLoading",a)}},actions:{restoreData:({state:t},{name:e})=>t[e].exampleData||"example-data",testLoading:({state:e,commit:a,dispatch:o},{name:s})=>new Promise(n=>{let i;e[s];a("setLoading",{name:s,status:!0}),o("restoreData",{name:s}).then(e=>(t("data",e),["data-2"])).then(e=>{i=e,t("data-2",e)}).finally(()=>{setTimeout(()=>{a("setLoading",{name:s,status:!1}),n(i)},2e3)})})},namespaced:!0};const d={name:"chromator",version:"1.0.0",install(t){Vue.use(n),t._store.registerModule("chromator",r),t.lang=i}};window&&"AWEMA"in window?AWEMA.use(d):(window.__awema_plugins_stack__=window.__awema_plugins_stack__||[],window.__awema_plugins_stack__.push(d))}();
