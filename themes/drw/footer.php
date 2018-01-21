<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Dietmar_Winkler
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<?php
			//outputs a list of portfolio item by year
			// WP_Query arguments
			$args = array(
				'post_type'              => array( 'portfolio' ),
				'post_status'            => array( 'publish' ),
				'meta_key' 				 => 'drw_box_year',
	            'orderby' 				 => 'meta_value_num',
				'order'                  => 'ASC',
			);
			
			// The Query
			$dates = new WP_Query( $args );
			$timeline_array = [];
			// The Loop
			if ( $dates->have_posts() ) {
				while ( $dates->have_posts() ) {
					$dates->the_post();
					?>
					<?php
					$the_date = get_post_meta($post->ID, 'drw_box_year', true);
					$the_title = get_the_title();
					$the_link = get_the_permalink();
					$item_array = [];
					$item_array['date'] = $the_date;
					$item_array['title'] = $the_title;
					$item_array['link'] = $the_link;
					array_push($timeline_array, $item_array);
					?>
					<?php
				}
			} else {
				// no posts found
			}
			
			// Restore original Post Data
			wp_reset_postdata();

		?>
		<div id="timeline">
			<ul>
				<li><span class="timeline-segment"></span></li>
				<li><span class="timeline-segment"></span></li>
				<li><span class="timeline-segment"></span></li>
				<li><span class="timeline-segment"></span></li>
				<li><span class="timeline-segment"></span></li>
				<li><div class="date">19<span class="divider"></span><strong>50</strong></div></li>
				<li><span class="timeline-segment"></span></li>
				<li><span class="timeline-segment"></span></li>
				<li><span class="timeline-segment"></span></li>
				<li><span class="timeline-segment"></span></li>
				<li><span class="timeline-segment"></span></li>
				<li><div class="date">19<span class="divider"></span><strong>60</strong></li></li>
				<li><span class="timeline-segment"></span></li>
				<li><span class="timeline-segment"></span></li>
				<li><span class="timeline-segment"></span></li>
				<li><span class="timeline-segment"></span></li>
				<li><span class="timeline-segment"></span></li>
				<li><div class="date">19<span class="divider"></span><strong>70</strong></div></li>
				<li><span class="timeline-segment"></span></li>
				<li><span class="timeline-segment"></span></li>
				<li><span class="timeline-segment"></span></li>
				<li><span class="timeline-segment"></span></li>
				<li><span class="timeline-segment"></span></li>
				<li><div class="date">19<span class="divider"></span><strong>80</strong></div></li>
				<li><span class="timeline-segment"></span></li>
				<li><span class="timeline-segment"></span></li>
				<li><span class="timeline-segment"></span></li>
				<li><span class="timeline-segment"></span></li>
				<li><span class="timeline-segment"></span></li>
				<li><div class="date">19<span class="divider"></span><strong>90</strong></div></li>
				<li><span class="timeline-segment"></span></li>
				<li><span class="timeline-segment"></span></li>
				<li><span class="timeline-segment"></span></li>
				<li><span class="timeline-segment"></span></li>
				<li><span class="timeline-segment"></span></li>
				<li><div class="date">20<span class="divider"></span><strong>00</strong></div></li>
				<li><span class="timeline-segment"></span></li>
				<li><span class="timeline-segment"></span></li>
				<li><span class="timeline-segment"></span></li>
				<li><span class="timeline-segment"></span></li>

			</ul>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
