!function(e){"function"==typeof define&&define.amd?define(["jquery"],e):"object"==typeof module&&module.exports?module.exports=function(t,i){return void 0===i&&(i="undefined"!=typeof window?require("jquery"):require("jquery")(t)),e(i),i}:e(jQuery)}(function(g){function n(t,i){this.settings=i,this.checkSettings(),this.imgAnalyzerTimeout=null,this.entries=null,this.buildingRow={entriesBuff:[],width:0,height:0,aspectRatio:0},this.lastFetchedEntry=null,this.lastAnalyzedIndex=-1,this.yield={every:2,flushed:0},this.border=0<=i.border?i.border:i.margins,this.maxRowHeight=this.retrieveMaxRowHeight(),this.suffixRanges=this.retrieveSuffixRanges(),this.offY=this.border,this.rows=0,this.spinner={phase:0,timeSlot:150,$el:g('<div class="jg-spinner"><span></span><span></span><span></span></div>'),intervalId:null},this.scrollBarOn=!1,this.checkWidthIntervalId=null,this.galleryWidth=t.width(),this.$gallery=t}n.prototype.getSuffix=function(t,i){for(var e=i<t?t:i,s=0;s<this.suffixRanges.length;s++)if(e<=this.suffixRanges[s])return this.settings.sizeRangeSuffixes[this.suffixRanges[s]];return this.settings.sizeRangeSuffixes[this.suffixRanges[s-1]]},n.prototype.removeSuffix=function(t,i){return t.substring(0,t.length-i.length)},n.prototype.endsWith=function(t,i){return-1!==t.indexOf(i,t.length-i.length)},n.prototype.getUsedSuffix=function(t){for(var i in this.settings.sizeRangeSuffixes)if(this.settings.sizeRangeSuffixes.hasOwnProperty(i)&&0!==this.settings.sizeRangeSuffixes[i].length&&this.endsWith(t,this.settings.sizeRangeSuffixes[i]))return this.settings.sizeRangeSuffixes[i];return""},n.prototype.newSrc=function(t,i,e,s){var n;return this.settings.thumbnailPath?n=this.settings.thumbnailPath(t,i,e,s):(s=null!==(s=t.match(this.settings.extension))?s[0]:"",n=t.replace(this.settings.extension,""),n=this.removeSuffix(n,this.getUsedSuffix(n)),n+=this.getSuffix(i,e)+s),n},n.prototype.showImg=function(t,i){this.settings.cssAnimation?(t.addClass("jg-entry-visible"),i&&i()):(t.stop().fadeTo(this.settings.imagesAnimationDuration,1,i),t.find(this.settings.imgSelector).stop().fadeTo(this.settings.imagesAnimationDuration,1,i))},n.prototype.extractImgSrcFromImage=function(t){var i=t.data("safe-src"),e="data-safe-src";return void 0===i&&(i=t.attr("src"),e="src"),t.data("jg.originalSrc",i),t.data("jg.src",i),t.data("jg.originalSrcLoc",e),i},n.prototype.imgFromEntry=function(t){t=t.find(this.settings.imgSelector);return 0===t.length?null:t},n.prototype.captionFromEntry=function(t){t=t.find("> .jg-caption");return 0===t.length?null:t},n.prototype.displayEntry=function(t,i,e,s,n,r){t.width(s),t.height(r),t.css("top",e),t.css("left",i);var o,a,h=this.imgFromEntry(t);null!==h?(h.css("width",s),h.css("height",n),h.css("margin-left",-s/2),h.css("margin-top",-n/2),(o=h.data("jg.src"))&&(o=this.newSrc(o,s,n,h[0]),h.one("error",function(){this.resetImgSrc(h)}),a=function(){h.attr("src",o)},"skipped"===t.data("jg.loaded")&&o?this.onImageEvent(o,function(){this.showImg(t,a),t.data("jg.loaded",!0)}.bind(this)):this.showImg(t,a))):this.showImg(t),this.displayEntryCaption(t)},n.prototype.displayEntryCaption=function(t){var i,e=this.imgFromEntry(t);null!==e&&this.settings.captions?(null===(i=this.captionFromEntry(t))&&(e=e.attr("alt"),this.isValidCaption(e)||(e=t.attr("title")),this.isValidCaption(e)&&(i=g('<div class="jg-caption">'+e+"</div>"),t.append(i),t.data("jg.createdCaption",!0))),null!==i&&(this.settings.cssAnimation||i.stop().fadeTo(0,this.settings.captionSettings.nonVisibleOpacity),this.addCaptionEventsHandlers(t))):this.removeCaptionEventsHandlers(t)},n.prototype.isValidCaption=function(t){return void 0!==t&&0<t.length},n.prototype.onEntryMouseEnterForCaption=function(t){t=this.captionFromEntry(g(t.currentTarget));this.settings.cssAnimation?t.addClass("jg-caption-visible").removeClass("jg-caption-hidden"):t.stop().fadeTo(this.settings.captionSettings.animationDuration,this.settings.captionSettings.visibleOpacity)},n.prototype.onEntryMouseLeaveForCaption=function(t){t=this.captionFromEntry(g(t.currentTarget));this.settings.cssAnimation?t.removeClass("jg-caption-visible").removeClass("jg-caption-hidden"):t.stop().fadeTo(this.settings.captionSettings.animationDuration,this.settings.captionSettings.nonVisibleOpacity)},n.prototype.addCaptionEventsHandlers=function(t){var i;void 0===(i=t.data("jg.captionMouseEvents"))&&(i={mouseenter:g.proxy(this.onEntryMouseEnterForCaption,this),mouseleave:g.proxy(this.onEntryMouseLeaveForCaption,this)},t.on("mouseenter",void 0,void 0,i.mouseenter),t.on("mouseleave",void 0,void 0,i.mouseleave),t.data("jg.captionMouseEvents",i))},n.prototype.removeCaptionEventsHandlers=function(t){var i=t.data("jg.captionMouseEvents");void 0!==i&&(t.off("mouseenter",void 0,i.mouseenter),t.off("mouseleave",void 0,i.mouseleave),t.removeData("jg.captionMouseEvents"))},n.prototype.clearBuildingRow=function(){this.buildingRow.entriesBuff=[],this.buildingRow.aspectRatio=0,this.buildingRow.width=0},n.prototype.prepareBuildingRow=function(t,i){var e,s,n,r,o=!0,a=0,h=this.galleryWidth-2*this.border-(this.buildingRow.entriesBuff.length-1)*this.settings.margins,g=h/this.buildingRow.aspectRatio,l=this.settings.rowHeight,u=this.buildingRow.width/h>this.settings.justifyThreshold;if(i||t&&"hide"===this.settings.lastRow&&!u){for(e=0;e<this.buildingRow.entriesBuff.length;e++)s=this.buildingRow.entriesBuff[e],this.settings.cssAnimation?s.removeClass("jg-entry-visible"):(s.stop().fadeTo(0,.1),s.find("> img, > a > img").fadeTo(0,0));return-1}for(t&&!u&&"justify"!==this.settings.lastRow&&"hide"!==this.settings.lastRow&&(o=!1,0<this.rows&&(o=(l=(this.offY-this.border-this.settings.margins*this.rows)/this.rows)*this.buildingRow.aspectRatio/h>this.settings.justifyThreshold)),e=0;e<this.buildingRow.entriesBuff.length;e++)r=(s=this.buildingRow.entriesBuff[e]).data("jg.width")/s.data("jg.height"),r=o?(n=e===this.buildingRow.entriesBuff.length-1?h:g*r,g):(n=l*r,l),h-=Math.round(n),s.data("jg.jwidth",Math.round(n)),s.data("jg.jheight",Math.ceil(r)),(0===e||r<a)&&(a=r);return this.buildingRow.height=a,o},n.prototype.flushRow=function(t,i){var e,s=this.settings,n=this.border,r=this.prepareBuildingRow(t,i);if(i||t&&"hide"===s.lastRow&&-1===r)this.clearBuildingRow();else{if(this.maxRowHeight&&this.maxRowHeight<this.buildingRow.height&&(this.buildingRow.height=this.maxRowHeight),t&&("center"===s.lastRow||"right"===s.lastRow)){for(var o=this.galleryWidth-2*this.border-(this.buildingRow.entriesBuff.length-1)*s.margins,a=0;a<this.buildingRow.entriesBuff.length;a++)o-=(e=this.buildingRow.entriesBuff[a]).data("jg.jwidth");"center"===s.lastRow?n+=Math.round(o/2):"right"===s.lastRow&&(n+=o)}var h=this.buildingRow.entriesBuff.length-1;for(a=0;a<=h;a++)e=this.buildingRow.entriesBuff[this.settings.rtl?h-a:a],this.displayEntry(e,n,this.offY,e.data("jg.jwidth"),e.data("jg.jheight"),this.buildingRow.height),n+=e.data("jg.jwidth")+s.margins;this.galleryHeightToSet=this.offY+this.buildingRow.height+this.border,this.setGalleryTempHeight(this.galleryHeightToSet+this.getSpinnerHeight()),(!t||this.buildingRow.height<=s.rowHeight&&r)&&(this.offY+=this.buildingRow.height+s.margins,this.rows+=1,this.clearBuildingRow(),this.settings.triggerEvent.call(this,"jg.rowflush"))}};var i=0;n.prototype.rememberGalleryHeight=function(){i=this.$gallery.height(),this.$gallery.height(i)},n.prototype.setGalleryTempHeight=function(t){i=Math.max(t,i),this.$gallery.height(i)},n.prototype.setGalleryFinalHeight=function(t){i=t,this.$gallery.height(t)},n.prototype.checkWidth=function(){this.checkWidthIntervalId=setInterval(g.proxy(function(){var t;this.$gallery.is(":visible")&&(t=parseFloat(this.$gallery.width()),Math.abs(t-this.galleryWidth)>this.settings.refreshSensitivity&&(this.galleryWidth=t,this.rewind(),this.rememberGalleryHeight(),this.startImgAnalyzer(!0)))},this),this.settings.refreshTime)},n.prototype.isSpinnerActive=function(){return null!==this.spinner.intervalId},n.prototype.getSpinnerHeight=function(){return this.spinner.$el.innerHeight()},n.prototype.stopLoadingSpinnerAnimation=function(){clearInterval(this.spinner.intervalId),this.spinner.intervalId=null,this.setGalleryTempHeight(this.$gallery.height()-this.getSpinnerHeight()),this.spinner.$el.detach()},n.prototype.startLoadingSpinnerAnimation=function(){var t=this.spinner,i=t.$el.find("span");clearInterval(t.intervalId),this.$gallery.append(t.$el),this.setGalleryTempHeight(this.offY+this.buildingRow.height+this.getSpinnerHeight()),t.intervalId=setInterval(function(){t.phase<i.length?i.eq(t.phase).fadeTo(t.timeSlot,1):i.eq(t.phase-i.length).fadeTo(t.timeSlot,0),t.phase=(t.phase+1)%(2*i.length)},t.timeSlot)},n.prototype.rewind=function(){this.lastFetchedEntry=null,this.lastAnalyzedIndex=-1,this.offY=this.border,this.rows=0,this.clearBuildingRow()},n.prototype.getSelectorWithoutSpinner=function(){return this.settings.selector+", div:not(.jg-spinner)"},n.prototype.getAllEntries=function(){var t=this.getSelectorWithoutSpinner();return this.$gallery.children(t).toArray()},n.prototype.updateEntries=function(t){var i;return 0<(i=t&&null!=this.lastFetchedEntry?(i=this.getSelectorWithoutSpinner(),g(this.lastFetchedEntry).nextAll(i).toArray()):(this.entries=[],this.getAllEntries())).length&&(g.isFunction(this.settings.sort)?i=this.sortArray(i):this.settings.randomize&&(i=this.shuffleArray(i)),this.lastFetchedEntry=i[i.length-1],this.settings.filter?i=this.filterArray(i):this.resetFilters(i)),this.entries=this.entries.concat(i),!0},n.prototype.insertToGallery=function(t){var i=this;g.each(t,function(){g(this).appendTo(i.$gallery)})},n.prototype.shuffleArray=function(t){for(var i,e,s=t.length-1;0<s;s--)i=Math.floor(Math.random()*(s+1)),e=t[s],t[s]=t[i],t[i]=e;return this.insertToGallery(t),t},n.prototype.sortArray=function(t){return t.sort(this.settings.sort),this.insertToGallery(t),t},n.prototype.resetFilters=function(t){for(var i=0;i<t.length;i++)g(t[i]).removeClass("jg-filtered")},n.prototype.filterArray=function(t){var i=this.settings;if("string"===g.type(i.filter))return t.filter(function(t){t=g(t);return t.is(i.filter)?(t.removeClass("jg-filtered"),!0):(t.addClass("jg-filtered").removeClass("jg-visible"),!1)});if(g.isFunction(i.filter)){for(var e=t.filter(i.filter),s=0;s<t.length;s++)-1===e.indexOf(t[s])?g(t[s]).addClass("jg-filtered").removeClass("jg-visible"):g(t[s]).removeClass("jg-filtered");return e}},n.prototype.resetImgSrc=function(t){"src"===t.data("jg.originalSrcLoc")?t.attr("src",t.data("jg.originalSrc")):t.attr("src","")},n.prototype.destroy=function(){clearInterval(this.checkWidthIntervalId),this.stopImgAnalyzerStarter(),g.each(this.getAllEntries(),g.proxy(function(t,i){var e=g(i);e.css("width",""),e.css("height",""),e.css("top",""),e.css("left",""),e.data("jg.loaded",void 0),e.removeClass("jg-entry jg-filtered jg-entry-visible");i=this.imgFromEntry(e);i&&(i.css("width",""),i.css("height",""),i.css("margin-left",""),i.css("margin-top",""),this.resetImgSrc(i),i.data("jg.originalSrc",void 0),i.data("jg.originalSrcLoc",void 0),i.data("jg.src",void 0)),this.removeCaptionEventsHandlers(e);i=this.captionFromEntry(e);e.data("jg.createdCaption")?(e.data("jg.createdCaption",void 0),null!==i&&i.remove()):null!==i&&i.fadeTo(0,1)},this)),this.$gallery.css("height",""),this.$gallery.removeClass("justified-gallery"),this.$gallery.data("jg.controller",void 0),this.settings.triggerEvent.call(this,"jg.destroy")},n.prototype.analyzeImages=function(t){for(var i=this.lastAnalyzedIndex+1;i<this.entries.length;i++){var e=g(this.entries[i]);if(!0===e.data("jg.loaded")||"skipped"===e.data("jg.loaded")){var s=this.galleryWidth-2*this.border-(this.buildingRow.entriesBuff.length-1)*this.settings.margins,n=e.data("jg.width")/e.data("jg.height");if(this.buildingRow.entriesBuff.push(e),this.buildingRow.aspectRatio+=n,this.buildingRow.width+=n*this.settings.rowHeight,this.lastAnalyzedIndex=i,s/(this.buildingRow.aspectRatio+n)<this.settings.rowHeight&&(this.flushRow(!1,0<this.settings.maxRowsCount&&this.rows===this.settings.maxRowsCount),++this.yield.flushed>=this.yield.every))return void this.startImgAnalyzer(t)}else if("error"!==e.data("jg.loaded"))return}0<this.buildingRow.entriesBuff.length&&this.flushRow(!0,0<this.settings.maxRowsCount&&this.rows===this.settings.maxRowsCount),this.isSpinnerActive()&&this.stopLoadingSpinnerAnimation(),this.stopImgAnalyzerStarter(),this.setGalleryFinalHeight(this.galleryHeightToSet),this.settings.triggerEvent.call(this,t?"jg.resize":"jg.complete")},n.prototype.stopImgAnalyzerStarter=function(){this.yield.flushed=0,null!==this.imgAnalyzerTimeout&&(clearTimeout(this.imgAnalyzerTimeout),this.imgAnalyzerTimeout=null)},n.prototype.startImgAnalyzer=function(t){var i=this;this.stopImgAnalyzerStarter(),this.imgAnalyzerTimeout=setTimeout(function(){i.analyzeImages(t)},.001)},n.prototype.onImageEvent=function(t,i,e){var s,n;(i||e)&&(s=new Image,n=g(s),i&&n.one("load",function(){n.off("load error"),i(s)}),e&&n.one("error",function(){n.off("load error"),e(s)}),s.src=t)},n.prototype.init=function(){var o=!1,a=!1,h=this;g.each(this.entries,function(t,i){var e=g(i),s=h.imgFromEntry(e);if(e.addClass("jg-entry"),!0!==e.data("jg.loaded")&&"skipped"!==e.data("jg.loaded"))if(null!==h.settings.rel&&e.attr("rel",h.settings.rel),null!==h.settings.target&&e.attr("target",h.settings.target),null!==s){var n=h.extractImgSrcFromImage(s);if(!1===h.settings.waitThumbnailsLoad||!n){var r=parseFloat(s.attr("width")),i=parseFloat(s.attr("height"));if("svg"===s.prop("tagName")&&(r=parseFloat(s[0].getBBox().width),i=parseFloat(s[0].getBBox().height)),!isNaN(r)&&!isNaN(i))return e.data("jg.width",r),e.data("jg.height",i),e.data("jg.loaded","skipped"),a=!0,h.startImgAnalyzer(!1),!0}e.data("jg.loaded",!1),o=!0,h.isSpinnerActive()||h.startLoadingSpinnerAnimation(),h.onImageEvent(n,function(t){e.data("jg.width",t.width),e.data("jg.height",t.height),e.data("jg.loaded",!0),h.startImgAnalyzer(!1)},function(){e.data("jg.loaded","error"),h.startImgAnalyzer(!1)})}else e.data("jg.loaded",!0),e.data("jg.width",e.width()|parseFloat(e.css("width"))|1),e.data("jg.height",e.height()|parseFloat(e.css("height"))|1)}),o||a||this.startImgAnalyzer(!1),this.checkWidth()},n.prototype.checkOrConvertNumber=function(t,i){if("string"===g.type(t[i])&&(t[i]=parseFloat(t[i])),"number"!==g.type(t[i]))throw i+" must be a number";if(isNaN(t[i]))throw"invalid number for "+i},n.prototype.checkSizeRangesSuffixes=function(){if("object"!==g.type(this.settings.sizeRangeSuffixes))throw"sizeRangeSuffixes must be defined and must be an object";var t,i=[];for(t in this.settings.sizeRangeSuffixes)this.settings.sizeRangeSuffixes.hasOwnProperty(t)&&i.push(t);for(var e={0:""},s=0;s<i.length;s++)if("string"===g.type(i[s]))try{e[parseInt(i[s].replace(/^[a-z]+/,""),10)]=this.settings.sizeRangeSuffixes[i[s]]}catch(t){throw"sizeRangeSuffixes keys must contains correct numbers ("+t+")"}else e[i[s]]=this.settings.sizeRangeSuffixes[i[s]];this.settings.sizeRangeSuffixes=e},n.prototype.retrieveMaxRowHeight=function(){var t=null,i=this.settings.rowHeight;if("string"===g.type(this.settings.maxRowHeight))t=this.settings.maxRowHeight.match(/^[0-9]+%$/)?i*parseFloat(this.settings.maxRowHeight.match(/^([0-9]+)%$/)[1])/100:parseFloat(this.settings.maxRowHeight);else{if("number"!==g.type(this.settings.maxRowHeight)){if(!1===this.settings.maxRowHeight||null==this.settings.maxRowHeight)return null;throw"maxRowHeight must be a number or a percentage"}t=this.settings.maxRowHeight}if(isNaN(t))throw"invalid number for maxRowHeight";return t=t<i?i:t},n.prototype.checkSettings=function(){this.checkSizeRangesSuffixes(),this.checkOrConvertNumber(this.settings,"rowHeight"),this.checkOrConvertNumber(this.settings,"margins"),this.checkOrConvertNumber(this.settings,"border"),this.checkOrConvertNumber(this.settings,"maxRowsCount");var t=["justify","nojustify","left","center","right","hide"];if(-1===t.indexOf(this.settings.lastRow))throw"lastRow must be one of: "+t.join(", ");if(this.checkOrConvertNumber(this.settings,"justifyThreshold"),this.settings.justifyThreshold<0||1<this.settings.justifyThreshold)throw"justifyThreshold must be in the interval [0,1]";if("boolean"!==g.type(this.settings.cssAnimation))throw"cssAnimation must be a boolean";if("boolean"!==g.type(this.settings.captions))throw"captions must be a boolean";if(this.checkOrConvertNumber(this.settings.captionSettings,"animationDuration"),this.checkOrConvertNumber(this.settings.captionSettings,"visibleOpacity"),this.settings.captionSettings.visibleOpacity<0||1<this.settings.captionSettings.visibleOpacity)throw"captionSettings.visibleOpacity must be in the interval [0, 1]";if(this.checkOrConvertNumber(this.settings.captionSettings,"nonVisibleOpacity"),this.settings.captionSettings.nonVisibleOpacity<0||1<this.settings.captionSettings.nonVisibleOpacity)throw"captionSettings.nonVisibleOpacity must be in the interval [0, 1]";if(this.checkOrConvertNumber(this.settings,"imagesAnimationDuration"),this.checkOrConvertNumber(this.settings,"refreshTime"),this.checkOrConvertNumber(this.settings,"refreshSensitivity"),"boolean"!==g.type(this.settings.randomize))throw"randomize must be a boolean";if("string"!==g.type(this.settings.selector))throw"selector must be a string";if(!1!==this.settings.sort&&!g.isFunction(this.settings.sort))throw"sort must be false or a comparison function";if(!1!==this.settings.filter&&!g.isFunction(this.settings.filter)&&"string"!==g.type(this.settings.filter))throw"filter must be false, a string or a filter function"},n.prototype.retrieveSuffixRanges=function(){var t,i=[];for(t in this.settings.sizeRangeSuffixes)this.settings.sizeRangeSuffixes.hasOwnProperty(t)&&i.push(parseInt(t,10));return i.sort(function(t,i){return i<t?1:t<i?-1:0}),i},n.prototype.updateSettings=function(t){this.settings=g.extend({},this.settings,t),this.checkSettings(),this.border=0<=this.settings.border?this.settings.border:this.settings.margins,this.maxRowHeight=this.retrieveMaxRowHeight(),this.suffixRanges=this.retrieveSuffixRanges()},n.prototype.defaults={sizeRangeSuffixes:{},thumbnailPath:void 0,rowHeight:120,maxRowHeight:!1,maxRowsCount:0,margins:1,border:-1,lastRow:"nojustify",justifyThreshold:.9,waitThumbnailsLoad:!0,captions:!0,cssAnimation:!0,imagesAnimationDuration:500,captionSettings:{animationDuration:500,visibleOpacity:.7,nonVisibleOpacity:0},rel:null,target:null,extension:/\.[^.\\/]+$/,refreshTime:200,refreshSensitivity:0,randomize:!1,rtl:!1,sort:!1,filter:!1,selector:"a",imgSelector:"> img, > a > img, > svg, > a > svg",triggerEvent:function(t){this.$gallery.trigger(t)}},g.fn.justifiedGallery=function(s){return this.each(function(t,i){var e=g(i);e.addClass("justified-gallery");i=e.data("jg.controller");if(void 0===i){if(null!=s&&"object"!==g.type(s)){if("destroy"===s)return;throw"The argument must be an object"}i=new n(e,g.extend({},n.prototype.defaults,s)),e.data("jg.controller",i)}else if("norewind"!==s){if("destroy"===s)return void i.destroy();i.updateSettings(s),i.rewind()}i.updateEntries("norewind"===s)&&i.init()})}});
!function(e,t){t=t(e,e.document);e.lazySizes=t,"object"==typeof module&&module.exports&&(module.exports=t)}(window,function(a,m){"use strict";if(m.getElementsByClassName){var z,n,i,t,s,o,y=m.documentElement,r=a.Date,l=a.HTMLPictureElement,c="addEventListener",h="getAttribute",d=a[c],u=a.setTimeout,f=a.requestAnimationFrame||u,g=a.requestIdleCallback,v=/^picture$/i,p=["load","error","lazyincluded","_lazyloaded"],C={},b=Array.prototype.forEach,A=function(e,t){return C[t]||(C[t]=new RegExp("(\\s|^)"+t+"(\\s|$)")),C[t].test(e[h]("class")||"")&&C[t]},E=function(e,t){A(e,t)||e.setAttribute("class",(e[h]("class")||"").trim()+" "+t)},_=function(e,t){(t=A(e,t))&&e.setAttribute("class",(e[h]("class")||"").replace(t," "))},w=function(t,n,e){var a=e?c:"removeEventListener";e&&w(t,n),p.forEach(function(e){t[a](e,n)})},M=function(e,t,n,a,i){var s=m.createEvent("Event");return(n=n||{}).instance=ue,s.initEvent(t,!a,!i),s.detail=n,e.dispatchEvent(s),s},N=function(e,t){var n;!l&&(n=a.picturefill||z.pf)?(t&&t.src&&!e[h]("srcset")&&e.setAttribute("srcset",t.src),n({reevaluate:!0,elements:[e]})):t&&t.src&&(e.src=t.src)},x=function(e,t){return(getComputedStyle(e,null)||{})[t]},W=function(e,t,n){for(n=n||e.offsetWidth;n<z.minSize&&t&&!e._lazysizesWidth;)n=t.offsetWidth,t=t.parentNode;return n},T=(s=[],o=t=[],he._lsFlush=ye,he),e=function(n,e){return e?function(){T(n)}:function(){var e=this,t=arguments;T(function(){n.apply(e,t)})}},B=function(e){var t,n,a=function(){t=null,e()},i=function(){var e=r.now()-n;e<99?u(i,99-e):(g||a)(a)};return function(){n=r.now(),t=t||u(i,99)}};!function(){var e,t={lazyClass:"lazyload",loadedClass:"lazyloaded",loadingClass:"lazyloading",preloadClass:"lazypreload",errorClass:"lazyerror",autosizesClass:"lazyautosizes",srcAttr:"data-src",srcsetAttr:"data-srcset",sizesAttr:"data-sizes",minSize:40,customMedia:{},init:!0,expFactor:1.5,hFac:.8,loadMode:2,loadHidden:!0,ricTimeout:0,throttleDelay:125};for(e in z=a.lazySizesConfig||a.lazysizesConfig||{},t)e in z||(z[e]=t[e]);a.lazySizesConfig=z,u(function(){z.init&&ze()})}();var F,S,L,R,k,D,H,O,P,$,I,q,j,G,J,K,Q,U,V,X,Y,Z,ee,te,ne,ae,ie,se,oe,re,le,ce,de,ue,fe=(V=/^img$/i,X=/^iframe$/i,Y="onscroll"in a&&!/(gle|ing)bot/.test(navigator.userAgent),te=-1,j=pe,J=ee=Z=0,K=z.throttleDelay,Q=z.ricTimeout,U=g&&49<Q?function(){g(Ce,{timeout:Q}),Q!==z.ricTimeout&&(Q=z.ricTimeout)}:e(function(){u(Ce)},!0),ae=e(be),ie=function(e){ae({target:e.target})},se=e(function(e,t,n,a,i){var s,o,r,l;(r=M(e,"lazybeforeunveil",t)).defaultPrevented||(a&&(n?E(e,z.autosizesClass):e.setAttribute("sizes",a)),n=e[h](z.srcsetAttr),a=e[h](z.srcAttr),i&&(o=(s=e.parentNode)&&v.test(s.nodeName||"")),l=t.firesLoad||"src"in e&&(n||a||o),r={target:e},E(e,z.loadingClass),l&&(clearTimeout(L),L=u(ge,2500),w(e,ie,!0)),o&&b.call(s.getElementsByTagName("source"),Ae),n?e.setAttribute("srcset",n):a&&!o&&(X.test(e.nodeName)?function(t,n){try{t.contentWindow.location.replace(n)}catch(e){t.src=n}}(e,a):e.src=a),i&&(n||o)&&N(e,{src:a})),e._lazyRace&&delete e._lazyRace,_(e,z.lazyClass),T(function(){(!l||e.complete&&1<e.naturalWidth)&&(be(r),e._lazyCache=!0,u(function(){"_lazyCache"in e&&delete e._lazyCache},9))},!0)}),re=function(){var e;S||(r.now()-k<999?u(re,999):(e=B(function(){z.loadMode=3,ne()}),S=!0,z.loadMode=3,ne(),d("scroll",function(){3==z.loadMode&&(z.loadMode=2),e()},!0)))},{_:function(){k=r.now(),ue.elements=m.getElementsByClassName(z.lazyClass),F=m.getElementsByClassName(z.lazyClass+" "+z.preloadClass),d("scroll",ne,!0),d("resize",ne,!0),a.MutationObserver?new MutationObserver(ne).observe(y,{childList:!0,subtree:!0,attributes:!0}):(y[c]("DOMNodeInserted",ne,!0),y[c]("DOMAttrModified",ne,!0),setInterval(ne,999)),d("hashchange",ne,!0),["focus","mouseover","click","load","transitionend","animationend","webkitAnimationEnd"].forEach(function(e){m[c](e,ne,!0)}),/d$|^c/.test(m.readyState)?re():(d("load",re),m[c]("DOMContentLoaded",ne),u(re,2e4)),ue.elements.length?(pe(),T._lsFlush()):ne()},checkElems:ne=function(e){var t;(e=!0===e)&&(Q=33),G||(G=!0,(t=K-(r.now()-J))<0&&(t=0),e||t<9?U():u(U,t))},unveil:oe=function(e){var t,n=V.test(e.nodeName),a=n&&(e[h](z.sizesAttr)||e[h]("sizes")),i="auto"==a;(!i&&S||!n||!e[h]("src")&&!e.srcset||e.complete||A(e,z.errorClass)||!A(e,z.lazyClass))&&(t=M(e,"lazyunveilread").detail,i&&me.updateElem(e,!0,e.offsetWidth),e._lazyRace=!0,ee++,se(e,t,i,a,n))}}),me=(ce=e(function(e,t,n,a){var i,s,o;if(e._lazysizesWidth=a,e.setAttribute("sizes",a+="px"),v.test(t.nodeName||""))for(s=0,o=(i=t.getElementsByTagName("source")).length;s<o;s++)i[s].setAttribute("sizes",a);n.detail.dataAttr||N(e,n.detail)}),{_:function(){le=m.getElementsByClassName(z.autosizesClass),d("resize",de)},checkElems:de=B(function(){var e,t=le.length;if(t)for(e=0;e<t;e++)Ee(le[e])}),updateElem:Ee}),ze=function(){ze.i||(ze.i=!0,me._(),fe._())};return ue={cfg:z,autoSizer:me,loader:fe,init:ze,uP:N,aC:E,rC:_,hC:A,fire:M,gW:W,rAF:T}}function ye(){var e=o;for(o=t.length?s:t,i=!(n=!0);e.length;)e.shift()();n=!1}function he(e,t){n&&!t?e.apply(this,arguments):(o.push(e),i||(i=!0,(m.hidden?u:f)(ye)))}function ge(e){ee--,e&&!(ee<0)&&e.target||(ee=0)}function ve(e){return(q=null==q?"hidden"==x(m.body,"visibility"):q)||"hidden"!=x(e.parentNode,"visibility")&&"hidden"!=x(e,"visibility")}function pe(){var e,t,n,a,i,s,o,r,l,c,d,u,f=ue.elements;if((R=z.loadMode)&&ee<8&&(e=f.length)){for(t=0,te++,c=!z.expand||z.expand<1?500<y.clientHeight&&500<y.clientWidth?500:370:z.expand,d=(ue._defEx=c)*z.expFactor,u=z.hFac,q=null,Z<d&&ee<1&&2<te&&2<R&&!m.hidden?(Z=d,te=0):Z=1<R&&1<te&&ee<6?c:0;t<e;t++)if(f[t]&&!f[t]._lazyRace)if(Y)if(l!==(s=!(r=f[t][h]("data-expand"))||!(s=+r)?Z:s)&&(D=innerWidth+s*u,H=innerHeight+s,o=-1*s,l=s),n=f[t].getBoundingClientRect(),(I=n.bottom)>=o&&(O=n.top)<=H&&($=n.right)>=o*u&&(P=n.left)<=D&&(I||$||P||O)&&(z.loadHidden||ve(f[t]))&&(S&&ee<3&&!r&&(R<3||te<4)||function(e,t){var n,a=e,i=ve(e);for(O-=t,I+=t,P-=t,$+=t;i&&(a=a.offsetParent)&&a!=m.body&&a!=y;)(i=0<(x(a,"opacity")||1))&&"visible"!=x(a,"overflow")&&(n=a.getBoundingClientRect(),i=$>n.left&&P<n.right&&I>n.top-1&&O<n.bottom+1);return i}(f[t],s))){if(oe(f[t]),i=!0,9<ee)break}else!i&&S&&!a&&ee<4&&te<4&&2<R&&(F[0]||z.preloadAfterLoad)&&(F[0]||!r&&(I||$||P||O||"auto"!=f[t][h](z.sizesAttr)))&&(a=F[0]||f[t]);else oe(f[t]);a&&!i&&oe(a)}}function Ce(){G=!1,J=r.now(),j()}function be(e){var t=e.target;t._lazyCache?delete t._lazyCache:(ge(e),E(t,z.loadedClass),_(t,z.loadingClass),w(t,ie),M(t,"lazyloaded"))}function Ae(e){var t,n=e[h](z.srcsetAttr);(t=z.customMedia[e[h]("data-media")||e[h]("media")])&&e.setAttribute("media",t),n&&e.setAttribute("srcset",n)}function Ee(e,t,n){var a=e.parentNode;a&&(n=W(e,a,n),(t=M(e,"lazybeforesizes",{width:n,dataAttr:!!t})).defaultPrevented||(n=t.detail.width)&&n!==e._lazysizesWidth&&ce(e,a,t,n))}});
function tg_getURLParameter(t){return decodeURIComponent((new RegExp("[?|&]"+t+"=([^&;]+?)(&|#|;|$)").exec(location.search)||[,""])[1].replace(/\+/g,"%20"))||null}function modulaInViewport(t){t=(t="function"==typeof jQuery&&t instanceof jQuery?t[0]:t).getBoundingClientRect();return t.top-jQuery(window).height()<=-100&&-400<=t.top-jQuery(window).height()||t.bottom<=jQuery(window).height()}jQuery(document).on("vc-full-width-row-single vc-full-width-row",function(t,i){0<jQuery("body").find(".modula").length&&jQuery(window).trigger("modula-update")}),jQuery(window).on("elementor/frontend/init",function(){window.elementorFrontend&&window.elementorFrontend.hooks.addAction("frontend/element_ready/global",function(t){jQuery("body").find(".modula").length})}),function(u,s,a,t){var n="modulaGallery",e={resizer:"/",keepArea:!0,type:"creative-gallery",columns:12,height:800,desktopHeight:800,mobileHeight:800,tabletHeight:800,gutter:10,desktopGutter:10,mobileGutter:10,tabletGutter:10,enableTwitter:!1,enableFacebook:!1,enableWhatsapp:!1,enablePinterest:!1,enableLinkedin:!1,enableEmail:!1,lazyLoad:0,initLightbox:!1,lightbox:"fancybox",lightboxOpts:{},inView:!1};function h(t,i){this.element=t,this.$element=u(t),this.$itemsCnt=this.$element.find(".modula-items"),this.$items=this.$itemsCnt.find(".modula-item"),this.options=u.extend({},e,i),this._defaults=e,this._name=n,this.tiles=[],this.$tilesCnt=null,this.completed=!1,this.lastWidth=0,this.resizeTO=0,this.isIsotope=!1,this.isLazyLoaded=!0,this.init()}h.prototype.init=function(){var i=this,t=a.documentElement.clientWidth;this.options.gutter=t<=568?this.options.mobileGutter:t<=768?this.options.tabletGutter:this.options.desktopGutter,u(a).trigger("modula_api_before_init",[i]),"custom-grid"===this.options.type?this.createCustomGallery():"creative-gallery"==this.options.type?this.createGrid():"grid"==this.options.type&&("automatic"==this.options.grid_type?this.createAutoGrid():this.createColumnsGrid()),"custom-grid"===this.options.type&&u(s).height()<u("html").height()&&i.onResize(i),u(s).resize(function(){i.onResize(i)});const e=new ResizeObserver(t=>{i.onResize(i)});e.observe(i.$element[0]),u(s).on("modula-update",function(){i.onResize(i)}),u(a).on("lazyloaded",function(t){t=u(t.target);"modula"==t.data("source")&&(t.data("size",{width:t.width(),height:t.height()}),(t=t.parents(".modula-item")).addClass("tg-loaded"),t=i.$items.not(".jtg-hidden").index(t),i.placeImage(t),i.isIsotope&&i.$itemsCnt.modulaisotope("layout"),"grid"==i.options.type&&"automatic"==i.options.grid_type&&i.$itemsCnt.justifiedGallery())}),i.options.inView&&jQuery(s).on("DOMContentLoaded load resize scroll",function(){modulaInViewport(i.$element)&&i.$element.addClass("modula-loaded-scale")}),this.setupSocial(),jQuery(i.$element).addClass("modula-gallery-initialized"),this.options.onComplete&&this.options.onComplete(),"fancybox"!=i.options.lightbox||i.options.initLightbox||this.initLightbox(),u(a).trigger("modula_api_after_init",[i])},h.prototype.initLightbox=function(){var e=this;e.$element.on("click",".modula-item-link:not( .modula-simple-link )",function(t){t.preventDefault();var i=u.map(e.$items,function(t){var i=jQuery(t).find(".modula-item-link:not( .modula-simple-link )"),t=jQuery(t).find(".pic");return{src:i.attr("href"),opts:{$thumb:t.parents(".modula-item"),caption:i.data("caption"),alt:t.attr("alt"),image_id:i.attr("data-image-id")}}}),t=e.$items.index(jQuery(this).parents(".modula-item"));jQuery.modulaFancybox.open(i,e.options.lightboxOpts,t)})},h.prototype.trunc=function(t){return Math.trunc?Math.trunc(t):(t=+t,isFinite(t)?t-t%1||(t<0?-0:0===t?t:0):t)},h.prototype.createCustomGallery=function(){var h,r=this,t=this.$element.find(".modula-items").width(),l=this,d=this.options.columns,i=a.documentElement.clientWidth;"1"==this.options.enableResponsive&&(i<=568?d=this.options.mobileColumns:i<=768&&(d=this.options.tabletColumns)),h=0<this.options.gutter?(t-this.options.gutter*(d-1))/d:Math.floor(t/d*1e3)/1e3,this.$items.not(".jtg-hidden").each(function(t,i){var e,o,n={},s=u(i).data("width"),a=u(i).data("height");12<s&&(s=12),"1"==l.options.enableResponsive&&(e=s,o=a,1==d?a=(s=1)*o/e:((s=Math.round(d*e/12))<1&&(s=1),(a=Math.round(s*o/e))<1&&(a=1))),n.width=h*s+l.options.gutter*(s-1),n.height=Math.round(h)*a+l.options.gutter*(a-1),u(i).data("size",n).addClass("tiled").addClass(n.width>n.height?"tile-h":"tile-v").data("position"),u(i).css(u(i).data("size")),u(i).find(".figc").css({width:u(i).data("size").width,height:u(i).data("size").height}),r.loadImage(t)});t={itemSelector:".modula-item",layoutMode:"packery",packery:{gutter:parseInt(l.options.gutter)}};this.$itemsCnt.modulaisotope(t),this.isIsotope=!0},h.prototype.createGrid=function(){var o=this,t=a.documentElement.clientWidth;o.options.height=t<=568?o.options.mobileHeight:t<=768?o.options.tabletHeight:o.options.desktopHeight,this.$itemsCnt.data("area",this.$itemsCnt.width()*this.options.height),this.lastWidth=this.$itemsCnt.width();for(var i=0;i<this.$items.not(".jtg-hidden").length;i++)this.tiles.push(o.getSlot());this.tiles.sort(function(t,i){return t.position-i.position}),this.$items.not(".jtg-hidden").each(function(t,i){var e=o.tiles[t];u(i).data("size",e),u(i).addClass("tiled").addClass(e.width>e.height?"tile-h":"tile-v").data("position"),u(i).css({width:e.width,height:e.height}),u(i).find(".figc").css({width:e.width,height:e.height}),o.loadImage(t)}),this.isIsotope||(t={resizesContainer:!1,itemSelector:".modula-item",layoutMode:"packery",packery:{gutter:parseInt(o.options.gutter)}},this.$itemsCnt.modulaisotope(t),this.isIsotope=!0)},h.prototype.createAutoGrid=function(){this.$itemsCnt.justifiedGallery({rowHeight:this.options.rowHeight,margins:this.options.gutter,lastRow:this.options.lastRow,captions:!1,border:0,imgSelector:".pic",cssAnimation:!0,imagesAnimationDuration:700})},h.prototype.createColumnsGrid=function(){var e=this;this.$itemsCnt.modulaisotope({itemSelector:".modula-item",layoutMode:"packery",packery:{gutter:parseInt(this.options.gutter)}}),this.$items.each(function(t,i){e.loadImage(t)}),this.isIsotope=!0},h.prototype.getSlot=function(){if(0==this.tiles.length)return o={top:0,left:0,width:this.$itemsCnt.width(),height:this.options.height,area:this.$itemsCnt.width()*this.options.height,position:0};for(var t=0,i=0;i<this.tiles.length;i++)(o=this.tiles[i]).area>this.tiles[t].area&&(t=i);var e,o={},n=this.tiles[t];return(o=n.width>n.height?(e=n.width/2*this.options.randomFactor,n.prevWidth=n.width,n.width=Math.floor(n.width/2+e*(Math.random()-.5)),{top:n.top,left:n.left+n.width+this.options.gutter,width:n.prevWidth-n.width-this.options.gutter,height:n.height}):(e=n.height/2*this.options.randomFactor,n.prevHeight=n.height,n.height=Math.floor(n.height/2+e*(Math.random()-.5)),{left:n.left,top:n.top+n.height+this.options.gutter,width:n.width,height:n.prevHeight-n.height-this.options.gutter})).area=o.width*o.height,o.position=1e3*o.top+o.left,n.position=1e3*n.top+n.left,this.tiles[t]=n,this.tiles[t].area=n.width*n.height,o},h.prototype.reset=function(){this.tiles=[],"custom-grid"===this.options.type?this.createCustomGallery():"creative-gallery"==this.options.type?this.createGrid():"grid"==this.options.type&&("automatic"==this.options.grid_type?this.createAutoGrid():this.createColumnsGrid()),this.lastWidth=this.$itemsCnt.width(),u(a).trigger("modula_api_reset",[this])},h.prototype.onResize=function(i){var t;i.lastWidth!=i.$itemsCnt.width()&&(t=a.documentElement.clientWidth,i.options.gutter=t<=568?i.options.mobileGutter:t<=768?i.options.tabletGutter:this.options.desktopGutter,clearTimeout(i.resizeTO),i.resizeTO=setTimeout(function(){var t;i.options.keepArea&&(t=i.$itemsCnt.data("area"),i.$itemsCnt.height(t/i.$itemsCnt.width())),i.reset(),i.isIsotope&&i.$itemsCnt.modulaisotope({packery:{gutter:parseInt(i.options.gutter)}}).modulaisotope("layout")},100))},h.prototype.loadImage=function(t){var i,e,o=this,n=o.$items.not(".jtg-hidden").eq(t).find(".pic");"0"==o.options.lazyLoad?((e=new Image).onload=function(){i={width:this.width,height:this.height},n.data("size",i),o.placeImage(t)},"undefined"!=n.attr("src")?e.src=n.attr("src"):e.src=n.data("src")):o.placeImage(t)},h.prototype.placeImage=function(t){if("grid"!=this.options.type){var i=this.$items.not(".jtg-hidden").eq(t),e=i.find(".pic"),o=i.data("size"),n=e.data("size");if(void 0!==o&&void 0!==n){o.width,o.height;var s=n.width/n.height,a=e.data("valign")?e.data("valign"):"middle",i=e.data("halign")?e.data("halign"):"center",h={top:"auto",bottom:"auto",left:"auto",right:"auto",width:"auto",height:"auto",margin:"0",maxWidth:"999em"};if(o.width*n.height/n.width>o.height)switch(h.width=o.width,h.left=0,a){case"top":h.top=0;break;case"middle":h.top=0-(o.width*(1/s)-o.height)/2;break;case"bottom":h.bottom=0}else switch(h.height=o.height,h.top=0,i){case"left":h.left=0;break;case"center":h.left=0-(o.height*s-o.width)/2;break;case"right":h.right=0}e.css(h),this.$items.not(".jtg-hidden").eq(t).addClass("tg-loaded")}}},h.prototype.setupSocial=function(){this.options.enableTwitter&&i(this.$items,this),this.options.enableFacebook&&o(this.$items,this),this.options.enablePinterest&&l(this.$items,this),this.options.enableLinkedin&&d(this.$items,this),this.options.enableWhatsapp&&r(this.$items,this),this.options.enableEmail&&p(this.$items,this)},h.prototype.destroy=function(){this.isPackeryActive&&(this.$itemsCnt.packery("destroy"),this.isPackeryActive=!1)};var i=function(t,i){t.find(".modula-icon-twitter").click(function(t){t.preventDefault();var i=u(this).parents(".modula-item").find("img.pic"),e=i.data("caption"),o=i.data("full"),t=i.attr("title"),i=a.title;return 0<t.length?i=u.trim(t):0<e.length&&(i=u.trim(e)),s.open("https://twitter.com/intent/tweet?url="+encodeURI(o)+"&text="+encodeURI(i),"ftgw","location=1,status=1,scrollbars=1,width=600,height=400").moveTo(screen.width/2-300,screen.height/2-200),!1})},o=function(t,i){t.find(".modula-icon-facebook").click(function(t){t.preventDefault();t=u(this).parents(".modula-item").find("img.pic").attr("data-full");return s.open("//www.facebook.com/sharer.php?u="+t,"ftgw","location=1,status=1,scrollbars=1,width=600,height=400").moveTo(screen.width/2-300,screen.height/2-200),!1})},r=function(t,i){t.find(".modula-icon-whatsapp").click(function(t){t.preventDefault();t=u(this).parents(".modula-item").find("img.pic").attr("data-full");return s.open("https://api.whatsapp.com/send?text="+encodeURI(t)+"&preview_url=true","ftgw","location=1,status=1,scrollbars=1,width=600,height=400").moveTo(screen.width/2-300,screen.height/2-200),!1})},l=function(t,i){t.find(".modula-icon-pinterest").click(function(t){t.preventDefault();var i=u(this).parents(".modula-item").find("img.pic"),e=i.data("full"),o=i.data("caption"),n=i.attr("title"),t=a.title;0<n.length?t=u.trim(n):0<o.length&&(t=u.trim(o));e="http://pinterest.com/pin/create/button/?url="+encodeURI(e)+"&description="+encodeURI(t);return 1<=i.length&&(t=i.attr("data-full"),e+="&media="+(i=t,(t=a.createElement("img")).src=i,i=t.src,t.src=null,i)),s.open(e,"ftgw","location=1,status=1,scrollbars=1,width=600,height=400").moveTo(screen.width/2-300,screen.height/2-200),!1})},d=function(t,i){t.find(".modula-icon-linkedin").click(function(t){t.preventDefault();t=u(this).parents(".modula-item").find("img.pic").attr("data-full"),t="//linkedin.com/shareArticle?mini=true&url="+encodeURI(t);return s.open(t,"ftgw","location=1,status=1,scrollbars=1,width=600,height=400").moveTo(screen.width/2-300,screen.height/2-200),!1})},p=function(t,n){t.find(".modula-icon-email").click(function(t){var i=encodeURI(n.options.email_subject),e=jQuery(".modula-icon-email").parents(".modula-item").find("img.pic").attr("data-full"),o=location.href,o=encodeURI(n.options.email_message.replace(/%%image_link%%/g,e).replace(/%%gallery_link%%/g,o));return s.open("mailto:?subject="+i+"&body="+o,"ftgw","location=1,status=1,scrollbars=1,width=600,height=400").moveTo(screen.width/2-300,screen.height/2-200),!1})};u.fn[n]=function(i){var e,o=arguments;return i===t||"object"==typeof i?this.each(function(){u.data(this,"plugin_"+n)||u.data(this,"plugin_"+n,new h(this,i))}):"string"==typeof i&&"_"!==i[0]&&"init"!==i?(this.each(function(){var t=u.data(this,"plugin_"+n);t instanceof h&&"function"==typeof t[i]&&(e=t[i].apply(t,Array.prototype.slice.call(o,1))),"destroy"===i&&u.data(this,"plugin_"+n,null)}),e!==t?e:this):void 0}}(jQuery,window,document),jQuery(document).ready(function(){var t=jQuery(".modula.modula-gallery");jQuery.each(t,function(){var t=jQuery(this).data("config");jQuery(this).modulaGallery(t)})});