<?php
namespace Plugin_Hundimauto;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Plugin class.
 *
 * The main class that initiates and runs the addon.
 *
 * @since 1.0.0
 */
final class Plugin {

	/**
	 * Addon Version
	 * 
	 * @since 1.0.0
	 * @var string The addon version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 * 
	 * @since 1.0.0
	 * @var string Minimum Elementor version required to run the addon.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '3.24.3';

	/**
	 * Minimum PHP Version
	 * 
	 * @since 1.0.0
	 * @var string Minimum PHP version required to run the addon.
	 */
	const MINIMUM_PHP_VERSION = '8.1';

	/**
	 * Instance
	 * 
	 * @since 1.0.0
	 * @access private
	 * @static
	 * @var \Elementor_Addon_Plugin\Plugin The single instance of the class
	 */
	private static $_instance = null;

	/**
	 * Instance
	 * 
	 * @since 1.0.0
	 * @access public
	 * @static
	 * @return \Elementor_Addon_Plugin\Plugin An instance of the class.
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Constructor
	 * 
	 * Perform some compatibility checks to make sure basic requirements are meet.
	 * If all compatibility checks pass, initialize the functionality.
	 * 
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {

		if ( $this->is_compatible() ) {
			add_action( 'elementor/init', [ $this, 'init' ] );
		}

	}

	/**
	 * Compatibility Checks
	 * 
	 * Checks whether the site meets the addon requirement.
	 * 
	 * @since 1.0.0
	 * @access public
	 */
	public function is_compatible() {

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return false;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return false;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return false;
		}

		return true;

	}

	/**
	 * Load Textdomain
	 * 
	 * Load plugin localization files.
	 * 
	 * Firead by 'init' action hook.
	 * 
	 * @since 1.0.0
	 * @access publi
	 */
	public function i18n() {
		load_plugin_textdomain( 'plugin_hundimauto' );
	}

	/**
	 * Admin Notice
	 * 
	 * Warning when the site doesn't have Elementor installed or activated
	 * 
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html_( '"%1$s" requires "%2$s" to be installed and activated', 'elementor-addon-plugin' ),
			'<strong>' . esc_html__( 'Elementor Custom Addon', 'elementor-custom-addon' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'elementor-custom-addon' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1s</p></div>', $message );
	}

	/**
	 * Admin Notice
	 * 
	 * Warning when the site doesn't have a minimum required Elementor version
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {

		if ( isset ( $_GET['activate' ] ) ) unset ( $_GET['activate' ] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s requires "%2$s" version %3$s or greater.', 'elementor-custom-addon' ),
			'<strong>' . esc_html__( 'Elementor Custom Addon', 'elementor-custom-addon' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'elementor-custom-addon' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Admin Notice
	 * 
	 * Warning when the site doesn't have a minimum required PHP vesion
	 * 
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'elementor-custom-addon' ),
			'<strong>' . esc_html__( 'Elementor Custom Addon', 'elementor-custom-addon' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'elementor-custom-addon' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Initialize
	 * 
	 * Load the addons functionality only after Elementor is initialized.
	 * 
	 * Fired by 'elementor/init' action hook.
	 * 
	 * @since 1.0.0
	 * @access public
	 */
	public function init() {
		// initialize plugin textdomain
		$this->i18n();

		add_action( 'elementor/elements/categories_registered', array( $this, 'add_elementor_widget_categories') );
		add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );
		add_action( 'elementor/controls/register', [ $this, 'register_controls' ] );

	}

	/**
	 * Initialize Custom Widget Category
	 * 
	 * @since 1.0.0
	 * @access public
	 */
	public function add_elementor_widget_categories( $elements_manager ) {

		$elements_manager->add_category(
			'hundimauto_custom_widget_category',
			[
				'title' => __( 'HiA Elements', 'plugin-hundimauto' ),
				'icon' => 'eicon-nerd'
			]
		);
	}

	/**
	 * Register Widgets
	 * 
	 * Load widget files and register new Elementor widgets.
	 * 
	 * Fired by 'elementor/widgets/register' action hook.
	 * 
	 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
	 */
	public function register_widgets( $widgets_manager ) {

		require_once( __DIR__ . '/widgets/class-page-title.php' );
		require_once( __DIR__ . '/widgets/class-section-title.php' );
		require_once( __DIR__ . '/widgets/class-contact-box.php' );
		require_once( __DIR__ . '/widgets/class-content-box.php' );
		require_once( __DIR__ . '/widgets/class-video.php' );
		require_once( __DIR__ . '/widgets/class-linkbox-image.php' );
		require_once( __DIR__ . '/widgets/class-gallery-image.php' );
		require_once( __DIR__ . '/widgets/class-product-item.php' );
		require_once( __DIR__ . '/widgets/class-testimonial-carousel.php' );
		require_once( __DIR__ . '/widgets/class-link-button.php' );

		$widgets_manager->register( new Elementor_Page_Title_Widget() );
		$widgets_manager->register( new Elementor_Section_Title_Widget() );
		$widgets_manager->register( new Elementor_Contact_Box_Widget() );
		$widgets_manager->register( new Elementor_Content_Box_Widget() );
		$widgets_manager->register( new Elementor_Vimeo_Video_Widget() );
		$widgets_manager->register( new Elementor_LinkBox_Image_Widget() );
		$widgets_manager->register( new Elementor_Gallery_Image_Widget() );
		$widgets_manager->register( new Elementor_Product_Item_Widget() );
		$widgets_manager->register( new Elementor_Testimonial_Carousel_Widget() );
		$widgets_manager->register( new Elementor_Link_Button_Widget() );

	}

	/**
	 * Register Controls
	 * 
	 * Load controls files and register new Elementor controls.
	 * 
	 * Fired by 'elementor/controls/register' action hook.
	 * 
	 * @param \Elementor\Controls_Manager $controls_manager Elementor controls manager.
	 */
	public function register_controls( $controls_manager ) {

		/* require_once( __DIR__ . '/controls/control-1.php' ); */

		/* controls_manager->register( new Control_1() ); */

	}
}