import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


import $ from 'jquery';
window.$ = $;
window.jQuery = $;

$(document).ready(function() {
    $('.select2').select2();
});
