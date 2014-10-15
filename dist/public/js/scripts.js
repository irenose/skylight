(function(e,t,n,r,i){function s(t,n){if(n){var r=n.getAttribute("viewBox"),i=e.createDocumentFragment(),s=n.cloneNode(true);if(r){t.setAttribute("viewBox",r)}while(s.childNodes.length){i.appendChild(s.childNodes[0])}t.appendChild(i)}}function o(){var t=this,n=e.createElement("x"),r=t.s;n.innerHTML=t.responseText;t.onload=function(){r.splice(0).map(function(e){s(e[0],n.querySelector("#"+e[1].replace(/(\W)/g,"\\$1")))})};t.onload()}function u(){var i;while(i=t[0]){var a=i.parentNode,f=i.getAttribute("xlink:href").split("#"),l=f[0],c=f[1];a.removeChild(i);if(l.length){var h=r[l]=r[l]||new XMLHttpRequest;if(!h.s){h.s=[];h.open("GET",l);h.onload=o;h.send()}h.s.push([a,c]);if(h.readyState===4){h.onload()}}else{s(a,e.getElementById(c))}}n(u)}if(i){u()}})(document,document.getElementsByTagName("use"),window.requestAnimationFrame||window.setTimeout,{},/Trident\/[567]\b/.test(navigator.userAgent))

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

/*
 * LOAD!
 */
jQuery(function() {
    ww.main.init();
});