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

		// Filter Defaults
		add_filter( 'modula_lite_default_settings', array( $this, 'default_settings' ) );

		// Save Filters for our items
        add_filter( 'modula_gallery_image_attributes', array( $this, 'add_item_fields' ) );
        
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
                "description" => esc_html__('Enable this option to autoplay your videos.', 'modula-video'),
                "default"     => 0,
                "afterrow"    => __('On iOS, Autoplay is supported only for self hosted videos. The videos will autoplay on mute. For more details check : <a target="_blank" href="https://webkit.org/blog/6784/new-video-policies-for-ios"> video policies </a> ', 'modula-video'),
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
                "default"     => "#ffffff",
                "is_child"    => true,
                'priority'    => 15,
            ),

            "video-icon-size"   => array(
                "name"        => esc_html__( 'Play Icon Size', 'modula-video'),
                "type"        => 'text',
                "default"     => "30px",
                "description" => esc_html__( 'Please use pixels or % depending on the one you want to use.', 'modula-video'),
                "is_child"    => true,
                "priority"    => 20,
            ),

        );
        
        $fields['video']['video-icon-color']['alpha']    = true;

        return $fields;

	}

	/**
     * Add default for item's video url.
     *
     * @since 1.0.0
     *
     * @return array $defaults.
     */
	public function default_settings( $defaults ) {

        $defaults['video_url']         = '';
        $defaults['autoplay-videos']   = 0;
        $defaults['show-video-icon']   = 1;
        $defaults['use-custom-icon']   = 0;
        $defaults['custom-video-icon'] = 0;
        $defaults['video-icon-color']  = '#ffffff';
        $defaults['video-icon-size']   = '30px';

		return $defaults;

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
                <span class="name"><?php _e( 'Video URL', 'modula-video' ); ?></span>
                <input type="text" name="video_url" value="{{ data.video_url }}" />
                <div class="description">
                    <?php _e( 'Insert a video url, can be YouTube, Vimeo or self hosted.', 'modula-video' ); ?>
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
		return $fields;

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