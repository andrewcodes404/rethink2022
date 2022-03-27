<?php

/**
 *
 */
class Modula_Video {

	/**
	 * Holds the class object.
	 *
	 * @since 1.0.0
	 *
	 * @var object
	 */
	public static $instance;

	/**
	 * The name of the plugin.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $plugin_name = 'Modula Video';

	/**
	 * Unique plugin slug identifier.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $plugin_slug = 'modula-video';

	/**
	 * Primary class constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		// Load the plugin textdomain.
		add_action( 'init', array( $this, 'set_locale' ) );

		// Register activation hook
		register_activation_hook( MODULA_VIDEO_FILE, array( $this, 'plugin_activation' ) );

		// Load the plugin.
		$this->init();
	}

	/**
	 * Prevent plugin activation if Modula Pro is not installed and activated
	 *
	 * @since 1.0.2
	 */
	public function plugin_activation() {
		if ( ! class_exists( 'Modula_PRO' ) ) {
			deactivate_plugins( plugin_basename( MODULA_VIDEO_FILE ) );
			wp_die( __( 'Please install and activate Modula Pro before using Modula Video add-on.', 'modula-video' ) );

		}

	}

	/**
	 * Loads the plugin textdomain for translation.
	 *
	 * @since 1.0.0
	 */
	public function set_locale() {
		load_plugin_textdomain( $this->plugin_slug, false, dirname( plugin_basename( MODULA_VIDEO_FILE ) ) . '/languages' );
	}

	/**
	 * Loads the plugin into WordPress.
	 *
	 * @since 1.0.0
	 */
	public function init() {

		if ( class_exists( 'WPChill_Upsells' ) ) {

			add_filter( 'modula_shortcode_item_data', array( $this, 'add_video' ), 80, 3 );
			add_filter( 'modula_get_icon', array( $this, 'show_video_icon' ), 10, 2 );

			add_action( 'modula_item_before_link', array( $this, 'output_video_icon' ) );
			add_action( 'modula_slider_after_thumbnail', array( $this, 'output_video_icon_to_slider_thumb' ), 10, 3 );

			// Register & enqueue scripts for lightbox video
			add_action( 'wp_enqueue_scripts', array( $this, 'register_lightgallery_video_script' ) );
			add_action( 'modula_lighbox_shortcode', array( $this, 'enqueue_lightgallery_video_script' ), 11 );

			// Filter fancybox video options
			add_filter( 'modula_fancybox_options', array( $this, 'video_autoplay_options' ), 10, 2 );

			// Add video css
			add_filter( 'modula_shortcode_css', array( $this, 'generate_video_css' ), 15, 3 );

			// Video in modula-link
			add_filter( 'modula_link_item', array( $this, 'modula_video_link' ), 10, 2 );

			// Video slider
			add_action( 'modula_slider_item_after_image', array( $this, 'modula_video_after_image_slider' ) );

			// Albums integration
			add_filter( 'modula_album_lightbox_item', array( $this, 'add_video_to_albums' ), 10, 3 );

			// add video data to migrator
			add_filter( 'modula_migrate_gallery_data', array( $this, 'modula_video_migrator_data' ), 25, 3 );

			// Register scripts
			add_action( 'init', array( $this, 'register_scripts' ) );
			// Add extra scripts
			add_action( 'modula_extra_scripts', array( $this, 'modula_video_scripts' ) );
			// Add extra scripts to albums
			add_action( 'modula_album_extra_scripts', array( $this, 'modula_video_albums_scripts' ) );

			// Filter Defaults
			add_filter( 'modula_lite_default_settings', array( $this, 'default_settings' ) );

			// Add video thumbnail image
			add_filter( 'modula_shortcode_item_data', array( $this, 'modula_video_add_thumbnail_image' ), 16, 3 );

			add_action( 'admin_init', array( $this, 'init_admin' ) );

		}
	}

	public function addon_updater( $license_key, $store_url ) {

		if ( class_exists( 'Modula_Pro_Base_Updater' ) ) {
			$modula_addon_updater = new Modula_Pro_Base_Updater(
				$store_url,
				MODULA_VIDEO_FILE,
				array(
					'version' => MODULA_VIDEO_VERSION,        // current version number
					'license' => $license_key,               // license key (used get_option above to retrieve from DB)
					'item_id' => 268575,                      // ID of the product
					'author'  => 'MachoThemes',            // author of this plugin
					'beta'    => false,
				)
			);
		}
	}

