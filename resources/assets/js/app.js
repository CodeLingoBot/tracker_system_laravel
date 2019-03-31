
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('jquery');

import $ from 'jquery';
window.$ = window.jQuery = $;

require('./postmon.js');
window.VMasker = require('./vanilla-masker.min.js');
require('../bootstrap-datetimepicker/js/bootstrap-datetimepicker');
require('../color-picker/js/colorpicker');

$.fn.extend({
    mask: function (patern) {
        VMasker(this).maskPattern(patern);
        return $(this);
    },
    maskMoney: function(unit){
        const patern = {
            precision: 2,
            separator: ',',
            delimiter: '.',
            unit: unit,
            zeroCents: true
        };
        VMasker(this).maskMoney(patern);
        return $(this);
    },
    maskFloat: function(){
        const patern = {
            precision: 2,
            separator: ',',
            delimiter: '.',
            zeroCents: true
        };
        VMasker(this).maskMoney(patern);
        return $(this);
    }
});