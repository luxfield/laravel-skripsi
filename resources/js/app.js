import './bootstrap';
w// Require Vue
window.Vue = require('vue').default;

// Register Vue Components
Vue.component('example-component', require('./components/UserComponent.vue').default);

// Initialize Vue
const app = new Vue({
    el: '#app',
});
