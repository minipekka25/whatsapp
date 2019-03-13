!function(){for(var t=["ms","moz","webkit","o"],i=0;i<t.length&&!window.requestAnimationFrame;++i)window.requestAnimationFrame=window[t[i]+"RequestAnimationFrame"];window.requestAnimationFrame||(window.requestAnimationFrame=function(t,i){return window.setTimeout(function(){t()},16)})}(),function(t){"use strict";function i(){s=window.pageYOffset}function e(){i();for(var t=0;t<a.length;t++)a[t].doParallax()}if(void 0===a)var s,n,a=[];!function(t,i,e,o){function r(i,e){this.element=i,this.settings=t.extend({},g,e),""==this.settings.align&&(this.settings.align="center"),""===this.settings.id&&(this.settings.id=+new Date),this._defaults=g,this._name=h,this.init()}var h="la_vc_row_parallax",g={direction:"up",mobileenabled:!1,mobiledevice:!1,width:"",height:"",align:"center",opacity:"1",velocity:".3",image:"",target:"",repeat:!1,loopScroll:"",loopScrollTime:"2",removeOrig:!1,zIndex:"-1",id:"",complete:function(){}};t.extend(r.prototype,{init:function(){""===this.settings.target&&(this.settings.target=t(this.element)),this.settings.target.addClass(this.settings.direction),""===this.settings.image&&void 0!==t(this.element).css("backgroundImage")&&""!==t(this.element).css("backgroundImage")&&(this.settings.image=t(this.element).css("backgroundImage").replace(/url\(|\)|"|'/g,"")),a.push(this),this.setup(),this.settings.complete(),this.containerWidth=0,this.containerHeight=0},setup:function(){!1!==this.settings.removeOrig&&t(this.element).remove(),this.resizeParallaxBackground()},doParallax:function(){if((!this.settings.mobiledevice||this.settings.mobileenabled)&&this.isInView()){void 0===this.settings.inner&&(this.settings.inner=this.settings.target[0].querySelectorAll(".parallax-inner-"+this.settings.id)[0]);var t=this.settings.inner;(void 0===this.settings.doParallaxClientLastUpdate||+new Date-this.settings.doParallaxClientLastUpdate>2e3+1e3*Math.random())&&(this.settings.doParallaxClientLastUpdate=+new Date,this.settings.clientWidthCache=this.settings.target[0].clientWidth,this.settings.clientHeightCache=this.settings.target[0].clientHeight),0===this.containerWidth||0===this.containerHeight||this.settings.clientWidthCache===this.containerWidth&&this.settings.clientHeightCache===this.containerHeight||this.resizeParallaxBackground(),this.containerWidth=this.settings.clientWidthCache,this.containerHeight=this.settings.clientHeightCache;var i=(s-this.scrollTopMin)/(this.scrollTopMax-this.scrollTopMin),e=this.moveMax*i;"left"!==this.settings.direction&&"up"!==this.settings.direction||(e*=-1);var n="translate3d(",a="px, 0px, 0px)",o="translate3d(0px, ",r="px, 0px)";try{"ie"==LA.utils.browser.name&&LA.utils.browser.version<10&&(n="translate(",a="px, 0px)",o="translate(0px, ",r="px)")}catch(t){}"no-repeat"===t.style.backgroundRepeat&&("down"===this.settings.direction&&e<0&&(e=0),"up"===this.settings.direction&&e>0&&(e=0)),"left"===this.settings.direction||"right"===this.settings.direction?(t.style.transition="transform 1ms linear",t.style.webkitTransform=n+e+a,t.style.transform=n+e+a):(t.style.transition="transform 1ms linear",t.style.webkitTransform=o+e+r,t.style.transform=o+e+r),t.style.transition="transform -1ms linear"}},isInView:function(){if(void 0===this.settings.offsetLastUpdate||+new Date-this.settings.offsetLastUpdate>4e3+1e3*Math.random()){this.settings.offsetLastUpdate=+new Date;var t=this.settings.target[0];this.settings.offsetTopCache=t.getBoundingClientRect().top+i.pageYOffset,this.settings.elemHeightCache=t.clientHeight}var e=this.settings.offsetTopCache;return!(e+this.settings.elemHeightCache<s||s+n<e)},computeCoverDimensions:function(t,i,e){if(t/i>=e.offsetWidth/e.offsetHeight)var s=t*(n=(a=e.offsetHeight)/i);else var n=(s=e.offsetWidth)/t,a=i*n;return s+"px "+a+"px"},resizeParallaxBackground:function(){var i=this.settings.target;if(void 0!==i&&0!==i.length){var e="true"===this.settings.repeat||!0===this.settings.repeat||1===this.settings.repeat;if(i[0].style.minHeight="150px","none"===this.settings.direction){var s=i.width()+parseInt(i.css("paddingRight"))+parseInt(i.css("paddingLeft")),a=i.offset().left;"center"===this.settings.align?a="50% 50%":"left"===this.settings.align?a="0% 50%":"right"===this.settings.align?a="100% 50%":"top"===this.settings.align?a="50% 0%":"bottom"===this.settings.align&&(a="50% 100%"),i.css({opacity:Math.abs(parseFloat(this.settings.opacity)/100),backgroundSize:"cover",backgroundAttachment:"scroll",backgroundPosition:a,backgroundRepeat:"no-repeat"}),""!==this.settings.image&&"none"!==this.settings.image&&i.css({opacity:Math.abs(parseFloat(this.settings.opacity)/100),backgroundImage:"url("+this.settings.image+")"})}else if("fixed"===this.settings.direction){var s=i.width()+parseInt(i.css("paddingRight"))+parseInt(i.css("paddingLeft")),o=n;"center"===this.settings.align?"50%":"right"===this.settings.align&&"100%";var r=i.offset().left,h=!!navigator.userAgent.match(/MSIE/)||!!navigator.userAgent.match(/Trident.*rv[ :]*11\./)||!!navigator.userAgent.match(/Edge\/12/),g=!!navigator.userAgent.match(/Edge\/12/);!h&&i.find(".fixed-wrapper-"+this.settings.id).length<1&&t("<div></div>").addClass("fixed-wrapper-"+this.settings.id).prependTo(i),i.find(".parallax-inner-"+this.settings.id).length<1&&t("<div></div>").addClass("la_parallax_inner").addClass("parallax-inner-"+this.settings.id).addClass(this.settings.direction).prependTo(h?i:i.find(".fixed-wrapper-"+this.settings.id)),i.css({position:"relative",overflow:"hidden",zIndex:1}),i.find(".fixed-wrapper-"+this.settings.id).css({position:"absolute",top:0,left:0,right:0,bottom:0,clip:h?"auto":"rect(auto,auto,auto,auto)",webkitTransform:"none",transform:"none"}),i.find(".parallax-inner-"+this.settings.id).css({pointerEvents:"none",width:s,height:o,position:h?"absolute":"fixed",zIndex:this.settings.zIndex,top:0,left:h?0:r,opacity:Math.abs(parseFloat(this.settings.opacity)/100),backgroundSize:e?"auto":h?this.computeCoverDimensions(this.settings.width,this.settings.height,i[0].querySelectorAll(".parallax-inner-"+this.settings.id)[0]):"cover",backgroundAttachment:"fixed",backgroundPosition:e?"0 0 ":"50% 50%",backgroundRepeat:e?"repeat":"no-repeat",webkitTransform:"translateZ(0)",transform:"translateZ(0)"}),g&&(i.css({transform:"none",transformStyle:"flat"}),i.find(".parallax-inner-"+this.settings.id).css({transform:"none",transformStyle:"flat"})),""!==this.settings.image&&"none"!==this.settings.image&&i.find(".parallax-inner-"+this.settings.id).css({opacity:Math.abs(parseFloat(this.settings.opacity)/100),backgroundImage:"url("+this.settings.image+")"}),this.settings.mobiledevice&&!this.settings.mobileenabled&&i.find(".parallax-inner-"+this.settings.id).css({position:"absolute",backgroundAttachment:"initial",backgroundSize:"cover",left:"0",right:"0",bottom:"0",top:"0",height:"auto",width:"auto"})}else if("left"===this.settings.direction||"right"===this.settings.direction){var s=i.width()+parseInt(i.css("paddingRight"))+parseInt(i.css("paddingLeft")),o=i.height()+parseInt(i.css("paddingTop"))+parseInt(i.css("paddingBottom")),d=s;s+=400*Math.abs(parseFloat(this.settings.velocity));p="0%";"center"===this.settings.align?p="50%":"bottom"===this.settings.align&&(p="100%");r=0;"right"===this.settings.direction&&(r-=s-d),i.find(".parallax-inner-"+this.settings.id).length<1&&t("<div></div>").addClass("la_parallax_inner").addClass("parallax-inner-"+this.settings.id).addClass(this.settings.direction).prependTo(i),i.css({position:"relative",overflow:"hidden",zIndex:1}).find(".parallax-inner-"+this.settings.id).css({pointerEvents:"none",width:s,height:o,position:"absolute",zIndex:this.settings.zIndex,top:0,left:r,opacity:Math.abs(parseFloat(this.settings.opacity)/100),backgroundSize:e?"auto":this.computeCoverDimensions(this.settings.width,this.settings.height,i[0].querySelectorAll(".parallax-inner-"+this.settings.id)[0]),backgroundPosition:e?"0 0 ":"50% "+p,backgroundRepeat:e?"repeat":"no-repeat"}),""!==this.settings.image&&"none"!==this.settings.image&&i.find(".parallax-inner-"+this.settings.id).css({opacity:Math.abs(parseFloat(this.settings.opacity)/100),backgroundImage:"url("+this.settings.image+")"});f=0;i.offset().top>n&&(f=i.offset().top-n);u=i.offset().top+i.height()+parseInt(i.css("paddingTop"))+parseInt(i.css("paddingBottom"));this.moveMax=s-d,this.scrollTopMin=f,this.scrollTopMax=u}else{var l=800;"down"===this.settings.direction&&(l*=1.2);var s=i.width()+parseInt(i.css("paddingRight"))+parseInt(i.css("paddingLeft")),c=o=i.height()+parseInt(i.css("paddingTop"))+parseInt(i.css("paddingBottom"));o+=l*Math.abs(parseFloat(this.settings.velocity));r="0%";"center"===this.settings.align?r="50%":"right"===this.settings.align&&(r="100%");var p=0;"down"===this.settings.direction&&(p-=o-c),i.find(".parallax-inner-"+this.settings.id).length<1&&t("<div></div>").addClass("la_parallax_inner").addClass("parallax-inner-"+this.settings.id).addClass(this.settings.direction).prependTo(i),i.css({position:"relative",overflow:"hidden",zIndex:1}).find(".parallax-inner-"+this.settings.id).css({pointerEvents:"none",width:s,height:o,position:"absolute",zIndex:this.settings.zIndex,top:p,left:0,opacity:Math.abs(parseFloat(this.settings.opacity)/100),backgroundSize:e?"auto":this.computeCoverDimensions(this.settings.width,this.settings.height,i[0].querySelectorAll(".parallax-inner-"+this.settings.id)[0]),backgroundPosition:e?"0":r+" 50%",backgroundRepeat:e?"repeat":"no-repeat"}),""!==this.settings.image&&"none"!==this.settings.image&&i.find(".parallax-inner-"+this.settings.id).css({opacity:Math.abs(parseFloat(this.settings.opacity)/100),backgroundImage:"url("+this.settings.image+")"});var f=0;i.offset().top>n&&(f=i.offset().top-n);var u=i.offset().top+i.height()+parseInt(i.css("paddingTop"))+parseInt(i.css("paddingBottom"));this.moveMax=o-c,this.scrollTopMin=f,this.scrollTopMax=u}}}}),t.fn[h]=function(i){return this.each(function(){t.data(this,"plugin_"+h)||t.data(this,"plugin_"+h,new r(this,i))}),this}}(jQuery,window,document),t(document).ready(function(){function o(){i();for(var t=0;t<a.length;t++)a[t].doParallax();requestAnimationFrame(o)}function r(){s=window.pageYOffset,n=window.innerHeight}t(window).on("scroll touchmove touchstart touchend gesturechange mousemove",function(t){requestAnimationFrame(e)}),navigator.userAgent.match(/(Mobi|Android)/)&&requestAnimationFrame(o),t(window).on("load resize grid:items:added la_vc_row_parallax:refresh",function(){setTimeout(function(){r(),t.each(a,function(t,i){i.resizeParallaxBackground()})},16)})})}(jQuery);