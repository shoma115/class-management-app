import './bootstrap';



require('./bootstrap');

window.Vue = require('vue');
Vue.component('v-select', require('vue-select').default); // 👈 追加

// 👇 不要な部分はコメントアウト

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

// const app = new Vue({
//     el: '#app',
// });