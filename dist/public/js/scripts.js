/*! iCheck v1.0.2 by Damir Sultanov, http://git.io/arlzeA, MIT Licensed */
(function(f){function A(a,b,d){var c=a[0],g=/er/.test(d)?_indeterminate:/bl/.test(d)?n:k,e=d==_update?{checked:c[k],disabled:c[n],indeterminate:"true"==a.attr(_indeterminate)||"false"==a.attr(_determinate)}:c[g];if(/^(ch|di|in)/.test(d)&&!e)x(a,g);else if(/^(un|en|de)/.test(d)&&e)q(a,g);else if(d==_update)for(var f in e)e[f]?x(a,f,!0):q(a,f,!0);else if(!b||"toggle"==d){if(!b)a[_callback]("ifClicked");e?c[_type]!==r&&q(a,g):x(a,g)}}function x(a,b,d){var c=a[0],g=a.parent(),e=b==k,u=b==_indeterminate,
v=b==n,s=u?_determinate:e?y:"enabled",F=l(a,s+t(c[_type])),B=l(a,b+t(c[_type]));if(!0!==c[b]){if(!d&&b==k&&c[_type]==r&&c.name){var w=a.closest("form"),p='input[name="'+c.name+'"]',p=w.length?w.find(p):f(p);p.each(function(){this!==c&&f(this).data(m)&&q(f(this),b)})}u?(c[b]=!0,c[k]&&q(a,k,"force")):(d||(c[b]=!0),e&&c[_indeterminate]&&q(a,_indeterminate,!1));D(a,e,b,d)}c[n]&&l(a,_cursor,!0)&&g.find("."+C).css(_cursor,"default");g[_add](B||l(a,b)||"");g.attr("role")&&!u&&g.attr("aria-"+(v?n:k),"true");
g[_remove](F||l(a,s)||"")}function q(a,b,d){var c=a[0],g=a.parent(),e=b==k,f=b==_indeterminate,m=b==n,s=f?_determinate:e?y:"enabled",q=l(a,s+t(c[_type])),r=l(a,b+t(c[_type]));if(!1!==c[b]){if(f||!d||"force"==d)c[b]=!1;D(a,e,s,d)}!c[n]&&l(a,_cursor,!0)&&g.find("."+C).css(_cursor,"pointer");g[_remove](r||l(a,b)||"");g.attr("role")&&!f&&g.attr("aria-"+(m?n:k),"false");g[_add](q||l(a,s)||"")}function E(a,b){if(a.data(m)){a.parent().html(a.attr("style",a.data(m).s||""));if(b)a[_callback](b);a.off(".i").unwrap();
f(_label+'[for="'+a[0].id+'"]').add(a.closest(_label)).off(".i")}}function l(a,b,f){if(a.data(m))return a.data(m).o[b+(f?"":"Class")]}function t(a){return a.charAt(0).toUpperCase()+a.slice(1)}function D(a,b,f,c){if(!c){if(b)a[_callback]("ifToggled");a[_callback]("ifChanged")[_callback]("if"+t(f))}}var m="iCheck",C=m+"-helper",r="radio",k="checked",y="un"+k,n="disabled";_determinate="determinate";_indeterminate="in"+_determinate;_update="update";_type="type";_click="click";_touch="touchbegin.i touchend.i";
_add="addClass";_remove="removeClass";_callback="trigger";_label="label";_cursor="cursor";_mobile=/ipad|iphone|ipod|android|blackberry|windows phone|opera mini|silk/i.test(navigator.userAgent);f.fn[m]=function(a,b){var d='input[type="checkbox"], input[type="'+r+'"]',c=f(),g=function(a){a.each(function(){var a=f(this);c=a.is(d)?c.add(a):c.add(a.find(d))})};if(/^(check|uncheck|toggle|indeterminate|determinate|disable|enable|update|destroy)$/i.test(a))return a=a.toLowerCase(),g(this),c.each(function(){var c=
f(this);"destroy"==a?E(c,"ifDestroyed"):A(c,!0,a);f.isFunction(b)&&b()});if("object"!=typeof a&&a)return this;var e=f.extend({checkedClass:k,disabledClass:n,indeterminateClass:_indeterminate,labelHover:!0},a),l=e.handle,v=e.hoverClass||"hover",s=e.focusClass||"focus",t=e.activeClass||"active",B=!!e.labelHover,w=e.labelHoverClass||"hover",p=(""+e.increaseArea).replace("%","")|0;if("checkbox"==l||l==r)d='input[type="'+l+'"]';-50>p&&(p=-50);g(this);return c.each(function(){var a=f(this);E(a);var c=this,
b=c.id,g=-p+"%",d=100+2*p+"%",d={position:"absolute",top:g,left:g,display:"block",width:d,height:d,margin:0,padding:0,background:"#fff",border:0,opacity:0},g=_mobile?{position:"absolute",visibility:"hidden"}:p?d:{position:"absolute",opacity:0},l="checkbox"==c[_type]?e.checkboxClass||"icheckbox":e.radioClass||"i"+r,z=f(_label+'[for="'+b+'"]').add(a.closest(_label)),u=!!e.aria,y=m+"-"+Math.random().toString(36).substr(2,6),h='<div class="'+l+'" '+(u?'role="'+c[_type]+'" ':"");u&&z.each(function(){h+=
'aria-labelledby="';this.id?h+=this.id:(this.id=y,h+=y);h+='"'});h=a.wrap(h+"/>")[_callback]("ifCreated").parent().append(e.insert);d=f('<ins class="'+C+'"/>').css(d).appendTo(h);a.data(m,{o:e,s:a.attr("style")}).css(g);e.inheritClass&&h[_add](c.className||"");e.inheritID&&b&&h.attr("id",m+"-"+b);"static"==h.css("position")&&h.css("position","relative");A(a,!0,_update);if(z.length)z.on(_click+".i mouseover.i mouseout.i "+_touch,function(b){var d=b[_type],e=f(this);if(!c[n]){if(d==_click){if(f(b.target).is("a"))return;
A(a,!1,!0)}else B&&(/ut|nd/.test(d)?(h[_remove](v),e[_remove](w)):(h[_add](v),e[_add](w)));if(_mobile)b.stopPropagation();else return!1}});a.on(_click+".i focus.i blur.i keyup.i keydown.i keypress.i",function(b){var d=b[_type];b=b.keyCode;if(d==_click)return!1;if("keydown"==d&&32==b)return c[_type]==r&&c[k]||(c[k]?q(a,k):x(a,k)),!1;if("keyup"==d&&c[_type]==r)!c[k]&&x(a,k);else if(/us|ur/.test(d))h["blur"==d?_remove:_add](s)});d.on(_click+" mousedown mouseup mouseover mouseout "+_touch,function(b){var d=
b[_type],e=/wn|up/.test(d)?t:v;if(!c[n]){if(d==_click)A(a,!1,!0);else{if(/wn|er|in/.test(d))h[_add](e);else h[_remove](e+" "+t);if(z.length&&B&&e==v)z[/ut|nd/.test(d)?_remove:_add](w)}if(_mobile)b.stopPropagation();else return!1}})})}})(window.jQuery||window.Zepto);

/**
 * Copyright (c) 2007-2014 Ariel Flesler - aflesler<a>gmail<d>com | http://flesler.blogspot.com
 * Licensed under MIT
 * @author Ariel Flesler
 * @version 1.4.14
 */
