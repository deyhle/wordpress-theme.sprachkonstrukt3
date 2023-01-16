<?php


/**
 * sprachkonstrukt3 functions and definitions
 *
 * @package sprachkonstrukt3
 * @since sprachkonstrukt3 0.1
 */
 
/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since sprachkonstrukt3 1.0
 */
#if ( ! isset( $content_width ) )
	$content_width = 800; /* pixels */

add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 800, 220, true );


/**
 * Enqueue scripts and styles
 */
function sprachkonstrukt3_scripts() {
	
	wp_register_script('sprachkonstrukt', get_template_directory_uri().'/js/sprachkonstrukt.min.js', array('jquery')); 
	wp_enqueue_script('sprachkonstrukt', get_template_directory_uri().'/js/sprachkonstrukt.min.js', 'false', '1.0', true);   
	
	wp_register_script('modernizr', get_template_directory_uri().'/js/modernizr.custom.83399.js');
	wp_enqueue_script('modernizr');
		
	
}
add_action( 'init', 'sprachkonstrukt3_scripts' );


if ( ! function_exists( 'sprachkonstrukt3_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since sprachkonstrukt3 1.0
 */
function sprachkonstrukt3_setup() {
	
	/* wp_deregister_script('jquery');
	 wp_register_script('jquery', ("https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"), false, '1.7.2');
	 wp_enqueue_script('jquery');
	 wp_deregister_script('jqueryui');
	 wp_register_script('jqueryui', ("https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"), false, '1.8.18');
	 wp_enqueue_script('jqueryui');
*/	 
	 
	 // register bottom sidebar
	register_sidebar(array(
		'id'			=> 'bottom_sidebar',
		'name' 			=> __('Bottom Sidebar', 'sprachkonstrukt'),
		'description'	=> __('The Bottom Sidebar', 'sprachkonstrukt'),
		'before_widget' => '<li id="%1$s" class="widget %2$s">', 
		'after_widget' 	=> '</li>', 
		'before_title' 	=> '<h2 class="widgettitle">', 
		'after_title' 	=> '</h2>' 
	));
	
	
	// register widget for beautiful archive
	add_action( 'widgets_init', function() { register_widget("sprachkonstrukt_archive_widget"); } );
	
	// register widget for related/featured posts
	add_action( 'widgets_init', function() { register_widget("sprachkonstrukt_relatedfeatured_widget"); } );
	
	
	add_action( 'send_headers', 'add_header_xua' );
	function add_header_xua() {
		header("X-XSS-Protection: 0");
	}
	
	
	/**
	 * Custom template tags for this theme.
	 */
	//require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Custom functions that act independently of the theme templates
	 */
	//require( get_template_directory() . '/inc/tweaks.php' );

	/**
	 * Custom Theme Options
	 */
	//require( get_template_directory() . '/inc/theme-options/theme-options.php' );

	/**
	 * WordPress.com-specific functions and definitions
	 */
	//require( get_template_directory() . '/inc/wpcom.php' );

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on sprachkonstrukt3, use a find and replace
	 * to change '_s' to the name of your theme in all the template files
	 */
	//load_theme_textdomain( '_s', get_template_directory() . '/languages' );

	/*$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );
*/
	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	/*register_nav_menus( array(
		'primary' => __( 'Primary Menu', '_s' ),
	) );*/

	/**
	 * Add support for the Aside and Gallery Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', ) );
}
endif; // sprachkonstrukt3_setup
add_action( 'after_setup_theme', 'sprachkonstrukt3_setup' );


function custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function sprachkonstrukt3_current_page() {
	return get_query_var('paged') == 0 ? 1 : get_query_var('paged');	
}

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since sprachkonstrukt3 1.0
 */
/*function sprachkonstrukt3_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar', '_s' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
}
add_action( 'widgets_init', '_s_widgets_init' );


/**
 * Implement the Custom Header feature
 */
//require( get_template_directory() . '/inc/custom-header.php' );


/** 
 * Enable threaded comments
 */
function sprachkonstrukt_enqueue_comment_reply() {
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'sprachkonstrukt_enqueue_comment_reply' );



/** 
 * outputs comments (and no pings/trackbacks) 
 */
if ( ! function_exists( 'sprachkonstrukt_comment' ) ):
function sprachkonstrukt_comment($comment, $args, $depth) {
   	$GLOBALS['comment'] = $comment; ?>
   	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
     	<div id="comment-<?php comment_ID(); ?>" >
     		<a href="<?php comment_author_url(); ?>" class="kommentar-avatar">
     			<?php echo get_avatar($comment,$size='32',$default=get_bloginfo('template_directory').'/images/gravatar.png' ); ?>
     		</a>
     		<div class="kommentar-inhalt">
      			<span class="comment-author vcard"><?php echo(get_comment_author_link()); ?>:</span> <?php comment_text(); ?>
				<?php if ($comment->comment_approved == '0') : ?>
        			<br /> <em><?php _e('Your comment is awaiting moderation.', 'sprachkonstrukt') ?></em>
      			<?php endif; ?>
      			
				<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_date();?>, <?php comment_time(); ?></a>
					<div class="reply">
         				<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
      				</div>
      			</div>
				
      			
      		</div>
     	</div>
<?php
}
endif;


/** 
 * outputs pings/trackbacks (and no comments) 
 */
if ( ! function_exists( 'sprachkonstrukt_ping' ) ):
function sprachkonstrukt_ping($comment, $args, $depth) {
   	$GLOBALS['comment'] = $comment; ?>
   	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
     	<div id="comment-<?php comment_ID(); ?>" >
     		<span class="comment-author vcard comment-meta commentmetadata">
      			<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php _e('Trackback', 'sprachkonstrukt'); ?>:</a> <?php echo(get_comment_author_link()); ?>
      			</span>
				
      			
      		
     	</div>
<?php
        }
endif;

/**
 * Cache Buster
 */
function css_cache_buster($info, $show) {
	if ($show == 'stylesheet_url') {
		$pieces = explode("wp-content", $info);
		get_bloginfo('template_directory');
		// Is there already a querystring? If so, add to the end of that.
		if (strpos($pieces[1], '?') === false) {
			return $info . "?" . filemtime(WP_CONTENT_DIR . $pieces[1]);
		} else {
			$morsels = explode("?", $pieces[1]);
			return $info . "&" . filemtime(WP_CONTENT_DIR . $morsels[1]);
		}
	}
	else return $info;
}

add_filter('bloginfo_url', 'css_cache_buster', 9999, 2);



require('widget_archive.class.php');
require('widget_relatedfeatured.class.php');
