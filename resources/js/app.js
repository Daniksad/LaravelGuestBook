/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.Vuex = require('vuex');
window.axios = require('axios');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.use(require('vue-moment'));
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('posts-component', require('./components/PostsComponent.vue').default);
Vue.component('submit-component', require('./components/SubmitComponent.vue').default);

const store = new Vuex.Store({
    actions: {
        addPost(context, data) {
            axios.post('/post/add', {data});
            axios.get('/');
        },
        changeStatus(context, data) {
            axios.post('/post/changeStatus', {data});
        },
        deletePost(context, data) {
            axios.post('/post/delete', {data});
        }
    },
    mutations: {

    }
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    store
});