;(function(k){'use strict';k(['jquery'],function($){var j=$.scrollTo=function(a,b,c){return $(window).scrollTo(a,b,c)};j.defaults={axis:'xy',duration:0,limit:!0};j.window=function(a){return $(window)._scrollable()};$.fn._scrollable=function(){return this.map(function(){var a=this,isWin=!a.nodeName||$.inArray(a.nodeName.toLowerCase(),['iframe','#document','html','body'])!=-1;if(!isWin)return a;var b=(a.contentWindow||a).document||a.ownerDocument||a;return/webkit/i.test(navigator.userAgent)||b.compatMode=='BackCompat'?b.body:b.documentElement})};$.fn.scrollTo=function(f,g,h){if(typeof g=='object'){h=g;g=0}if(typeof h=='function')h={onAfter:h};if(f=='max')f=9e9;h=$.extend({},j.defaults,h);g=g||h.duration;h.queue=h.queue&&h.axis.length>1;if(h.queue)g/=2;h.offset=both(h.offset);h.over=both(h.over);return this._scrollable().each(function(){if(f==null)return;var d=this,$elem=$(d),targ=f,toff,attr={},win=$elem.is('html,body');switch(typeof targ){case'number':case'string':if(/^([+-]=?)?\d+(\.\d+)?(px|%)?$/.test(targ)){targ=both(targ);break}targ=win?$(targ):$(targ,this);if(!targ.length)return;case'object':if(targ.is||targ.style)toff=(targ=$(targ)).offset()}var e=$.isFunction(h.offset)&&h.offset(d,targ)||h.offset;$.each(h.axis.split(''),function(i,a){var b=a=='x'?'Left':'Top',pos=b.toLowerCase(),key='scroll'+b,old=d[key],max=j.max(d,a);if(toff){attr[key]=toff[pos]+(win?0:old-$elem.offset()[pos]);if(h.margin){attr[key]-=parseInt(targ.css('margin'+b))||0;attr[key]-=parseInt(targ.css('border'+b+'Width'))||0}attr[key]+=e[pos]||0;if(h.over[pos])attr[key]+=targ[a=='x'?'width':'height']()*h.over[pos]}else{var c=targ[pos];attr[key]=c.slice&&c.slice(-1)=='%'?parseFloat(c)/100*max:c}if(h.limit&&/^\d+$/.test(attr[key]))attr[key]=attr[key]<=0?0:Math.min(attr[key],max);if(!i&&h.queue){if(old!=attr[key])animate(h.onAfterFirst);delete attr[key]}});animate(h.onAfter);function animate(a){$elem.animate(attr,g,h.easing,a&&function(){a.call(this,targ,h)})}}).end()};j.max=function(a,b){var c=b=='x'?'Width':'Height',scroll='scroll'+c;if(!$(a).is('html,body'))return a[scroll]-$(a)[c.toLowerCase()]();var d='client'+c,html=a.ownerDocument.documentElement,body=a.ownerDocument.body;return Math.max(html[scroll],body[scroll])-Math.min(html[d],body[d])};function both(a){return $.isFunction(a)||$.isPlainObject(a)?a:{top:a,left:a}}return j})}(typeof define==='function'&&define.amd?define:function(a,b){if(typeof module!=='undefined'&&module.exports){module.exports=b(require('jquery'))}else{b(jQuery)}}));
/*! Selectric ϟ v1.8.4 (2014-09-23) - git.io/tjl9sQ - Copyright (c) 2014 Leonardo Santos - Dual licensed: MIT/GPL */
!function(e){"use strict";var t="selectric",s="Input Items Open Disabled TempShow HideSelect Wrapper Hover Responsive Above Scroll",i=".sl",o={onChange:function(t){e(t).change()},maxHeight:300,keySearchTimeout:500,arrowButtonMarkup:'<b class="button">&#x25be;</b>',disableOnMobile:!0,openOnHover:!1,expandToItemText:!1,responsive:!1,preventWindowScroll:!0,inheritOriginalWidth:!1,customClass:{prefix:t,postfixes:s,camelCase:!0},optionsItemBuilder:"{text}"},n={add:function(e,t,s){this[e]||(this[e]={}),this[e][t]=s},remove:function(e,t){delete this[e][t]}},a={replaceDiacritics:function(e){for(var t="40-46 50-53 54-57 62-70 71-74 61 47 77".replace(/\d+/g,"\\3$&").split(" "),s=t.length;s--;)e=e.toLowerCase().replace(RegExp("["+t[s]+"]","g"),"aeiouncy".charAt(s));return e},format:function(e){var t=arguments;return(""+e).replace(/{(\d+|(\w+))}/g,function(e,s,i){return i&&t[1]?t[1][i]:t[s]})},nextEnabledItem:function(e,t){for(;e[t=(t+1)%e.length].disabled;);return t},previousEnabledItem:function(e,t){for(;e[t=(t>0?t:e.length)-1].disabled;);return t},toDash:function(e){return e.replace(/([a-z])([A-Z])/g,"$1-$2").toLowerCase()},triggerCallback:function(s,i){var o=i.element,l=i.options["on"+s];e.isFunction(l)&&l.call(o,o,i),n[s]&&e.each(n[s],function(){this.call(o,o,i)}),e(o).trigger(t+"-"+a.toDash(s),i)}},l=e(document),r=e(window),c=function(n,c){function d(t){if($.options=e.extend(!0,{},o,$.options,t),$.classes={},$.element=n,a.triggerCallback("BeforeInit",$),$.options.disableOnMobile&&L)return void($.disableOnMobile=!0);C(!0);var i=$.options.customClass,l=i.postfixes.split(" "),r=R.width();e.each(s.split(" "),function(e,t){var s=i.prefix+l[e];$.classes[t.toLowerCase()]=i.camelCase?s:a.toDash(s)}),x=e("<input/>",{"class":$.classes.input,readonly:L}),k=e("<div/>",{"class":$.classes.items,tabindex:-1}),T=e("<div/>",{"class":$.classes.scroll}),D=e("<div/>",{"class":i.prefix,html:$.options.arrowButtonMarkup}),y=e('<p class="label"/>'),I=R.wrap("<div>").parent().append(D.prepend(y),k,x),A={open:v,close:m,destroy:C,refresh:u,init:d},R.on(A).wrap('<div class="'+$.classes.hideselect+'">'),e.extend($,A),$.options.inheritOriginalWidth&&r>0&&I.width(r),p()}function p(){$.items=[];var s=R.children(),o="<ul>",n=s.filter(":selected").index();H=S=~n?n:0,(E=s.length)&&(s.each(function(t){var s=e(this),i=s.html(),n=s.prop("disabled"),l=$.options.optionsItemBuilder;$.items[t]={value:s.val(),text:i,slug:a.replaceDiacritics(i),disabled:n},o+=a.format('<li class="{1}">{2}</li>',e.trim([t==H?"selected":"",t==E-1?"last":"",n?"disabled":""].join(" ")),e.isFunction(l)?l($.items[t],s,t):a.format(l,$.items[t]))}),k.append(T.html(o+"</ul>")),y.html($.items[H].text)),D.add(R).add(I).add(x).off(i),I.prop("class",[$.classes.wrapper,R.prop("class").replace(/\S+/g,t+"-$&"),$.options.responsive?$.classes.responsive:""].join(" ")),R.prop("disabled")?(I.addClass($.classes.disabled),x.prop("disabled",!0)):(j=!0,I.removeClass($.classes.disabled).on("mouseenter"+i+" mouseleave"+i,function(t){e(this).toggleClass($.classes.hover),$.options.openOnHover&&(clearTimeout($.closeTimer),"mouseleave"==t.type?$.closeTimer=setTimeout(m,500):v())}),D.on("click"+i,function(e){Y?m():v(e)}),x.prop({tabindex:q,disabled:!1}).on("keypress"+i,h).on("keydown"+i,function(e){h(e),clearTimeout($.resetStr),$.resetStr=setTimeout(function(){x.val("")},$.options.keySearchTimeout);var t=e.keyCode||e.which;t>36&&41>t&&b(a[(39>t?"previous":"next")+"EnabledItem"]($.items,S))}).on("focusin"+i,function(e){x.one("blur",function(){x.blur()}),Y||v(e)}).on("oninput"in x[0]?"input":"keyup",function(){x.val().length&&e.each($.items,function(e,t){return RegExp("^"+x.val(),"i").test(t.slug)&&!t.disabled?(b(e),!1):void 0})}),R.prop("tabindex",!1),O=e("li",k.removeAttr("style")).click(function(){return b(e(this).index(),!0),!1})),a.triggerCallback("Init",$)}function u(){a.triggerCallback("Refresh",$),p()}function h(e){var t=e.keyCode||e.which;13==t&&e.preventDefault(),/^(9|13|27)$/.test(t)&&(e.stopPropagation(),b(S,!0))}function f(){var e=k.closest(":visible").children(":hidden"),t=$.options.maxHeight;e.addClass($.classes.tempshow);var s=k.outerWidth(),i=D.outerWidth()-(s-k.width());!$.options.expandToItemText||i>s?W=i:(k.css("overflow","scroll"),I.width(9e4),W=k.width(),k.css("overflow",""),I.width("")),k.width(W).height()>t&&k.height(t),e.removeClass($.classes.tempshow)}function v(s){a.triggerCallback("BeforeOpen",$),s&&(s.preventDefault(),s.stopPropagation()),j&&(f(),e("."+$.classes.hideselect,"."+$.classes.open).children()[t]("close"),Y=!0,B=k.outerHeight(),M=k.height(),x.val("").is(":focus")||x.focus(),l.on("click"+i,m).on("scroll"+i,g),g(),$.options.preventWindowScroll&&l.on("mousewheel"+i+" DOMMouseScroll"+i,"."+$.classes.scroll,function(t){var s=t.originalEvent,i=e(this).scrollTop(),o=0;"detail"in s&&(o=-1*s.detail),"wheelDelta"in s&&(o=s.wheelDelta),"wheelDeltaY"in s&&(o=s.wheelDeltaY),"deltaY"in s&&(o=-1*s.deltaY),(i==this.scrollHeight-M&&0>o||0==i&&o>0)&&t.preventDefault()}),I.addClass($.classes.open),w(S),a.triggerCallback("Open",$))}function g(){f(),I.toggleClass($.classes.above,I.offset().top+I.outerHeight()+B>r.scrollTop()+r.height())}function m(){if(a.triggerCallback("BeforeClose",$),H!=S){a.triggerCallback("BeforeChange",$);var e=$.items[S].text;R.prop("selectedIndex",H=S).data("value",e),y.html(e),a.triggerCallback("Change",$)}l.off(i),I.removeClass($.classes.open),Y=!1,a.triggerCallback("Close",$)}function b(e,t){$.items[S=e].disabled||(O.removeClass("selected").eq(e).addClass("selected"),w(e),t&&m())}function w(e){var t=O.eq(e).outerHeight(),s=O[e].offsetTop,i=T.scrollTop(),o=s+2*t;T.scrollTop(o>i+B?o-B:i>s-t?s-t:i)}function C(e){j&&(k.add(D).add(x).remove(),!e&&R.removeData(t).removeData("value"),R.prop("tabindex",q).off(i).off(A).unwrap().unwrap(),j=!1)}var x,k,T,D,y,I,O,S,H,B,M,W,E,A,$=this,R=e(n),Y=!1,j=!1,L=/android|ip(hone|od|ad)/i.test(navigator.userAgent),q=R.prop("tabindex");d(c)};e.fn[t]=function(s){return this.each(function(){var i=e.data(this,t);i&&!i.disableOnMobile?""+s===s&&i[s]?i[s]():i.init(s):e.data(this,t,new c(this,s))})},e.fn[t].hooks=n}(jQuery);
/*
     _ _      _       _
 ___| (_) ___| | __  (_)___
/ __| | |/ __| |/ /  | / __|
\__ \ | | (__|   < _ | \__ \
|___/_|_|\___|_|\_(_)/ |___/
                   |__/

 Version: 1.3.15
  Author: Ken Wheeler
 Website: http://kenwheeler.github.io
    Docs: http://kenwheeler.github.io/slick
    Repo: http://github.com/kenwheeler/slick
  Issues: http://github.com/kenwheeler/slick/issues

 */

