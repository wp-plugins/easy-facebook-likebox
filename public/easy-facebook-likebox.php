<?php
/**
 * Plugin Name.
 *
 * @package   Plugin_Name
 * @author    Your Name <email@example.com>
 * @license   GPL-2.0+
 * @link      http://example.com
 * @copyright 2014 Your Name or Company Name
 */

/**
 * Plugin class. This class should ideally be used to work with the
 * public-facing side of the WordPress site.
 *
 * If you're interested in introducing administrative or dashboard
 * functionality, then refer to `class-plugin-name-admin.php`
 *
 * @TODO: Rename this class to a proper name for your plugin.
 *
 * @package Plugin_Name
 * @author  Your Name <email@example.com>
 */
class Easy_Facebook_Likebox {

	/**
	 * Plugin version, used for cache-busting of style and script file references.
	 *
	 * @since   1.1.0
	 *
	 * @var     string
	 */
	const VERSION = '2.1.0';

	/**
	 * @TODO - Rename "plugin-name" to the name your your plugin
	 *
	 * Unique identifier for your plugin.
	 *
	 *
	 * The variable name is used as the text domain when internationalizing strings
	 * of text. Its value should match the Text Domain file header in the main
	 * plugin file.
	 *
	 * @since    1.1.0
	 *
	 * @var      string
	 */
	protected $plugin_slug = 'easy-facebook-likebox';

	/**
	 * Instance of this class.
	 *
	 * @since    1.1.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Initialize the plugin by setting localization and loading public scripts
	 * and styles.
	 *
	 * @since     1.1.0
	 */
	private function __construct() {

		// Load plugin text domain
		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );
		
		// Load plugin text domain
		add_action( 'wp_footer', array( $this, 'efbl_display_popup' ), 50 );

		// Activate plugin when new blog is added
		add_action( 'wpmu_new_blog', array( $this, 'activate_new_site' ) );

		// Load public-facing style sheet and JavaScript.
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		
		add_shortcode( 'efb_likebox', array( $this, 'efb_likebox_shortcode' ) );
 
