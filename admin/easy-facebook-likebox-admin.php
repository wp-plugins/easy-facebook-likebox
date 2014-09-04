<?php 
/** 
 * Plugin Name.
 *
 * @package   Easy_Facebook_Likebox_Admin
 * @author    Sajid Javed <email@example.com>
 * @license   GPL-2.0+
 * @link      http://example.com
 * @copyright 2014 Your Name or Company Name
 */

/**
 * Plugin class. This class should ideally be used to work with the
 * administrative side of the WordPress site.
 *
 * If you're interested in introducing public-facing
 * functionality, then refer to `class-plugin-name.php`
 *
 * @TODO: Rename this class to a proper name for your plugin.
 *
 * @package Plugin_Name_Admin
 * @author  Your Name <email@example.com> 
 */
class Easy_Facebook_Likebox_Admin {

	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Slug of the plugin screen.
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $plugin_screen_hook_suffix = null;

	/**
	 * Initialize the plugin by loading admin scripts & styles and adding a
	 * settings page and menu.
	 *
	 * @since     1.0.0
	 */
	private function __construct() {

		/*
		 * @TODO :
		 *
		 * - Uncomment following lines if the admin class should only be available for super admins
		 */
		/* if( ! is_super_admin() ) {
			return;
		} */

		/*
		 * Call $plugin_slug from public plugin class.
		 *
		 * @TODO:
		 *
		 * - Rename "Plugin_Name" to the name of your initial plugin class
		 *
		 */
		$plugin = Easy_Facebook_Likebox::get_instance();
		$this->plugin_slug = $plugin->get_plugin_slug();

		// Load admin style sheet and JavaScript.
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );

		// Add the options page and menu item.
		add_action( 'admin_menu', array( $this, 'add_plugin_admin_menu' ) );

		// Add an action link pointing to the options page.
		$plugin_basename = plugin_basename( plugin_dir_path( __DIR__ ) . $this->plugin_slug . '.php' );
		add_filter( 'plugin_action_links_' . $plugin_basename, array( $this, 'add_action_links' ) );
		
		add_action( 'admin_init', array( $this, 'i_have_supported_efbl') );
		
		//if ( get_option('I_HAVE_SUPPORTED_THE_EFBL_PLUGIN') != 1 )
			add_action( 'admin_notices', array( $this, 'post_installtion_upgrade_nag') );
 
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		/*
		 * @TODO :
		 *
		 * - Uncomment following lines if the admin class should only be available for super admins
		 */
		/* if( ! is_super_admin() ) {
			return;
		} */

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Register and enqueue admin-specific style sheet.
	 *
	 * @TODO:
	 *
	 * - Rename "Plugin_Name" to the name your plugin
	 *
	 * @since     1.0.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_styles() {

		/*if ( ! isset( $this->plugin_screen_hook_suffix ) ) {
			return;
		}

		$screen = get_current_screen();
		if ( $this->plugin_screen_hook_suffix == $screen->id ) {
			
		}*/
		
		wp_enqueue_style( $this->plugin_slug .'-admin-styles', plugins_url( 'assets/css/admin.css', __FILE__ ), array(), Easy_Facebook_Likebox::VERSION );

	}

	/**
	 * Register and enqueue admin-specific JavaScript.
	 *
	 * @TODO:
	 *
	 * - Rename "Plugin_Name" to the name your plugin
	 *
	 * @since     1.0.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_scripts() {

		if ( ! isset( $this->plugin_screen_hook_suffix ) ) {
			return;
		}

		$screen = get_current_screen();
		if ( $this->plugin_screen_hook_suffix == $screen->id ) {
			wp_enqueue_script( $this->plugin_slug . '-admin-script', plugins_url( 'assets/js/admin.js', __FILE__ ), array( 'jquery' ), Easy_Facebook_Likebox::VERSION );
		}

	}

	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 *
	 * @since    1.0.0
	 */
	public function add_plugin_admin_menu() {

		/*
		 * Add a settings page for this plugin to the Settings menu.
		 *
		 * NOTE:  Alternative menu locations are available via WordPress administration menu functions.
		 *
		 *        Administration Menus: http://codex.wordpress.org/Administration_Menus
		 *
		 * @TODO:
		 *
		 * - Change 'Page Title' to the title of your plugin admin page
		 * - Change 'Menu Text' to the text for menu item for the plugin settings page
		 * - Change 'manage_options' to the capability you see fit
		 *   For reference: http://codex.wordpress.org/Roles_and_Capabilities
		 */
		$this->plugin_screen_hook_suffix = add_options_page(
			__( 'Easy Fcebook Likebox', $this->plugin_slug ),
			__( 'Easy Fcebook Likebox', $this->plugin_slug ),
			'manage_options',
			$this->plugin_slug,
			array( $this, 'display_plugin_admin_page' )
		);

	}

	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.0
	 */
	public function display_plugin_admin_page() {
		include_once( 'views/admin.php' );
	}

	/**
	 * Add settings action link to the plugins page.
	 *
	 * @since    1.0.0
	 */
	public function add_action_links( $links ) {

		return array_merge(
			array(
				'settings' => '<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_slug ) . '">' . __( 'Settings', $this->plugin_slug ) . '</a>'
			),
			$links
		);

	}
	
	/**
	 * Display a thank you nag when the plugin has been installed/upgraded.
	 */
	public function post_installtion_upgrade_nag() {
 		if ( !current_user_can('install_plugins') ) return;
		
		$plugin_verstion = Easy_Facebook_Likebox::VERSION;
		
		$version_key = '_efbl_version';
		$notice_key = 'I_HAVE_SUPPORTED_THE_EFBL_PLUGIN';
		
		if ( get_site_option( $version_key ) == $plugin_verstion && get_site_option( $notice_key ) == 1 ) return;

		$msg = sprintf(__('Thanks for installting/upgrading the Easy Facebook Likebox Plugin! If you like this plugin, please consider some <a href="%s" target="_blank">donation</a> and/or <a href="%s" target="_blank">rating it</a>!
		Support us by liking our facebook fan page! 
		
	  <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=517129121754984&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, \'script\', \'facebook-jssdk\'));</script>

<div class="fb-like" data-href="https://facebook.com/jwebsol" data-layout="standard" data-action="like" data-show-faces="false" data-share="true"></div>
			  	  <br /><br />
		<a href="%s" class="button button-primary">I have supported already</a>				  
		', 'efbl'),
				'https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=sjaved786%40gmail%2ecom&lc=US&item_name=Easy%20Facebook%20Like%20Box%20WordPress%20Plugin&item_number=efbl&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted',
				'http://wordpress.org/plugins/easy-facebook-likebox/',
				get_admin_url().'?efbl_supported=1'
				);
		echo "<div class='update-nag'>$msg</div>";

		update_site_option( $version_key, $plugin_verstion );
 	}
	
	function i_have_supported_efbl(){
		
		if(isset($_GET['efbl_supported'])) {
			update_site_option( 'I_HAVE_SUPPORTED_THE_EFBL_PLUGIN', 1 );	
 		}
			
		/*echo I_HAVE_SUPPORTED_THE_EFBL_PLUGIN;	
		exit;	*/
	}
}