!function(a){"use strict";"function"==typeof define&&define.amd?define(["jquery"],a):"undefined"!=typeof exports?module.exports=a(require("jquery")):a(jQuery)}(function(a){"use strict";var b=window.Slick||{};b=function(){function c(c,d){var f,g,e=this;if(e.defaults={accessibility:!0,adaptiveHeight:!1,appendArrows:a(c),appendDots:a(c),arrows:!0,asNavFor:null,prevArrow:'<button type="button" data-role="none" class="slick-prev">Previous</button>',nextArrow:'<button type="button" data-role="none" class="slick-next">Next</button>',autoplay:!1,autoplaySpeed:3e3,centerMode:!1,centerPadding:"50px",cssEase:"ease",customPaging:function(a,b){return'<button type="button" data-role="none">'+(b+1)+"</button>"},dots:!1,dotsClass:"slick-dots",draggable:!0,easing:"linear",fade:!1,focusOnSelect:!1,infinite:!0,initialSlide:0,lazyLoad:"ondemand",onBeforeChange:null,onAfterChange:null,onInit:null,onReInit:null,onSetPosition:null,pauseOnHover:!0,pauseOnDotsHover:!1,respondTo:"window",responsive:null,rtl:!1,slide:"div",slidesToShow:1,slidesToScroll:1,speed:500,swipe:!0,swipeToSlide:!1,touchMove:!0,touchThreshold:5,useCSS:!0,variableWidth:!1,vertical:!1,waitForAnimate:!0},e.initials={animating:!1,dragging:!1,autoPlayTimer:null,currentDirection:0,currentLeft:null,currentSlide:0,direction:1,$dots:null,listWidth:null,listHeight:null,loadIndex:0,$nextArrow:null,$prevArrow:null,slideCount:null,slideWidth:null,$slideTrack:null,$slides:null,sliding:!1,slideOffset:0,swipeLeft:null,$list:null,touchObject:{},transformsEnabled:!1},a.extend(e,e.initials),e.activeBreakpoint=null,e.animType=null,e.animProp=null,e.breakpoints=[],e.breakpointSettings=[],e.cssTransitions=!1,e.paused=!1,e.positionProp=null,e.respondTo=null,e.shouldClick=!0,e.$slider=a(c),e.$slidesCache=null,e.transformType=null,e.transitionType=null,e.windowWidth=0,e.windowTimer=null,e.options=a.extend({},e.defaults,d),e.currentSlide=e.options.initialSlide,e.originalSettings=e.options,f=e.options.responsive||null,f&&f.length>-1){e.respondTo=e.options.respondTo||"window";for(g in f)f.hasOwnProperty(g)&&(e.breakpoints.push(f[g].breakpoint),e.breakpointSettings[f[g].breakpoint]=f[g].settings);e.breakpoints.sort(function(a,b){return b-a})}e.autoPlay=a.proxy(e.autoPlay,e),e.autoPlayClear=a.proxy(e.autoPlayClear,e),e.changeSlide=a.proxy(e.changeSlide,e),e.clickHandler=a.proxy(e.clickHandler,e),e.selectHandler=a.proxy(e.selectHandler,e),e.setPosition=a.proxy(e.setPosition,e),e.swipeHandler=a.proxy(e.swipeHandler,e),e.dragHandler=a.proxy(e.dragHandler,e),e.keyHandler=a.proxy(e.keyHandler,e),e.autoPlayIterator=a.proxy(e.autoPlayIterator,e),e.instanceUid=b++,e.htmlExpr=/^(?:\s*(<[\w\W]+>)[^>]*)$/,e.init(),e.checkResponsive()}var b=0;return c}(),b.prototype.addSlide=function(b,c,d){var e=this;if("boolean"==typeof c)d=c,c=null;else if(0>c||c>=e.slideCount)return!1;e.unload(),"number"==typeof c?0===c&&0===e.$slides.length?a(b).appendTo(e.$slideTrack):d?a(b).insertBefore(e.$slides.eq(c)):a(b).insertAfter(e.$slides.eq(c)):d===!0?a(b).prependTo(e.$slideTrack):a(b).appendTo(e.$slideTrack),e.$slides=e.$slideTrack.children(this.options.slide),e.$slideTrack.children(this.options.slide).detach(),e.$slideTrack.append(e.$slides),e.$slides.each(function(b,c){a(c).attr("index",b)}),e.$slidesCache=e.$slides,e.reinit()},b.prototype.animateSlide=function(b,c){var d={},e=this;if(1===e.options.slidesToShow&&e.options.adaptiveHeight===!0&&e.options.vertical===!1){var f=e.$slides.eq(e.currentSlide).outerHeight(!0);e.$list.animate({height:f},e.options.speed)}e.options.rtl===!0&&e.options.vertical===!1&&(b=-b),e.transformsEnabled===!1?e.options.vertical===!1?e.$slideTrack.animate({left:b},e.options.speed,e.options.easing,c):e.$slideTrack.animate({top:b},e.options.speed,e.options.easing,c):e.cssTransitions===!1?a({animStart:e.currentLeft}).animate({animStart:b},{duration:e.options.speed,easing:e.options.easing,step:function(a){e.options.vertical===!1?(d[e.animType]="translate("+a+"px, 0px)",e.$slideTrack.css(d)):(d[e.animType]="translate(0px,"+a+"px)",e.$slideTrack.css(d))},complete:function(){c&&c.call()}}):(e.applyTransition(),d[e.animType]=e.options.vertical===!1?"translate3d("+b+"px, 0px, 0px)":"translate3d(0px,"+b+"px, 0px)",e.$slideTrack.css(d),c&&setTimeout(function(){e.disableTransition(),c.call()},e.options.speed))},b.prototype.asNavFor=function(b){var c=this,d=null!=c.options.asNavFor?a(c.options.asNavFor).getSlick():null;null!=d&&d.slideHandler(b,!0)},b.prototype.applyTransition=function(a){var b=this,c={};c[b.transitionType]=b.options.fade===!1?b.transformType+" "+b.options.speed+"ms "+b.options.cssEase:"opacity "+b.options.speed+"ms "+b.options.cssEase,b.options.fade===!1?b.$slideTrack.css(c):b.$slides.eq(a).css(c)},b.prototype.autoPlay=function(){var a=this;a.autoPlayTimer&&clearInterval(a.autoPlayTimer),a.slideCount>a.options.slidesToShow&&a.paused!==!0&&(a.autoPlayTimer=setInterval(a.autoPlayIterator,a.options.autoplaySpeed))},b.prototype.autoPlayClear=function(){var a=this;a.autoPlayTimer&&clearInterval(a.autoPlayTimer)},b.prototype.autoPlayIterator=function(){var a=this;a.options.infinite===!1?1===a.direction?(a.currentSlide+1===a.slideCount-1&&(a.direction=0),a.slideHandler(a.currentSlide+a.options.slidesToScroll)):(0===a.currentSlide-1&&(a.direction=1),a.slideHandler(a.currentSlide-a.options.slidesToScroll)):a.slideHandler(a.currentSlide+a.options.slidesToScroll)},b.prototype.buildArrows=function(){var b=this;b.options.arrows===!0&&b.slideCount>b.options.slidesToShow&&(b.$prevArrow=a(b.options.prevArrow),b.$nextArrow=a(b.options.nextArrow),b.htmlExpr.test(b.options.prevArrow)&&b.$prevArrow.appendTo(b.options.appendArrows),b.htmlExpr.test(b.options.nextArrow)&&b.$nextArrow.appendTo(b.options.appendArrows),b.options.infinite!==!0&&b.$prevArrow.addClass("slick-disabled"))},b.prototype.buildDots=function(){var c,d,b=this;if(b.options.dots===!0&&b.slideCount>b.options.slidesToShow){for(d='<ul class="'+b.options.dotsClass+'">',c=0;c<=b.getDotCount();c+=1)d+="<li>"+b.options.customPaging.call(this,b,c)+"</li>";d+="</ul>",b.$dots=a(d).appendTo(b.options.appendDots),b.$dots.find("li").first().addClass("slick-active")}},b.prototype.buildOut=function(){var b=this;b.$slides=b.$slider.children(b.options.slide+":not(.slick-cloned)").addClass("slick-slide"),b.slideCount=b.$slides.length,b.$slides.each(function(b,c){a(c).attr("index",b)}),b.$slidesCache=b.$slides,b.$slider.addClass("slick-slider"),b.$slideTrack=0===b.slideCount?a('<div class="slick-track"/>').appendTo(b.$slider):b.$slides.wrapAll('<div class="slick-track"/>').parent(),b.$list=b.$slideTrack.wrap('<div class="slick-list"/>').parent(),b.$slideTrack.css("opacity",0),b.options.centerMode===!0&&(b.options.slidesToScroll=1),a("img[data-lazy]",b.$slider).not("[src]").addClass("slick-loading"),b.setupInfinite(),b.buildArrows(),b.buildDots(),b.updateDots(),b.options.accessibility===!0&&b.$list.prop("tabIndex",0),b.setSlideClasses("number"==typeof this.currentSlide?this.currentSlide:0),b.options.draggable===!0&&b.$list.addClass("draggable")},b.prototype.checkResponsive=function(){var c,d,e,b=this,f=b.$slider.width(),g=window.innerWidth||a(window).width();if("window"===b.respondTo?e=g:"slider"===b.respondTo?e=f:"min"===b.respondTo&&(e=Math.min(g,f)),b.originalSettings.responsive&&b.originalSettings.responsive.length>-1&&null!==b.originalSettings.responsive){d=null;for(c in b.breakpoints)b.breakpoints.hasOwnProperty(c)&&e<b.breakpoints[c]&&(d=b.breakpoints[c]);null!==d?null!==b.activeBreakpoint?d!==b.activeBreakpoint&&(b.activeBreakpoint=d,b.options=a.extend({},b.originalSettings,b.breakpointSettings[d]),b.refresh()):(b.activeBreakpoint=d,b.options=a.extend({},b.originalSettings,b.breakpointSettings[d]),b.refresh()):null!==b.activeBreakpoint&&(b.activeBreakpoint=null,b.options=b.originalSettings,b.refresh())}},b.prototype.changeSlide=function(b,c){var f,g,h,i,j,d=this,e=a(b.target);switch(e.is("a")&&b.preventDefault(),h=0!==d.slideCount%d.options.slidesToScroll,f=h?0:(d.slideCount-d.currentSlide)%d.options.slidesToScroll,b.data.message){case"previous":g=0===f?d.options.slidesToScroll:d.options.slidesToShow-f,d.slideCount>d.options.slidesToShow&&d.slideHandler(d.currentSlide-g,!1,c);break;case"next":g=0===f?d.options.slidesToScroll:f,d.slideCount>d.options.slidesToShow&&d.slideHandler(d.currentSlide+g,!1,c);break;case"index":var k=0===b.data.index?0:b.data.index||a(b.target).parent().index()*d.options.slidesToScroll;if(i=d.getNavigableIndexes(),j=0,i[k]&&i[k]===k)if(k>i[i.length-1])k=i[i.length-1];else for(var l in i){if(k<i[l]){k=j;break}j=i[l]}d.slideHandler(k,!1,c);default:return}},b.prototype.clickHandler=function(a){var b=this;b.shouldClick===!1&&(a.stopImmediatePropagation(),a.stopPropagation(),a.preventDefault())},b.prototype.destroy=function(){var b=this;b.autoPlayClear(),b.touchObject={},a(".slick-cloned",b.$slider).remove(),b.$dots&&b.$dots.remove(),b.$prevArrow&&"object"!=typeof b.options.prevArrow&&b.$prevArrow.remove(),b.$nextArrow&&"object"!=typeof b.options.nextArrow&&b.$nextArrow.remove(),b.$slides.parent().hasClass("slick-track")&&b.$slides.unwrap().unwrap(),b.$slides.removeClass("slick-slide slick-active slick-center slick-visible").removeAttr("index").css({position:"",left:"",top:"",zIndex:"",opacity:"",width:""}),b.$slider.removeClass("slick-slider"),b.$slider.removeClass("slick-initialized"),b.$list.off(".slick"),a(window).off(".slick-"+b.instanceUid),a(document).off(".slick-"+b.instanceUid)},b.prototype.disableTransition=function(a){var b=this,c={};c[b.transitionType]="",b.options.fade===!1?b.$slideTrack.css(c):b.$slides.eq(a).css(c)},b.prototype.fadeSlide=function(a,b,c){var d=this;d.cssTransitions===!1?(d.$slides.eq(b).css({zIndex:1e3}),d.$slides.eq(b).animate({opacity:1},d.options.speed,d.options.easing,c),d.$slides.eq(a).animate({opacity:0},d.options.speed,d.options.easing)):(d.applyTransition(b),d.applyTransition(a),d.$slides.eq(b).css({opacity:1,zIndex:1e3}),d.$slides.eq(a).css({opacity:0}),c&&setTimeout(function(){d.disableTransition(b),d.disableTransition(a),c.call()},d.options.speed))},b.prototype.filterSlides=function(a){var b=this;null!==a&&(b.unload(),b.$slideTrack.children(this.options.slide).detach(),b.$slidesCache.filter(a).appendTo(b.$slideTrack),b.reinit())},b.prototype.getCurrent=function(){var a=this;return a.currentSlide},b.prototype.getDotCount=function(){var a=this,b=0,c=0,d=0;if(a.options.infinite===!0)d=Math.ceil(a.slideCount/a.options.slidesToScroll);else for(;b<a.slideCount;)++d,b=c+a.options.slidesToShow,c+=a.options.slidesToScroll<=a.options.slidesToShow?a.options.slidesToScroll:a.options.slidesToShow;return d-1},b.prototype.getLeft=function(a){var c,d,g,b=this,e=0;return b.slideOffset=0,d=b.$slides.first().outerHeight(),b.options.infinite===!0?(b.slideCount>b.options.slidesToShow&&(b.slideOffset=-1*b.slideWidth*b.options.slidesToShow,e=-1*d*b.options.slidesToShow),0!==b.slideCount%b.options.slidesToScroll&&a+b.options.slidesToScroll>b.slideCount&&b.slideCount>b.options.slidesToShow&&(a>b.slideCount?(b.slideOffset=-1*(b.options.slidesToShow-(a-b.slideCount))*b.slideWidth,e=-1*(b.options.slidesToShow-(a-b.slideCount))*d):(b.slideOffset=-1*b.slideCount%b.options.slidesToScroll*b.slideWidth,e=-1*b.slideCount%b.options.slidesToScroll*d))):a+b.options.slidesToShow>b.slideCount&&(b.slideOffset=(a+b.options.slidesToShow-b.slideCount)*b.slideWidth,e=(a+b.options.slidesToShow-b.slideCount)*d),b.slideCount<=b.options.slidesToShow&&(b.slideOffset=0,e=0),b.options.centerMode===!0&&b.options.infinite===!0?b.slideOffset+=b.slideWidth*Math.floor(b.options.slidesToShow/2)-b.slideWidth:b.options.centerMode===!0&&(b.slideOffset=0,b.slideOffset+=b.slideWidth*Math.floor(b.options.slidesToShow/2)),c=b.options.vertical===!1?-1*a*b.slideWidth+b.slideOffset:-1*a*d+e,b.options.variableWidth===!0&&(g=b.slideCount<=b.options.slidesToShow||b.options.infinite===!1?b.$slideTrack.children(".slick-slide").eq(a):b.$slideTrack.children(".slick-slide").eq(a+b.options.slidesToShow),c=g[0]?-1*g[0].offsetLeft:0,b.options.centerMode===!0&&(g=b.options.infinite===!1?b.$slideTrack.children(".slick-slide").eq(a):b.$slideTrack.children(".slick-slide").eq(a+b.options.slidesToShow+1),c=g[0]?-1*g[0].offsetLeft:0,c+=(b.$list.width()-g.outerWidth())/2)),c},b.prototype.getNavigableIndexes=function(){for(var a=this,b=0,c=0,d=[];b<a.slideCount;)d.push(b),b=c+a.options.slidesToScroll,c+=a.options.slidesToScroll<=a.options.slidesToShow?a.options.slidesToScroll:a.options.slidesToShow;return d},b.prototype.getSlideCount=function(){var c,b=this;if(b.options.swipeToSlide===!0){var d=null;return b.$slideTrack.find(".slick-slide").each(function(c,e){return e.offsetLeft+a(e).outerWidth()/2>-1*b.swipeLeft?(d=e,!1):void 0}),c=Math.abs(a(d).attr("index")-b.currentSlide)}return b.options.slidesToScroll},b.prototype.init=function(){var b=this;a(b.$slider).hasClass("slick-initialized")||(a(b.$slider).addClass("slick-initialized"),b.buildOut(),b.setProps(),b.startLoad(),b.loadSlider(),b.initializeEvents(),b.updateArrows(),b.updateDots()),null!==b.options.onInit&&b.options.onInit.call(this,b)},b.prototype.initArrowEvents=function(){var a=this;a.options.arrows===!0&&a.slideCount>a.options.slidesToShow&&(a.$prevArrow.on("click.slick",{message:"previous"},a.changeSlide),a.$nextArrow.on("click.slick",{message:"next"},a.changeSlide))},b.prototype.initDotEvents=function(){var b=this;b.options.dots===!0&&b.slideCount>b.options.slidesToShow&&a("li",b.$dots).on("click.slick",{message:"index"},b.changeSlide),b.options.dots===!0&&b.options.pauseOnDotsHover===!0&&b.options.autoplay===!0&&a("li",b.$dots).on("mouseenter.slick",function(){b.paused=!0,b.autoPlayClear()}).on("mouseleave.slick",function(){b.paused=!1,b.autoPlay()})},b.prototype.initializeEvents=function(){var b=this;b.initArrowEvents(),b.initDotEvents(),b.$list.on("touchstart.slick mousedown.slick",{action:"start"},b.swipeHandler),b.$list.on("touchmove.slick mousemove.slick",{action:"move"},b.swipeHandler),b.$list.on("touchend.slick mouseup.slick",{action:"end"},b.swipeHandler),b.$list.on("touchcancel.slick mouseleave.slick",{action:"end"},b.swipeHandler),b.$list.on("click.slick",b.clickHandler),b.options.pauseOnHover===!0&&b.options.autoplay===!0&&(b.$list.on("mouseenter.slick",function(){b.paused=!0,b.autoPlayClear()}),b.$list.on("mouseleave.slick",function(){b.paused=!1,b.autoPlay()})),b.options.accessibility===!0&&b.$list.on("keydown.slick",b.keyHandler),b.options.focusOnSelect===!0&&a(b.options.slide,b.$slideTrack).on("click.slick",b.selectHandler),a(window).on("orientationchange.slick.slick-"+b.instanceUid,function(){b.checkResponsive(),b.setPosition()}),a(window).on("resize.slick.slick-"+b.instanceUid,function(){a(window).width()!==b.windowWidth&&(clearTimeout(b.windowDelay),b.windowDelay=window.setTimeout(function(){b.windowWidth=a(window).width(),b.checkResponsive(),b.setPosition()},50))}),a("*[draggable!=true]",b.$slideTrack).on("dragstart",function(a){a.preventDefault()}),a(window).on("load.slick.slick-"+b.instanceUid,b.setPosition),a(document).on("ready.slick.slick-"+b.instanceUid,b.setPosition)},b.prototype.initUI=function(){var a=this;a.options.arrows===!0&&a.slideCount>a.options.slidesToShow&&(a.$prevArrow.show(),a.$nextArrow.show()),a.options.dots===!0&&a.slideCount>a.options.slidesToShow&&a.$dots.show(),a.options.autoplay===!0&&a.autoPlay()},b.prototype.keyHandler=function(a){var b=this;37===a.keyCode&&b.options.accessibility===!0?b.changeSlide({data:{message:"previous"}}):39===a.keyCode&&b.options.accessibility===!0&&b.changeSlide({data:{message:"next"}})},b.prototype.lazyLoad=function(){function g(b){a("img[data-lazy]",b).each(function(){var b=a(this),c=a(this).attr("data-lazy");b.load(function(){b.animate({opacity:1},200)}).css({opacity:0}).attr("src",c).removeAttr("data-lazy").removeClass("slick-loading")})}var c,d,e,f,b=this;b.options.centerMode===!0?b.options.infinite===!0?(e=b.currentSlide+(b.options.slidesToShow/2+1),f=e+b.options.slidesToShow+2):(e=Math.max(0,b.currentSlide-(b.options.slidesToShow/2+1)),f=2+(b.options.slidesToShow/2+1)+b.currentSlide):(e=b.options.infinite?b.options.slidesToShow+b.currentSlide:b.currentSlide,f=e+b.options.slidesToShow,b.options.fade===!0&&(e>0&&e--,f<=b.slideCount&&f++)),c=b.$slider.find(".slick-slide").slice(e,f),g(c),b.slideCount<=b.options.slidesToShow?(d=b.$slider.find(".slick-slide"),g(d)):b.currentSlide>=b.slideCount-b.options.slidesToShow?(d=b.$slider.find(".slick-cloned").slice(0,b.options.slidesToShow),g(d)):0===b.currentSlide&&(d=b.$slider.find(".slick-cloned").slice(-1*b.options.slidesToShow),g(d))},b.prototype.loadSlider=function(){var a=this;a.setPosition(),a.$slideTrack.css({opacity:1}),a.$slider.removeClass("slick-loading"),a.initUI(),"progressive"===a.options.lazyLoad&&a.progressiveLazyLoad()},b.prototype.postSlide=function(a){var b=this;null!==b.options.onAfterChange&&b.options.onAfterChange.call(this,b,a),b.animating=!1,b.setPosition(),b.swipeLeft=null,b.options.autoplay===!0&&b.paused===!1&&b.autoPlay()},b.prototype.progressiveLazyLoad=function(){var c,d,b=this;c=a("img[data-lazy]",b.$slider).length,c>0&&(d=a("img[data-lazy]",b.$slider).first(),d.attr("src",d.attr("data-lazy")).removeClass("slick-loading").load(function(){d.removeAttr("data-lazy"),b.progressiveLazyLoad()}).error(function(){d.removeAttr("data-lazy"),b.progressiveLazyLoad()}))},b.prototype.refresh=function(){var b=this,c=b.currentSlide;b.destroy(),a.extend(b,b.initials),b.init(),b.changeSlide({data:{message:"index",index:c}},!0)},b.prototype.reinit=function(){var b=this;b.$slides=b.$slideTrack.children(b.options.slide).addClass("slick-slide"),b.slideCount=b.$slides.length,b.currentSlide>=b.slideCount&&0!==b.currentSlide&&(b.currentSlide=b.currentSlide-b.options.slidesToScroll),b.slideCount<=b.options.slidesToShow&&(b.currentSlide=0),b.setProps(),b.setupInfinite(),b.buildArrows(),b.updateArrows(),b.initArrowEvents(),b.buildDots(),b.updateDots(),b.initDotEvents(),b.options.focusOnSelect===!0&&a(b.options.slide,b.$slideTrack).on("click.slick",b.selectHandler),b.setSlideClasses(0),b.setPosition(),null!==b.options.onReInit&&b.options.onReInit.call(this,b)},b.prototype.removeSlide=function(a,b,c){var d=this;return"boolean"==typeof a?(b=a,a=b===!0?0:d.slideCount-1):a=b===!0?--a:a,d.slideCount<1||0>a||a>d.slideCount-1?!1:(d.unload(),c===!0?d.$slideTrack.children().remove():d.$slideTrack.children(this.options.slide).eq(a).remove(),d.$slides=d.$slideTrack.children(this.options.slide),d.$slideTrack.children(this.options.slide).detach(),d.$slideTrack.append(d.$slides),d.$slidesCache=d.$slides,d.reinit(),void 0)},b.prototype.setCSS=function(a){var d,e,b=this,c={};b.options.rtl===!0&&(a=-a),d="left"==b.positionProp?a+"px":"0px",e="top"==b.positionProp?a+"px":"0px",c[b.positionProp]=a,b.transformsEnabled===!1?b.$slideTrack.css(c):(c={},b.cssTransitions===!1?(c[b.animType]="translate("+d+", "+e+")",b.$slideTrack.css(c)):(c[b.animType]="translate3d("+d+", "+e+", 0px)",b.$slideTrack.css(c)))},b.prototype.setDimensions=function(){var b=this;if(b.options.vertical===!1?b.options.centerMode===!0&&b.$list.css({padding:"0px "+b.options.centerPadding}):(b.$list.height(b.$slides.first().outerHeight(!0)*b.options.slidesToShow),b.options.centerMode===!0&&b.$list.css({padding:b.options.centerPadding+" 0px"})),b.listWidth=b.$list.width(),b.listHeight=b.$list.height(),b.options.vertical===!1&&b.options.variableWidth===!1)b.slideWidth=Math.ceil(b.listWidth/b.options.slidesToShow),b.$slideTrack.width(Math.ceil(b.slideWidth*b.$slideTrack.children(".slick-slide").length));else if(b.options.variableWidth===!0){var c=0;b.slideWidth=Math.ceil(b.listWidth/b.options.slidesToShow),b.$slideTrack.children(".slick-slide").each(function(){c+=Math.ceil(a(this).outerWidth(!0))}),b.$slideTrack.width(Math.ceil(c)+1)}else b.slideWidth=Math.ceil(b.listWidth),b.$slideTrack.height(Math.ceil(b.$slides.first().outerHeight(!0)*b.$slideTrack.children(".slick-slide").length));var d=b.$slides.first().outerWidth(!0)-b.$slides.first().width();b.options.variableWidth===!1&&b.$slideTrack.children(".slick-slide").width(b.slideWidth-d)},b.prototype.setFade=function(){var c,b=this;b.$slides.each(function(d,e){c=-1*b.slideWidth*d,b.options.rtl===!0?a(e).css({position:"relative",right:c,top:0,zIndex:800,opacity:0}):a(e).css({position:"relative",left:c,top:0,zIndex:800,opacity:0})}),b.$slides.eq(b.currentSlide).css({zIndex:900,opacity:1})},b.prototype.setHeight=function(){var a=this;if(1===a.options.slidesToShow&&a.options.adaptiveHeight===!0&&a.options.vertical===!1){var b=a.$slides.eq(a.currentSlide).outerHeight(!0);a.$list.css("height",b)}},b.prototype.setPosition=function(){var a=this;a.setDimensions(),a.setHeight(),a.options.fade===!1?a.setCSS(a.getLeft(a.currentSlide)):a.setFade(),null!==a.options.onSetPosition&&a.options.onSetPosition.call(this,a)},b.prototype.setProps=function(){var a=this,b=document.body.style;a.positionProp=a.options.vertical===!0?"top":"left","top"===a.positionProp?a.$slider.addClass("slick-vertical"):a.$slider.removeClass("slick-vertical"),(void 0!==b.WebkitTransition||void 0!==b.MozTransition||void 0!==b.msTransition)&&a.options.useCSS===!0&&(a.cssTransitions=!0),void 0!==b.OTransform&&(a.animType="OTransform",a.transformType="-o-transform",a.transitionType="OTransition",void 0===b.perspectiveProperty&&void 0===b.webkitPerspective&&(a.animType=!1)),void 0!==b.MozTransform&&(a.animType="MozTransform",a.transformType="-moz-transform",a.transitionType="MozTransition",void 0===b.perspectiveProperty&&void 0===b.MozPerspective&&(a.animType=!1)),void 0!==b.webkitTransform&&(a.animType="webkitTransform",a.transformType="-webkit-transform",a.transitionType="webkitTransition",void 0===b.perspectiveProperty&&void 0===b.webkitPerspective&&(a.animType=!1)),void 0!==b.msTransform&&(a.animType="msTransform",a.transformType="-ms-transform",a.transitionType="msTransition",void 0===b.msTransform&&(a.animType=!1)),void 0!==b.transform&&a.animType!==!1&&(a.animType="transform",a.transformType="transform",a.transitionType="transition"),a.transformsEnabled=null!==a.animType&&a.animType!==!1},b.prototype.setSlideClasses=function(a){var c,d,e,f,b=this;b.$slider.find(".slick-slide").removeClass("slick-active").removeClass("slick-center"),d=b.$slider.find(".slick-slide"),b.options.centerMode===!0?(c=Math.floor(b.options.slidesToShow/2),b.options.infinite===!0&&(a>=c&&a<=b.slideCount-1-c?b.$slides.slice(a-c,a+c+1).addClass("slick-active"):(e=b.options.slidesToShow+a,d.slice(e-c+1,e+c+2).addClass("slick-active")),0===a?d.eq(d.length-1-b.options.slidesToShow).addClass("slick-center"):a===b.slideCount-1&&d.eq(b.options.slidesToShow).addClass("slick-center")),b.$slides.eq(a).addClass("slick-center")):a>=0&&a<=b.slideCount-b.options.slidesToShow?b.$slides.slice(a,a+b.options.slidesToShow).addClass("slick-active"):d.length<=b.options.slidesToShow?d.addClass("slick-active"):(f=b.slideCount%b.options.slidesToShow,e=b.options.infinite===!0?b.options.slidesToShow+a:a,b.options.slidesToShow==b.options.slidesToScroll&&b.slideCount-a<b.options.slidesToShow?d.slice(e-(b.options.slidesToShow-f),e+f).addClass("slick-active"):d.slice(e,e+b.options.slidesToShow).addClass("slick-active")),"ondemand"===b.options.lazyLoad&&b.lazyLoad()},b.prototype.setupInfinite=function(){var c,d,e,b=this;if(b.options.fade===!0&&(b.options.centerMode=!1),b.options.infinite===!0&&b.options.fade===!1&&(d=null,b.slideCount>b.options.slidesToShow)){for(e=b.options.centerMode===!0?b.options.slidesToShow+1:b.options.slidesToShow,c=b.slideCount;c>b.slideCount-e;c-=1)d=c-1,a(b.$slides[d]).clone(!0).attr("id","").attr("index",d-b.slideCount).prependTo(b.$slideTrack).addClass("slick-cloned");for(c=0;e>c;c+=1)d=c,a(b.$slides[d]).clone(!0).attr("id","").attr("index",d+b.slideCount).appendTo(b.$slideTrack).addClass("slick-cloned");b.$slideTrack.find(".slick-cloned").find("[id]").each(function(){a(this).attr("id","")})}},b.prototype.selectHandler=function(b){var c=this,d=parseInt(a(b.target).parents(".slick-slide").attr("index"));return d||(d=0),c.slideCount<=c.options.slidesToShow?(c.$slider.find(".slick-slide").removeClass("slick-active"),c.$slides.eq(d).addClass("slick-active"),c.options.centerMode===!0&&(c.$slider.find(".slick-slide").removeClass("slick-center"),c.$slides.eq(d).addClass("slick-center")),c.asNavFor(d),void 0):(c.slideHandler(d),void 0)},b.prototype.slideHandler=function(a,b,c){var d,e,f,g,i=null,j=this;return b=b||!1,j.animating===!0&&j.options.waitForAnimate===!0||j.options.fade===!0&&j.currentSlide===a||j.slideCount<=j.options.slidesToShow?void 0:(b===!1&&j.asNavFor(a),d=a,i=j.getLeft(d),g=j.getLeft(j.currentSlide),j.currentLeft=null===j.swipeLeft?g:j.swipeLeft,j.options.infinite===!1&&j.options.centerMode===!1&&(0>a||a>j.getDotCount()*j.options.slidesToScroll)?(j.options.fade===!1&&(d=j.currentSlide,c!==!0?j.animateSlide(g,function(){j.postSlide(d)}):j.postSlide(d)),void 0):j.options.infinite===!1&&j.options.centerMode===!0&&(0>a||a>j.slideCount-j.options.slidesToScroll)?(j.options.fade===!1&&(d=j.currentSlide,c!==!0?j.animateSlide(g,function(){j.postSlide(d)}):j.postSlide(d)),void 0):(j.options.autoplay===!0&&clearInterval(j.autoPlayTimer),e=0>d?0!==j.slideCount%j.options.slidesToScroll?j.slideCount-j.slideCount%j.options.slidesToScroll:j.slideCount+d:d>=j.slideCount?0!==j.slideCount%j.options.slidesToScroll?0:d-j.slideCount:d,j.animating=!0,null!==j.options.onBeforeChange&&a!==j.currentSlide&&j.options.onBeforeChange.call(this,j,j.currentSlide,e),f=j.currentSlide,j.currentSlide=e,j.setSlideClasses(j.currentSlide),j.updateDots(),j.updateArrows(),j.options.fade===!0?(c!==!0?j.fadeSlide(f,e,function(){j.postSlide(e)}):j.postSlide(e),void 0):(c!==!0?j.animateSlide(i,function(){j.postSlide(e)}):j.postSlide(e),void 0)))},b.prototype.startLoad=function(){var a=this;a.options.arrows===!0&&a.slideCount>a.options.slidesToShow&&(a.$prevArrow.hide(),a.$nextArrow.hide()),a.options.dots===!0&&a.slideCount>a.options.slidesToShow&&a.$dots.hide(),a.$slider.addClass("slick-loading")},b.prototype.swipeDirection=function(){var a,b,c,d,e=this;return a=e.touchObject.startX-e.touchObject.curX,b=e.touchObject.startY-e.touchObject.curY,c=Math.atan2(b,a),d=Math.round(180*c/Math.PI),0>d&&(d=360-Math.abs(d)),45>=d&&d>=0?e.options.rtl===!1?"left":"right":360>=d&&d>=315?e.options.rtl===!1?"left":"right":d>=135&&225>=d?e.options.rtl===!1?"right":"left":"vertical"},b.prototype.swipeEnd=function(){var b=this;if(b.dragging=!1,b.shouldClick=b.touchObject.swipeLength>10?!1:!0,void 0===b.touchObject.curX)return!1;if(b.touchObject.swipeLength>=b.touchObject.minSwipe)switch(b.swipeDirection()){case"left":b.slideHandler(b.currentSlide+b.getSlideCount()),b.currentDirection=0,b.touchObject={};break;case"right":b.slideHandler(b.currentSlide-b.getSlideCount()),b.currentDirection=1,b.touchObject={}}else b.touchObject.startX!==b.touchObject.curX&&(b.slideHandler(b.currentSlide),b.touchObject={})},b.prototype.swipeHandler=function(a){var b=this;if(!(b.options.swipe===!1||"ontouchend"in document&&b.options.swipe===!1||b.options.draggable===!1&&-1!==a.type.indexOf("mouse")))switch(b.touchObject.fingerCount=a.originalEvent&&void 0!==a.originalEvent.touches?a.originalEvent.touches.length:1,b.touchObject.minSwipe=b.listWidth/b.options.touchThreshold,a.data.action){case"start":b.swipeStart(a);break;case"move":b.swipeMove(a);break;case"end":b.swipeEnd(a)}},b.prototype.swipeMove=function(a){var c,d,e,f,b=this;return f=void 0!==a.originalEvent?a.originalEvent.touches:null,!b.dragging||f&&1!==f.length?!1:(c=b.getLeft(b.currentSlide),b.touchObject.curX=void 0!==f?f[0].pageX:a.clientX,b.touchObject.curY=void 0!==f?f[0].pageY:a.clientY,b.touchObject.swipeLength=Math.round(Math.sqrt(Math.pow(b.touchObject.curX-b.touchObject.startX,2))),d=b.swipeDirection(),"vertical"!==d?(void 0!==a.originalEvent&&b.touchObject.swipeLength>4&&a.preventDefault(),e=(b.options.rtl===!1?1:-1)*(b.touchObject.curX>b.touchObject.startX?1:-1),b.swipeLeft=b.options.vertical===!1?c+b.touchObject.swipeLength*e:c+b.touchObject.swipeLength*(b.$list.height()/b.listWidth)*e,b.options.fade===!0||b.options.touchMove===!1?!1:b.animating===!0?(b.swipeLeft=null,!1):(b.setCSS(b.swipeLeft),void 0)):void 0)},b.prototype.swipeStart=function(a){var c,b=this;return 1!==b.touchObject.fingerCount||b.slideCount<=b.options.slidesToShow?(b.touchObject={},!1):(void 0!==a.originalEvent&&void 0!==a.originalEvent.touches&&(c=a.originalEvent.touches[0]),b.touchObject.startX=b.touchObject.curX=void 0!==c?c.pageX:a.clientX,b.touchObject.startY=b.touchObject.curY=void 0!==c?c.pageY:a.clientY,b.dragging=!0,void 0)},b.prototype.unfilterSlides=function(){var a=this;null!==a.$slidesCache&&(a.unload(),a.$slideTrack.children(this.options.slide).detach(),a.$slidesCache.appendTo(a.$slideTrack),a.reinit())},b.prototype.unload=function(){var b=this;a(".slick-cloned",b.$slider).remove(),b.$dots&&b.$dots.remove(),b.$prevArrow&&"object"!=typeof b.options.prevArrow&&b.$prevArrow.remove(),b.$nextArrow&&"object"!=typeof b.options.nextArrow&&b.$nextArrow.remove(),b.$slides.removeClass("slick-slide slick-active slick-visible").css("width","")},b.prototype.updateArrows=function(){var b,a=this;b=Math.floor(a.options.slidesToShow/2),a.options.arrows===!0&&a.options.infinite!==!0&&a.slideCount>a.options.slidesToShow&&(a.$prevArrow.removeClass("slick-disabled"),a.$nextArrow.removeClass("slick-disabled"),0===a.currentSlide?(a.$prevArrow.addClass("slick-disabled"),a.$nextArrow.removeClass("slick-disabled")):a.currentSlide>=a.slideCount-a.options.slidesToShow&&a.options.centerMode===!1?(a.$nextArrow.addClass("slick-disabled"),a.$prevArrow.removeClass("slick-disabled")):a.currentSlide>a.slideCount-a.options.slidesToShow+b&&a.options.centerMode===!0&&(a.$nextArrow.addClass("slick-disabled"),a.$prevArrow.removeClass("slick-disabled")))},b.prototype.updateDots=function(){var a=this;null!==a.$dots&&(a.$dots.find("li").removeClass("slick-active"),a.$dots.find("li").eq(Math.floor(a.currentSlide/a.options.slidesToScroll)).addClass("slick-active"))},a.fn.slick=function(a){var c=this;return c.each(function(c,d){d.slick=new b(d,a)})},a.fn.slickAdd=function(a,b,c){var d=this;return d.each(function(d,e){e.slick.addSlide(a,b,c)})},a.fn.slickCurrentSlide=function(){var a=this;return a.get(0).slick.getCurrent()},a.fn.slickFilter=function(a){var b=this;return b.each(function(b,c){c.slick.filterSlides(a)})},a.fn.slickGoTo=function(a,b){var c=this;return c.each(function(c,d){d.slick.changeSlide({data:{message:"index",index:parseInt(a)}},b)})},a.fn.slickNext=function(){var a=this;return a.each(function(a,b){b.slick.changeSlide({data:{message:"next"}})})},a.fn.slickPause=function(){var a=this;return a.each(function(a,b){b.slick.autoPlayClear(),b.slick.paused=!0})},a.fn.slickPlay=function(){var a=this;return a.each(function(a,b){b.slick.paused=!1,b.slick.autoPlay()})},a.fn.slickPrev=function(){var a=this;return a.each(function(a,b){b.slick.changeSlide({data:{message:"previous"}})})},a.fn.slickRemove=function(a,b){var c=this;return c.each(function(c,d){d.slick.removeSlide(a,b)})},a.fn.slickRemoveAll=function(){var a=this;return a.each(function(a,b){b.slick.removeSlide(null,null,!0)})},a.fn.slickGetOption=function(a){var b=this;return b.get(0).slick.options[a]},a.fn.slickSetOption=function(a,b,c){var d=this;return d.each(function(d,e){e.slick.options[a]=b,c===!0&&(e.slick.unload(),e.slick.reinit())})},a.fn.slickUnfilter=function(){var a=this;return a.each(function(a,b){b.slick.unfilterSlides()})},a.fn.unslick=function(){var a=this;return a.each(function(a,b){b.slick&&b.slick.destroy()})},a.fn.getSlick=function(){var a=null,b=this;return b.each(function(b,c){a=c.slick}),a}});
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
            ww.inline_svg_fallback.init();
            ww.conditional_modals.init();
            ww.paid_search.init();
            ww.scrollto.init();
            ww.maps.init();
            ww.search_maps.init();
            ww.anchors_to_options.init();
            ww.contact_validation.init();
            if($('#ps-form').length) {
                //ww.fixed_ps_form.init();
                ww.sticky_form.init();
            }
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
  @INLINE SVG FALLBACK
