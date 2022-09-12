$(function () {
    "use strict";
    console.log('( •ิཬ•ั ) Hello!!!');

    var obj = {
        init: function () {
            // this.aos();
            // this.wow();
            // this.visual();
            this.sterength();
            this.endless();
        },

        //aos
        aos: function () {
            AOS.init({
                startEvent: 'DOMContentLoaded',
                offset: 0,
                duration: 800,
                delay: '200',
                easing: 'ease-in-sine',
                once: true,
                mirror: true,
                disable: function () {
                    return $(window).width() <= 768;
                },
            });
        },

        wow: function () {
            var wow = new WOW(
                {
                    boxClass: 'wow',      // default
                    animateClass: 'animated', // default
                    offset: 0,          // default
                    mobile: false,
                    live: false,       // default
                }
            )
            wow.init();
        },

        visual: function () {
            if ($('#visual').length > 0) {
                $('#visual').slick({
                    dots: false,
                    infinite: true,
                    speed: 1000,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 5000,
                    arrows: false,
                    centerMode: false,
                    centerPadding: 0,
                    pauseOnHover: false,
                    fade: false,
                    variableWidth: false,
                });
            }
        },

        sterength: function () {
            $('.stere-slider').slick({
                dots: true,
                arrows: true,
                infinite: true,
                speed: 1000,
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 4000,
                pauseOnHover: false,
                pauseOnFocus: false,
                fade: true,
                cssEase: 'linear',
                prevArrow: $('.stere-prev'),
                nextArrow: $('.stere-next'),
                customPaging: function (slick, index) {
                    var html = '<div class="stere-line">' +
                        '<svg class="stere-shadow"><circle cx="50%" cy="50%" r="49%"></circle></svg>' +
                        '<svg class="stere-form"><circle cx="50%" cy="50%" r="49%"></circle></svg>' +
                        '</div>' +
                        '<div class="ste-pagi">' +
                        '<span class="stere-current">' + (index + 1) + '</span>/' +
                        '<span class="stere-total">' + slick.slideCount + '</span>'
                        + '</div>';
                    return html;
                },
                appendDots: $('.stere-pagi'),
            });
        },
        endless: function () {
            $("#trouble").endlessRiver({
                'speed': 80
            });
        }


    }

    obj.init();
});