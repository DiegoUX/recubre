<?php 
$theme_options_default = null;
class EWAbstractTheme 
{
	protected $options = array();
	protected $arrFunctions = array();
	protected $arrShortcodes = array();
	protected $arrWidgets = array();
	protected $arrIncludes = array();
	public function __construct($options){
		$this->initArrFunctions();
		$this->initArrShortcodes();
		$this->initArrWidgets();
		$this->initArrIncludes();
	}

	protected function init(){
		////// Active theme
		$this->hookActive($this->options['theme_slug'], array($this,'activeTheme'));
		
		
		$this->initIncludes();
		
		///// After Setup theme
		add_action( 'after_setup_theme', array($this,'wpdancesetup'));
		
		////// deactive theme
		$this->hookDeactive($this->options['theme_slug'], array($this,'deactiveTheme'));
		
		add_action('wp_enqueue_scripts',array($this,'addScripts'));
		
		add_action('wp_enqueue_scripts',array($this,'addTailScripts'),1000000);
		
		///// Create Custom Post Type
		$this->iniPostTypes();
		
		
		$this->initFunctions();
		$this->initShortcodes();
		$this->initWidgets();
		//$this->initSidebars();
		
		////// if login to admin, generate admin panel for theme
		require_once THEME_ADMIN.'/admin.php';
			if(file_exists(THEME_EXTENDS_ADMIN.'/admin.php')){
				require_once THEME_EXTENDS_ADMIN.'/admin.php';
				$classNameAdmin = 'AdminTheme'.strtoupper(substr(THEME_SLUG,0,strlen(THEME_SLUG)-1));
			}
			else{
				$classNameAdmin = 'AdminTheme';
			}
			$panel = new $classNameAdmin();
	}
	
	protected function initArrFunctions(){
		$this->arrFunctions = array('main','global_var','preview_mod','ads','filter_editor','quicksand','slide','markup_categories','lightbox_control',
		'breadcrumbs','sidebar','twitter_update','feed_burner','excerpt',/*'thumbnail',*/'pagination','filter_theme','posted_in_on',
		'video','comment','theme_sidebar','custom_style','logo_function','wdmenus','woo-cart','woo-product','woo-hook','woo-shortcode','woo-account','custom_term');
	}
	
	protected function initArrShortcodes(){
		$this->arrShortcodes = array('banner','accordion','code','custom_query','embbed_video','image_video',
		'faq','lightbox','list_post','listing','quote','sidebar','google_map','slide','style_box','symbol','table','tabs',
		'recent_post','align','typography','column_article','bt_buttons','slide','portfolio');
	}
	
	protected function initArrWidgets(){
		$this->arrWidgets = array('flickr','popular','recent_post_slider','customrecent','about','emads','custompages','twitterupdate','multitab');
	}
	
	protected function initArrIncludes(){
		$this->arrIncludes = array('mostviewed','twitteroauth','mobile_detect');
	}
	