------------------------*/
ww.inline_svg_fallback = (function(){
    return {
        init: function() {
            if (typeof Modernizr !== 'undefined') {
                if ( ! Modernizr.inlinesvg) {
                    var $el;

                    $("[data-inline-svg-fallback]").each(function() {
                        $el = $(this);
                        $img = $("<img src='"+$el.data("inline-svg-fallback")+"'>");
                        $el.html($img);
                    });
                }
            }
        }
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
            //For Photo Gallery, add function to update caption
            if( $carousel.data("carousel-type") == 'photo-gallery') {
                slick_options.onAfterChange = function() {
                    ww.carousels.show_caption();
                };
            }

            var $slick_api = $carousel.slick(slick_options);

            if ($carousel.is("[data-equal-heights]")) {
                $('.slick__item').imagesLoaded( function() {
                    ww.carousels.equal_heights($carousel);
                });
            }
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
                autoplay: true,
                autoplaySpeed: 4000
            });
        },
        show_caption: function() {
            var caption = $('.slick-active').find('img').attr('data-caption');
            if(caption !== '') {
                $('#gallery-caption').removeClass('caption-empty').html('<p>' + caption + '</p>');
            } else {
                $('#gallery-caption').addClass('caption-empty').html('');
            }
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
            s.$bar.on("click", function(e) {
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
                        $message = $('#contact-comments').val(),
                        $message_label = $('#label-comments');

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

/*-----------------------
  @FIXED PS FORM
------------------------*/
ww.fixed_ps_form = (function() {
    var s = {
        $win: $(window),
        $body: $('body'),
        $main: $('main'),
        $fixed_el: $('#ps-form'),
        $offset_el: $('.ps-welcome'),
        $footer: $('.ps-footer'),
        $masthead: $('.ps-masthead'),
        $hero: $('.ps-hero'),
        width: null,
        height: null,
        top: null,
        footer_height: null,
        bottom: null,
        eloffset: null,
        right: null,
    };

    return {
        init: function() {
            s.$win.scroll(function() {
                // wait until the first scroll to calculate offset
                // otherwise font loading throws off calculation
                if (s.eloffset === null) {
                    s.eloffset = s.$offset_el.offset().top - s.$masthead.outerHeight();
                    s.width = s.$fixed_el.outerWidth();
                    s.height = s.$fixed_el.outerHeight();
                    s.top = s.$masthead.outerHeight() + 20;
                    s.footer_height = s.$footer.outerHeight();
                    s.bottom = $(document).height() - s.footer_height;
                    if(s.$win.width() - 1800 > 0) {
                        //Half the difference and add padding
                        s.right = ((s.$win.width() - 1800) / 2) + parseInt($('.page-row--snug').css('padding-right'),10);
                    } else {
                        s.right = $('.page-row--snug').css('padding-right');
                    }
                    s.$fixed_el.css({right: s.right});
                }

                if (s.eloffset < s.$win.scrollTop()) {
                    var bottom = s.$main.outerHeight() - ( s.$fixed_el.outerHeight() + 140);
                    if(bottom < s.$win.scrollTop()) {
                        s.$fixed_el.removeClass('is-fixed').css({ top: (bottom - 240) + 'px',  right: '0'});
                    } else {
                        // enter fixed mode
                        s.$fixed_el.addClass('is-fixed').css({ top: s.top + 'px', width: s.width + 'px', height: s.height, right: s.right});
                    }
                } else {
                    s.$fixed_el.removeClass('is-fixed').css({ top: '0',  right: '0'});
                }
            });
        },

        reset_offset: function() {
            s.eloffset = s.$offset_el.outerHeight();
        },
    };
})();

/*-----------------------
  @STICKY PS FORM
------------------------*/
ww.sticky_form = (function() {
    var s = {
        $win: $(window),
        $doc: $(document),
        $mashead_el: $('.ps-masthead'),
        $fixed_el: $('#ps-form'),
        $offset_el: $('.ps-welcome'),
        $footer_el: $('.ps-footer'),
        $footer_offset_top: $('.ps-footer').offset().top,
        $offset_top: $('.ps-welcome').offset().top,
        eloffset: null,
        footer_height: null,
        form_height: null,
        doc_height: null,
        max_height: null,
        masthead_height: null,
        min_height: null
    };

    return {
        init: function() {
            s.$win.scroll(function() {
                if (s.eloffset === null) {
                    footer_height = s.$footer_el.outerHeight();
                    form_height = s.$fixed_el.outerHeight();
                    masthead_height = s.$mashead_el.outerHeight() + 40;
                    doc_height = s.$doc.height();
                    total_height = s.$win.scrollTop() + footer_height + form_height + masthead_height;
                    max_height = doc_height - form_height - footer_height - masthead_height;
                    min_height = masthead_height + form_height + 20;
                }
                console.log(s.$win.height() + ' ' + min_height);
                if(s.$win.height() >= min_height) {
                    var top = total_height > doc_height ? max_height : s.$win.scrollTop();
                    s.$fixed_el.css({top: top + 'px'});
                } else {
                    s.$fixed_el.css({top: '0px'});
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

$(window).load(function() {
    ww.window_events.init();
});