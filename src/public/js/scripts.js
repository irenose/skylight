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
            ww.fixed_nav.init();
            ww.conditional_modals.init();
            ww.scrollto.init();
            ww.maps.init();
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
        $icon: $(".footer .logo").clone(),
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

        // recalculate offset after window resize
        window_resize: function() {
            var doit;
            window.onresize = function() {
                clearTimeout(doit);
                doit = setTimeout(ww.fixed_nav.reset_offset, 100);
            };
        },

        reset_offset: function() {
            s.eloffset = s.$fixed_el.offset().top;
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
                    ww.conditional_modals.inject_modal_content($(this));
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
            s.$modal_body.empty();
        },
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
                lat: -33.8665433,
                lng: 151.1956316,
            };

            var settings = {
                $el: $('#map'),
                map_options: {
                    center: new google.maps.LatLng(coordinates.lat, coordinates.lng),
                    zoom: 14,
                    // UI options
                    mapTypeControl: false,
                    panControl: false,
                    scrollwheel: false,
                    streetViewControl: false, // pegman
                },
                request: {
                    placeId: 'ChIJN1t_tDeuEmsRUsoyG83frY4',
                },
            };

            var ww_map = new google.maps.Map(settings.$el.get(0), settings.map_options),
                ww_service = new google.maps.places.PlacesService(ww_map),
                ww_infowindow = new google.maps.InfoWindow();

            ww_service.getDetails(settings.request, function(place, status) {
                if (status == google.maps.places.PlacesServiceStatus.OK) {
                    
                    // set marker
                    var ww_marker = new google.maps.Marker({
                        map: ww_map,
                        position: place.geometry.location
                    });

                    google.maps.event.addListener(ww_marker, 'click', function() {
                        ww_infowindow.setContent(place.name);
                        ww_infowindow.open(ww_map, this);
                    });

                    google.maps.event.addDomListener(window, 'resize', function() {
                        ww_map.setCenter(settings.map_options.center);
                    });
                }
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
                $scroll_target = $("[name='"+hash+"']");
                s.my_offset = s.$masthead;

                $.scrollTo($scroll_target, s.scroll_rate, {
                    offset: -s.my_offset,
                });
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