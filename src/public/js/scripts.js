/*-----------------------
  @MODULE
------------------------*/
// ww.module_prototype = (function(){
//     return {
//         init: function() {

//         }
//     };
// })();

/* TOC

  @MAIN

   TOC */

/*-----------------------*/

if (typeof ww == 'undefined') {
    var ww = {};
}

/*-----------------------
  @MAIN
------------------------*/
ww.main = (function() {

    return {
        init: function() {
            ww.common.init();
            this.register_events();
        },

        register_events: function() {
            ww.navigation.init();
            ww.embed_video.init();
            ww.custom_forms.init();
            ww.carousels.init();
        },
    };
})();

/*-----------------------
  @COMMON
------------------------*/
ww.common = (function(){
    return {
        init: function() {
            this.baseline();
            this.dummy_links();
        },

        baseline: function() {
            if (this.get_qs_val('ruled') == 1) {
                $.get("/ajax/get_view", {view: "styleguide/partials/_baseline"}, function(data) {
                    $(".styleguide__block").append(data);
                });
            }
        },

        dummy_links: function() {
            $(document).on("click", "a[href='#']", function(e) {
                e.preventDefault();
            });
        },

        // http://stackoverflow.com/a/3855394
        get_qs_val: function(my_key) {
            var qs = (function(a) {
                if (a === "") {
                    return {};
                }

                var b = {};
                for (var i = 0; i < a.length; ++i) {
                    var p = a[i].split('=', 2);

                    if (p.length == 1) {
                        b[p[0]] = "";
                    } else {
                        b[p[0]] = decodeURIComponent(p[1].replace(/\+/g, " "));
                    }
                }
                return b;
            })(window.location.search.substr(1).split('&'));

            return qs[my_key];
        }
    };
})();

/*-----------------------
  @NAVIGATION
------------------------*/
ww.navigation = (function(){
    var settings = {
        $menu_trigger: $('.nav-header-trigger'),
        $masthead: $('.masthead'),
        $products_dropdown: $('.products-dropdown'),
        $subnav_trigger_mobile: $('.subnav-trigger'),
        $nav_arrow_products: $('.nav-arrow--products'),
    };

    return {
        init: function() {

            this.mobile_menu();
            this.products_subnav_hover();
            this.products_subnav_click();
        },

        mobile_menu: function() {
            settings.$menu_trigger.on("click", function(e) {
                settings.$masthead.toggleClass('nav-header--is-open');
                e.preventDefault();
            });
        },

        products_subnav_hover: function() {

            settings.$products_dropdown.on("mouseenter", function(e) {
                settings.$masthead.toggleClass('subnav-products--is-hovered');
                settings.$nav_arrow_products.toggleClass('hovered');
            });
            settings.$products_dropdown.on("mouseleave", function(e) {
                settings.$masthead.toggleClass('subnav-products--is-hovered');
                settings.$nav_arrow_products.toggleClass('hovered');
            });
        },

        products_subnav_click: function() {

            settings.$subnav_trigger_mobile.on("click", function(e) {
                if ($(window).width() < 1024) {
                    settings.$masthead.toggleClass('subnav-products--is-open');
                    settings.$nav_arrow_products.toggleClass('selected');
                    e.preventDefault();
                }
            });
        }
    };
})();

/*-----------------------
  @EMBED VIDEO
------------------------*/
ww.embed_video = (function() {
    var settings = {
        autoplay: 1,
        video_width: 462,
        video_height: 260,
        current_height: 0,
        $icon: $(".footer .icon-brand").clone(),
    };

    return {
        init: function() {
            $(".video-embed-trigger").on("click", function(e) {
                e.preventDefault();

                var $el = $(this),
                    video_id = $el.attr("href").split('/').pop(),
                    $wrapper = $el.closest(".video");
                settings.current_height = $wrapper.outerHeight();

                $wrapper
                    .css({"height":settings.current_height})
                    .contents()
                    .fadeOut(300, function() {
                        $wrapper
                            .css({"padding-top":settings.current_height / 2})
                            .html(settings.$icon);
                        settings.$icon
                            .delay(500)
                            .fadeIn(300, function() {
                                settings.$icon.delay(1500).fadeOut(300, function() {
                                    $wrapper
                                        .css({"padding-top":0})
                                        .html('<iframe src="//player.vimeo.com/video/'+video_id+'?title=0&amp;byline=0&amp;portrait=0&amp;autoplay='+settings.autoplay+'" width="'+settings.video_width+'" height="'+settings.video_height+'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>')
                                        .fitVids();
                                });
                            });
                    });
            });
        },
    };
})();

/*-----------------------
  @CUSTOM FORMS
------------------------*/
ww.custom_forms = (function() {
    return {
        init: function() {
            this.selects();
            this.checks();
        },

        selects: function() {
            $('.selectric').selectric();
        },
        checks: function() {
            $('input[type="checkbox"]').iCheck({
                checkboxClass: 'icheckbox_flat',
                radioClass: 'iradio_flat'
            });
        },
    };
})();

/*-----------------------
  @CAROUSELS
------------------------*/
ww.carousels = (function(){
    return {
        init: function() {
            $('.slick-carousel').slick({
                prevArrow: '<button type="button" class="my-slick-prev"><img src="http://skylightspecialist.dev/assets/images/prev-arrow.png"></button>',
                nextArrow: '<button type="button" class="my-slick-next"><img src="http://skylightspecialist.dev/assets/images/next-arrow.png"></button>',
                infinite: true,
                speed: 500,
                fade: true,
                slide: 'div',
                cssEase: 'linear'
            });
        },
    };
})();

/*
 * LOAD!
 */
 
jQuery(function() {
    ww.main.init();
});