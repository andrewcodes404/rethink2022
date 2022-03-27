<?php

class Modula_Video_Setings {

	/**
     * Holds the admin class object.
     *
     * @since 1.0.0
     *
     * @var object
     */
    public static $instance;
	
	function __construct() {

		// Filter Modula Fields
		add_filter( 'modula_gallery_fields', array( $this, 'modula_video_fields' ) );

		// Save Filters for our items
        add_filter( 'modula_gallery_image_attributes', array( $this, 'add_item_fields' ) );

		// Save Filters for our resonsive-input types
        add_filter( 'modula_render_responsive-input_field_type', array( $this, 'edit_icon_size_fields' ),10,3 ); 

        // Backwards compatibility for responsive-input types
        add_filter( 'modula_admin_field_value', array( $this, 'backward_compatibility_responsive_video_icon' ), 15, 3 );
        add_filter( 'modula_backbone_settings', array( $this, 'backward_compatibility_backbone_responsive_video_icon' ), 15 );
        

        // Custom video icon upload field type
        add_filter( 'modula_render_video_icon_upload_field_type', array( $this, 'video_icon_upload_field_type' ), 10, 5 );

		/* Add templates for our plugin */
        add_action( 'admin_footer', array( $this, 'print_modula_video_templates' ) );
        
        // Show Video Icon on backend 
        add_action( 'modula_admin_gallery_image_start', array($this, 'backend_show_video_icon'), 99 );

		// Add new input for item
		add_action( 'modula_item_extra_fields', array( $this, 'extra_item_fields' ) );

		// Add JS
        add_action( 'modula_scripts_before_wp_modula', array( $this, 'video_js' ) );
        
        // Enqueue admin required scripts
		add_action( 'modula_scripts_after_wp_modula', array( $this, 'modula_video_admin_scripts' ), 40 );
		add_action( 'modula_defaults_scripts_after_wp_modula', array( $this, 'modula_video_admin_scripts' ), 40 );

		add_action( 'modula_scripts_before_wp_modula', array( $this, 'video_js' ) );

		//Filter Modula Video Tab
		add_filter( 'modula_gallery_tabs', array( $this, 'modula_video_tab' ) );

	}

    
	/**
     * Returns the singleton instance of the class.
     *
     * @since 1.0.0
     *
     * @return object The Modula_Video_Setings object.
     */
    public static function get_instance() {

        if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Modula_Video_Setings ) ) {
            self::$instance = new Modula_Video_Setings();
        }

        return self::$instance;

	}

	public function modula_video_tab( $tabs ) {
		
		unset($tabs['video']['badge']);

        return $tabs;
    }
    
    public function modula_video_admin_scripts() {

        wp_enqueue_script( 'modula-video-conditions', MODULA_VIDEO_URL . 'assets/js/wp-modula-video-conditional.js', array('modula-conditions'), MODULA_VIDEO_VERSION , true );
        wp_enqueue_style( 'modula-video-admin-css', MODULA_VIDEO_URL . 'assets/css/wp-modula-video-admin.css', MODULA_VIDEO_VERSION );
    }

	/**
     * Add video related settings.
     *
     * @since 1.0.0
     *
     * @return array $fields.
     */
	public function modula_video_fields(  $fields ){

        $fields['video'] = array(
            "autoplay-videos"   => array(
                "name"        => esc_html__('Autoplay Videos', 'modula-video'),
                "type"        => "toggle",
                "description" => esc_html__('Enable this option to autoplay your videos in the lightbox.', 'modula-video'),
                "default"     => 0,
                "afterrow"    => wp_kses_post('On iOS, Autoplay is supported only for self hosted videos. The videos will autoplay on mute. For more details check : <a target="_blank" href="https://webkit.org/blog/6784/new-video-policies-for-ios"> video policies </a> ', 'modula-video'),
                'priority'    => 1,
            ),

            "show-video-icon"   => array(
                "name"        => esc_html__('Display Play Icon', 'modula-video'),
                "type"        => "toggle",
                "default"     => 1,
                "description" => esc_html__('Display a Play Icon over a Gallery Image which is linked to a Video, to make it clear to the user that it is a video.', 'modula-video'),
                'priority'    => 3,
            ),

            'use-custom-icon'   => array(
				"name"        => esc_html__( 'Use custom icon', 'modula-video' ),
                "type"        => "toggle",
                "default"     => 0,
                "description" => esc_html__('Enable this to upload your own video icon.', 'modula-video'),
                "is_child"    => true,
                'priority'    => 5,
            ),
            
            "custom-video-icon" => array(
                "name"        => esc_html__( 'Use Custom Video Icon', 'modula-video'),
                "type"        => "video_icon_upload",
                "default"     => 0,
                "description" => esc_html__( 'Upload your own video icon.', 'modula-video'),
                "class"       => 'button insert-media-url',
                "button_text" => esc_html__( 'Upload Video Icon', 'modula-video'),
                "is_child"    => true,
                "priority"    => 10,

            ),

            "video-icon-color"  => array(
                "name"        => esc_html__( 'Play Icon Colour', 'modula-video' ),
                "type"        => "color",
                "description" => esc_html__( 'Set the colour of your video icon.', 'modula-video' ),
                "default"     => "#FFF",
                'alpha'       => true,
                "is_child"    => true,
                'priority'    => 15,
            ),

            "play-icon-size"   => array(
                "name"        => esc_html__( 'Play Icon Size', 'modula-video'),
                "type"        => 'responsive-input',
                "default"     => array( 30, 30, 30 ),
                "description" => esc_html__( 'Please play button size in pixels.', 'modula-video'),
                "is_child"    => true,
                "priority"    => 20,
            ),

        );
        

        return $fields;

	}

	/**
     * Modula Item's video url template.
     *
     * @since 1.0.0
     *
     */
	public function print_modula_video_templates() {
		?>
		<script type="text/html" id="tmpl-modula-video">
		    <label class="">
                <span class="name"><?php esc_html_e( 'Video URL', 'modula-video' ); ?></span>
                <input type="text" name="video_url" value="{{ data.video_url }}" />
                <div class="description">
                    <?php esc_html_e( 'Insert a video url, can be YouTube, Vimeo or self hosted.', 'modula-video' ); ?>
                </div>
            </label>
		    <label class="">
                <span class="name"><?php esc_html_e( 'Video Thumbnail', 'modula-video' ); ?></span>
                <input type="text" name="video_thumbnail" value="{{ data.video_thumbnail }}" />
                <div class="description">
                    <?php esc_html_e( 'Insert a video thumbnail.', 'modula-video' ); ?>
                </div>
            </label>
		</script>
		<?php
	}

	/**
     * Item's video url hidden input.
     *
     * @since 1.0.0
     *
     */
	public function extra_item_fields() {
		echo '<input type="hidden" name="modula-images[video_url][{{data.index}}]" class="modula-image-video-url" value="{{ data.video_url }}">';
	}

	/**
     * Add video related settings to edit modal.
     *
     * @since 1.0.0
     *
     * @return array $fields.
     */
	public function add_item_fields( $fields ) {

		$fields[] = 'video_url';
        $fields[] = 'video_thumbnail';
		return $fields;

    }

	/**
     * Add input settings for video play button size on different devices.
     *
     * @since 1.0.6
     *
     * @return string.
     */
	public function edit_icon_size_fields($html, $field, $value ) {

        $html  = '<span class="dashicons dashicons-desktop"></span><input type="text" class="responsive-input" name="modula-settings[' . esc_attr( $field['id'] ) . '][]" value="' .esc_attr( $value[0] ). '"><span class="modula_input_suffix">px</span>';
        $html .= '<span class="dashicons dashicons-tablet"></span><input type="text" class="responsive-input" name="modula-settings[' . esc_attr( $field['id'] ) . '][]" value="' .esc_attr( $value[1] ). '"><span class="modula_input_suffix">px</span>';
        $html .= '<span class="dashicons dashicons-smartphone"></span><input type="text" class="responsive-input" name="modula-settings[' . esc_attr( $field['id'] ) . '][]"  value="' .esc_attr( $value [2]). '"><span class="modula_input_suffix">px</span>';

        return $html;
    } 

	/**
	 *  Backwards compatibility for responsie play button size fields
	 *
	 * @since 1.0.6
	 */
	public function backward_compatibility_responsive_video_icon( $value, $key, $settings ) {
        
		if ( 'play-icon-size' == $key && ! isset( $settings['play-icon-size'] ) ){
			if ( isset( $settings['video-icon-size'] ) ){
                $size = str_replace( array('px', '%'), '', $settings['video-icon-size']);
                return array( $size, $size, $size );
			}
		}
        
		return $value;

	}

	/**
	 *  Backwards compatibility for responsie play button size fields
	 *
	 * @since 1.0.6
	 */
	public function backward_compatibility_backbone_responsive_video_icon( $settings ){
           
		if ( isset( $settings['video-icon-size'] ) && !isset( $settings['play-icon-size'][0] ) ){
			$settings['play-icon-size'][0] = str_replace(['px', '%'], '', $settings['video-icon-size']);
		}

		if ( isset( $settings['video-icon-size'] ) && !isset( $settings['play-icon-size'][1] ) ){
			$settings['play-icon-size'][1] = str_replace(['px', '%'], '', $settings['video-icon-size']);
		}

		if ( isset( $settings['video-icon-size'] ) && !isset( $settings['play-icon-size'][2] ) ){
			$settings['play-icon-size'][2] = str_replace(['px', '%'], '', $settings['video-icon-size']);
		}
        
		return $settings;

	}

    /***
	 * Add video_icon_upload field type
	 *
	 * @param $html
	 * @param $field
	 * @param $value
	 *
	 * @return string
	 */
	public function video_icon_upload_field_type( $html, $field, $value ) {

		$style = array(
			'upload'  => '',
			'replace' => 'display:none;',
			'delete'  => 'display:none;',
		);

		if ( 0 != absint( $value ) ) {
			$style['upload'] = 'display:none;';
			$style['replace'] = '';
			$style['delete'] = '';
		}

		$html = '<input type="hidden" name="modula-settings[' . esc_attr( $field['id'] ) . ']" id="' . esc_attr( $field['id'] ) . '" value="' . absint( $value ) . '">';
		$html .= '<div class="modula_custom_video_icon_preview">';
		if ( $value ) {
			$image = wp_get_attachment_image_src( $value );
			if ( $image ) {
				$html .= '<img src="' . esc_url( $image[0] ) . '" id="modula_custom_video_icon_preview">';
			}
		}
		$html .= '</div>';
		$html .= '<input type="button" style="' . esc_attr( $style['upload'] ) . '" class="button button-primary" id="upload_video_icon" value="' . esc_attr__( 'Upload', 'modula-video' ) . '">';
		$html .= '<input type="button" style="' . esc_attr( $style['replace'] ) . '" class="button button-primary" id="replace_video_icon" value="' . esc_attr__( 'Replace', 'modula-video' ) . '">';
		$html .= '<input type="button" style="' . esc_attr( $style['delete'] ) . '" class="button" id="delete_video_icon" value="' . esc_attr__( 'Delete', 'modula-video' ) . '">';

		return $html;

	}

	/**
     * Add script that will handle video related actions in backend.
     *
     * @since 1.0.0
     *
     */
	public function video_js() {
        wp_enqueue_script( 'modula-video', MODULA_VIDEO_URL . 'assets/js/wp-modula-video.js', array( 'jquery' ), '1.0.0', true );

    }
    
    public function backend_show_video_icon() {

        ?> <# if ( 'video_url' in data && data.video_url != '' ) { #> <?php
                
            echo '<div class="modula-video-icon">' . Modula_Helper::get_icon( 'video' ) . '</div>'; 
                    
        ?> <# } #> <?php 
    }


}

// Load the main plugin class.
$modula_video_settings = Modula_Video_Setings::get_instance();