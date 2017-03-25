<?php
/**
 * Theme Footer
 *
 * @package	   	WordPress
 * @subpackage	Sprachkonstrukt3 Theme
 * @author     	Ruben Deyhle <ruben@sprachkonstrukt.de>
 * @url		   	http://sprachkonstrukt2.deyhle-webdesign.com
 */
 ?>
	 	<footer id="footer">
			<ul id="sidebar-bottom">
				
				
				
				
				<?php if ( dynamic_sidebar('Bottom Sidebar') ) : else : ?>
					
				<?php endif; ?> 
				
				
				
				
			</ul>
			<span class="eof">EoF</span>
	 	</footer>
	 	<?php wp_footer(); ?>
 	</body>
 </html>