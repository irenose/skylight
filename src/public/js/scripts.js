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
  https://developers.google.com/maps/documentation/javascript/examples/map-simple
  https://developers.google.com/maps/documentation/javascript/examples/place-details

  "placeId" comes from this json call:
  https://maps.googleapis.com/maps/api/place/radarsearch/json?location=35.21411,-80.843075&radius=5000&name=Wray+Ward&key=AIzaSyCp0DvWYnLCOKlItxqOCtPTkhd2vn7R0_g
  Note that the API key used here is connected to my personal gmail account. I just needed a way to ping the URL to find the "placeId".
------------------------*/
/*ww.maps = (function() {
    return {
        init: function() {
            google.maps.event.addDomListener(window, 'load', this.draw_map());
        },

        draw_map: function() {
            var coordinates = {
                lat: 35.21411,
                lng: -80.843075,
            };

            // pushes map down to make sure infowindow is always visible
            var offset_vertical = 0.002;

            var settings = {
                $el: $('#map'),
                map_options: {
                    center: new google.maps.LatLng((coordinates.lat + offset_vertical), coordinates.lng),
                    zoom: 14,

                    // UI options
                    mapTypeControl: false,
                    panControl: false,
                    scrollwheel: false,
                    streetViewControl: false, // pegman
                },
                request: {
                    placeId: 'ChIJuaHPp4ifVogR-xsoeCf-IN4',
                },
            };

            var ww_map = new google.maps.Map(settings.$el.get(0), settings.map_options),
                ww_service = new google.maps.places.PlacesService(ww_map),
                ww_infowindow = new google.maps.InfoWindow();

            ww_service.getDetails(settings.request, function(place, status) {
                if (status == google.maps.places.PlacesServiceStatus.OK) {
                    // create custom marker
                    var ww_pin = {
                        path: "M9.9,0C9.9,0,0,0.1,0,11.9C0,17.9,9.9,32,9.9,32S20,18.1,20,11.9C20,0.1,9.9,0,9.9,0z M12.6,17.2L10,10.4 l-2.6,6.8H6.2L2.6,8.8H4l2.8,6.9l2.6-6.9h1.2l2.6,6.9L16,8.8h1.4l-3.6,8.4H12.6z",
                        fillColor: "#d05133",
                        fillOpacity: 1,
                        scale: 2,
                        strokeColor: "red",
                        strokeWeight: 0,
                        rotation: 0
                    };

                    // set marker
                    var ww_marker = new google.maps.Marker({
                        map: ww_map,
                        position: place.geometry.location,
                        // icon: ww_pin,
                    });

                    // build infowindow contents
                    var directions_link = $(".vcard .adr").attr("href");
                    var ww_infowindow_content = '<a href="' + directions_link + '" style="display: block;">' + place.name + '<br>' + place.formatted_address.replace(", United States", "") + '</a>';

                    // tell the infowindow to open on marker click
                    google.maps.event.addListener(ww_marker, 'click', function() {
                        ww_infowindow.setContent(ww_infowindow_content);
                        ww_infowindow.open(ww_map, this);
                    });
                    // trigger a marker click to auto-open infowindow
                    google.maps.event.trigger(ww_marker, 'click');

                    // make sure the pin stays centered
                    google.maps.event.addDomListener(window, 'resize', function() {
                        ww_map.setCenter(settings.map_options.center);
                    });

                    // traffic layer!
                    // var trafficLayer = new google.maps.TrafficLayer();
                    // trafficLayer.setMap(ww_map);
                }
            });
        },
    };
})();*/

ww.maps = (function() {
    return {
        init: function() {
            google.maps.event.addDomListener(window, 'load', this.draw_map());
        },

        draw_map: function() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: new google.maps.LatLng(-33.8665433, 151.1956316),
                zoom: 15,
                // UI options
                mapTypeControl: false,
                panControl: false,
                scrollwheel: false,
                streetViewControl: false, // pegman
            });

            var request = {
                placeId: 'ChIJN1t_tDeuEmsRUsoyG83frY4'
            };

            var infowindow = new google.maps.InfoWindow();
            var service = new google.maps.places.PlacesService(map);

            service.getDetails(request, function(place, status) {
                if (status == google.maps.places.PlacesServiceStatus.OK) {
                    var marker = new google.maps.Marker({
                        map: map,
                        position: place.geometry.location
                    });
                    google.maps.event.addListener(marker, 'click', function() {
                        infowindow.setContent(place.name);
                        infowindow.open(map, this);
                    });
                }
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