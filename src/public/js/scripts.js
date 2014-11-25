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

/*
 * LOAD!
 */
 
jQuery(function() {
    ww.main.init();
});