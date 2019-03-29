
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('jquery');

import $ from 'jquery';
window.$ = window.jQuery = $;

import './postmon.js';
import $VMask from './vanilla-masker.min.js';
window.VMask = $VMask;

require('bootstrap');

window.Vue = require('vue');

const app = new Vue({
    el: '#wrapper'
});