	public function wpdancesetup() {
		// This theme styles the visual editor with editor-style.css to match the theme style.
		add_editor_style();

		// Post Format support. You can also use the legacy "gallery" or "asides" (note the plural) categories.
		//add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );


		// This theme supports a variety of post formats.
		//add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ) );	
		add_theme_support( 'post-formats', array( 'aside', 'link', 'gallery', 'status', 'quote', 'image' ) );		
		//add_theme_support( 'custom-header', $args ) ;
		
		// This theme uses post thumbnails
		add_theme_support( 'post-thumbnails' );

		// Add default posts and comments RSS feed links to head
		add_theme_support( 'automatic-feed-links' );

		$defaults = array(
			'default-color'          => '',
			'default-image'          => get_template_directory_uri()."/images/default-background.png",
			// 'wp-head-callback'       => 'head_callback_on_bg',
			// 'admin-head-callback'    => '',
			// 'admin-preview-callback' => ''
		);
		
		global $wp_version;
		if ( version_compare( $wp_version, '3.4', '>=' ) ) :
			add_theme_support( 'custom-background', $defaults );
		else :
			add_custom_background( $defaults );
		endif;		
				
				
		add_theme_support( 'woocommerce' );	
		if ( ! isset( $content_width ) ) $content_width = 960;
		
		// Make theme available for translation
		// Translations can be filed in the /languages/ directory
		load_theme_textdomain( 'wpdance', get_template_directory() . '/languages' );

		$locale = get_locale();
		$locale_file = get_template_directory() . "/languages/$locale.php";
		if ( is_readable( $locale_file ) )
			require_once( $locale_file );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => __( 'Primary Navigation', 'wpdance' ),
		) );


		// Your changeable header business starts here
		if ( ! defined( 'HEADER_TEXTCOLOR' ) )
			define( 'HEADER_TEXTCOLOR', '' );

		// No CSS, just IMG call. The %s is a placeholder for the theme template directory URI.
		if ( ! defined( 'HEADER_IMAGE' ) )
			define( 'HEADER_IMAGE', '%s/images/headers/path.jpg' );

		// The height and width of your custom header. You can hook into the theme's own filters to change these values.
		// Add a filter to wpdance_header_image_width and wpdance_header_image_height to change these values.
		define( 'HEADER_IMAGE_WIDTH', apply_filters( 'wpdance_header_image_width', 940 ) );
		define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'wpdance_header_image_height', 198 ) );

		// We'll be using post thumbnails for custom header images on posts and pages.
		// We want them to be 940 pixels wide by 198 pixels tall.
		// Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
		set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );

		// Don't support text inside the header image.
		if ( ! defined( 'NO_HEADER_TEXT' ) )
			define( 'NO_HEADER_TEXT', true );

		// Add a way for the custom header to be styled in the admin panel that controls
		// custom headers. See wpdance_admin_header_style(), below.


		// ... and thus ends the changeable header business.
		
		$detect = new Mobile_Detect;
		$_is_tablet = $detect->isTablet();
		$_is_mobile = $detect->isMobile() && !$_is_tablet;
		define( 'WD_IS_MOBILE', $_is_mobile );
		define( 'WD_IS_TABLET', $_is_tablet );
	}
	
	protected function constant($options){
		define('DS',DIRECTORY_SEPARATOR);	
		define('THEME_NAME', $options['theme_name']);
		define('THEME_SLUG', $options['theme_slug'].'_');
		
		define('THEME_DIR', get_template_directory());
		
		define('THEME_CACHE', get_template_directory().DS.'cache_theme'.DS);
		
		define('THEME_URI', get_template_directory_uri());
		define('THEME_FRAMEWORK_JS_URI', THEME_URI.'/framework/js');
		define('THEME_FRAMEWORK_CSS_URI', THEME_URI.'/framework/css');
		define('THEME_ADMIN_URI', THEME_URI.'/framework/admin');
		
		define('THEME_FRAMEWORK', THEME_DIR . '/framework');
		
		define('THEME_PLUGINS', THEME_FRAMEWORK . '/plugins');
		define('THEME_HELPERS', THEME_FRAMEWORK . '/helpers');
		define('THEME_FUNCTIONS', THEME_FRAMEWORK . '/functions');
		define('THEME_WIDGETS', THEME_FRAMEWORK . '/widgets');
		define('THEME_SHORTCODES', THEME_FRAMEWORK . '/shortcodes');
		define('THEME_INCLUDES', THEME_FRAMEWORK . '/includes');
		define('THEME_TYPES', THEME_FRAMEWORK . '/types');
		
		define('THEME_IMAGES', THEME_URI . '/images');
		define('THEME_CSS', THEME_URI . '/css');
		define('THEME_JS', THEME_URI . '/js');
		
		define('THEME_ADMIN', THEME_FRAMEWORK . '/admin');
			
		define('ENABLED_FONT', false);
		define('ENABLED_COLOR', false);
		define('ENABLED_PREVIEW', false);
		define('SITE_LAYOUT', 'wide');
		
		define('USING_CSS_CACHE', true);
		
	}
	
	protected function iniPostTypes(){
		if(file_exists(THEME_EXTENDS_TYPES."/portfolio.php")){
			require_once THEME_EXTENDS_TYPES."/portfolio.php";
		} else {	
			require_once THEME_TYPES."/portfolio.php";
		}
		// require_once THEME_TYPES."/testimonials.php";
		// require_once THEME_TYPES."/feature.php";
		require_once THEME_TYPES."/slide.php";		 
	}
	
	protected function initFunctions(){
		foreach($this->arrFunctions as $function){
			if(file_exists(THEME_EXTENDS_FUNCTIONS."/{$function}.php"))
				require_once THEME_EXTENDS_FUNCTIONS."/{$function}.php";
			else	
				require_once THEME_FUNCTIONS."/{$function}.php";
		}
	}
	
	protected function initShortcodes(){
		foreach($this->arrShortcodes as $shortcode){
			if(file_exists(THEME_EXTENDS_SHORTCODES."/{$shortcode}.php"))
				require_once THEME_EXTENDS_SHORTCODES."/{$shortcode}.php";
			else
				require_once THEME_SHORTCODES."/{$shortcode}.php";
		}
	}
	
	protected function initWidgets(){
		foreach($this->arrWidgets as $widget){
			if(file_exists(THEME_EXTENDS_WIDGETS."/{$widget}.php"))
				require_once THEME_EXTENDS_WIDGETS."/{$widget}.php";
			else	
				require_once THEME_WIDGETS."/{$widget}.php";
		}
		add_action( 'widgets_init', array($this,'loadWidgets'));
	}
	
	protected function initIncludes(){
		foreach($this->arrIncludes as $include){
			if(file_exists(THEME_EXTENDS_INCLUDES."/{$include}.php"))
				require_once THEME_EXTENDS_INCLUDES."/{$include}.php";
			else	
				require_once THEME_INCLUDES."/{$include}.php";
		}
	}
	
	public function loadWidgets(){
		foreach($this->arrWidgets as $widget)
			register_widget( 'WP_Widget_'.ucfirst($widget) );
	}
