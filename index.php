<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package sprachkonstrukt3
 * @since sprachkonstrukt3 0.1
 */

get_header(); 

$page_number = (get_query_var('paged')) ? get_query_var('paged') : 1; ;
?>

		<div id="primary" class="site-content" data-pagenumber="<?php echo $page_number; ?>">
			<?php 
				if (is_search()) {
					?><h1><?php echo $wp_query->found_posts; ?> Suchergebnisse: <?php the_search_query(); ?></h1><?php
				}
				if (is_archive()) { 
					echo '<h1>';
				 	if ( is_month() ) { 
				 		echo "Archiv vom ".get_the_date('F Y'); 
				 	} elseif ( is_year() ) { 
				 		echo "Jahresarchiv ".get_the_date('Y'); 
				 	}
				 	echo '</h1>';
				} ?>
			<div id="content" role="main">

				
				<?php /* Start the Loop */
				while ( have_posts() ) : the_post(); ?>

					<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( '%s', '_s' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" class="entry-box">
						<?php if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
							  	$background_style = 'background-image: url('.wp_get_attachment_image_src( get_post_thumbnail_id(), 'large')[0].');';
							} else {
								$background_style = '';
							} 
							get_post_meta($post_id, $key, $single)
							?>
						<time class="entry-date" datetime="<?php the_date('Y-m-d');?>"><?php echo get_the_date(); ?></time>
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> style="<?php echo $background_style.get_post_meta(get_the_ID(), "indexstyle", true); ?>">
							<h2 class="entry-title"><?php the_title(); ?></h2>
						<?php if($post->post_excerpt) { ?>
							<div class="entry-summary"><?php the_excerpt(); ?></div><!-- .entry-summary -->
						<?php } ?>
						</article><!-- #post-<?php the_ID(); ?> -->
					</a>
					
				<?php endwhile; ?>

				

			</div><!-- #content -->
			<div id="ajaxcontentloader">
				<?php next_posts_link('Mehr laden…') ?>
			</div>
			
			
		</div><!-- #primary .site-content -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>