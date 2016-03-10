<?php
require_once ( 'inc/mobile-detect.php' );
require_once ( 'inc/project-sections.php' );

require_once ( 'inc/loading.php' );

/** **/
require_once ( 'inc/vc_init.php' );

/** widget **/
require_once ( 'inc/widgets/about-us.php' );
require_once ( 'inc/widgets/contact.php' );
require_once ( 'inc/widgets/newsletter.php' );

/** Post type **/
require_once ( 'inc/post_types/slider.php' );
require_once ( 'inc/post_types/brands.php' );
require_once ( 'inc/post_types/projects.php' );
require_once ( 'inc/post_types/member_countries.php' );
require_once ( 'inc/post_types/media_gallery.php' );
require_once ( 'inc/post_types/photo_gallery.php' );
/** **/

require_once ( 'inc/multi-images/multi-image-metabox.php' );
require_once ( 'inc/custom-functions.php' );

function theme_slug_setup() {
   add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'theme_slug_setup' );
add_theme_support( 'html5', array( 'search-form' ) );

// Define Theme Name for localization
define('THEME_NAME', 'site_lang');
define('IMAGE_URI', get_template_directory_uri().'/assets/images/');

if ( ! function_exists( 'main_site_setup' ) ) {
    function main_site_setup() {
    	// Enable support for Post Thumbnails, and declare two sizes.
    	add_theme_support( 'post-thumbnails' );
    	set_post_thumbnail_size( 370, 247, true );
        add_image_size('img-block-1', 270, 230, true);
        add_image_size('img-block-2', 370, 246, true);
        add_image_size('testimonial', 170, 170, true);
        
        add_image_size('low-res', 1200, 798);
    
    	// This theme uses wp_nav_menu() in two locations.
    	register_nav_menus( array(
    		'primary'   => __( 'Primary menu', THEME_NAME ),
            'top'   => __( 'Top menu', THEME_NAME ),
            
            'wdc_menu'   => __( 'WDC menu', THEME_NAME ),
            'wdip_menu'   => __( 'WDIP menu', THEME_NAME ),
            'wdpp_menu'   => __( 'WDPP menu', THEME_NAME ),
            
            'interdesign_menu'   => __( 'Interdesign menu', THEME_NAME ),
            'widd_menu'   => __( 'WIDD menu', THEME_NAME ),
            'udid_menu'   => __( 'UDID menu', THEME_NAME ),
            'regional_menu'   => __( 'Regional menu', THEME_NAME ),
            
    	) );
    
    }
}
add_action( 'after_setup_theme', 'main_site_setup' );

// Translation
add_action('after_setup_theme', 'lang_setup');
function lang_setup(){
	load_theme_textdomain(THEME_NAME, get_template_directory() . '/inc/languages');
}

// Visual Post Editor Button for Shortcodes
//require_once ( 'inc/tinymce/tinymce-class.php' );	
//require_once ( 'inc/tinymce/shortcode-processing.php' );
//add_filter('widget_text', 'do_shortcode');

/**
 * Register three widget areas.
 */
function site_widgets_init() {
    if ( function_exists('register_sidebar') ){
    	register_sidebar( array(
    		'name'          => __( 'Primary', THEME_NAME ),
    		'id'            => 'sidebar-primary',
    		'before_widget' => '<aside class="widget %1$s %2$s">',
    		'after_widget'  => '</aside>',
    		'before_title'  => '<h3 class="widget-title">',
    		'after_title'   => '</h3>'
    	) );
        
        register_sidebar( array(
    		'name'          => __( 'Footer #1', THEME_NAME ),
    		'id'            => 'sidebar-footer-1',
    		'before_widget' => '<section class="widget %1$s %2$s">',
    		'after_widget'  => '</div></section>',
    		'before_title'  => '<h3 class="widget-title border-caption">',
    		'after_title'   => '</h3><div class="widget-content">'
    	) );
    	register_sidebar( array(
    		'name'          => __( 'Footer #2', THEME_NAME ),
    		'id'            => 'sidebar-footer-2',
    		'before_widget' => '<section class="widget %1$s %2$s">',
    		'after_widget'  => '</div></section>',
    		'before_title'  => '<h3 class="widget-title border-caption">',
    		'after_title'   => '</h3><div class="widget-content">'
    	) );
    	register_sidebar( array(
    		'name'          => __( 'Footer #3', THEME_NAME ),
    		'id'            => 'sidebar-footer-3',
    		'before_widget' => '<section class="widget %1$s %2$s">',
    		'after_widget'  => '</div></section>',
    		'before_title'  => '<h3 class="widget-title border-caption">',
    		'after_title'   => '</h3><div class="widget-content">'
    	) );
        register_sidebar( array(
    		'name'          => __( 'Footer #4', THEME_NAME ),
    		'id'            => 'sidebar-footer-4',
    		'before_widget' => '<section class="widget %1$s %2$s">',
    		'after_widget'  => '</div></section>',
    		'before_title'  => '<h3 class="widget-title border-caption">',
    		'after_title'   => '</h3><div class="widget-content">'
    	) );
	}
}
add_action( 'widgets_init', 'site_widgets_init' );

