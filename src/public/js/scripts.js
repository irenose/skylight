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

if (!window.console) {
    console = {log: function() {}};
}

var ww_globals = {
    $win: $(window),
    KEYCODE_ENTER: 13,
    KEYCODE_ESC: 27,
    KEYCODE_ARROW_LEFT: 37,
    KEYCODE_ARROW_RIGHT: 39,
    KEYCODE_M: 77,
    icon_chevron_left: '<i class="icon icon-chevron--left"><svg class="icon__svg"><use xlink:href="/assets/images/sprites/sprite.svg#icon-chevron--left"></use></svg></i>',
    icon_chevron_right: '<i class="icon icon-chevron--right"><svg class="icon__svg"><use xlink:href="/assets/images/sprites/sprite.svg#icon-chevron--right"></use></svg></i>',
    icon_chevron_left_reversed: '<i class="icon icon-chevron--left--reversed"><svg class="icon__svg"><use xlink:href="/assets/images/sprites/sprite.svg#icon-chevron--left--reversed"></use></svg></i>',
    icon_chevron_right_reversed: '<i class="icon icon-chevron--right--reversed"><svg class="icon__svg"><use xlink:href="/assets/images/sprites/sprite.svg#icon-chevron--right--reversed"></use></svg></i>',
};

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
            ww.fixed_nav.init();
            ww.conditional_modals.init();
            ww.paid_search.init();
            ww.scrollto.init();
            ww.maps.init();
            ww.search_maps.init();
            ww.anchors_to_options.init();
            ww.contact_validation.init();
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
            this.window_resize();
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

        // tests min-width based on _utilities.scss HOOKS
        check_breakpoint: function(str) {
            var result = window.getComputedStyle(document.body,':after').getPropertyValue('content').indexOf(str) > -1 ? true : false;
            return result;
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
        },

        // recalculate offset after window resize
        window_resize: function() {
            var doit;
            window.onresize = function() {
                clearTimeout(doit);
                doit = setTimeout(ww.fixed_nav.reset_offset, 10);
                doit = setTimeout(ww.paid_search.height_calc, 10);
                doit = setTimeout(ww.navigation.reset, 10);
            };
        }
    };
})();

/*-----------------------
  @WINDOW EVENTS
------------------------*/
ww.window_events = (function() {
    return {
        init: function() {
            this.register_events();
        },

        register_events: function() {
            ww.wallpaper.init();

            if ($("[data-module='tabs']").length) {
                ww.simple_tabs.init();
            }
        },
    };
})();

/*-----------------------
  @WALLPAPER IMAGES
------------------------*/
ww.wallpaper = (function(){
    var s = {
        img_path: "/assets/images/backgrounds/",
    };

    return {
        init: function() {
            $("[data-wallpaper]").each(function() {
                var $el = $(this),
                    img_obj = $el.data("wallpaper");

                ww.wallpaper.do_check($el, img_obj);
            });
        },

        do_check: function($el, img_obj) {
            // run bp check
            if ($el.is("[data-check-bp]")) {
                if ($el.data("check-bp-status") === "passing") {
                    this.load_wallpaper($el, img_obj);
                }
            }
            // auto load
            else {
                this.load_wallpaper($el, img_obj);
            }
        },

        load_wallpaper: function($el, img_obj) {
            $el.css({
                "background-image" : "url('" + s.img_path + img_obj.file + "." + img_obj.ext + "')",
            });
        },
    };
})();

