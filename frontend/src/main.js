import Vue from 'vue'
import "./mixins/local-functions";
import App from './App.vue'
import router from './router'
import axios from './plugins/axios'
import vuetify from './plugins/vuetify'
import { appData } from "./mixins/store";
import { CsrfToken } from "./mixins/csrf-token";
import FormLoader from 'laravel-vue-easyforms';
import AsyncComputed from 'vue-async-computed'
import VueScrollTo from 'vue-scrollto'
import VueMask from 'v-mask'
import moment from 'moment'


import './styles/globalStyles.scss';

window.axios = axios;
// intercepting responses
// window.axios.interceptors.response.use(function (response) {
//     return response;
// }, function (error) {
//     console.log(error)
//     // Do something with response error
//     if(error.response.status === 403){
//         appData.setSystemSnackBar({value: true, message: error.response.data.message});
//     }
//     // Check for Unauthenticated and Expired Sessions
//     if(error.response.status === 401 || error.response.status === 419){
//         router.push('/login');
//     }
//     // Check for Errors in response
//     if(error.response.status === 500){
//         router.push('/login');
//     }
//     return Promise.reject(error);
// });

Vue.config.productionTip = false

Vue.prototype.$appLegalName = "Laravel Vue Easy Forms";
Vue.prototype.$appName = "Laravel Vue Easy Forms";
Vue.prototype.$appVersion = "v0.0.001-beta";
Vue.prototype.$storageUrl = '';

Vue.prototype.$axios = axios;

Vue.prototype.$crsfToken = { 
    token: false, 
    loading: false,
};
Vue.prototype.$microservice = { 
    url: 'http://localhost:80',
    forms: 'http://localhost:80/axios',
};

Vue.mixin(CsrfToken);

Vue.use(AsyncComputed)
Vue.use(VueMask);
Vue.use(VueScrollTo);
Vue.use(appData);

Vue.use( FormLoader, {
    axiosPrefix: Vue.prototype.$microservice.forms,
    axios: axios,
    vueRouter: true,
});


Vue.directive('click-outside', {
    bind () {
        if(this != undefined && this.event){
            this.event = event => this.vm.$emit(this.expression, event)
            this.el.addEventListener('click', this.stopProp)
            document.body.addEventListener('click', this.event)
        }
    },   
    unbind() {
        this.el.removeEventListener('click', this.stopProp)
        document.body.removeEventListener('click', this.event)
    },

    stopProp(event) { event.stopPropagation() }
})

Vue.filter('formatDate', function(value) {
    if (value) {
      return moment(String(value)).format('DD/MM/YYYY hh:mm A')
    }
  }
)
window.setLocal('microservice', JSON.stringify(Vue.prototype.$microservice))

new Vue({
  vuetify,
  router,
  render: h => h(App)
}).$mount('#app')