	public function init_admin(){

		$args = apply_filters(
			'modula_upsells_args',
			array(
				'shop_url' => 'https://wp-modula.com',
				'slug'     => 'modula',
			)
		);
		$wpchill_upsell = WPChill_Upsells::get_instance( $args );

		if ( $wpchill_upsell && ! $wpchill_upsell->is_upgradable_addon( 'modula-video' ) ) {

			// Load admin only components.
			if ( is_admin() ) {
				add_action( 'modula_pro_updater', array( $this, 'addon_updater' ), 15, 2 );
				$this->require_admin();
			}
		}

	}

	/**
	 * Loads all admin related files into scope.
	 *
	 * @since 1.0.0
	 */
	public function require_admin() {

		require_once MODULA_VIDEO_PATH . 'includes/admin/class-modula-video-settings.php';

	}

	/**
	 * Returns the singleton instance of the class.
	 *
	 * @since 1.0.0
	 *
	 * @return object The Modula_Video object.
	 */
	public static function get_instance() {

		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Modula_Video ) ) {
			self::$instance = new Modula_Video();
		}

		return self::$instance;

	}

	/**
	 * Enqueue needed scripts
	 *
	 * @since 1.0.5
	 */
	public function register_scripts() {
		wp_register_script( 'modula-fancybox-video', MODULA_VIDEO_URL . 'assets/js/fancybox-modula-video.js', array( 'jquery' ), '', true );
		wp_register_style( 'modula-video-css', MODULA_VIDEO_URL . 'assets/css/modula-video-css.css' );
		wp_register_script( 'modula-albums-fancybox-video', MODULA_VIDEO_URL . 'assets/js/fancybox-albums-modula-video.js', array( 'jquery' ), '', true );
	}

	/**
	 * Enqueue needed scripts for galleries
	 *
	 * @param $settings
	 * @since 1.0.5
	 */
	public function modula_video_scripts( $settings ) {
		wp_enqueue_script( 'modula-fancybox-video' );
		wp_enqueue_style( 'modula-video-css' );
	}

	/**
	 * Enqueue needed scripts for albums
	 *
	 * @since 1.0.5
	 */
	public function modula_video_albums_scripts() {
		wp_enqueue_script( 'modula-albums-fancybox-video' );
		wp_enqueue_style( 'modula-video-css' );
	}

	/**
	 * Alter the current gallery item data in order to add video related attributes.
	 *
	 * @since 1.0.0
	 *
	 * @return array item_data.
	 */
	public function add_video( $item_data, $item, $settings ) {

		$item_data['is_video'] = false;

		if ( isset( $item['video_url'] ) && '' != $item['video_url'] ) {

			if ( strpos( $item['video_url'], 'vimeo' ) ) {
				// check if already player format
				if ( ! strpos( $item['video_url'], 'player' ) ) {
					$item['video_url'] = self::video_link_formatter( $item['video_url'] );
				}
			}

			$item_data['link_attributes']['href']  = esc_url( $item['video_url'] );
			$item_data['link_attributes']['class'] = array( 'tile-inner', 'modula-item-link' );
			$item_data['link_attributes']['rel']   = $settings['gallery_id'];

			// we nee to remake the array keys as the hover effect needs to be 1
			$item_data['item_classes'] = array_values( array_diff( $item_data['item_classes'], array( 'modula-simple-link' ) ) );

			if ( 'magnific' == $settings['lightbox'] ) {
				$item_data['link_classes'][] = 'mfp-iframe';
			}

			$item_data['is_video'] = true;
		}

		if ( isset( $settings['use-custom-icon'] ) && 1 == $settings['use-custom-icon'] && 0 != $settings['custom-video-icon'] ) {
			$item_data['custom_video_icon_id'] = $settings['custom-video-icon'];
		}

		if ( ! isset( $settings['show-video-icon'] ) || ! $settings['show-video-icon'] ) {
			$item_data['is_video'] = false;

		}

		return $item_data;

	}
	/**
	 * Display video in link shortcode
	 *
	 * @param $image
	 * @param $item
	 * @return $image
	 */
	public function modula_video_link( $image, $item ) {

		if ( isset( $item['video_url'] ) && '' != $item['video_url'] ) {
			$image['src'] = $item['video_url'];
		}
		return $image;
	}

	/**
	 * Alter the modula icons.
	 *
	 * @since 1.0.0
	 *
	 * @return string $svg.
	 */
	public function show_video_icon( $svg, $icon ) {

		if ( 'video' == $icon ) {
			return '<svg aria-hidden="true" data-prefix="far" data-icon="play-circle" class="svg-inline--fa fa-play-circle fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="#fff" d="M371.7 238l-176-107c-15.8-8.8-35.7 2.5-35.7 21v208c0 18.4 19.8 29.8 35.7 21l176-101c16.4-9.1 16.4-32.8 0-42zM504 256C504 119 393 8 256 8S8 119 8 256s111 248 248 248 248-111 248-248zm-448 0c0-110.5 89.5-200 200-200s200 89.5 200 200-89.5 200-200 200S56 366.5 56 256z"></path></svg>';
		}

		return $svg;
	}

	/**
	 * Output video icon, if enabled, for each gallery item.
	 *
	 * @since 1.0.0
	 */
	public function output_video_icon( $data ) {

		if ( $data->is_video && isset( $data->custom_video_icon_id ) ) {
			echo '<div class="modula-video-icon" >' . '<img src ="' . wp_get_attachment_image_src( $data->custom_video_icon_id, $size = 'full' )[0] . '">' . '</div>';
		} elseif ( $data->is_video ) {
			echo '<div class="modula-video-icon">' . Modula_Helper::get_icon( 'video' ) . '</div>';
		}

	}

	/**
	 * Output video icon, if enabled, for each slider nav item.
	 *
	 * @since 1.0.0
	 */
	public function output_video_icon_to_slider_thumb( $image, $images, $settings ) {

		if ( isset( $settings['show-video-icon'] ) && $settings['show-video-icon'] ) {

			if ( isset( $image['video_url'] ) && '' != $image['video_url'] ) {

				if ( isset( $settings['custom-video-icon'] ) && $settings['custom-video-icon'] ) {
					echo '<div class="modula-video-icon" >' . '<img src ="' . wp_get_attachment_image_src( $data->custom_video_icon_id, $size = 'full' )[0] . '">' . '</div>';
				} else {
					echo '<div class="modula-video-icon">' . Modula_Helper::get_icon( 'video' ) . '</div>';
				}
			}
		}

	}

	/**
	 * Register lightgallery video script.
	 *
	 * @since 1.0.0
	 */
	public function register_lightgallery_video_script() {
		wp_register_script( 'lightgallery-video', MODULA_VIDEO_URL . 'assets/js/lg-video.min.js', array( 'jquery' ), null, true );
	}

	/**
	 * If the current lightbox is lightgallery enqueue the lightgallery video script.
	 *
	 * @since 1.0.0
	 */
	public function enqueue_lightgallery_video_script( $lightbox ) {

		if ( 'lightgallery' == $lightbox ) {
			wp_enqueue_script( 'lightgallery-video' );
		}

	}

	/**
	 * Change video icon color if necessary
	 *
	 * @since 1.0.0
	 *
	 * @return string $css.
	 */
	public function generate_video_css( $css, $gallery_id, $settings ) {

		if ( isset( $settings['show-video-icon'] ) && $settings['show-video-icon'] ) {

			$css .= "#{$gallery_id} .modula-video-icon {  position: absolute; width: 30px;top: 50%;left: 50%;transform: translate(-50%,-50%); }";

			// Backwards compatibility check
			if ( isset( $settings['video-icon-size'] ) && ! isset( $settings['play-icon-size'] ) ) {
				$size                       = str_replace( array( 'px', '%' ), '', $settings['video-icon-size'] );
				$settings['play-icon-size'] = array( $size, $size, $size );
			}

			if ( 'under' != $settings['effect'] ) {
				$css .= "#{$gallery_id} .modula-video-icon { z-index:10; }";
			}

			if ( isset( $settings['video-icon-color'] ) && '#ffffff' != $settings['video-icon-color'] ) {
				$css .= "#{$gallery_id} .modula-video-icon path { fill : " . Modula_Helper::sanitize_rgba_colour( $settings['video-icon-color'] ) . ' }';
			}
			// Play icon size css
			if ( isset( $settings['play-icon-size'][0] ) && 1 == $settings['use-custom-icon'] || 0 != $settings['custom-video-icon'] ) {
				$css .= "#{$gallery_id} .modula-video-icon { width : " . absint( $settings['play-icon-size'][0] ) . 'px}';
			}
			if ( isset( $settings['play-icon-size'][1] ) && 1 == $settings['use-custom-icon'] || 0 != $settings['custom-video-icon'] ) {
				$css .= "@media screen and (max-width: 992px){ #{$gallery_id}  .modula-video-icon { width : " . absint( $settings['play-icon-size'][1] ) . 'px}}';
			}
			if ( isset( $settings['play-icon-size'][2] ) && 1 == $settings['use-custom-icon'] || 0 != $settings['custom-video-icon'] ) {
				$css .= "@media screen and (max-width: 768px) { #{$gallery_id}  .modula-video-icon { width : " . absint( $settings['play-icon-size'][2] ) . 'px}}';
			}

			if ( 1 == $settings['use-custom-icon'] && 0 != $settings['custom-video-icon'] ) {
				$css .= "#{$gallery_id} .modula-video-icon > img{ max-width : 100%!important;width:100%; }";
			}
		}

		return $css;

	}

	public function video_autoplay_options( $fancybox_options, $settings ) {

		if ( isset( $settings['autoplay-videos'] ) && 1 == $settings['autoplay-videos'] ) {

			if ( preg_match( '/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i', $_SERVER['HTTP_USER_AGENT'] ) ) {
				$fancybox_options['video']['tpl'] = '<video class="modula-fancybox-video" controls muted playsinline autoplay controlsList="nodownload" disablepictureinpicture poster="{{poster}}">' .
				'<source src="{{src}}" type="{{format}}" />' .
				'Sorry, your browser doesn\'t support embedded videos, <a href="{{src}}">download</a> and watch with your favorite video player!' .
				'</video>';
			}
		}

		if ( isset( $settings['autoplay-videos'] ) && 0 == $settings['autoplay-videos'] ) {

			$fancybox_options['youtube']['autoplay'] = 0;
			$fancybox_options['video']['autoStart']  = false;
			$fancybox_options['vimeo']['autoplay']   = 0;

		} else {
			$fancybox_options['youtube']['autoplay'] = 1;
			$fancybox_options['video']['autoStart']  = true;
			$fancybox_options['vimeo']['autoplay']   = 1;
		}
		return $fancybox_options;

	}

	public static function video_link_formatter( $url ) {

		// Check if youtube
		if ( strpos( $url, 'youtu' ) ) {
			// check if already embed format
			if ( strpos( $url, 'embed' ) ) {
				return $url;

			} else {
				$youtube_matcher = '/(youtube\.com|youtu\.be|youtube\-nocookie\.com)\/(watch\?(.*&)?v=|v\/|u\/|embed\/?)?(videoseries\?list=(.*)|[\w-]{11}|\?listType=(.*)&list=(.*))(.*)/i';
				preg_match( $youtube_matcher, $url, $matches, PREG_OFFSET_CAPTURE );

				$video_id   = $matches[4][0];
				$start_time = '';
				if ( '' != $matches[8][0] ) {
					// Check if embed format
					if ( strpos( $matches[8][0], 'start' ) ) {
						$start_time = $matches[8][0];
					} else {
						$start_time = str_replace( 't', 'start', $matches[8][0] );
					}
				}
				$final_url = 'https://www.youtube.com/embed/' . $video_id . $start_time;

			}
			// check if vimeo
		} elseif ( strpos( $url, 'vimeo' ) ) {
			// check if already player format
			if ( strpos( $url, 'player' ) ) {
				return $url;
			} else {

				$url_parts  = array(
					'hd'            => 1,
					'show_portrait' => 0,
					'fullscreen'    => 1,
				);
				$start_time = '';
				$vimeo_id   = '';

				// remove traling slash if exist
				$vimeo_url = rtrim( $url, '/\\' );

				// remove the first part of vimeo link
				$vimeo_url = preg_replace( '/(https?:\/\/)?(www\.)?(player\.)?vimeo\.com\//', '', $vimeo_url );

				// check if we have start time
				if ( false !== strpos( $vimeo_url, '#t=' ) ) {
					$parts      = explode( '#t=', $vimeo_url );
					$start_time = '#t=' . $parts[1];
					$vimeo_url  = $parts[0];
				}

				// remove traling slash if exist
				$vimeo_url = rtrim( $vimeo_url, '/\\' );

				// check if we have / in url, probably we have a private url
				if ( false !== strpos( $vimeo_url, '/' ) ) {
					$parts = explode( '/', $vimeo_url );
					if ( isset( $parts[1] ) && ! empty( $parts[1] ) ) {
						$url_parts['h'] = $parts[1];
					}
					$vimeo_url = $parts[0];
				}

				// now $vimeo_url should be the video id.
				$vimeo_id = $vimeo_url;

				if ( empty( $vimeo_id ) ) {
					$request     = wp_remote_get( 'https://vimeo.com/api/oembed.json?url=' . $url );
					$response    = wp_remote_retrieve_body( $request );
					$video_array = json_decode( $response, true );
					$vimeo_id    = $video_array['video_id'];
					$start_time  = '';
				}

				$final_url = '//player.vimeo.com/video/' . $vimeo_id;
				$final_url = add_query_arg( $url_parts, $final_url );
				if ( ! empty( $start_time ) ) {
					$final_url .= '&' . $start_time;
				}

				return $final_url;
			}
		}

		return $url;

	}

	public function modula_video_after_image_slider( $data ) {
		if ( true == $data->is_video ) { ?>

			<div class="video-sizer">
			
				<?php if ( strpos( $data->link_attributes['href'], 'youtu' ) || strpos( $data->link_attributes['href'], 'vimeo' ) ) { ?>
		
				<iframe src="<?php echo esc_attr( self::video_link_formatter( $data->link_attributes['href'] ) ); ?>" frameborder="0" allow="encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		
				<?php } else { ?>
		
				<video src="<?php echo esc_attr( $data->link_attributes['href'] ); ?>" controls allowfullscreen></video>
		
				<?php } ?> 
			</div>
			<?php
		}

	}

	public function add_video_to_albums( $image_config, $image, $gallery_settings ) {

		if ( isset( $image['video_url'] ) && '' != $image['video_url'] ) {

			$autoplay_videos = ( isset( $gallery_settings['autoplay-videos'] ) ) ? $gallery_settings['autoplay-videos'] : true;

			$image_config['src']             = esc_url( $image['video_url'] );
			$image_config['opts']['youtube'] = array( 'autoplay' => $autoplay_videos );
			$image_config['opts']['vimeo']   = array( 'autoplay' => $autoplay_videos );
			$image_config['opts']['video']   = array( 'autoplay' => boolval( $autoplay_videos ) );

			if ( strpos( $image_config['src'], 'vimeo' ) ) {
				// check if already player format
				if ( ! strpos( $image_config['src'], 'player' ) ) {
					$image_config['src'] = self::video_link_formatter( $image_config['src'] );
				}
			}
		}

		return $image_config;
	}

	/**
	 * Add Modula Video data to migrator
	 *
	 * @param $modula_settings
	 * @param $guest_settings
	 * @param $source
	 *
	 * @return mixed
	 *
	 * @since 1.0.4
	 */
	public function modula_video_migrator_data( $modula_settings, $guest_settings, $source ) {

		if ( $source ) {
			switch ( $source ) {
				case 'envira':
					if ( isset( $guest_settings['config']['videos_play_icon'] ) && 1 == $guest_settings['config']['videos_play_icon'] ) {
						$modula_settings['show-video-icon'] = 1;
					}

					if ( isset( $guest_settings['config']['videos_autoplay'] ) && 1 == $guest_settings['config']['videos_autoplay'] ) {
						$modula_settings['autoplay-videos'] = 1;
					}

					break;
			}
		}

		return $modula_settings;
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
		$defaults['video_thumbnail']   = '';
		$defaults['autoplay-videos']   = 0;
		$defaults['show-video-icon']   = 1;
		$defaults['use-custom-icon']   = 0;
		$defaults['custom-video-icon'] = 0;
		$defaults['video-icon-color']  = '#ffffff';
		// $defaults['play-icon-size']    = array('100','80','60');

		return $defaults;

	}

	/**
	 * Add image settings thumbnail url to image data.
	 *
	 * @since 1.0.6
	 */
	public function modula_video_add_thumbnail_image( $item_data, $image, $settings ) {

		if ( isset( $image['video_thumbnail'] ) && $image['video_thumbnail'] != '' ) {
			$item_data['link_attributes']['data-thumb'] = esc_url( $image['video_thumbnail'] );
		}

		return $item_data;
	}

}
