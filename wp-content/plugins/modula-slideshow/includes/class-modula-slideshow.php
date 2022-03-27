<?php

/**
 *
 */
class Modula_Slideshow {

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
	public $plugin_name = 'Modula Slideshow';

	/**
	 * Unique plugin slug identifier.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $plugin_slug = 'modula-slideshow';

	/**
	 * Primary class constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		// Load the plugin textdomain.
		add_action( 'init', array( $this, 'set_locale' ) );
		add_action( 'admin_init', array( $this, 'admin_init' ) );

		add_action( 'modula_scripts_after_wp_modula', array( $this, 'modula_slideshow_backbone' ), 40 );
		add_action( 'modula_defaults_scripts_after_wp_modula', array( $this, 'modula_slideshow_backbone' ), 40 );

		// Add defaults
		add_filter( 'modula_lite_default_settings', array( $this, 'set_defaults' ) );

		// Register Slideshow Scripts
		add_action( 'wp_enqueue_scripts', array( $this, 'register_slideshow_scripts' ) );

		// Filter Modula Slideshow Scripts & Styles
		add_filter( 'modula_necessary_scripts', array( $this, 'modula_slideshow_scripts' ), 15, 2 );
		add_filter( 'modula_link_necessary_scripts', array( $this, 'modula_slideshow_scripts' ), 15, 2 );

		add_filter( 'modula_fancybox_options', array( $this, 'modula_slideshow_fancybox_options' ), 15, 2 );

		add_filter( 'modula_gallery_settings', array( $this, 'modula_slideshow_config' ), 10, 2 );
		add_filter( 'modula_link_gallery_settings', array( $this, 'modula_link_slideshow_config' ), 10, 2 );

		add_filter( 'modula_extra_lightboxes', array( $this, 'extra_lightboxes_options' ), 16, 2 );

		add_filter( 'modula_migrate_gallery_data', array( $this, 'modula_slidehsow_migrator_data' ), 25, 3 );

		add_action( 'wp_head', array( $this, 'output_css' ) );

		register_activation_hook( MODULA_SLIDESHOW_FILE, array( $this, 'plugin_activation' ) );

		// Load the plugin.
		$this->init();

	}

	/**
	 * Prevent plugin activation if Modula Pro is not installed and activated
	 *
	 * @since 1.0.1
	 */
	public function plugin_activation() {
		if ( ! class_exists( 'Modula_PRO' ) ) {
			deactivate_plugins( plugin_basename( MODULA_SLIDESHOW_FILE ) );
			wp_die( __( 'Please install and activate Modula Pro before using Modula Slideshow add-on.', 'modula-slideshow' ) );

		}

	}

	/**
	 * Loads the plugin textdomain for translation.
	 *
	 * @since 1.0.0
	 */
	public function set_locale() {
		load_plugin_textdomain( $this->plugin_slug, false, dirname( plugin_basename( MODULA_SLIDESHOW_FILE ) ) . '/languages' );
	}

	/**
	 * Loads the plugin into WordPress.
	 *
	 * @since 1.0.0
	 */
	public function init() {

		// Load admin only components.
		if ( is_admin() ) {
			add_action( 'modula_pro_updater', array( $this, 'addon_updater' ), 15, 2 );
		}

	}

	public function admin_init(){

		if ( class_exists( 'WPChill_Upsells' ) ) {

			$args           = apply_filters(
				'modula_upsells_args',
				array(
					'shop_url' => 'https://wp-modula.com',
					'slug'     => 'modula',
				)
			);
			$wpchill_upsell = WPChill_Upsells::get_instance( $args );

			if ( $wpchill_upsell && ! $wpchill_upsell->is_upgradable_addon( 'modula-slideshow' ) ) {

				// Filter Modula Slideshow Tab
				add_filter( 'modula_gallery_tabs', array( $this, 'modula_slideshow_tabs' ), 99 );

				// Filter Modula Slideshow Fields
				add_filter( 'modula_gallery_fields', array( $this, 'modula_slideshow_fields' ) );
			}
		}
		
	}