		/* Define custom functionality.
		 * Refer To http://codex.wordpress.org/Plugin_API#Hooks.2C_Actions_and_Filters
		 */
		//add_action( '@TODO', array( $this, 'action_method_name' ) );
		//add_filter( '@TODO', array( $this, 'filter_method_name' ) );

	}

	/**
	 * Return the plugin slug.
	 *
	 * @since    1.1.0
	 *
	 * @return    Plugin slug variable.
	 */
	public function get_plugin_slug() {
		return $this->plugin_slug;
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since     1.1.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Fired when the plugin is activated.
	 *
	 * @since    1.1.0
	 *
	 * @param    boolean    $network_wide    True if WPMU superadmin uses
	 *                                       "Network Activate" action, false if
	 *                                       WPMU is disabled or plugin is
	 *                                       activated on an individual blog.
	 */
	public static function activate( $network_wide ) {

		if ( function_exists( 'is_multisite' ) && is_multisite() ) {

			if ( $network_wide  ) {

				// Get all blog ids
				$blog_ids = self::get_blog_ids();

				foreach ( $blog_ids as $blog_id ) {

					switch_to_blog( $blog_id );
					self::single_activate();
				}

				restore_current_blog();

			} else {
				self::single_activate();
			}

		} else {
			self::single_activate();
		}

	}

	/**
	 * Fired when the plugin is deactivated.
	 *
	 * @since    1.1.0
	 *
	 * @param    boolean    $network_wide    True if WPMU superadmin uses
	 *                                       "Network Deactivate" action, false if
	 *                                       WPMU is disabled or plugin is
	 *                                       deactivated on an individual blog.
	 */
	public static function deactivate( $network_wide ) {

		if ( function_exists( 'is_multisite' ) && is_multisite() ) {

			if ( $network_wide ) {

				// Get all blog ids
				$blog_ids = self::get_blog_ids();

				foreach ( $blog_ids as $blog_id ) {

					switch_to_blog( $blog_id );
					self::single_deactivate();

				}

				restore_current_blog();

			} else {
				self::single_deactivate();
			}

		} else {
			self::single_deactivate();
		}

	}

	/**
	 * Fired when a new site is activated with a WPMU environment.
	 *
	 * @since    1.1.0
	 *
	 * @param    int    $blog_id    ID of the new blog.
	 */
	public function activate_new_site( $blog_id ) {

		if ( 1 !== did_action( 'wpmu_new_blog' ) ) {
			return;
		}

		switch_to_blog( $blog_id );
		self::single_activate();
		restore_current_blog();

	}

	/**
	 * Get all blog ids of blogs in the current network that are:
	 * - not archived
	 * - not spam
	 * - not deleted
	 *
	 * @since    1.1.0
	 *
	 * @return   array|false    The blog ids, false if no matches.
	 */
	private static function get_blog_ids() {

		global $wpdb;

		// get an array of blog ids
		$sql = "SELECT blog_id FROM $wpdb->blogs
			WHERE archived = '0' AND spam = '0'
			AND deleted = '0'";

		return $wpdb->get_col( $sql );

	}

	/**
	 * Fired for each blog when the plugin is activated.
	 *
	 * @since    1.1.0
	 */
	private static function single_activate() {
		// @TODO: Define activation functionality here
	}

	/**
	 * Fired for each blog when the plugin is deactivated.
	 *
	 * @since    1.1.0
	 */
	private static function single_deactivate() {
		// @TODO: Define deactivation functionality here
	}

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.1.0
	 */
	public function load_plugin_textdomain() {

		$domain = $this->plugin_slug;
		$locale = apply_filters( 'plugin_locale', get_locale(), $domain );

		load_textdomain( $domain, trailingslashit( WP_LANG_DIR ) . $domain . '/' . $domain . '-' . $locale . '.mo' );
		load_plugin_textdomain( $domain, FALSE, basename( plugin_dir_path( dirname( __FILE__ ) ) ) . '/languages/' );

	}

	/**
	 * Register and enqueue public-facing style sheet.
	 *
	 * @since    1.1.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_slug . '-plugin-styles', plugins_url( 'assets/css/public.css', __FILE__ ), array(), self::VERSION );
		
		wp_enqueue_style( $this->plugin_slug . '-popup-styles', plugins_url( 'assets/popup/magnific-popup.css', __FILE__ ), array(), self::VERSION );
	}

	/**
	 * Register and enqueues public-facing JavaScript files.
	 *
	 * @since    1.1.0
	 */
	public function enqueue_scripts() {
 		wp_enqueue_script( $this->plugin_slug . '-popup-script', plugins_url( 'assets/popup/jquery.magnific-popup.min.js', __FILE__ ), array( 'jquery' ), self::VERSION );
 		wp_enqueue_script( $this->plugin_slug . '-plugin-script', plugins_url( 'assets/js/public.js', __FILE__ ), array( 'jquery', $this->plugin_slug . '-popup-script' ), self::VERSION );
	}

	/**
	 * NOTE:  Actions are points in the execution of a page or process
	 *        lifecycle that WordPress fires.
	 *
	 *        Actions:    http://codex.wordpress.org/Plugin_API#Actions
	 *        Reference:  http://codex.wordpress.org/Plugin_API/Action_Reference
	 *
	 * @since    1.1.0
	 */
	public function action_method_name() {
		// @TODO: Define your action hook callback here
	}

	/**
	 * NOTE:  Filters are points of execution in which WordPress modifies data
	 *        before saving it or sending it to the browser.
	 *
	 *        Filters: http://codex.wordpress.org/Plugin_API#Filters
	 *        Reference:  http://codex.wordpress.org/Plugin_API/Filter_Reference
	 *
	 * @since    1.1.0
	 */
	public function filter_method_name() {
		// @TODO: Define your filter hook callback here
	}
	
	public function efb_likebox_shortcode($atts, $content=""){
		return $this->render_fb_box($atts);
	}
	
	/**
	 * 		  This fucntion will render the facebook like box
	 *        before saving it or sending it to the browser.
	 *
	 *        Filters: http://codex.wordpress.org/Plugin_API#Filters
	 *        Reference:  http://codex.wordpress.org/Plugin_API/Filter_Reference
	 *
	 * @since    1.1.0
	 */
	public function render_fb_box($options) {
		
		extract($options, EXTR_SKIP);
		
		if( empty( $fb_appid ) ){
			$fb_appid = '395202813876688';
		}
		
		if( empty( $locale ) ){
			$locale = 'en_US';
		}
 		
		if( !empty( $locale_other ) ){
			$locale = $locale_other;
		}
		
 		$pieces = explode('/', $fanpage_url); // divides the string in pieces where '/' is found
		$page_name_id = end($pieces); //takes the last piece
 
 		$show_stream = ( $show_stream == 1 ) ? 'data-stream=true' : 'data-stream=false'; 
		$show_faces = ( $show_faces == 1 ) ? 'data-show-faces=true' : 'data-show-faces=false'; 
		$show_border = ( $show_border == 1 ) ? 'data-show-border=true' : 'data-show-border=false' ;
		$show_header = ( $show_header == 1 ) ? 'data-header=true' : 'data-header=false';
		$responsive = ( $responsive == 1 ) ? 'responsive' : '';
 		 
		$returner = '<div id="fb-root"></div>
					<script>(function(d, s, id) {
					  var js, fjs = d.getElementsByTagName(s)[0];
					  if (d.getElementById(id)) return;
					  js = d.createElement(s); js.id = id;
					  js.src = "//connect.facebook.net/'.$locale.'/all.js#xfbml=1&appId='.$fb_appid.'";
					  fjs.parentNode.insertBefore(js, fjs);
					}(document, \'script\', \'facebook-jssdk\'));</script>';
					
		$returner .= '<div class="fb-like-box '.$responsive.' " data-href="https://www.facebook.com/'.$page_name_id.'" data-colorscheme="'.$colorscheme.'" data-width="'.$box_width.'" data-height="'.$box_height.'" '.$show_faces.' '.$show_header.' '.$show_stream.' '.$show_border.'></div>';
		
/*		echo '<pre>';
		echo htmlspecialchars($returner);
		echo '</pre>';*/
		
 		return $returner;
		 
	}
	
	function efbl_display_popup(){
		include('views/public.php');
	}
	
	 

}
