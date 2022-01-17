<?php
/**
 * Licence checker class . Handles checking licence expiry date.
 *
 * @package wpchill
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Wpchill_License_Checker' ) ) {

	/**
	 * Main class for license checker
	 */
	class Wpchill_License_Checker {
		/**
		 * Plugin file
		 *
		 * @var string
		 */
		private $plugin_file;

		/**
		 * Plugin slug
		 *
		 * @var string
		 */
		private $plugin_slug;

		/**
		 * Plugin nice name
		 *
		 * @var string
		 */
		private $plugin_nicename;

		/**
		 * Store url
		 *
		 * @var string
		 */
		private $store_url;

		/**
		 * Item id
		 *
		 * @var int
		 */
		private $item_id;
		/**
		 * Users license.
		 *
		 * @var string
		 */
		private $license = '';

		/**
		 * License status
		 *
		 * @var string
		 */
		private $license_status;

		/**
		 * License data trans
		 *
		 * @var array
		 */
		private $license_data_trans;

		/**
		 * Define the core functionality of the class.
		 *
		 * @param array $args args to init the class.
		 */
		public function __construct( $args ) {//@phpcs:ignore

			// If the arguments don't check out we return, means the class can't be initialized correctly
			if ( ! $this->check_args( $args ) ) {
				return;
			}

			// We se out class variables here
			$this->set_class_variables( $args );

			// We set the hooks after we set the variables because inside the hooks we need the variables
			$this->set_hooks();

			$this->init();

		}

		/**
		 * Check the arguments given when creating the instance of the class
		 *
		 * @param $args
		 *
		 * @return bool
		 */
		public function check_args( $args ) {

			if ( ! isset( $args['plugin_slug'] ) || ! isset( $args['plugin_nicename'] ) || ! isset( $args['store_url'] ) || ! isset( $args['license'] ) || ! isset( $args['plugin_file'] ) || ! isset( $args['item_id'] ) || ! isset( $args['license_status'] ) ) {

				return false;
			}

			return true;

		}

		/**
		 * Set our class variables
		 *
		 * @param $args
		 */
		public function set_class_variables( $args ) {

			$this->plugin_file     = $args['plugin_file'];
			$this->plugin_slug     = $args['plugin_slug'];
			$this->plugin_nicename = $args['plugin_nicename'];
			$this->store_url       = $args['store_url'];
			$this->item_id         = $args['item_id'];
			$this->license         = $args['license'];
			$this->license_status  = $args['license_status'];
		}

		/**
		 * Set our hooks
		 */
		public function set_hooks() {

			register_activation_hook( $this->plugin_file, array( $this, 'schedule_tracking' ) );
			register_deactivation_hook( $this->plugin_file, array( $this, 'remove_transients' ) );

			// Add set transients and options to plugin uninstall functionality

			// Modula plugin
			add_filter( 'modula_uninstall_transients', array( $this, 'unintall_transients' ) );

			// Strong Testimonials plugin
			add_filter( 'st_uninstall_transients', array( $this, 'unintall_transients' ) );

			// Set the weekly interval.
			add_filter( 'cron_schedules', array( $this, 'set_weekly_cron_schedule' ) );

			// Hook our check_license_valability function to the weekly action.
			add_action( 'put_do_weekly_license_action', array( $this, 'check_license_valability' ) );
		}

		/**
		 * Initialize function.
		 */
		public function init() {

			$this->license_data_trans = get_transient( "wpchill_{$this->plugin_slug}_license_data" );

			if ( $this->license_data_trans && $this->license_data_trans['notice_time'] && 'lifetime' !== $this->license_data_trans['expires'] ) {

				add_action( 'admin_notices', array( $this, 'expiry_notice' ) );
			}

		}

		/**
		 * When the plugin is activated
		 * Create scheduled event
		 * And check if tracking is enabled - perhaps the plugin has been reactivated
		 */
		public function schedule_tracking() {

			if ( ! wp_next_scheduled( 'put_do_weekly_license_action' ) ) {

				wp_schedule_event( time(), 'weekly', 'put_do_weekly_license_action' );
			}

			$this->check_license_valability();
		}

		/**
		 * Remove transients on uninstall
		 */
		public function remove_transients() {

			delete_transient( "wpchill_{$this->plugin_slug}_license_data" );
		}

		/**
		 * Check license valability function
		 */
		public function check_license_valability() {

			$this->license = $this->get_license();

			// Return if there is no license
			if ( false === $this->license || empty( $this->license ) ) {
				return;
			}

			// data to send in our API request.
			$api_params = array(
					'edd_action' => 'check_license',
					'license'    => $this->license,
					'item_id'    => $this->item_id,
					'url'        => home_url(),
			);

			// Call the custom API.
			$response = wp_remote_post(
					$this->store_url,
					array(
							'timeout'   => 15,
							'sslverify' => false,
							'body'      => $api_params,
					)
			);

			// make sure the response came back okay.
			if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {

				if ( is_wp_error( $response ) ) {
					$message = $response->get_error_message();
				} else {
					$message = esc_html__( 'An error occurred, please try again.', $this->plugin_slug ); //@phpcs:ignore
				}

				wp_send_json_error( $message );
				die();
			}

			// Decode license data and check status and expiry .
			// Add `false` to assicuative - we retrieve an object
			$license_data = json_decode( wp_remote_retrieve_body( $response ), false );

			// Stop the function if license is invalid.
			if ( 'invalid' === $license_data->license || 'lifetime' === $license_data->expires ) {
				return false;
			}

			$license_args = array(
					'expires'     => $license_data->expires,
					'notice_time' => strtotime( $license_data->expires ) < strtotime( '+1 week' ),
			);

			// Check if the license is expired . If it is then set its status to expired.
			if ( strtotime( $license_data->expires ) < strtotime( 'now' ) ) {

				$license_status = get_option( $this->license_status );

				$license_status->license = 'expired';
				update_option( $this->license_status, $license_status );

			}

			// Set the transient that holds the necessary information and expires in a week , when the next time to check is.
			set_transient( "wpchill_{$this->plugin_slug}_license_data", $license_args, 604800 );

			return true;

		}

		/**
		 * Set weekly cron schedule
		 *
		 * @param array $schedules list of recurrences ( daily , hourly , twice daily by default).
		 */
		public function set_weekly_cron_schedule( $schedules ) {

			$schedules['weekly'] = array(
					'interval' => 604800,
					'display'  => __( 'Weekly' ),
			);

			return $schedules;
		}

		/**
		 * Display expiry notice
		 */
		public function expiry_notice() {

			$date         = $this->license_data_trans['expires'];
			$create_date  = new DateTime( $date );
			$date_no_time = $create_date->format( 'Y-m-d' );
			?>
			<div class='notice notice-warning'>
				<p> Your <?php echo esc_html( $this->plugin_nicename ); ?> License is
					about to expire on <strong style="color:#bd1919"> <?php echo esc_html( $date_no_time ); ?> </strong>
					.</p>
			</div>

			<?php
		}

		/**
		 * Helper function to retrieve the license
		 */
		public function get_license() {

			return trim( get_option( $this->license ) );
		}

		/**
		 * Add our transients to the uninstall process
		 *
		 * @param $transients
		 *
		 * @return mixed
		 *
		 */
		public function unintall_transients( $transients ) {

			if ( ! isset( $transients["wpchill_{$this->plugin_slug}_license_data"] ) ) {

				$transients[] = "wpchill_{$this->plugin_slug}_license_data";
			}

			return $transients;
		}
	}
}
