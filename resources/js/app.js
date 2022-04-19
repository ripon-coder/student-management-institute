/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;
import Vuetify from 'vuetify';
Vue.use(Vuetify);


// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))


import batchCreate from './components/batch/batchcreate.vue';
import batchEdit from './components/batch/batchEdit.vue';






const app = new Vue({
    vuetify : new Vuetify(),
    el: '#app',
    components : {
        batchCreate,batchEdit,
    },
});
