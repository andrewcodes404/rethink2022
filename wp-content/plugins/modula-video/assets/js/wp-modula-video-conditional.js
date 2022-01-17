(function( $, modula ){
    "use strict"
	var modulaVideoConditions = Backbone.Model.extend({

		initialize: function( args ){

			var rows = jQuery('.modula-settings-container tr[data-container]');
			this.set( 'rows', rows );

			this.initEvents();
			this.initValues();

		},

		initValues: function(){
			this.changedType(false, wp.Modula.Settings.get('type'));
			this.changedShowVideoIcon(false, wp.Modula.Settings.get('show-video-icon'));
			this.changedCustomIcon(false, wp.Modula.Settings.get('use-custom-icon'));

		},

		initEvents: function(){
			this.listenTo(wp.Modula.Settings,'change:type', this.changedType);
			this.listenTo(wp.Modula.Settings, 'change:show-video-icon', this.changedShowVideoIcon);
			this.listenTo(wp.Modula.Settings, 'change:use-custom-icon', this.changedCustomIcon);

		},

		changedType: function( settings, value ) {
			let rows = this.get( 'rows' );

			if( 'slider' == value ) {
				rows.filter('[data-container="autoplay-videos"], [data-container="show-video-icon"]').hide();
				rows.filter('[data-container="enableVideosOnSlider"]').show();
			}else if( 'custom-grid' == value ) {
				rows.filter('[data-container="autoplay-videos"], [data-container="show-video-icon"]').show();
				rows.filter('[data-container="enableVideosOnSlider"]').hide();
			}else if ( 'creative-gallery' == value ) {
				rows.filter('[data-container="autoplay-videos"], [data-container="show-video-icon"]').show();
				rows.filter('[data-container="enableVideosOnSlider"]').hide();
			}else if ('grid' == value ) {
				rows.filter('[data-container="autoplay-videos"], [data-container="show-video-icon"]').show();
				rows.filter('[data-container="enableVideosOnSlider"]').hide();
			}
		},

		changedShowVideoIcon: function( settings, value ){
			let rows = this.get( 'rows' );

            if ('1' == value) {
				rows.filter('[data-container="use-custom-icon"], [data-container="video-icon-size"]').show();
				if( '0' == wp.Modula.Settings.get('use-custom-icon') ) {
					rows.filter( '[data-container="custom-video-icon"]').hide();
					rows.filter( '[data-container="video-icon-color"]').show();
				}else {
					rows.filter( '[data-container="custom-video-icon"]').show();
					rows.filter( '[data-container="video-icon-color"]').hide();
				}
            } else {
                rows.filter('[data-container="use-custom-icon"], [data-container="custom-video-icon"], [data-container="video-icon-color"],[data-container="video-icon-size"]').hide();
            }

		},

		changedCustomIcon: function( settings, value ) {
			let rows = this.get( 'rows' );

			if( '1' == value ) {
				if( '0' == wp.Modula.Settings.get('show-video-icon') ) {
					rows.filter( '[data-container="custom-video-icon"]').hide();
				}else {
					rows.filter( '[data-container="custom-video-icon"]').show();
				}
				rows.filter( '[data-container="video-icon-color"]').hide();
			}else {
				rows.filter( '[data-container="custom-video-icon"]').hide();
				if( '0' == wp.Modula.Settings.get('show-video-icon') ) {
					rows.filter( '[data-container="video-icon-color"],[data-container="use-custom-icon"],[data-container="video-icon-size"] ').hide();
				} else {
					rows.filter( '[data-container="video-icon-color"],[data-container="use-custom-icon"],[data-container="video-icon-size"] ').show();
				}
			}
		}

	});

	$(document).ready(function(){
		new modulaVideoConditions();

		

		var modulaVideoFrame = new wp.media({
            title: 'Select a image to upload',
            button: {
                text: 'Use this image',
            },
            multiple: false // Set to true to allow multiple files to be selected
        });

        modulaVideoFrame.on('select', function () {
            // We set multiple to false so only get one image from the uploader
            var attachment = modulaVideoFrame.state().get('selection').first().toJSON();

            var att_id = attachment.id,
                att_src = attachment.url;

            if ( 'undefined' != typeof attachment.sizes.thumbnail ) {
                att_src = attachment.sizes.thumbnail.url;
            }

            $('#custom-video-icon').val( att_id );
            $('.modula_custom_video_icon_preview').html( '<img src="' + att_src + '">' );

            $( '#upload_video_icon' ).hide();
            $( '#replace_video_icon' ).show();
			$( '#delete_video_icon' ).show();
			
		});

			$( '#upload_video_icon' ).click(function( event ){
				event.preventDefault();
				modulaVideoFrame.open();
			});
	
			$( '#replace_video_icon' ).click(function( event ){
				event.preventDefault();
				modulaVideoFrame.open();
			});
	
			$( '#delete_video_icon' ).click(function( event ){
				event.preventDefault();
	
				$('#custom-video-icon').val( 0 );
				$('.modula_custom_video_icon_preview').html( '' );
	
				$( '#upload_video_icon' ).show();
				$( '#replace_video_icon' ).hide();
				$( '#delete_video_icon' ).hide();
	
			});

    });


}( jQuery, wp.Modula ))