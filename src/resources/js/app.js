/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});




// ハンバーガーメニュ 
$(".c-openbtn").on('click', function() {
    $(this).toggleClass('active');
    $(".c-nav").toggleClass('panelactive');
});

$(".c-nav a").on('click', function() {
    $(".c-openbtn").removeClass('active');
    $(".c-nav").removeClass('panelactive');
});



$('.top-p-top-img img:nth-child(n+2)').hide();

setInterval(function() {
    $(".top-p-top-img img:first-child").fadeOut(3000);
    $(".top-p-top-img img:nth-child(2)").fadeIn(3000);
    $(".top-p-top-img img:first-child").appendTo(".top-p-top-img");
}, 6000);


$(window).on('scroll', function() {
    $('.u-fade-up , .u-fade-down , .u-fade-right').each(function() {
        //ターゲットの位置を取得
        var target = $(this).offset().top;
        //スクロール量を取得
        var scroll = $(window).scrollTop();
        //ウィンド高さ
        var height = $(window).height();

        var point = target - height; // 画面下部からのターゲットの位置


        //ターゲットまでスクロールするとフェードインする
        if (scroll > point && scroll < (point + $(this).height() + height)) {
            //クラスを付与
            $(this).addClass('active');
        } else {
            $(this).removeClass('active');
        }
    });
});