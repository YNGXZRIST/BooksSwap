import _ from 'lodash';

window._ = _;

import axios from 'axios';
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import tippy from 'tippy.js'
import "slick-carousel"
import Echo from 'laravel-echo';
window.toastr = require('toastr');
window.Pusher = require('pusher-js');
window.tippy = require('tippy.js');
window.slick=require('slick-carousel');


import "toastr";
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '52f22895600e08353c7e',
    cluster: 'eu',
    forceTLS: true
});
