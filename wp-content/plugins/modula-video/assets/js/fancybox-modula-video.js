jQuery( document ).on( 'modula_fancybox_lightbox_after_show', function ( e, obj, instance, current ) {
	let video_src = instance.src;

	if ( video_src.indexOf( '.mov' ) > 0 ) {
		instance.type = 'html';
		instance.contentType = 'html';
		instance.$content.html( '<object  pluginspage="http://www.apple.com/quicktime/download" data="' + video_src + '" type="video/quicktime"><param name="autoplay" value="true"><param name="scale" value="tofit"><param name="controller" value="true"><param name="enablejavascript" value="true"><param name="src" value="' + video_src + '"><param name="loop" value="false"></object>' );
		instance.$slide.addClass('modula-mov-object');
	}
} );