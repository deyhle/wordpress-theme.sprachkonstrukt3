<?php
/**
 * Template for Comments
 *
 * @package	   	WordPress
 * @subpackage	Sprachkonstrukt2 Theme
 * @author     	Ruben Deyhle <ruben@sprachkonstrukt.de>
 * @url		   	http://sprachkonstrukt.deyhle-webdesign.com
 */
?>
<div class="entry_commentarea">
	<?php	if ( post_password_required() ) : ?>
				<p><?php _e( 'This post is password protected. Enter the password to view any comments.', 'sprachkonstrukt' ); ?></p>
		<?php
				return;
			endif; ?>



<?php if ( have_comments() ) : ?>
				<h2 id="comments">Kommentare</h2>
				<ul class="pinglist">
					<?php wp_list_comments('type=pings&callback=sprachkonstrukt_ping'); ?>
				</ul>
				<ul class="commentlist">
					<?php wp_list_comments('type=comment&callback=sprachkonstrukt_comment'); ?>
				</ul>
				<div class="navigation">
					<div class="alignleft"><?php previous_comments_link() ?></div>
					<div class="alignright"><?php next_comments_link() ?></div>
				</div>
<?php endif; ?>

<?php if ( comments_open() ) : ?>

<?php comment_form(	array (
 					'fields'  => apply_filters( 'comment_form_default_fields', array (
 						'author' => '<input id="author" name="author" type="text" value="" placeholder="Name" />',
						'email' => '<input id="email" name="email" type="email" value="" placeholder="eMail" />',
						'url' =>  '<input id="url" name="url" type="url" value="" placeholder="Website" />'
 					) ),
					'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" required placeholder="Kommentar"></textarea></p>', 
					'title_reply' => __('Kommentieren', 'sprachkonstrukt'), 
					'title_reply_to' => __('Antwort auf %s', 'sprachkonstrukt'),
					'comment_notes_before' => '',
					 
					 // In Germany, you should consider to use the following and insert a link to your legal notice page.
						
						'comment_notes_after' => '
						<p class="legal_notice">Mit dem Absenden eines Kommentars bestätigst du, die <a href="http://sprachkonstrukt.de/rechtliches/#datenschutz">Datenschutzbestimmungen</a> gelesen und verstanden zu haben.</p>' 
					 
					  )); ?>
					  
					 
<?php endif; ?>				
</div>