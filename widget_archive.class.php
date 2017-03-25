<?php
/**
 * Sprachkonstrukt2 Archive Widget
 *
 * MODIFIED @2013-12-30 to display all months, regardless of if there is a post or not
 */ 

class Sprachkonstrukt_Archive_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		'sprachkonstrukt_archive_widget', // Base ID
			__('Sprachkonstrukt Archive Widget', 'sprachkonstrukt'), // Name
			array( 'description' => __( 'Simple widget displaying links to monthly and yearly archives.', 'sprachkonstrukt' ) ) 		);
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
		$title = apply_filters( 'widget_title', $instance['title'] );
	
		// retrieve data
		global $wpdb; // Wordpress Database
	
		$years = $wpdb->get_results( "SELECT distinct year(post_date) AS year, count(ID) as posts FROM $wpdb->posts WHERE post_type = 'post' AND post_status = 'publish' GROUP BY year(post_date) ORDER BY post_date DESC" );
		
		if ( empty( $years ) ) {
			return; // empty archive
		}
		
		$oldest_year = end($years)->year; // we want an archive with all years since the beginning
		$years = array();
		for ($i = date("Y"); $i >= $oldest_year; $i--) {
   		$years[] = $i;
		}
		
		$months_short = apply_filters( 'sprachkonstrukt_archive_widget_months', array( '', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec' ) );
		$months_short = apply_filters( 'sprachkonstrukt_archive_widget_months', array( '', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12' ) );
		
		
	
	
		
		echo $before_widget;
		echo $before_title;
		
		if ( ! empty( $title ) ) {
			echo $title;
		} else {
			_e( 'Archiv', 'sprachkonstrukt' ); 
		}
		echo $after_title;

		?>
		<ul class="better-archives">
		<?php foreach ( $years as $year ) {
			print '<li><a class="year-link" href="' . get_year_link( $year ) . '">' . $year . '</a> ';
			
			for ( $month = 1; $month <= 12; $month++ ) {
				//if ( (int) $wpdb->get_var( "SELECT COUNT(ID) FROM $wpdb->posts WHERE post_type = 'post' AND post_status = 'publish' AND year(post_date) = '$year' AND month(post_date) = '$month'" ) > 0 ) {
				
				if ($month <= date("n") || $year < date("Y")) { // always show link, regardless of if there is a post in this month
					print '<a class="month-link" href="' . get_month_link( $year, $month ) . '">' . $months_short[$month] . '</a>';
				}
				
				if ( $month != 12 ) {
					print ' ';
				}
			}
			
			print '</li>';
		}
		
		print '</ul>';
		echo $after_widget;
	}
}
?>