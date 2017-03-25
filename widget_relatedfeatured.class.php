<?php
/**
 * Sprachkonstrukt2 Archive Widget
 *
 * @package	   	WordPress
 * @subpackage	Sprachkonstrukt2 Theme
 * @author     	Ruben Deyhle <ruben@sprachkonstrukt.de>
 * @url		   	http://sprachkonstrukt2.deyhle-webdesign.com
 */ 

class Sprachkonstrukt_RelatedFeatured_Widget extends WP_Widget {

	private $_featured_tag_id = 224;

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		'sprachkonstrukt_relatedfeatured_widget', // Base ID
			__('Sprachkonstrukt Related/Featured Widget', 'sprachkonstrukt'), // Name
			array( 'description' => __( 'Widget displaying related posts (post ids seperated by whitespace in custom field "related") or displaying featured posts having a specific tag', 'sprachkonstrukt' ) ) 		);
	}

	
	
	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args=array(), $instance=null ) {
		extract( $args );
		
		if ( is_singular() ) 
			return; // Related übernimmt YARPP
		
		echo $before_widget;
		
		//global $wp_query;
		//$post_id = $wp_query->post->ID;
		/*$value = get_post_meta( $post_id, 'related', TRUE );
		if ($value) {
		
			echo $before_title."Passend zum Thema".$after_title;
			$related = explode(" ", $value);
			print '<ul>';
			foreach($related as $id) {
				echo '<li><a href="'.get_permalink($id).'">'.get_the_title($id).'</a></li>';
			}
			print '</ul>';
		} else {
		*/
			
			echo $before_title."Auch lesenswert".$after_title;
			print '<ul>';
			 $args=array(
			    'tag__in' => array($this->_featured_tag_id),
			    'showposts'=>5,
			    'caller_get_posts'=>1
			   );
			  $my_query = new WP_Query($args);
			  if( $my_query->have_posts() ) {
			    while ($my_query->have_posts()) : $my_query->the_post(); ?>
			      <li><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
			      <?php
			    endwhile;
			  }
			  print '</ul>';
		//}
				
		
		
		echo $after_widget;
	}
}
?>