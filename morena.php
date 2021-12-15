<?php
/**
 * Plugin Name: Morena Addons for Elementor
 * Description: Addons for Elementor Website Builder
 * Author: panmaruda
 * Version: 1.0.0
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

final class Morena {

	/**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 *
	 * @var string The plugin version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '2.5.11';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '6.0';

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 * @static
	 *
	 * The single instance of the class.
	 */
	protected static $instance = null;

	public static function get_instance() {
		if ( ! isset( static::$instance ) ) {
			static::$instance = new static;
		}

		return static::$instance;
	}

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */

	protected function __construct() {
		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
		}
		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}
		// Requires widgets
		require_once('widgets/swiper-slider/swiper-slider.php');
		require_once('widgets/team-members/team-members.php');
		require_once('widgets/random-number/random-number.php');
		require_once('widgets/alert/alert.php');
		require_once('widgets/quote/quote.php');

		// Register Widget
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );

		// Register Widget Styles
		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'widget_styles' ] );

		// Register Widget Scripts
		add_action( 'elementor/frontend/after_enqueue_scripts', [ $this, 'widget_scripts' ] );

	}


	public function register_widgets() {
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Swiper_Slider() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Team_Member() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Random_Number() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Alert() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\Quote() );

	}

	public function widget_styles() {
		wp_enqueue_style( 'swiper-slider-css', plugins_url( 'widgets/swiper-slider/css/swiper-slider.css', __FILE__ ) );
		wp_enqueue_style( 'team-members-css', plugins_url( 'widgets/team-members/css/team-members.css', __FILE__ ) );
		wp_enqueue_style( 'team-members-css', plugins_url( 'widgets/random-number/css/random-number.css', __FILE__ ) );
		wp_enqueue_style( 'team-members-css', plugins_url( 'widgets/alert/css/alert.css', __FILE__ ) );
		wp_enqueue_style( 'team-members-css', plugins_url( 'widgets/quote/css/quote.css', __FILE__ ) );
	}

	public function widget_scripts() {
		wp_enqueue_script( 'swiper-slider-js', plugins_url( 'widgets/swiper-slider/js/swiper-slider.js', __FILE__ ), array( 'jquery' ) );
		wp_enqueue_script( 'team-members-js', plugins_url( 'widgets/team-members/js/team-members.js', __FILE__ ), array( 'jquery' ) );
		wp_enqueue_script( 'team-members-js', plugins_url( 'widgets/random-number/js/random-number.js', __FILE__ ), array( 'jquery' ) );
		wp_enqueue_script( 'team-members-js', plugins_url( 'widgets/alert/js/alert.js', __FILE__ ), array( 'jquery' ) );
		wp_enqueue_script( 'team-members-js', plugins_url( 'widgets/quote/js/quote.js', __FILE__ ), array( 'jquery' ) );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
		/* 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'morena' ),
			'<strong>' . esc_html__( 'Morena', 'morena' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'morena' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
		/* 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'morena' ),
			'<strong>' . esc_html__( 'Morena', 'morena' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'morena' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);
		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
		/* 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'morena' ),
			'<strong>' . esc_html__( 'Morena', 'morena' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'morena' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

}

add_action( 'init', 'Morena_elementor_init' );
function Morena_elementor_init() {
	Morena::get_instance();
}

    