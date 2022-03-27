(function ($) {
	'use strict';

	var autoInterval, modulaToolBar;

	modulaToolBar = '<div class="modula-toolbar">';
	modulaToolBar += '<span class="modula-play"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="play" class="svg-inline--fa fa-play fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M424.4 214.7L72.4 6.6C43.8-10.3 0 6.1 0 47.9V464c0 37.5 40.7 60.1 72.4 41.3l352-208c31.4-18.5 31.5-64.1 0-82.6z"></path></svg></span>';
	modulaToolBar += '<span class="modula-pause"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="pause" class="svg-inline--fa fa-pause fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M144 479H48c-26.5 0-48-21.5-48-48V79c0-26.5 21.5-48 48-48h96c26.5 0 48 21.5 48 48v352c0 26.5-21.5 48-48 48zm304-48V79c0-26.5-21.5-48-48-48h-96c-26.5 0-48 21.5-48 48v352c0 26.5 21.5 48 48 48h96c26.5 0 48-21.5 48-48z"></path></svg></span>';
	modulaToolBar += '<div>';

	$(document).on('modula_api_after_init', function (e, instance) {

		var options = instance.options,
			$element = instance.$element,
			slideSpeed = options.slideshowSpeed,
			pauseOnHover = options.pauseOnHover;

		$element.find('a.tile-inner').click(function () {
			if ( 'lightbox2' == options.lightbox ) {
				initLightbox2(options);
			} else if ( 'lightgallery' == options.lightbox ) {
				initLightgallery(options);
			} else if ( 'prettyphoto' == options.lightbox ) {
				initPrettyPhoto(options);
			}
		});

	});

	// Swipebox
	jQuery(document).on('modula_swipebox_lightbox_after_open', function (event, instance, lightbox) {
		var options = instance.options,
			$element = instance.$element,
			slideSpeed = options.slideshowSpeed,
			pauseOnHover = options.pauseOnHover,
			nextButton = jQuery('a#swipebox-next');

		jQuery('#swipebox-container #swipebox-slider').before(modulaToolBar);

		if ( '1' == options.enableAutoplay ) {
			jQuery('.modula-toolbar').addClass('modula-is-playing');
			autoInterval = setInterval(function () {
				nextButton.click();
			}, slideSpeed);
		}

		// play pause functionality
		jQuery('#swipebox-container .modula-toolbar .modula-play').click(function (e) {
			e.stopPropagation();
			if ( !autoInterval ) {
				autoInterval = setInterval(function () {
					nextButton.click();
				}, slideSpeed);
			}

			jQuery('.modula-toolbar').addClass('modula-is-playing');

		});
		jQuery('#swipebox-container .modula-toolbar .modula-pause').click(function (e) {

			e.stopPropagation();

			if ( autoInterval ) {
				clearInterval(autoInterval);
			}

			autoInterval = false;

			jQuery('.modula-toolbar').removeClass('modula-is-playing');

		});

		// mouse over/ mouse out
		jQuery('#swipebox-slider').on('mouseover', function () {

			if ( '0' == pauseOnHover || '0' == options.enableAutoplay) {
				return ;
			}

			// if manually paused by user don't do function
			if ( autoInterval ) {
				clearInterval(autoInterval);
			}

			autoInterval = false;

			jQuery('.modula-toolbar').removeClass('modula-is-playing');
		});

		jQuery('#swipebox-slider').on('mouseout', function () {

			if ( '0' == pauseOnHover || '0' == options.enableAutoplay ) {
				return true;
			}

			// clear previous set interval
			if ( autoInterval ) {
				clearInterval(autoInterval);
			}

			// set new interval
			autoInterval = setInterval(function () {
				nextButton.click();
			}, slideSpeed);

			jQuery('.modula-toolbar').addClass('modula-is-playing');
		});

	});

	// Magnific popup
	jQuery(document).on(' modula_magnific_lightbox_open', function (e, event, instance, popup) {

		var options = instance.options,
			$element = instance.$element,
			slideSpeed = options.slideshowSpeed,
			pauseOnHover = options.pauseOnHover,
			magnific = jQuery.magnificPopup.instance;

		jQuery('.mfp-wrap .mfp-container .mfp-content').before(modulaToolBar);

		if ( '1' == options.enableAutoplay ) {
			jQuery('.modula-toolbar').addClass('modula-is-playing');
			autoInterval = setInterval(function () {
				magnific.next();
			}, slideSpeed);
		}

		jQuery('.mfp-wrap .mfp-figure').on('mouseover', function () {

			if ( '0' == pauseOnHover  || '0' == options.enableAutoplay) {
				return true;
			}

			if ( autoInterval ) {
				clearInterval(autoInterval);
			}

			autoInterval = false;

			jQuery('.modula-toolbar').removeClass('modula-is-playing');

		});

		jQuery('.mfp-wrap .mfp-figure').on('mouseout', function () {

			if ( '0' == pauseOnHover || '0' == options.enableAutoplay ) {
				return true;
			}

			// clear previous set interval
			if ( autoInterval ) {
				clearInterval(autoInterval);
			}

			// set new interval
			autoInterval = setInterval(function () {
				magnific.next();
			}, slideSpeed);

			jQuery('.modula-toolbar').addClass('modula-is-playing');

		});

		// play pause functionality
		jQuery('.mfp-wrap .mfp-container .modula-toolbar .modula-play').click(function (e) {
			e.stopPropagation();
			if ( !autoInterval ) {
				autoInterval = setInterval(function () {
					magnific.next();
				}, slideSpeed);
			}

			jQuery('.modula-toolbar').addClass('modula-is-playing');

		});
		jQuery('.mfp-wrap .mfp-container .modula-toolbar .modula-pause').click(function (e) {

			e.stopPropagation();

			if ( autoInterval ) {
				clearInterval(autoInterval);
			}
			autoInterval = false;
			jQuery('.modula-toolbar').removeClass('modula-is-playing');

		});

	});

	// Fancybox
	jQuery( document ).on( 'modula_fancybox_lightbox_after_show', function ( event, instance ) {

		var options        = instance.options,
		    $element       = instance.$element,
		    pauseOnHover   = options.pauseOnHover,
		    modulaFancybox = jQuery.modulaFancybox.getInstance(),
		    paused = false;

		if ( '1' == pauseOnHover ) {

			jQuery( '.modula-fancybox-container .modula-fancybox-stage .modula-fancybox-content' ).on( 'mouseover', function ( e ) {

				if ( modulaFancybox.SlideShow.isActive ) {
					modulaFancybox.SlideShow.stop();
					paused = true;
				}

			} );

			jQuery( '.modula-fancybox-container .modula-fancybox-stage .modula-fancybox-content' ).on( 'mouseout', function ( e ) {

				if ( paused ) {
					modulaFancybox.SlideShow.start();
					paused = false;
				}

			} );
		}
	} );

	// Lightbox2
	function initLightbox2(options) {

		var slideSpeed = options.slideshowSpeed,
			pauseOnHover = options.pauseOnHover;

		lightbox.$lightbox.append(modulaToolBar);

		if ( '1' == options.enableAutoplay ) {
			jQuery('.modula-toolbar').addClass('modula-is-playing');
			autoInterval = setInterval(function () {
				modulaLightboxNext();
			}, slideSpeed);
		}

		lightbox.$lightbox.on('mouseover', function () {

			if ( '0' == pauseOnHover ) {
				return true;
			}

			if ( autoInterval ) {
				clearInterval(autoInterval);
			}

			autoInterval = false;

			jQuery('.modula-toolbar').removeClass('modula-is-playing');

		});

		lightbox.$lightbox.on('mouseout', function () {

			if ( '0' == pauseOnHover ) {
				return true;
			}

			//clear previous set interval
			if ( autoInterval ) {
				clearInterval(autoInterval);
			}

			//set new interval
			autoInterval = setInterval(function () {
				modulaLightboxNext();
			}, slideSpeed);

			jQuery('.modula-toolbar').addClass('modula-is-playing');

		});

		// play pause functionality
		lightbox.$lightbox.find('.modula-toolbar .modula-play').click(function (e) {
			e.stopPropagation();
			if ( !autoInterval ) {
				autoInterval = setInterval(function () {
					modulaLightboxNext();
				}, slideSpeed);
			}

			jQuery('.modula-toolbar').addClass('modula-is-playing');

		});
		lightbox.$lightbox.find('.modula-toolbar .modula-pause').click(function (e) {
			e.stopPropagation();
			if ( autoInterval ) {
				clearInterval(autoInterval);
			}

			autoInterval = false;

			jQuery('.modula-toolbar').removeClass('modula-is-playing');

		});

	}

	function modulaLightboxNext() {

		if ( lightbox.currentImageIndex === lightbox.album.length - 1 ) {
			lightbox.changeImage(0);
		} else {
			lightbox.changeImage(lightbox.currentImageIndex + 1);
		}

	}

	// PrettyPhoto
	function initPrettyPhoto(options) {

		if ( '0' == options.pauseOnHover ) {
			return true;
		}

		jQuery('body').on('mouseover','.pp_content .pp_hoverContainer', function () {
			$.prettyPhoto.stopSlideshow();
		});

		jQuery('body').on('mouseout','.pp_content .pp_hoverContainer', function () {
			$.prettyPhoto.startSlideshow();
		});

	}

	function initLightgallery(options) {
		var instance = jQuery('.modula.modula-gallery').lightGallery().data();

		if ( '0' == options.pauseOnHover ) {
			return true;
		}

		jQuery('body').on('mouseover','.lg-outer > .lg ', function (e) {

			e.stopPropagation();
			instance.lightGallery.modules.autoplay.cancelAuto();
		});

		jQuery('body').on('mouseout','.lg-outer > .lg ', function (e) {
			e.stopPropagation();
			instance.lightGallery.modules.autoplay.startlAuto();
		});

	}

	// Fix for lightbox2
	jQuery(document).on('modula_lightbox2_lightbox_close', function () {
		clearInterval(autoInterval);
	});


})(jQuery);