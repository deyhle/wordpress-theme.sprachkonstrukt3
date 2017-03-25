<?php
/**
 * Theme Header
 *
 * @package	   	WordPress
 * @subpackage	Sprachkonstrukt3 Theme
 * @author     	Ruben Deyhle <ruben@sprachkonstrukt.de>
 * @url		   	http://sprachkonstrukt2.deyhle-webdesign.com
 */
 ?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta http-equiv="X-UA-Compatible" content="chrome=1" /> <!-- use Google Chrome Frame -->
		
		<title><?php
		/*
		 * Print the <title> tag based on what is being viewed.
		 */
		global $page, $paged;
	
		wp_title( '|', true, 'right' );
	
		// Add the blog name.
		bloginfo( 'name' );
	
		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			echo " | $site_description";
	
		// Add a page number if necessary:
		if ( $paged >= 2 || $page >= 2 )
			echo ' | ' . sprintf( __( 'Page %s', 'sprachkonstrukt'), max( $paged, $page ) );
	
		?></title>
		
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="all" />
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
		
		
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
	<?php if (is_singular()) $sprachkonstrukt_pagetype = "singular"; else $sprachkonstrukt_pagetype = "main"; ?>
	
<header class="<?php echo $sprachkonstrukt_pagetype ?>">
			<hgroup>
				<h1><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home" <?php echo $sprachkonstrukt_header_textcolor; ?>><?php bloginfo( 'name' ); ?></a></h1>
				<?php if (is_singular()) { 
					  	wp_nav_menu( array( 'container' => 'nav', 'fallback_cb' => 'sprachkonstrukt_menu', 'theme_location' => 'primary', 'depth' => 1 ) ); 
					  } else { ?>
				<h2><?php bloginfo( 'description' ); ?></h2>
				<?php } ?>
			</hgroup>
		</header>
		
