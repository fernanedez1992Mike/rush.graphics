<?php
namespace pixer;

/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.2.0
 */
class Plugin {

	/**
	 * Instance
	 *
	 * @since 1.2.0
	 * @access private
	 * @static
	 *
	 * @var Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * widget_categories
	 *
	 * Register new category for widgets.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function widget_categories( $elements_manager ) {

		$elements_manager->add_category(
			'pixer-slider',
			[
				'title' => esc_html__( 'Pixer Necessary Addons', 'megaaddons' ),
				'icon' => 'fa fa-slideshare',
			]
		);

	}

	/**
	 * widget_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function widget_scripts() {
		wp_enqueue_style( 'pixer-slider', plugins_url( '/assets/css/pixer-slider.css', __FILE__ ) );
		wp_enqueue_style( 'pricing', plugins_url( '/assets/css/pricing.css', __FILE__ ) );
		wp_enqueue_style( 'bootstrap', plugins_url( '/assets/css/bootstrap.min.css', __FILE__ ) );
		wp_enqueue_style( 'banner', plugins_url( '/assets/css/banner.css', __FILE__ ) );
		wp_enqueue_style( 'infobox', plugins_url( '/assets/css/infobox.css', __FILE__ ) );
		wp_enqueue_style( 'slick-theme', plugins_url( '/assets/css/slick-theme.css', __FILE__ ) );
		wp_enqueue_style( 'magnific-popup', plugins_url( '/assets/css/magnific-popup.css', __FILE__ ) );

		wp_enqueue_script( 'bootstrap', plugins_url( '/assets/js/bootstrap.min.js', __FILE__ ) , [ 'jquery' ], false, true );
		wp_enqueue_script( 'magnific-popup', plugins_url( '/assets/js/jquery.magnific-popup.min.js', __FILE__ ) , [ 'jquery' ], false, true );
		wp_enqueue_script( 'info-boxes', plugins_url( '/assets/js/pixer-slider.js', __FILE__ ), [ 'jquery' ], false, true );
	}

	/**
	 * Include Widgets files
	 *
	 * Load widgets files
	 *
	 * @since 1.2.0
	 * @access private
	 */
	

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function register_widgets() {

		// Include Widget files
		require_once( __DIR__ . '/widgets/widget-hero.php' );
		require_once( __DIR__ . '/widgets/widget-hero2.php' );
		require_once( __DIR__ . '/widgets/widget-features.php' );
		require_once( __DIR__ . '/widgets/widget-pricing.php' );
		require_once( __DIR__ . '/widgets/widget-team.php' );
		require_once( __DIR__ . '/widgets/widget-client.php' );
		require_once( __DIR__ . '/widgets/widget-contentwithvideo.php' );
		require_once( __DIR__ . '/widgets/widget-contentwithimage.php' );
		require_once( __DIR__ . '/widgets/widget-newsletter.php' );
		require_once( __DIR__ . '/widgets/widget-title.php' );
		require_once( __DIR__ . '/widgets/widget-video.php' );
		require_once( __DIR__ . '/widgets/widget-infobox.php' );
		require_once( __DIR__ . '/widgets/widget-infobox2.php' );
		require_once( __DIR__ . '/widgets/widget-infobox3.php' );

  		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Pixerbanner_widgets() );
  		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Pixerbanner2_widgets() );
  		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Pixerfeatures_widgets() );
  		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Pixerpricing_widgets() );
  		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Pixerteam_widgets() );
  		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Pixerclient_widgets() );
  		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Pixercontentwithvideo_widgets() );
  		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Pixercontentwithimage_widgets() );
  		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Pixernewsletter_widgets() );
  		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Pixertitle_widgets() );
  		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Pixervideo_widgets() );
  		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Pixerinobox1_widgets() );
  		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Pixerinobox2_widgets() );
  		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Pixerinobox3_widgets() );



	}

	/**
	 *  Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function __construct() {
		add_action( 'elementor/elements/categories_registered', [ $this, 'widget_categories' ] );

		// Register widget scripts
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );

		// Register widgets
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );
	}
}

// Instantiate Plugin Class
Plugin::instance();