/*-----------------------
  @NAVIGATION
------------------------*/
ww.navigation = (function(){
    var settings = {
        $menu_trigger: $('.nav-header-trigger'),
        $masthead_wrapper: $('.masthead-wrapper'),
        $masthead: $('.masthead'),
        $branding: $('.branding'),
        $nav_header: $('.nav-header'),
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
                /*if ($(window).width() < 768) {
                    ww.navigation.height_calc();
                }*/
                settings.$masthead_wrapper.toggleClass('nav-header--is-open');
                e.preventDefault();

                /*ww_globals.$win.scroll(function() {
                    if ($(window).width() < 768) {
                        clearTimeout(setTimeout(ww.navigation.height_calc(), 20));
                    }
                });*/
            });
        },

        products_subnav_hover: function() {

            settings.$products_dropdown.on("mouseenter", function(e) {
                settings.$masthead_wrapper.toggleClass('subnav-products--is-hovered');
                settings.$nav_arrow_products.toggleClass('hovered');
            });
            settings.$products_dropdown.on("mouseleave", function(e) {
                settings.$masthead_wrapper.toggleClass('subnav-products--is-hovered');
                settings.$nav_arrow_products.toggleClass('hovered');
            });
        },

        products_subnav_click: function() {

            settings.$subnav_trigger_mobile.on("click", function(e) {
                if ($(window).width() < 1025) {
                    settings.$masthead_wrapper.toggleClass('subnav-products--is-open');
                    settings.$nav_arrow_products.toggleClass('selected');
                    e.preventDefault();
                }
            });
        },

        height_calc: function() {

            if (ww_globals.$win.scrollTop() > settings.$branding.outerHeight()) {
                settings.$nav_header.css({"height":ww_globals.$win.outerHeight() - settings.$masthead.outerHeight()});
            } else {
                settings.$nav_header.css({"height":ww_globals.$win.outerHeight() - settings.$masthead.outerHeight() - settings.$branding.scrollTop()});
            }
        },

        reset: function() {

            /*if ($(window).width() < 768) {
                ww.navigation.height_calc();
            } else {
                settings.$nav_header.css({"height": "auto"});
            }*/
            if ($(window).width() > 1025) {
                settings.$masthead_wrapper.removeClass('subnav-products--is-open');
                settings.$nav_arrow_products.removeClass('selected');
            }
        }
    };
})();

/*-----------------------
  @TABS SIMPLE

  Loads tab if valid hash is present
  If hash doesn't exist in this module, loads the first item (is-active)
------------------------*/
ww.simple_tabs = (function(){
    var s = {
        hash: window.location.hash.substr(1),
        $menu: $(".tabs-menu"),
        $menu_links: $(".tabs-menu__link"),
        $content: $(".tabs-content"),
        $content_items: $(".tabs-content__item"),
    };

    return {
        init: function() {
            this.set_height();
            this.register_handlers();

            if (s.hash !== '') {
                this.load_hash();
            } else {
                this.load_first();
            }

        },

        set_height: function() {
            // for things like loading carousels inside a tab
            // this helps prevent an initially hidden tab from being super tall before the carousel is initialized
            if (s.$content.is("[data-set-height]")) {
                s.$content.css({
                    "height":s.$content_items.first().outerHeight(),
                });
            }
        },

        register_handlers: function() {
            s.$menu_links.on("click", function(e) {
                var tab = $(this).attr("href").replace("#", "");

                e.preventDefault();
                ww.simple_tabs.switch_tab(tab);
            });
        },

        load_hash: function() {
            var $el = s.$menu_links.filter("[href='#"+s.hash+"']");

            if ($el.length) {
                ww.simple_tabs.switch_tab(s.hash);
            } else {
                console.log("simple bad hash");
                this.load_first();
            }
        },

        load_first: function() {
            var tab = s.$menu_links.first().attr("href").replace("#", "");
            this.switch_tab(tab);
        },

        switch_tab: function(tab) {
            var $link = s.$menu_links.filter("[href=#"+tab+"]");

            $link.addClass("is-active").siblings().removeClass("is-active");
            s.$content_items.hide().filter($("#"+tab)).show();
        },
    };
})();

