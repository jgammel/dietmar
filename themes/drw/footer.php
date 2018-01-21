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
		<?php 
			$fifties = [];
			$sixties = [];
			$seventies = [];
			$eighties = [];
			$nineties = [];
			$oughts = [];
			$oughteens = [];
			foreach ($timeline_array as $item_array){
				$the_date = $item_array['date'];
				$the_date = substr($the_date, 0, 3);//get first three digits of date
				if($the_date == "195"){
					array_push($fifties, $item_array);
				}
				if($the_date == "196"){
					array_push($sixties, $item_array);
				}
				if($the_date == "197"){
					array_push($seventies, $item_array);
				}
				if($the_date == "198"){
					array_push($eighties, $item_array);
				}
				if($the_date == "199"){
					array_push($nineties, $item_array);
				}
				if($the_date == "200"){
					array_push($oughts, $item_array);
				}
				if($the_date == "201"){
					array_push($oughteens, $item_array);
				}
		}
		function timeline_dump($decade){
			$i = 0;
			while($i < 10){
				echo("<div class=\"timeline-segment ".$i."\">");
				echo("</div>");
				$i++;
			}
			if($decade !== []){
				$earliest_year = $decade[0]['date'];
				$zero_year_a = substr($earliest_year, 0, -2);
				$zero_year_b = substr($earliest_year, -2, 1);
				$zero_year_b .= "0";
				echo("<div class=\"timeline-zero-year\">".$zero_year_a."<div class=\"timeline-segment\"></div><strong>".$zero_year_b."</strong></div>");
			}
			echo("<div class=\"timeline-item-container\">");
			foreach($decade as $year){
				if($year){
					echo("<div class=\"timeline-ball\">");
					echo("</div>");
					echo("<div class=\"title hidden\">");
					echo($year['title']);
					echo("</div>");
				}
			}
			echo("</div>");
		}
		?>
		<div id="timeline">
			<div class="decade fifties">
				<?php timeline_dump($fifties);?>
			</div>
			<div class="decade sixties">
				<?php timeline_dump($sixties);?>
			</div>
			<div class="decade seventies">
				<?php timeline_dump($seventies);?>
			</div>
			<div class="decade eighties">
				<?php timeline_dump($eighties);?>
			</div>
			<div class="decade nineties">
				<?php timeline_dump($nineties);?>
			</div>
			<div class="decade oughts">
				<?php timeline_dump($oughts);?>
			</div>
			<div class="decade oughteens">
				<?php timeline_dump($oughteens);?>
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
