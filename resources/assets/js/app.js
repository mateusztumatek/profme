
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import 'jquery-ui';

import 'jquery-ui/ui/effect.js';
import 'chart.js';
import 'jquery-ui';
import 'jquery-ui/ui/widgets/autocomplete';
import 'jquery-ui/ui/widgets/tooltip';
import 'jquery-ui/ui/widgets/datepicker';
import 'jquery-ui/ui/widgets/tabs.js';
import 'jquery-ui/ui/widgets/resizable.js';
import 'jquery-ui/ui/widgets/button.js';


require ('jquery-ui/ui/widgets/autocomplete.js');
window.jquery_ui = require('jquery-ui');
window.Vue = require('vue');
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('post-comments', require('./components/comments.vue'));
Vue.component('example-component', require('./components/ExampleComponent.vue'));


const app = new Vue({
    el: '#app'
});


