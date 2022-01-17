<?php

/**
 * Class Modula PRO Upsells
 *
 * @since 2.5.2
 */
if ( class_exists( 'WPChill_Upsells' ) ) {


	class Modula_PRO_Upsells extends WPChill_Upsells {

		/**
		 * Holds the class object.
		 *
		 * @since 2.5.2
		 *
		 * @var object
		 */
		public static $instance;

		/**
		 * URL endpoints
		 *
		 * @since 2.5.2
		 *
		 * @var array
		 */
		private $endpoints = array(
			'checkout' => 'checkout',
			'pricing'  => 'pricing',
			'base'     => 'wp-json/wpchill/v1/'
		);

		/**
		 * Upsell extensions
		 *
		 * @since 2.5.2
		 *
		 * @var array
		 */
		private $upsell_extensions = array();

		/**
		 * PRO fields required based on previous PRO tabs/fields
		 *
		 * @since 2.5.2
		 *
		 * @var string[]
		 */
		private $pro_fields = array();

		/**
		 * Modula_PRO_Upsells constructor.
		 *
		 * @param $args
		 *
		 * @since 2.5.2
		 */
		function __construct( $args ) {

			parent::__construct( $args );

			if ( class_exists( 'WPChill_Upsells' ) ) {

				// output wpchill lite vs pro page
				add_action( 'modula_admin_page_link', array( $this, 'lite_vs_premium_page_title' ), 35, 1 );
				add_filter( 'modula_packages', array( $this, 'modula_pro_packages' ), 35, 1 );
				add_filter( 'modula_uninstall_transients', array( $this, 'smart_upsells_transients' ), 15 );
				add_filter( 'modula_upsells_args', array( $this, 'modula_pro_upsell_args' ), 15 );
				add_filter( 'wpchill-upsells-buy-button', array( $this, 'modula_upgrade_button' ), 15, 3 );
				add_action( 'modula_after_license_save', array( $this, 'delete_transients' ) );
				add_action( 'modula_after_license_deactivated', array( $this, 'delete_transients' ) );
				add_filter( 'modula_pro_fields', array( $this, 'fields' ) );
				add_filter( 'modula_gallery_tabs', array( $this, 'smart_upsells_tabs' ), 99 );
				add_filter( 'modula_upsell_buttons', array( $this, 'smart_upsells_buttons' ), 99 );

				$this->set_pro_fields();
			}

		}

		/**
		 * Returns the singleton instance of the class.
		 *
		 * @return object The Modula_PRO_Upsells object.
		 * @since 2.5.2
		 *
		 */
		public static function get_instance( $args ) {

			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Modula_PRO_Upsells ) ) {
				self::$instance = new Modula_PRO_Upsells( $args );
			}

			return self::$instance;

		}


		/**
		 * Lets check for license
		 *
		 * @return bool
		 *
		 * @since 2.5.2
		 */
		public function check_for_license() {

			$license_status = get_option( 'modula_pro_license_status' );

			// There is no license or license is not valid anymore, so we get all packages
			if ( ! $license_status || 'valid' != $license_status->license ) {
				return false;
			}

			return true;
		}


		/**
		 * The LITE vs Premium page title
		 *
		 * @param $links
		 *
		 * @return mixed
		 *
		 * @since 2.5.2
		 */
		public function lite_vs_premium_page_title( $links ) {

			$packages = get_transient( 'modula_upgradable_packages' );

			// Check for license and current package
			if ( ! $this->check_for_license() || ! isset( $packages['current_package'] ) || empty( $packages['current_package'] ) ) {
				return $links;
			}

			// We made it here, so license is active and there is a current package
			// If no upsells are present means that the client has the highest package
			if ( empty( $packages['upsell_packages'] ) ) {
				if ( isset( $links['freevspro'] ) ) {
					unset( $links['freevspro'] );
				}

				return $links;
			}

			if ( isset( $links['freevspro'] ) ) {
				$links['freevspro']['page_title'] = esc_html__( 'Upgrade', 'modula-best-grid-gallery' );
				$links['freevspro']['menu_title'] = esc_html__( 'Upgrade', 'modula-best-grid-gallery' );
			}

			if ( isset( $links['modulaalbums'] ) ) {
				unset( $links['modulaalbums'] );
			}

			return $links;
		}

		/**
		 * Set the type and route of package
		 *
		 * @param $packages
		 *
		 * @return mixed|string
		 *
		 * @since 2.5.2
		 */
		public function modula_pro_packages( $packages ) {

			if ( ! $this->check_for_license() ) {
				return $packages;
			}

			$packages['packages'] = 'upgradable_packages';

			// Transient doesn't exist so we make the call
			$url         = preg_replace( '/\?.*/', '', get_bloginfo( 'url' ) );
			$license_key = get_option( 'modula_pro_license_key' );
			$query_var   = 'get-upgrade?license=' . $license_key . '&url=' . $url;

			$packages['route'] = $query_var;

			return $packages;

		}

		/**
		 * Set PRO args
		 *
		 * @param $args
		 *
		 * @return mixed
		 *
		 * @since 2.5.2
		 */
		public function modula_pro_upsell_args( $args ) {

			// Initialize WPChill upsell class
			$args['shop_url'] = MODULA_PRO_STORE_URL;
			$args['license']  = array(
				'key'    => 'modula_pro_license_key',
				'status' => 'modula_pro_license_status'
			);
			$args['slug']     = 'modula';

			return $args;

		}

		/**
		 * Add the smart upsells transients to deletion
		 *
		 * @param $transients
		 *
		 * @return mixed
		 *
		 * @since 2.5.2
		 */
		public function smart_upsells_transients( $transients ) {

			$transients[] = 'modula_upgradable_packages';

			return $transients;
		}

		/**
		 * Button label and URL
		 *
		 * @param $button
		 * @param $slug
		 * @param $package
		 *
		 * @return mixed
		 *
		 * @since 2.5.2
		 */
		public function modula_upgrade_button( $button, $slug, $package ) {

			if ( ! isset( $package['upgrade_path'] ) ) {

				$checkout_page = trailingslashit( MODULA_PRO_STORE_URL ) . $this->endpoints['checkout'];
				$url           = add_query_arg( array(
					'edd_action'   => 'add_to_cart',
					'download_id'  => $package['id'],
					'utm_source'   => 'upsell',
					'utm_medium'   => 'litevspro',
					'utm_campaign' => $slug,
				), $checkout_page );

			} else {
				$checkout_page = $package['upgrade_path'];
				$url           = add_query_arg( array(
					'utm_source'   => 'upsell',
					'utm_medium'   => 'litevspro',
					'utm_campaign' => $slug,
				), $checkout_page );
			}

			$button['url']   = $url;
			$button['label'] = esc_html__( 'Upgrade', 'modula-pro' );

			return $button;

		}


		/**
		 * Delete our set transients in the eventuality that the license has been activated/deactivated
		 *
		 * @since 2.5.2
		 */
		public function delete_transients() {
			delete_transient( 'modula_upgradable_packages' );
			delete_transient( 'modula_all_packages' );
		}

		/**
		 * Set the Modula PRO fields in order for us to handle them
		 * this is required due to previous declaration of fields and tabs
		 *
		 * @since 2.5.2
		 */
		public function set_pro_fields() {

			$this->pro_fields = apply_filters( 'modula_upsell_pro_fields', array(
				'modula-video'            => 'video',
				'modula-speedup'          => 'speedup',
				'modula-watermark'        => 'watermark',
				'modula-download'         => 'download',
				'modula-zoom'             => 'zoom',
				'modula-exif'             => 'exif',
				'modula-slideshow'        => 'slideshow',
				'modula-password-protect' => 'password_protect'
			) );

		}

		/**
		 * Modula PRO Upsell fields
		 *
		 * @param $fields
		 *
		 * @return mixed
		 *
		 * @since 2.5.2
		 */
		public function fields( $fields ) {

			if ( empty( $this->upsell_extensions ) ) {

				$this->fetch_packages();
				$packages                = $this->get_packages();
				$this->upsell_extensions = $this->get_extensions_upsell( $packages );
			}

			foreach ( $this->upsell_extensions as $key => $package ) {

				if ( isset( $this->pro_fields[ $key ] ) && isset( $fields[ $this->pro_fields[ $key ] ] ) ) {

					unset( $fields[ $this->pro_fields[ $key ] ] );
				}
			}

			return $fields;
		}

		/**
		 * Set badges
		 *
		 * @param $tabs
		 *
		 * @return mixed
		 *
		 * @since 2.5.2
		 */
		public function smart_upsells_tabs( $tabs ) {

			// If our class variable is empty get the extensions
			if ( empty( $this->upsell_extensions ) ) {

				$this->fetch_packages();
				$packages                = $this->get_packages();
				$this->upsell_extensions = $this->get_extensions_upsell( $packages );
			}

			// Set the proper badges for tabs
			foreach ( $this->upsell_extensions as $key => $package ) {

				// First lets check if the tab exists
				if ( isset( $this->pro_fields[ $key ] ) && isset( $tabs[ $this->pro_fields[ $key ] ] ) ) {

					// Set the badge
					$tabs[ $this->pro_fields[ $key ] ]['badge'] = __( 'Upgrade', 'modula-pro' );
				}
			}

			return $tabs;
		}

		/**
		 * Set proper buttons label
		 *
		 * @param $buttons
		 * @param $tab
		 *
		 * @return string
		 *
		 * @since 2.5.2
		 */
		public function smart_upsells_buttons() {

			return '<a target="_blank" href="' . esc_url( admin_url( 'edit.php?post_type=modula-gallery&page=modula-lite-vs-pro' ) ) . '" class="button-primary button">' . esc_html__( 'Upgrade!', 'modula-pro' ) . '</a>';


		}
	}

	// Initialize Modula_PRO_Upsells class
	$args             = array();
	$args['shop_url'] = MODULA_PRO_STORE_URL;
	$args['license']  = array(
		'key'    => 'modula_pro_license_key',
		'status' => 'modula_pro_license_status'
	);
	$args['slug']     = 'modula';

	Modula_PRO_Upsells::get_instance( $args );
}