/*-----------------------
  @EMBED VIDEO
------------------------*/
ww.embed_video = (function() {
    var s = {
        autoplay: 1,
        video_width: 0,
        video_height: 0,
        video_ratio: 0,
        $icon: $(".icon-loader").clone(),
    };

    return {
        init: function() {
            this.register_handlers();
        },

        // modules available on load
        register_handlers: function() {
            $("[data-video-trigger]").on("click", function(e) {
                e.preventDefault();

                ww.embed_video.do_embed($(this));
            });
        },

        // modules not available on load
        register_modal: function() {
            var $el;

            $("[data-video-embed='modal']").each(function() {
                // using $(this) inside of the timeout gets the window object
                $el = $(this);

                var timeout = window.setTimeout(function() {
                    ww.embed_video.do_embed($el);
                }, 500);
            });
        },

        do_embed: function($el) {

            var video_id = $el.attr("href").split('/').pop(),
                $wrapper = $el.closest("[data-video-wrapper]");

            s.video_ratio = $wrapper.data("video-wrapper").v_ratio;
            s.video_width = $wrapper.outerWidth();
            s.video_height = s.video_width / s.video_ratio;

            $wrapper
                .css({
                    "background-color":"black",
                    "height":s.video_height,
                })
                .addClass("centered")
                .contents()
                .fadeOut(300, function() {
                    $wrapper
                        .css({
                            "padding-top":s.video_height / 2,
                        })
                        .html(s.$icon);
                    s.$icon
                        .delay(500)
                        .fadeIn(300, function() {
                            s.$icon.delay(1500).fadeOut(300, function() {
                                $wrapper
                                    .css({"padding-top":0})
                                    .html('<iframe src="//player.vimeo.com/video/'+video_id+'?title=0&amp;byline=0&amp;portrait=0&amp;autoplay='+s.autoplay+'" width="'+s.video_width+'" height="'+s.video_height+'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>')
                                    .fitVids();
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
// ww.carousels = (function(){
//     return {
//         init: function() {
//             $('.slick-carousel').slick({
//                 prevArrow: '<button type="button" class="my-slick-prev"><img src="http://skylightspecialist.dev/assets/images/prev-arrow.png"></button>',
//                 nextArrow: '<button type="button" class="my-slick-next"><img src="http://skylightspecialist.dev/assets/images/next-arrow.png"></button>',
//                 speed: 500,
//                 fade: true,
//                 slide: 'div',
//                 cssEase: 'linear'
//             });

//             $('.slick-carousel-cards').slick({
//                 arrows: false,
//                 dots: true,
//                 speed: 500,
//                 cssEase: 'linear',
//                 slidesToShow: 3,
//                 responsive: [
//                     {
//                         breakpoint: 768,
//                         settings: {
//                             arrows: false,
//                             centerMode: false,
//                             centerPadding: '40px',
//                             dots: true,
//                             slidesToShow: 1
//                         }
//                     }
//                 ]
//             });
//         },
//     };
// })();

ww.carousels = (function(){
    var s = {
        arrows: {
            nextArrow: '<button class="my-slick-next" title="Next">' + ww_globals.icon_chevron_right + '</button>',
            prevArrow: '<button class="my-slick-prev" title="Previous">' + ww_globals.icon_chevron_left + '</button>',
            nextArrow_reversed: '<button class="my-slick-next reversed" title="Next">' + ww_globals.icon_chevron_right_reversed + '</button>',
            prevArrow_reversed: '<button class="my-slick-prev reversed" title="Previous">' + ww_globals.icon_chevron_left_reversed + '</button>',
        },
        nodes: {
            controls: '<div class="my-slick-controls"></div>',
        },
        $slick: $(".slick")
    };

    return {
        init: function() {
            this.register_handlers();
            if ($('.slick__category').length) {
                this.category_carousel();
            }
        },

        // carousels available on page load
        register_handlers: function() {
            // auto
            $("[data-carousel-init='auto']").each(function() {
                ww.carousels.set_options($(this));
            });

            // manual
            $("[data-carousel-trigger]").on("click", function() {
                var $btn = $(this),
                    $carousel = $("[aria-labelledby='" + $btn.attr("id") + "']"),
                    timeout = window.setTimeout(function() {
                        ww.carousels.set_options($carousel);
                    }, 500);

                    // we only want to initialize the carousel once
                    $btn.removeAttr("data-carousel-trigger");
            });
        },

        set_options: function($carousel) {
            var carousel_type = $carousel.data("carousel-type");

            var slick_options = {
                draggable: false,
                responsive: null,
                slide: '.slick__item',
                //swipe: false,
                touchMove: false,
                touchThreshold: 100, // prevents a minimal touch from temporarily hiding the slide
            };

            switch (carousel_type) {

                case "photo-gallery":

// speed: 500,
// cssEase: 'linear'

                    // nodes
                    ww.carousels.insert_nodes($carousel, ['controls']);

                    // arrows
                    slick_options.arrows = true;
                    slick_options.appendArrows = $carousel.find(".my-slick-controls");
                    slick_options.nextArrow = s.arrows.nextArrow_reversed;
                    slick_options.prevArrow = s.arrows.prevArrow_reversed;

                    // draggable
                    slick_options.draggable = true;

                    // dots
                    slick_options.dots = false;

                    // to show
                    slick_options.slidesToShow = $carousel.data("slides-to-show");

                    // transition
                    slick_options.fade = true;

                    // adaptive height
                    slick_options.adaptiveHeight = true;

                    // responsive
                    slick_options.responsive = [
                        {
                            breakpoint: 768,
                            settings: {
                                arrows: false,
                                dots: true,
                                // centerPadding: '40px',
                                slidesToShow: 1,
                            }
                        },
                    ];
                    break;

                case "product-cards":
                    // dots
                    slick_options.arrows = false;
                    slick_options.dots = true;

                    // to show
                    slick_options.slidesToShow = $carousel.data("slides-to-show");

                    // responsive
                    slick_options.responsive = [
                        {
                            breakpoint: 768,
                            settings: {
                                centerMode: false,
                                dots: true,
                                // centerPadding: '40px',
                                slidesToShow: 1,
                            }
                        },
                    ];
                    break;

                case "locator":
                    // nodes
                    ww.carousels.insert_nodes($carousel, ['controls']);

                    // arrows
                    slick_options.arrows = true;
                    slick_options.appendArrows = $carousel.find(".my-slick-controls");
                    slick_options.nextArrow = s.arrows.nextArrow_reversed;
                    slick_options.prevArrow = s.arrows.prevArrow_reversed;

                    // to show
                    slick_options.slidesToShow = 3;

                    // centering
                    slick_options.centerMode = true;
                    slick_options.centerPadding = '0';

                    // responsive
                    slick_options.responsive = [
                        {
                            breakpoint: 960,
                            settings: {
                                arrows: true,
                                centerMode: true,
                                centerPadding: '40px',
                                slidesToShow: 1,
                            }
                        },
                    ];
                    break;

                case "benefits":
                    // infinite
                    slick_options.infinite = false;

                    // dots
                    slick_options.arrows = false;
                    slick_options.dots = true;

                    // to show
                    slick_options.slidesToShow = $carousel.data("slides-to-show");

                    // responsive
                    slick_options.responsive = [
                        {
                            breakpoint: 768,
                            settings: {
                                centerMode: false,
                                // centerPadding: '40px',
                                slidesToShow: 1,
                            }
                        },
                        {
                            breakpoint: 1450,
                            settings: {
                                slidesToShow: 3,
                            }
                        },
                    ];
                    break;

                case "swatches":
                    // dots
                    slick_options.arrows = false;
                    slick_options.dots = true;

                    // to show
                    slick_options.slidesToShow = $carousel.data("slides-to-show");
                    slick_options.slidesToScroll = $carousel.data("slides-to-show");

                    // responsive
                    slick_options.responsive = [
                        {
                            breakpoint: 850,
                            settings: {
                                centerMode: false,
                                // centerPadding: '40px',
                                slidesToScroll: 3,
                                slidesToShow: 3,
                            }
                        },
                        {
                            breakpoint: 1200, // my-large
                            settings: {
                                centerMode: false,
                                // centerPadding: '40px',
                                slidesToScroll: 5,
                                slidesToShow: 5,
                            }
                        },
                    ];
                    break;
            }

            this.do_carousel($carousel, slick_options);
        },

        do_carousel: function($carousel, slick_options) {
            var $slick_api = $carousel.slick(slick_options);

            if ($carousel.is("[data-equal-heights]")) {

                $('.slick__item').imagesLoaded( function() {
                    ww.carousels.equal_heights($carousel);
                });

                
            }

            /*var my_timer = window.setTimeout(function() {
                ww.carousels.equal_heights($carousel);
            }, 500);*/
        },

        equal_heights: function($carousel) {
            if ($carousel.is("[data-equal-heights]")) {
                // Get an array of all element heights
                var elementHeights = $carousel.find('.slick__item').map(function() {
                    return $(this).height();
                }).get();

                // Math.max takes a variable number of arguments
                // `apply` is equivalent to passing each height as an argument
                var maxHeight = Math.max.apply(null, elementHeights);

                // Set each height to the max height
                $carousel.find('.slick__item').height(maxHeight);

                //If carousel is product-cards, adjust the height of the product-card as well
                if($carousel.data("carousel-type") == 'product-cards') {
                    // Get an array of all element heights
                    var cardHeights = $carousel.find('.slick__item > .product-card-wrapper').map(function() {
                        return $(this).height();
                    }).get();

                    var cardMaxHeight = Math.max.apply(null, cardHeights);
                    $carousel.find('.slick__item > .product-card').height(maxHeight - 20);
                }

                $carousel.attr("data-equal-heights", "done");
            }
        },

        insert_nodes: function($carousel, types) {
            for (var i = 0; i < types.length; i++) {
                $carousel.append(s.nodes[types[i]]);
            }
        },

        category_carousel: function() {
            var $slick_api = s.$slick.slick({
                // autoplay: true,
                arrows: false,
                dots: true,
                draggable: false,
                fade: true,
                pauseOnHover: true,
                slide: '.slick__item',
                swipe: true,
                // touchMove: false,
                touchThreshold: 100, // prevents a minimal touch from temporarily hiding the slide
            });
        }
    };
})();

/*-----------------------
  @FIXED NAV
------------------------*/
ww.fixed_nav = (function() {
    var s = {
        $win: $(window),
        $body: $('body'),
        $page: $('.page'),
        $fixed_el: $('[data-fixie]'),
        $offset_el: $('.branding'),
        eloffset: null,
    };

    return {
        init: function() {
            s.$win.scroll(function() {
                // wait until the first scroll to calculate offset
                // otherwise font loading throws off caluclation
                if (s.eloffset === null) {
                    s.eloffset = s.$offset_el.outerHeight();
                }

                if (s.eloffset < s.$win.scrollTop()) {
                    // enter fixed mode
                    s.$fixed_el.addClass('is-fixed');
                    // push body contents down equal to the height of the fixed bar
                    s.$body.css({"padding-top":s.$fixed_el.outerHeight()});
                } else {
                    // exit fixed mode
                    s.$fixed_el.removeClass('is-fixed');
                    // reset body padding to 0
                    s.$body.css({"padding-top":0});
                }
            });
        },

        reset_offset: function() {
            s.eloffset = s.$offset_el.outerHeight();
        },
    };
})();

/*-----------------------
  @CONDITIONAL MODALS

  http://codepen.io/bradfrost/pen/tfCAp
  http://adactio.com/journal/5429/
------------------------*/
ww.conditional_modals = (function() {
    var s = {
        $modal: $(".modal"),
        $modal_body: $(".modal__body"),
        $modal_screen: $(".modal-screen"),
    };

    return {
        init: function() {
            this.register_events();
        },

        register_events: function() {
            // open
            $("[data-modal-open]").on("click", function(e) {
                if (ww.common.check_breakpoint('modal-is-enabled')) {
                    e.preventDefault();
                    //ww.conditional_modals.inject_modal_content($(this));
                    ww.conditional_modals.open_modal();

                }
            });

            // close
            s.$modal.on("click", "[data-modal-close]", function(e) {
                e.preventDefault();
                ww.conditional_modals.close_modal();
            });
        },

        inject_modal_content: function($trigger) {
            $.get("/ajax/get_view", {
                view: $trigger.data("ajax-vars").view,
                vars: $trigger.data("ajax-vars"),
            }, function(data) {
                s.$modal_body.html(data);
                ww.conditional_modals.open_modal();
            });
        },

        open_modal: function() {
            if ( ! $(".modal--is-open").length) {
                s.$modal.add(s.$modal_screen).addClass('modal--is-open');
                ww.custom_forms.init();
            }
        },

        close_modal: function() {
            s.$modal.add(s.$modal_screen).removeClass('modal--is-open');

            // prepare for next opening
            //s.$modal_body.empty();
        },
    };
})();

/*-----------------------
  @PAID SEARCH FORM
------------------------*/
ww.paid_search = (function() {
    var s = {
        $bar: $('.ps-bar'),
        $wrapper: $('.ps-mobile-wrapper'),
        $form_wrapper: $('.ps-mobile-form-wrapper'),
        $plus: $('.icon-plus'),
        $x: $('.ps-mobile-form-close'),
    };

    return {
        init: function() {
            if (s.$bar.length) {
                this.open_form();
            }
        },

        open_form: function() {
            s.$plus.on("click", function(e) {
                s.$form_wrapper.css({"height":ww_globals.$win.outerHeight()});
                s.$wrapper.addClass('form--is-open');
                e.preventDefault();
            });
            s.$x.on("click", function(e) {
                s.$form_wrapper.css({"height":0});
                s.$wrapper.removeClass('form--is-open');
                e.preventDefault();
            });
        },

        height_calc: function() {
            s.$form_wrapper.css({"height":ww_globals.$win.outerHeight()});
        }
    };
})();

/*-----------------------
  @MAPS

  Google Maps API v3
  https://developers.google.com/maps/documentation/javascript/examples/place-details
------------------------*/
ww.maps = (function() {
    var s = {
        el: 'map',
    };

    return {
        init: function() {
            if ($("#" + s.el).length) {
                google.maps.event.addDomListener(window, 'load', this.draw_map());
            }
        },

        draw_map: function() {
            var coordinates = {
                lat: $('#map').attr('data-lat'),
                lng: $('#map').attr('data-long')
            };
            var encoded_address = $('#map').attr('data-address');
            var geocoder = new google.maps.Geocoder();
            var ww_map;
            var settings = {};
            // custom marker
            var ww_image = "/assets/images/icon-pin-map.png";

            if($('.installer').length) {
                settings = {
                    $el: $('#map'),
                    map_options: {
                        center: new google.maps.LatLng(coordinates.lat, coordinates.lng),
                        zoom: 8,
                        // UI options
                        mapTypeControl: false,
                        panControl: false,
                        scrollwheel: false,
                        streetViewControl: false, // pegman
                    }
                };
                ww_map = new google.maps.Map(settings.$el.get(0), settings.map_options);
                var infowindow = new google.maps.InfoWindow();
                var count = 0;
                $('.installer').each(function() {
                    count++;
                    var encoded_address = $(this).attr('data-address');
                    var info_window_content = $(this).clone().addClass("my_infowindow").get(0);
                    geocoder.geocode( { 'address': encoded_address}, function(results, status) {
                        if (status == google.maps.GeocoderStatus.OK) {
                            ww_marker = new google.maps.Marker({
                                map: ww_map,
                                position: results[0].geometry.location,
                                icon: ww_image
                            });

                        }
                        google.maps.event.addListener(ww_marker, 'click', (function(ww_marker) {
                            return function() {
                                infowindow.setContent(info_window_content);
                                infowindow.open(ww_map, ww_marker);
                            };
                        })(ww_marker));
                    });
                });

            } else {

                settings = {
                    $el: $('#map'),
                    map_options: {
                        //center: new google.maps.LatLng(coordinates.lat, coordinates.lng),
                        zoom: 14,
                        // UI options
                        mapTypeControl: false,
                        panControl: false,
                        scrollwheel: false,
                        streetViewControl: false, // pegman
                    }
                };
                ww_map = new google.maps.Map(settings.$el.get(0), settings.map_options);

                geocoder.geocode( { 'address': encoded_address}, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        ww_map.setCenter(results[0].geometry.location);
                        ww_marker = new google.maps.Marker({
                            map: ww_map,
                            position: results[0].geometry.location,
                            icon: ww_image
                        });

                    } else {
                        ww_map.setCenter(new google.maps.LatLng(coordinates.lat, coordinates.lng));
                        // set marker
                        ww_marker = new google.maps.Marker({
                            map: ww_map,
                            position: settings.map_options.center,
                            icon: ww_image
                        });
                    }
                });
            }
        },
    };
})();

/*-----------------------
  @SEARCH PAGE MAPS

  Google Maps API v3
  https://developers.google.com/maps/documentation/javascript/examples/place-details
------------------------*/
ww.search_maps = (function() {
    var s = {
        el: 'search-map',
    };

    return {
        init: function() {
            if ($("#" + s.el).length) {
                google.maps.event.addDomListener(window, 'load', this.draw_map());
            }
        },

        draw_map: function() {
            var coordinates = {
                lat: $('#search-map').attr('data-lat'),
                lng: $('#search-map').attr('data-long')
            };
            var geocoder = new google.maps.Geocoder();

            var settings = {
                $el: $('#search-map'),
                map_options: {
                    center: new google.maps.LatLng(coordinates.lat, coordinates.lng),
                    zoom: 8,
                    // UI options
                    mapTypeControl: false,
                    panControl: false,
                    scrollwheel: false,
                    streetViewControl: false, // pegman
                }
            };
            var ww_map = new google.maps.Map(settings.$el.get(0), settings.map_options);
            var infowindow = new google.maps.InfoWindow();
            var count = 0;
            $('.installer').each(function() {
                count++;
                var encoded_address = $(this).attr('data-address');
                var info_window_content = $(this).clone().addClass("my_infowindow").get(0);
                geocoder.geocode( { 'address': encoded_address}, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        ww_marker = new google.maps.Marker({
                            map: ww_map,
                            position: results[0].geometry.location
                        });

                    }
                    google.maps.event.addListener(ww_marker, 'click', (function(ww_marker) {
                        return function() {
                            infowindow.setContent(info_window_content);
                            infowindow.open(ww_map, ww_marker);
                        };
                    })(ww_marker));
                });
            });

        },
    };
})();

/*-----------------------
  @SCROLLTO

  required: http://demos.flesler.com/jquery/scrollTo/
  optional: https://github.com/gdsmith/jquery.easing
------------------------*/
ww.scrollto = (function() {
    var s = {
        $trigger: $("[data-btn-scroll]"),
        scroll_rate: 400,
        $masthead: $(".masthead").outerHeight(),
        my_offset: 0,
    };

    return {
        init: function() {
            s.$trigger.on("click", function(e){
                e.preventDefault();
                hash = $(this).attr("href").replace("#", "");
                $scroll_target = $("[id='"+hash+"']");
                s.my_offset = s.$masthead;

                $.scrollTo($scroll_target, s.scroll_rate, {
                    offset: -s.my_offset,
                });
            });
        },
    };
})();

/*-----------------------
  @ANCHORS TO OPTIONS

  Take a bunch of links and turn them into a <select> menu
  http://css-tricks.com/convert-menu-to-dropdown/
------------------------*/
ww.anchors_to_options = (function(){
    var s = {
        $menu: $("[data-anchors-to-options]"),
        $new_select: $("<select class='nav-secondary--select' />"),
    };

    return {
        init: function() {
            // Create the dropdown base
            s.$new_select.insertAfter(s.$menu);

            // Populate dropdown with menu items
            s.$menu.find("a").each(function() {
                var $el = $(this);

                $("<option />", {
                    "value": $el.attr("href").replace("#", ""),
                    "text": $el.hasClass("btn-icon") ? $el.attr("title") : $el.text(),
                }).appendTo(s.$new_select);
            });

            this.register_handlers();
        },

        register_handlers: function() {
            s.$new_select.change(function(e) {
                e.preventDefault();
                var $el = $(this),
                    tag = $el.find("option:selected").val();
                var s = {
                    scroll_rate: 400,
                    $masthead: $(".masthead").outerHeight(),
                    my_offset: 0,
                };
                s.my_offset = s.$masthead;
                $.scrollTo($('[id="' + tag + '"]'), s.scroll_rate, {
                    offset: -s.my_offset,
                });
            });
        },
    };
})();

ww.contact_validation = (function() {
    return {
        init: function() {
            if($("[data-modal-form]").length) {
                if($('#paid-search-submit').length) {
                    this.validate_paid_search();
                }
                if($('#contact-submit').length) {
                    this.validate_contact();
                }
            }
        },

        validate_contact: function() {
            $('#contact-submit').on({
                click: function(e) {
                    e.preventDefault();
                    var error_count = 0,
                        $name = $('#contact-name').val(),
                        $name_label = $('#label-name'),
                        $phone = $('#contact-phone').val(),
                        $phone_label = $('#label-phone'),
                        $email_address = $('#contact-email').val(),
                        $email_label = $('#label-email'),
                        $subject = $('#contact-subject').val(),
                        $subject_label = $('#label-subject'),
                        $message = $('#contact-message').val(),
                        $message_label = $('#label-message');

                    if($name === '') {
                        error_count++;
                        $name_label.html('Name* <span class="required">Required</span>');
                    } else {
                        $name_label.html('Name*');
                    }
                    if($phone === '' && ! ww.contact_validation.validate_email($email_address)) {
                        error_count++;
                        $phone_label.html('Phone* <span class="required">Required</span>');
                    } else {
                        $phone_label.html('Phone*');
                    }
                    if($subject === '') {
                        $subject_label.html('What Can We Help You With?*<span class="required">Required</span>');
                        error_count++;
                    } else {
                        $subject_label.html('What Can We Help You With?*');
                    }
                    if($message === '') {
                        $message_label.html('Message* <span class="required">Required</span>');
                        error_count++;
                    } else {
                        $message_label.html('Message*');
                    }
                    if(error_count === 0) {
                        $('#contact-form').submit();
                    } else {

                    }
                }
            });
        },

        validate_paid_search: function() {
            $('#paid-search-submit-mobile').on({
                click: function(e) {
                    e.preventDefault();
                    var error_count = 0,
                        $name = $('#paid-search-name').val(),
                        $name_label = $('#ps-name'),
                        $phone = $('#paid-search-phone').val(),
                        $phone_label = $('#ps-phone'),
                        $email_address = $('#paid-search-email').val(),
                        $email_label = $('#ps-email'),
                        $message = $('#paid-search-comments').val(),
                        $message_label = $('#ps-comments');

                    if($name === '') {
                        error_count++;
                        $name_label.html('Name* <span class="required">Required</span>');
                    } else {
                        $name_label.html('Name*');
                    }
                    if($phone === '' && ! ww.contact_validation.validate_email($email_address)) {
                        error_count++;
                        $phone_label.html('Phone* <span class="required">Required</span>');
                    } else {
                        $phone_label.html('Phone*');
                    }
                    if($message === '') {
                        $message_label.html('Message* <span class="required">Required</span>');
                        error_count++;
                    } else {
                        $message_label.html('Message*');
                    }
                    if(error_count === 0) {
                        $('#paid-search-form-mobile').submit();
                    } else {

                    }
                }
            });
        },

        validate_email: function(email_address) {
            var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email_address);
        }
    };
})();

/*
 * LOAD!
 */

jQuery(function() {
    ww.main.init();
});

$(window).load(function() {
    ww.window_events.init();
});