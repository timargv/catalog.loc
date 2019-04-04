
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

$('.toast').toast('show');

$(document).ready(function() {
    $(".dropdown-menu").on("click", function (e) {
        e.stopPropagation();
    });


    // $('#aHref[data-id]').hover(function () {
    //     $('.vertical-menu_block[data-id=' + $(this).attr('data-id') + ']').show();
    // }, function () {
    //     var dataId = $('.vertical-menu_block[data-id=' + $(this).attr('data-id') + ']');
    //     $(dataId).data('timer', setTimeout(function () {
    //         $(dataId).hide();
    //     }, 1000));
    //
    // });

    var categoryDataId = $('#aHref[data-id]:first').addClass('active');
    $('.vertical-menu_block[data-id=' + $(categoryDataId).attr('data-id') + ']').show();


    $('#aHref[data-id]').on('mouseover', function(e) {
        $('.n-navigation-vertical-category > li').removeClass('active');
        $('.vertical-menu_block[data-id]').hide();


        $(this).addClass('active');
        $('.vertical-menu_block[data-id=' + $(this).attr('data-id') + ']').show();


    });

});


// window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//     el: '#app'
// });
