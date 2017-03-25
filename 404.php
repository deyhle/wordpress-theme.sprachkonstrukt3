<?php
/**
 * Template for 404 Error Pages
 *
 * @package	   	WordPress
 * @subpackage	Sprachkonstrukt2 Theme
 * @author     	Ruben Deyhle <ruben@sprachkonstrukt.de>
 * @url		   	http://sprachkonstrukt2.deyhle-webdesign.com
 */

get_header(); ?>
<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
					<h1 style="font-size: 10em; margin: 1em auto;">404</h1>
					<?php the_content(); ?>
					<p>Die Seite existiert nicht, sorry.</p>  	
</article>

<?php get_footer(); ?>