//add new css & js
function list_style()  
{  
    /** register **/
    wp_register_script( 'infinitescroll', get_template_directory_uri() . '/assets/js/jquery.infinitescroll.js');
    wp_register_script( 'lightbox.js', get_template_directory_uri() . '/assets/js/lightbox.js' );
    wp_register_style( 'lightbox', get_template_directory_uri() . '/assets/css/lightbox.css' );
    
    
    wp_enqueue_script( 'jquery' );
    wp_register_script( 'owl.js', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array(), null, true); 
    wp_enqueue_script( 'owl.js' );
    wp_register_script( 'lazy.js', get_template_directory_uri() . '/assets/js/jquery.lazyload.js', array(), null, true); 
    wp_enqueue_script( 'lazy.js' );
    
    if( is_singular( "site_project" ) ) {
        wp_enqueue_script( 'lightbox.js', false, array(), false, true );
    }
    
    wp_register_script( 'functions.js', get_template_directory_uri() . '/assets/js/functions.js', array(), null, true); 
    wp_enqueue_script( 'functions.js' );
    
    wp_register_style( 'boostrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), null); 
    wp_enqueue_style( 'boostrap' );
    wp_register_style( 'awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), null); 
    wp_enqueue_style( 'awesome' );
    wp_register_style( 'owl', get_template_directory_uri() . '/assets/css/owl.carousel.min.css', array(), null); 
    wp_enqueue_style( 'owl' );
    wp_register_style( 'site-form-style', get_template_directory_uri() . '/assets/css/form.css', array(), null); 
    wp_enqueue_style( 'site-form-style' );
    
    if( is_singular( "site_project" ) ) {
        wp_enqueue_style( 'lightbox' );
    }
    wp_register_style( 'main-styles', get_template_directory_uri() . '/assets/css/styles.css', array(), null); 
    wp_enqueue_style( 'main-styles' );
    wp_register_style( 'responsive', get_template_directory_uri() . '/assets/css/responsive.css', array(), null); 
    wp_enqueue_style( 'responsive' );
}  
add_action( 'wp_enqueue_scripts', 'list_style', 15 );  

/**
 * Change url to dynamic
 **/
function dynamic_url($url) {
    $img_url = '';
    if( !empty($url) ) {
        $ary_img_url = explode("//",$url);
        if(count($ary_img_url) >= 2)
            $img_url_a = $ary_img_url[1];
        else
            $img_url_a = $ary_img_url[0];
        $img_url_a = explode("/",$img_url_a);
        $img_url = "/";
        $shift_array = array_shift($img_url_a);
        $img_url .= implode("/",$img_url_a);
    }
    return $img_url;
}

/* Remove Unwanted Tags */
function remove_invalid_tags($str, $tags) 
{
    foreach($tags as $tag)
    {
    	$str = preg_replace('#^<\/'.$tag.'>|<'.$tag.'>$#', '', $str);
    }

    return $str;
}

/**
 * admin style
 **/
function my_login_logo() { ?>
    <style type="text/css">
        body.login div#login h1 a {
            background-repeat: no-repeat;
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icsid-logo.png);
            height: 75px;
            width: 100%;
            margin: 0;
            background-size: 80%;
            background-position: center;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );
add_filter( 'login_headerurl', 'custom_loginlogo_url' );
function custom_loginlogo_url($url) { 
    return home_url('/');
}

//hide admin bar
add_filter('show_admin_bar', '__return_false');

// Add specific CSS class by filter
add_filter( 'body_class', 'my_class_names');
function my_class_names( $classes ) {
    
	return $classes;
}

/**
 * Start Session
 **/
function my_session() {
    if(!session_id())
        session_start();
}
add_action('init', 'my_session');

/** checking logged in **/
function is_login_required($current_url, $redirect = 215) {
    if( !is_user_logged_in() ) {
        $_SESSION['prev_url'] = $current_url;
        wp_redirect( get_permalink( $redirect ) );
    }
    return false;
}

/** login **/
function ajax_login($username, $password, $remember = false, $redirect_page = false) {

    if(is_email($username)) {
        $username = get_username_from_email($username);
    }

    if(!$username) {
        return array('sts' => 'error', 'message' => __('Your email address and/or password are invalid. Please try again.', THB_THEME_NAME));
    }

    $creds = array();
    $creds['user_login'] = $username;
    $creds['user_password'] = $password;

    if(empty($creds['user_login']) || empty($creds['user_password'])){
        return array('sts' => 'error', 'message' => __('You must enter your email address and your password.', THB_THEME_NAME));
    }

    $creds['remember'] = (!empty($remember)) ? $remember : false;
    $user = wp_signon($creds, false);

    if (is_wp_error($user)) {
        return array('sts' => 'error', 'message' => __('Your email address and/or password are invalid. Please try again.', THB_THEME_NAME));
    } else {
        if($redirect_page != false) {
            return array('sts' => 'success', 'user_id' => $user->ID, 'url' => $redirect_page);
        } elseif(isset($_SESSION['prev_url']) && $_SESSION['prev_url'] != '') {
            return array('sts' => 'success', 'user_id' => $user->ID, 'url' => $_SESSION['prev_url']);
        }
        return array('sts' => 'success', 'user_id' => $user->ID, 'url' => home_url('/'));
    }
}


/** get username from email for login **/
function get_username_from_email($username) {
    $user = get_user_by( 'email', $username );
    if ( empty( $user ) ) {
        return false;
    }
    return $user->user_login;
}

add_action('wp_ajax_nopriv_do_ajax', 'our_ajax_function');
add_action('wp_ajax_do_ajax', 'our_ajax_function');
function our_ajax_function(){

    // the first part is a SWTICHBOARD that fires specific functions
    // according to the value of Query Var 'fn'

    switch($_REQUEST['fn']){
        case 'ajax_login':
            $username = sanitize_text_field($_REQUEST['user_name']);
            $password = sanitize_text_field($_REQUEST['pass']);
            $remember = sanitize_text_field($_REQUEST['remember_log']);
            $output = ajax_login($username, $password, $remember);
            break;

        default:
            $output = 'No function specified, check your jQuery.ajax() call';
            break;

    }

    $output=json_encode($output);
    if(is_array($output)){
        print_r($output);
    }
    else{
        echo $output;
    }
    die;
}

/** get the first post of category **/
function get_first_post_category( $cat_id ) {
    $fist_post = new WP_Query( array(
        'post_type' => 'media_gallery',
        'posts_per_page' => 1,
        'tax_query' => array(
            array(
                'taxonomy' => 'media_gallery_album',
                'terms' => $cat_id,
            ),
        ),
    ) );
    
    if( $fist_post->have_posts() )
        return $fist_post->posts[0];
    return false;
}

/**
 * pagination
 **/
function pagination($pages = '', $range = 2, $tax_id = "") {   
     $showitems = ($range * 2)+1;
     
     if($tax_id != "")
        $category_link = get_term_link($tax_id, 'photo_gallery_categories');
        
     global $paged;
     if(empty($paged)) $paged = 1;
 
     if($pages == '') {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if(!$pages) {
            $pages = 1;
        }
     }   
 
     if(1 != $pages) {
        echo "<div class=\"pagination\" id='pagination'>";
        $next_link = get_pagenum_link($paged + 1);
        if($tax_id != "") {
            $next_link = explode("page", $next_link);
            $next_link = $category_link."page".$next_link[1];
        }
        if ($paged < $pages) echo "<a href=\"".$next_link."\" class='next'>&rsaquo;</a>";  
        //if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
        echo "</div>\n";
     }
}

/** check project categories and get specific data **/
function get_project_category_info( $cat_id ) {
    $result = array();
    
    switch( $cat_id ) {
        case 40:
            $result['alt'] = "WDC logo";
            $result['menu_location'] = 'wdc_menu';
            $result['main_class'] = 'wdc-page';
            break;
        case 41:
            $result['alt'] = "WDIP logo";
            $result['menu_location'] = 'wdip_menu';
            $result['main_class'] = 'wdip-page';
            break;
        case 42:
            $result['alt'] = "WDPP logo";
            $result['menu_location'] = 'wdpp_menu';
            $result['main_class'] = 'wdpp-page';
            break;
        case 43:
            $result['alt'] = "WIDD logo";
            $result['menu_location'] = 'widd_menu';
            $result['main_class'] = 'widd-page';
            break;
        case 44:
            $result['alt'] = "UDID logo";
            $result['menu_location'] = 'udid_menu';
            $result['main_class'] = 'udid-page';
            break;
        case 45:
            $result['alt'] = "Interdesign logo";
            $result['menu_location'] = 'interdesign_menu';
            $result['main_class'] = 'interdesign-page';
            break;
        case 46:
            $result['alt'] = "Regional logo";
            $result['menu_location'] = 'regional_menu';
            $result['main_class'] = 'regional-page';
            break;
    }
    $result['logo'] = get_field( 'logo', 'project_categories_'.$cat_id);
    
    return $result;
}

function media_people_access( $uid ) {
    $user_info = get_userdata( $uid );
    
    $role = $user_info->roles;

    return ( $role[0] == 'administrator' || $role[0] == 'media_people' );
}
