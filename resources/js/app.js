/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue'
import { ValidationProvider,ValidationObserver, extend } from 'vee-validate';

window.Vue = require('vue');

import vuetify from './plugins/vuetify';
import router from './router';
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('main-component', require('./components/MainComponent.vue').default);
Vue.component('ValidationProvider', ValidationProvider);
Vue.component('ValidationObserver', ValidationObserver);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import { required, email ,numeric} from 'vee-validate/dist/rules';

// Add the required rule
extend('required', {
    ...required,
    message: 'This field is required'
});

// Add the email rule
extend('email', {
    ...email,
    message: 'This field must be a valid email'
});

// Add the decimal rule
extend("decimal_amount", {
    validate: (value, { decimals = '*', separator = '.' } = {}) => {
        if (value === null || value === undefined || value === '') {
            return {
                valid: false
            };
        }
        let regexp = /^(?!0*[.,]0*$|[.,]0*$|0*$)\d+[,.]?\d{0,2}$/;
        return {
            valid: regexp.test(value),
        };
    },
    message: 'The {_field_} field must contain only positive decimal values'
})

const app = new Vue({
    el: '#app',
    vuetify,
    router
});
