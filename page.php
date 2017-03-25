<?php
/**
 * Main Template File for a single post
 *
 * @package	   	WordPress
 * @subpackage	Sprachkonstrukt2 Theme
 * @author     	Ruben Deyhle <ruben@sprachkonstrukt.de>
 * @url		   	http://sprachkonstrukt2.deyhle-webdesign.com
 */ 

get_header(); 

if (have_posts()) : 
	while (have_posts()) : the_post(); ?>

				<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
				
				<?php if($post->post_parent) {
					$parent_link = get_permalink($post->post_parent); 
					$parent_title = get_the_title($post->post_parent); ?>
				<a href="<?php echo $parent_link; ?>">« <?php echo $parent_title;?></a>
				<?php } ?>
				
					<h1><a href="<?php echo get_permalink() ?>" rel="bookmark" title=" <?php the_title(); ?>"><?php the_title(); ?></a></h1>
					<?php the_content(); ?>
	
		
					<p class="entry_pages">		
						<?php wp_link_pages(array('before' => '<strong>'.__( 'Pages', 'sprachkonstrukt' ).':</strong> ', 'after' => '', 'next_or_number' => 'number')); ?>
					</p>  				
					

				<footer class="entry_meta">
					
					
					<span class="dates">
					<a href="<?php echo get_permalink() ?>" rel="bookmark" title=" <?php the_title(); ?>"><time datetime="<?php the_time('c') ?>"><?php the_modified_time(get_option('date_format')); ?>, <?php the_modified_time(); ?></time></a>
					
					</span>
					<div class="share">
						<div id="fb-root"></div>
						<div class="fb-like" data-send="false" data-layout="button_count" data-width="82" data-show-faces="false"></div>
						<div class="twitter"><a href="https://twitter.com/share" class="twitter-share-button" data-via="sprachkonstrukt" data-lang="de" data-count="none">Twittern</a></div>
						
						<div class="g-plusone" data-size="medium" data-annotation="none"></div>
						<div class="g-plus" data-action="share" data-annotation="none"></div>
						
	
						
						<div class="flattr"><?php the_flattr_permalink() ?></div>
						
						
					</div>
				</footer>
					
					<?php comments_template(); ?>
				</article>
				
<?php endwhile; endif; ?>				
				

<?php get_footer(); ?>