	public function addon_updater( $license_key, $store_url ) {

		if ( class_exists( 'Modula_Pro_Base_Updater' ) ) {
			$modula_addon_updater = new Modula_Pro_Base_Updater(
				$store_url,
				MODULA_SLIDESHOW_FILE,
				array(
					'version' => MODULA_SLIDESHOW_VERSION,        // current version number
					'license' => $license_key,               // license key (used get_option above to retrieve from DB)
					'item_id' => 408737,                      // ID of the product
					'author'  => 'MachoThemes',            // author of this plugin
					'beta'    => false,
				)
			);
		}
	}


	/**
	 * Returns the singleton instance of the class.
	 *
	 * @since 1.0.0
	 *
	 * @return object The Modula_Slideshow object.
	 */
	public static function get_instance() {

		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Modula_Slideshow ) ) {
			self::$instance = new Modula_Slideshow();
		}

		return self::$instance;

	}


	/**
	 * Enqueue our slideshow conditions
	 *
	 * @since 1.0.2
	 */
	public function modula_slideshow_backbone() {

		wp_enqueue_script( 'modula-slideshow-conditions', MODULA_SLIDESHOW_URL . 'assets/js/wp-modula-slideshow-conditions.js', array( 'modula-conditions' ), MODULA_SLIDESHOW_VERSION, true );

	}

	/**
	 * Register slideshow script and style
	 */
	public function register_slideshow_scripts() {
		// Register Slideshow script
		wp_register_script( 'modula-slideshow-script', MODULA_SLIDESHOW_URL . 'assets/js/modula-slideshow.min.js', array( 'jquery', 'modula-pro' ), MODULA_SLIDESHOW_VERSION );

		// Autoplay script for lightgallery
		wp_register_script( 'modula-lg-autoplay-script', MODULA_SLIDESHOW_URL . 'assets/js/lg-autoplay.min.js', array( 'jquery', 'modula-lightgallery' ), MODULA_SLIDESHOW_VERSION );

	}

	/**
	 * Extra scripts required by Modula Slideshow plugin
	 *
	 * @param $scripts
	 * @param $settings
	 *
	 * @return array
	 *
	 * Enqueue slideshow script
	 */
	public function modula_slideshow_scripts( $scripts, $settings ) {

		if ( isset( $settings['enable_slideshow'] ) && '1' == $settings['enable_slideshow'] ) {
			$scripts[] = 'modula-slideshow-script';
		}

		if ( isset( $settings['enable_slideshow'] ) && '1' == $settings['enable_slideshow'] && 'lightgallery' == $settings['lightbox'] ) {
			$scripts[] = 'modula-lg-autoplay-script';
		}

		return $scripts;
	}


	/**
	 * Add extra tab for Modula Slideshow
	 *
	 * @param $tabs
	 *
	 * @return mixed
	 */
	public function modula_slideshow_tabs( $tabs ) {

		if ( ! isset( $tabs['slideshow'] ) ) {

			$tabs['slideshow'] = array(
				'label'       => esc_html__( 'Slideshow', 'modula-slideshow' ),
				'title'       => esc_html__( 'Lightbox Slideshow Settings', 'modula-slideshow' ),
				'description' => esc_html__( 'Here you can modify the settings for lightbox slideshow like : autoplay / autoplay time / pause on hover', 'modula-slideshow' ),
				'icon'        => 'dashicons dashicons-images-alt2',
				'priority'    => 110,
			);

		}

		unset( $tabs['slideshow']['badge'] );

		return $tabs;
	}

	/**
	 * Add fields for Modula Slideshow
	 *
	 * @param $fields
	 *
	 * @return mixed
	 */
	public function modula_slideshow_fields( $fields ) {

		if ( ! isset( $fields['slideshow'] ) || ! is_array( $fields['slideshow'] ) ) {
			$fields['slideshow'] = array();
		}

		// Add slideshow settings
		$fields['slideshow'] = array(
			'enable_slideshow' => array(
				'name'        => esc_html__( 'Enable Slideshow', 'modula-slideshow' ),
				'type'        => 'toggle',
				'default'     => 0,
				'description' => __( 'Enables slideshow functionality on Modula Galleries', 'modula-slideshow' ),
				'priority'    => 10,
			),
			'enable_autoplay'  => array(
				'name'        => esc_html__( 'Enable Slideshow Autoplay', 'modula-slideshow' ),
				'type'        => 'toggle',
				'default'     => 0,
				'description' => __( 'Enables slideshow autoplay functionality on Modula Galleries', 'modula-slideshow' ),
				'is_child'    => true,
				'priority'    => 11,
			),
			'pause_on_hover'   => array(
				'name'        => esc_html__( 'Pause slideshow on hover', 'modula-slideshow' ),
				'type'        => 'toggle',
				'default'     => 0,
				'description' => __( 'Enables pausing the slideshow when visitor hovers the gallery', 'modula-slideshow' ),
				'is_child'    => true,
				'priority'    => 12,
			),
			'slideshow_speed'  => array(
				'name'        => esc_html__( 'Time between slides', 'modula-slideshow' ),
				'type'        => 'ui-slider',
				'description' => __( 'Set the time of the slideshow, the time between the slides', 'modula-slideshow' ),
				'is_child'    => true,
				'min'         => 1000,
				'max'         => 30000,
				'step'        => 1000,
				'default'     => 5000,
				'priority'    => 13,
			),
		);

		return $fields;
	}


	/**
	 * Set defaults for Modula Slideshow
	 *
	 * @param $defaults
	 *
	 * @return mixed
	 */
	public function set_defaults( $defaults ) {
		$defaults['enable_slideshow'] = 0;
		$defaults['enable_autoplay']  = 0;
		$defaults['pause_on_hover']   = 0;
		$defaults['slideshow_speed']  = 5000;

		return $defaults;
	}


	/**
	 * Add extra options to fancybox for slideshow functionality
	 *
	 * @param $ligtboxes_options
	 * @param $settings
	 *
	 * @return mixed
	 */
	public function modula_slideshow_fancybox_options( $fancybox_options, $settings ) {

		$autoplay = false;
		if ( isset( $settings['enable_autoplay'] ) && '1' == $settings['enable_autoplay'] ) {
			$autoplay = true;
		};

		if ( isset( $settings['enable_slideshow'] ) && '1' == $settings['enable_slideshow'] ) {

			if ( ! isset( $fancybox_options['buttons']['slideshow'] ) ) {
				$fancybox_options['buttons'][] = 'slideShow';
			}

			$fancybox_options['slideShow']['autoStart'] = $autoplay;
			$fancybox_options['slideShow']['speed']     = absint( $settings['slideshow_speed'] );
			$fancybox_options['loop']                   = true;

		}

		return $fancybox_options;
	}


	public function modula_slideshow_config( $js_config, $settings ) {
		$js_config['options']['lightbox'] = $settings['lightbox'];

		if ( isset( $settings['enable_slideshow'] ) ) {
			$js_config['enableSlideshow'] = $settings['enable_slideshow'];
		}

		if ( isset( $settings['enable_autoplay'] ) ) {
			$js_config['enableAutoplay'] = esc_attr( $settings['enable_autoplay'] );
		}

		if ( isset( $settings['slideshow_speed'] ) ) {
			$js_config['slideshowSpeed'] = $settings['slideshow_speed'];
		}

		if ( isset( $settings['pause_on_hover'] ) ) {
			$js_config['pauseOnHover'] = esc_attr( $settings['pause_on_hover'] );
		}

		return $js_config;
	}

	/**
	 * Add config for modula-link shortcode
	 *
	 * @param $js_config
	 * @param $settings
	 *
	 * @return mixed
	 *
	 * @since 1.0.2
	 */
	public function modula_link_slideshow_config( $js_config, $settings ) {

		if ( isset( $settings['enable_slideshow'] ) ) {
			$js_config['options']['enableSlideshow'] = $settings['enable_slideshow'];
		}

		if ( isset( $settings['enable_autoplay'] ) ) {
			$js_config['options']['enableAutoplay'] = esc_attr( $settings['enable_autoplay'] );
		}

		if ( isset( $settings['slideshow_speed'] ) ) {
			$js_config['options']['slideshowSpeed'] = $settings['slideshow_speed'];
		}

		if ( isset( $settings['pause_on_hover'] ) ) {
			$js_config['options']['pauseOnHover'] = esc_attr( $settings['pause_on_hover'] );
		}

		return $js_config;
	}


	/**
	 * Add functionality to extra lightboxes
	 *
	 * @param $lightboxes_options
	 * @param $settings
	 *
	 * @since 1.0.2
	 *
	 * @return mixed
	 */
	public function extra_lightboxes_options( $lightboxes_options, $settings ) {

		$autoplay = false;
		if ( isset( $settings['enable_autoplay'] ) && '1' == $settings['enable_autoplay'] ) {
			$autoplay = true;
		};

		if ( isset( $settings['enable_slideshow'] ) && '1' == $settings['enable_slideshow'] ) {
			$lightboxes_options['lightboxes']['prettyphoto']['options']['slideshow'] = true;
		}

		if ( isset( $settings['enable_slideshow'] ) && '1' == $settings['enable_slideshow'] ) {

			if ( 'prettyphoto' == $settings['lightbox'] ) {
				$lightboxes_options['lightboxes']['prettyphoto']['options']['autoplay_slideshow'] = $autoplay;
				$lightboxes_options['lightboxes']['prettyphoto']['options']['slideshow']          = intval( $settings['slideshow_speed'] );
			}

			if ( 'fancybox' == $settings['lightbox'] ) {
				$lightboxes_options['lightboxes']['fancybox']['options']['slideShow']['autoStart'] = $autoplay;
				$lightboxes_options['lightboxes']['fancybox']['options']['slideShow']['speed']     = intval( $settings['slideshow_speed'] );
				$lightboxes_options['lightboxes']['fancybox']['options']['loop']                   = true;
			}

			if ( 'lightgallery' == $settings['lightbox'] ) {
				$lightboxes_options['lightboxes']['lightgallery']['options']['pause']    = intval( $settings['slideshow_speed'] );
				$lightboxes_options['lightboxes']['lightgallery']['options']['loop']     = true;
				$lightboxes_options['lightboxes']['lightgallery']['options']['autoplay'] = $autoplay;
			}
		}

		return $lightboxes_options;
	}

	public function output_css() {
		echo '<style id="modula-slideshow">.modula-toolbar {position: absolute;top: 0;right: 60px;z-index: 9999999;display: block;opacity: 1;}.modula-toolbar span.modula-play {margin-right: 10px;}.modula-toolbar span {cursor:pointer;color: #fff;display:inline-block;}.modula-toolbar span svg {width: 15px;}.modula-toolbar.modula-is-playing span.modula-play {opacity: .5;}.modula-toolbar:not(.modula-is-playing) span.modula-pause {opacity: .5;}#swipebox-container .modula-toolbar {top: 8px;}</style>';
	}

	/**
	 * Add Modula Slidehsow migrator data
	 *
	 * @param $modula_settings
	 * @param $guest_settings
	 * @param $source
	 *
	 * @return mixed
	 * @since 1.0.3
	 */
	public function modula_slidehsow_migrator_data( $modula_settings, $guest_settings, $source ) {

		if ( isset( $source ) ) {
			switch ( $source ) {
				case 'envira':
					if ( isset( $guest_settings['config']['slideshow'] ) && 1 == $guest_settings['config']['slideshow'] ) {
						$modula_settings['enable_slideshow'] = 1;
					}

					if ( isset( $guest_settings['config']['autoplay'] ) && 1 == $guest_settings['config']['autoplay'] ) {
						$modula_settings['enable_autoplay'] = 1;
					}

					if ( isset( $guest_settings['config']['slideshow_hover'] ) && 1 == $guest_settings['config']['slideshow_hover'] ) {
						$modula_settings['pause_on_hover'] = 1;
					}

					if ( isset( $guest_settings['config']['ss_speed'] ) && '' != $guest_settings['config']['ss_speed'] ) {
						$modula_settings['slideshow_speed'] = $guest_settings['config']['ss_speed'];
					}
					break;
			}
		}

		return $modula_settings;
	}

}
