<?php
/**
 * Theme Search Form
 *
 * @package	   	WordPress
 * @subpackage	Sprachkonstrukt2 Theme
 * @author     	Ruben Deyhle <ruben@sprachkonstrukt.de>
 * @url		   	http://sprachkonstrukt2.deyhle-webdesign.com
 */
 ?>
 
<form method="get" id="searchform" action="<?php echo home_url(); ?>/">
	<p>
		<input type="search" value="<?php the_search_query(); ?>" name="s" id="s" pattern=".+" required="required" placeholder="<?php esc_attr_e('Suchbegriff', 'sprachkonstrukt'); ?>" />
		<input type="submit" id="searchsubmit" value="<?php esc_attr_e('Suchen', 'sprachkonstrukt'); ?>" />
	</p>
</form>