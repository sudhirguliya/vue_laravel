
window._ = require('lodash');

try {
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {}


window.axios = require('axios');
//window.axios.defaults.baseURL = document.head.querySelector('meta[name="api-base-url"]').content;
//window.axios.defaults.baseURL = 'http://52.66.58.148/Vue-Laravel-SPA/public';
window.axios.defaults.baseURL = 'http://localhost:8000';

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