/*	
	protected function initSidebars(){
		add_action( 'widgets_init', array($this,'loadSidebars'));
	}
	
	public function loadSidebars(){
		$custom_sidebar_str = get_option(THEME_SLUG.'areas');
		if($custom_sidebar_str){
			$custom_sidebar_arr = json_decode($custom_sidebar_str);
			foreach($custom_sidebar_arr as $sidebar){
				register_sidebar( array(
					'name' => __( $sidebar, 'lacinia' ),
					'id' => friendlyURL($sidebar),
					'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
					'after_widget' => '</li>',
					'before_title' => '<h3 class="widget-title">',
					'after_title' => '</h3>',
				) );
			}
		}
	}
*/	
	protected function loadOptions(){
		if(file_exists(THEME_EXTENDS_INCLUDES."/options.php"))
			require_once THEME_EXTENDS_INCLUDES."/options.php";
		else	
			require_once THEME_INCLUDES."/options.php";
	}
	
	public function activeTheme(){
		$this->loadOptions();
		global $theme_options_default,$wpdb;
		foreach($theme_options_default as $key => $value){
			update_option(THEME_SLUG.$key, $value);
		}
		//Single Image
		update_option( 'shop_single_image_size', array('height'=>'500', 'width' => '500', 'crop' => 1 ));
		//Thumbnail Image
		update_option( 'shop_thumbnail_image_size', array('height'=>'108', 'width' => '108', 'crop' => 1 ));
		//Catalog Image
		update_option( 'shop_catalog_image_size', array('height'=>'180', 'width' => '180', 'crop' => 1 )); 

		// code to execute on theme activation
		global $wpdb;
		$wpdb->query("CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."popular_by_views` (
		  `id` bigint(50) NOT NULL AUTO_INCREMENT,
		  `post_id` varchar(255) NOT NULL,
		  `views` bigint(50) NOT NULL,
		  PRIMARY KEY (`id`),
		  UNIQUE KEY `id` (`id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37") ;
	}
	
	public function hookActive($code, $function){
		$optionKey="theme_is_activated_" . $code;
		if(!get_option($optionKey)) {
			call_user_func($function);
			update_option($optionKey , 1);
		}
	}
	
	public function deactiveTheme(){
	
	}
	
	/**
	 * @desc registers deactivation hook
	 * @param string $code : Code of the theme. This must match the value you provided in wp_register_theme_activation_hook function as $code
	 * @param callback $function : Function to call when theme gets deactivated.
	 */
	public function hookDeactive($code, $function) {
		// store function in code specific global
		$GLOBALS["wp_register_theme_deactivation_hook_function" . $code]=$function;

		// create a runtime function which will delete the option set while activation of this theme and will call deactivation function provided in $function
		$fn=create_function('$theme', ' call_user_func($GLOBALS["wp_register_theme_deactivation_hook_function' . $code . '"]); delete_option("theme_is_activated_' . $code. '");');

		// add above created function to switch_theme action hook. This hook gets called when admin changes the theme.
		// Due to wordpress core implementation this hook can only be received by currently active theme (which is going to be deactivated as admin has chosen another one.
		// Your theme can perceive this hook as a deactivation hook.)
		add_action("switch_theme", $fn);
	}
	
	public function addTailScripts(){

		global $default_custom_style_config;
		
		$custom_style_config = get_option(THEME_SLUG.'custom_style_config','');
		$custom_style_config_arr = unserialize($custom_style_config);
		$custom_style_config_arr = wd_array_atts_str($default_custom_style_config,$custom_style_config_arr);
		
		
	
		
		$enable_custom_preview = (bool) $custom_style_config_arr['enable_custom_preview'];
		$enable_custom_font = 	(bool) $custom_style_config_arr['enable_custom_font'];
		$enable_custom_color = 	(bool) $custom_style_config_arr['enable_custom_color'];
	
	
		if( $enable_custom_font || $enable_custom_color ){
			wp_register_style( 'custom', THEME_CSS.'/custom.less');
			wp_enqueue_style('custom');	
		}else{
			wp_register_style( 'custom_default', THEME_CSS.'/custom_default.less');
			wp_enqueue_style('custom_default');			
		}
		

		wp_register_script( 'less', THEME_FRAMEWORK_JS_URI.'/less.js');
		wp_enqueue_script('less');	
	}
	
	public function addScripts(){
		global $is_IE;

		
		$protocol = is_ssl() ? 'https' : 'http';
		wp_enqueue_style( 'techgo-roboto', "$protocol://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700" );
		wp_enqueue_style( 'techgo-share-tech', "$protocol://fonts.googleapis.com/css?family=Share+Tech" );
		wp_enqueue_style( 'techgo-share', "$protocol://fonts.googleapis.com/css?family=Share" );
		
		wp_enqueue_style( 'techgo', get_stylesheet_uri() ); 
		
		wp_register_script( 'TweenMax', THEME_FRAMEWORK_JS_URI.'/TweenMax.min.js',false,false,true);
		wp_enqueue_script('TweenMax');			
		
		wp_enqueue_script('jquery');	
		wp_register_script( 'jquery-migrate-1.2.1', THEME_JS.'/jquery-migrate-1.2.1.js',false,false,true);
		wp_enqueue_script('jquery-migrate-1.2.1');
		wp_register_script( 'bootstrap', THEME_JS.'/bootstrap.js',false,false,true);
		wp_enqueue_script('bootstrap');		
		
		wp_enqueue_script("jquery-ui-core");
		wp_enqueue_script("jquery-ui-widget");
		wp_enqueue_script("jquery-ui-tabs");
		wp_enqueue_script("jquery-ui-mouse");
		//wp_enqueue_script("jquery-ui-sortable");
		//wp_enqueue_script("jquery-ui-slider");
		wp_enqueue_script("jquery-ui-accordion");
		wp_enqueue_script("jquery-effects-core");
		//wp_enqueue_script("jquery-effects-slide");
		//wp_enqueue_script("jquery-effects-blind");
		

		
		/// Load Anythingslider js,css
		wp_enqueue_script('flexslider',THEME_JS.'/jquery.flexslider-min.js',false,true);

		wp_register_style( 'flexslider', THEME_CSS.'/flexslider.css');
		wp_enqueue_style('flexslider');

		wp_register_style( 'reset', THEME_CSS.'/reset.css');
		wp_enqueue_style('reset');
		
		wp_register_style( 'shortcode', THEME_CSS.'/shortcode.css');
		wp_enqueue_style('shortcode');
		
		//wp_register_script( 'jquery.cookie', THEME_FRAMEWORK_JS_URI.'/jquery.cookie.js',false,false,true);
		//wp_enqueue_script('jquery.cookie');	
		
		wp_register_style( 'colorpicker', THEME_CSS.'/colorpicker.css');
		wp_enqueue_style('colorpicker');		
		wp_register_script( 'bootstrap-colorpicker', THEME_JS.'/bootstrap-colorpicker.js',false,false,true);
		wp_enqueue_script('bootstrap-colorpicker');	
				
		//wp_register_script( 'easepack', THEME_FRAMEWORK_JS_URI.'/easepack.js',false,false,true);
		//wp_enqueue_script('easepack');
		
		//wp_register_script( 'jquery.timer', THEME_FRAMEWORK_JS_URI.'/jquery.timer.js',false,false,true);
		//wp_enqueue_script('jquery.timer');
		//wp_register_script( 'jquery.wipetouch', THEME_FRAMEWORK_JS_URI.'/jquery.wipetouch.js',false,false,true);
		//wp_enqueue_script('jquery.wipetouch');
		
		//wp_register_script( 'jquery.nicescroll', THEME_FRAMEWORK_JS_URI.'/jquery.nicescroll.js',false,false,false);
		//wp_enqueue_script('jquery.nicescroll');
		
		// wp_register_script( 'jquery.mousewheel', THEME_FRAMEWORK_JS_URI.'/jquery.mousewheel.min.js');
		// wp_enqueue_script('jquery.mousewheel');	
		
		wp_register_script( 'wd.animation', THEME_FRAMEWORK_JS_URI.'/wd.animation.js',false,false,true);
		wp_enqueue_script('wd.animation');
		

		
		/// Start Fancy Box
		wp_register_style( 'fancybox_css', THEME_CSS.'/jquery.fancybox.css');
		wp_enqueue_style('fancybox_css');		
		//wp_register_script( 'fancybox_js', THEME_JS.'/jquery.fancybox.pack.js',false,false,true);
		//wp_enqueue_script('fancybox_js');	
		/// End Fancy Box
		
		/// Load Jquery Form
		//wp_register_script( 'jqueryform', THEME_FRAMEWORK_JS_URI.'/jquery.form.js',false,false,true);
		//wp_enqueue_script('jqueryform');
		
		
		
		//wp_register_script( 'debounce', THEME_FRAMEWORK_JS_URI.'/debounce.min.js');
		//wp_enqueue_script('debounce');
		
			
		if( $is_IE ){
			// responsive IE
			// wp_register_script( 'respond', THEME_FRAMEWORK_JS_URI.'/ie-respond.js');
			// wp_enqueue_script('respond');
			
			
			// wp_register_style( 'font-awesome-ie7.min', THEME_FRAMEWORK_CSS_URI.'/font-awesome-ie7.min.css');
			// wp_enqueue_style('font-awesome-ie7.min');

		
			// wp_register_script( 'SelectorIE', THEME_FRAMEWORK_JS_URI.'/SelectorIE.js');
			// wp_enqueue_script('SelectorIE');
			
		}
		

		// Load init quicksand
		//wp_register_script( 'quicksand', THEME_FRAMEWORK_JS_URI.'/jquery.quicksand.js',false,false,true);
		//wp_enqueue_script('quicksand');
		//wp_register_script( 'jquery-animate-css-rotate-scale', THEME_FRAMEWORK_JS_URI.'/jquery-animate-css-rotate-scale.js');
		// wp_enqueue_script('jquery-animate-css-rotate-scale');
		// wp_register_script( 'jquery-css-transform', THEME_FRAMEWORK_JS_URI.'/jquery-css-transform.js');
		// wp_enqueue_script('jquery-css-transform');
		//wp_register_script( 'jquery.easing.1.3', THEME_FRAMEWORK_JS_URI.'/jquery.easing.1.3.js',false,false,true);
		//wp_enqueue_script('jquery.easing.1.3');
		wp_register_script( 'include-script', THEME_FRAMEWORK_JS_URI.'/include-script.js',false,false,true);
		wp_enqueue_script('include-script');
		wp_register_style( 'bootstrap-style', THEME_CSS.'/bootstrap-style.css');
		wp_enqueue_style('bootstrap-style');
		wp_register_style( 'bootstrap', THEME_CSS.'/bootstrap.css');
		wp_enqueue_style('bootstrap');	
		wp_register_style( 'bootstrap-ie8-buttonfix', THEME_CSS.'/bootstrap-ie8-buttonfix.css');
		wp_enqueue_style('bootstrap-ie8-buttonfix');
		wp_register_style( 'responsive', THEME_CSS.'/responsive.css');
		wp_enqueue_style('responsive');		
		wp_register_style( 'font-awesome', THEME_FRAMEWORK_CSS_URI.'/font-awesome.css');
		wp_enqueue_style('font-awesome');	

		// wp_register_script( 'js_wd_menu_frontend', THEME_JS.'/wd_menu_front.js');
		// wp_enqueue_script('js_wd_menu_frontend');
		//wp_register_script( 'jquery.hoverIntent', THEME_JS.'/jquery.hoverIntent.js',false,false,true);
		//wp_enqueue_script('jquery.hoverIntent');		
		
		wp_register_script( 'jquery.carouFredSel', THEME_FRAMEWORK_JS_URI.'/jquery.carouFredSel-6.2.1.min.js',false,false,true);
		wp_enqueue_script('jquery.carouFredSel');		
						
		wp_register_script( 'jquery.nivo-js', THEME_JS.'/jquery.nivo.slider.js',false,false,true);
		wp_enqueue_script('jquery.nivo-js');		
		wp_register_style( 'nivo-slider-css', THEME_CSS.'/nivo-slider.css');
		wp_enqueue_style('nivo-slider-css');		
			
		// wp_register_script( 'jquery.superscrollorama', THEME_JS.'/jquery.superscrollorama.js');
		// wp_enqueue_script('jquery.superscrollorama');			
		

		if(is_singular('product')){
			wp_register_script( 'jquery.cloud-zoom', THEME_JS.'/cloud-zoom.1.0.2.js',false,false,true);
			wp_enqueue_script('jquery.cloud-zoom');		
			wp_register_style( 'cloud-zoom-css', THEME_CSS.'/cloud-zoom.css');
			wp_enqueue_style('cloud-zoom-css');
		
		}else{
			wp_register_script( 'jquery.prettyPhoto', THEME_JS.'/jquery.prettyPhoto.min.js',false,false,true);
			wp_enqueue_script('jquery.prettyPhoto');	
			wp_register_script( 'jquery.prettyPhoto.init', THEME_JS.'/jquery.prettyPhoto.init.min.js',false,false,true);
			wp_enqueue_script('jquery.prettyPhoto.init');				
			wp_register_style( 'css.prettyPhoto', THEME_CSS.'/prettyPhoto.css');
			wp_enqueue_style('css.prettyPhoto');
		}
	
		
	}
}
?>