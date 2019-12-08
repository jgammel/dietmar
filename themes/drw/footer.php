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

	<footer id="colophon" class="site-footer" style="display:none;">
		<?php
			//outputs a list of portfolio item by year
			// WP_Query arguments
			$args = array(
				'post_type'              => array( 'portfolio' ),
				'post_status'            => array( 'publish' ),
				'meta_key' 				 => 'drw_box_year',
	            'orderby' 				 => 'meta_value_num',
				'order'                  => 'ASC',
				'posts_per_page'		 => -1,
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
					$the_thumbnail = get_the_post_thumbnail();
					$term_args = array(
						'fields' => 'slugs',
					);
					$the_genre = wp_get_object_terms($post->ID,'genre',$term_args);
					$item_array = [];
					$item_array['date'] = $the_date;
					$item_array['title'] = $the_title;
					$item_array['link'] = $the_link;
					$item_array['genre'] = $the_genre;
					$item_array['thumbnail'] = $the_thumbnail;
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
/*
			if($decade !== []){
				$earliest_year = $decade[0]['date'];
				$zero_year_a = substr($earliest_year, 0, -2);
				$zero_year_b = substr($earliest_year, -2, 1);
				$zero_year_b .= "0";
				echo("<div class=\"timeline-zero-year\"><p>".$zero_year_a."</p><div class=\"timeline-segment\"></div><strong>".$zero_year_b."</strong></div>");
			}
*/
			$i = 1;

			while($i < 10){
				if ($i == 5){
					echo("<div class=\"timeline-segment half\">"); //ex: .timeline-segment.5
					echo("</div>");
				}
				else{
					echo("<div class=\"timeline-segment ".$i."\">"); //ex: .timeline-segment.1
					echo("</div>");
				}
				$i++;
			}


			echo("<div class=\"timeline-item-container\">");
			foreach($decade as $year){
				if($year){
					$specific_year = substr($year['date'], -1, 1);
					$specific_genre = $year['genre'];
					$specific_link = $year['link'];
					$genre = [];
					if ($specific_genre !== []){
						foreach($specific_genre as $key => $value){
							array_push($genre, $value);
						}
					}
					else{
						array_push($genre, "null-genre");
					}
					$genre_implode = implode(' ', $genre);
					echo("<div class=\"timeline-data area{$specific_year}\" data-name=\"{$genre_implode}\">");
					echo("<a href=\"{$specific_link}\"class=\"timeline-ball\">");
					echo("</a>");
					echo("<div class=\"hover-box hidden\">");
					echo("<div class=\"thumbnail\">");
					echo($year['thumbnail']);
					echo("</div>");
					echo("<div class=\"title\">");
					echo($year['title']);
					echo("</div>");
					echo("</div>");
					echo("</div>"); // < /timeline-data >
				}
			}
			echo("</div>");
		}
		?>
		<div id="timeline">
			<!-- TODO: Infinite Decades. Imagine a giant screen or smart TV. -->
			<div class="decade forties">
				<div class="timeline-segment"></div>
				<div class="timeline-segment"></div>
				<div class="timeline-segment"></div>
				<div class="timeline-segment"></div>
			</div>
			<div class="decade fifties">
				<div class="timeline-zero-year"><p>19</p><div class="timeline-segment"></div><strong>50</strong></div>
				<?php timeline_dump($fifties);?>
			</div>
			<div class="decade sixties">
				<div class="timeline-zero-year"><p>19</p><div class="timeline-segment"></div><strong>60</strong></div>
				<?php timeline_dump($sixties);?>
			</div>
			<div class="decade seventies">
				<div class="timeline-zero-year"><p>19</p><div class="timeline-segment"></div><strong>70</strong></div>
				<?php timeline_dump($seventies);?>
			</div>
			<div class="decade eighties">
				<div class="timeline-zero-year"><p>19</p><div class="timeline-segment"></div><strong>80</strong></div>
				<?php timeline_dump($eighties);?>
			</div>
			<div class="decade nineties">
				<div class="timeline-zero-year"><p>19</p><div class="timeline-segment"></div><strong>90</strong></div>
				<?php timeline_dump($nineties);?>
			</div>
			<div class="decade oughts">
				<div class="timeline-zero-year"><p>20</p><div class="timeline-segment"></div><strong>00</strong></div>
				<?php timeline_dump($oughts);?>
			</div>
			<div class="decade oughteens">
				<div class="timeline-zero-year"><p>20</p><div class="timeline-segment"></div><strong>10</strong></div>
				<?php timeline_dump($oughteens);?>
			</div>
			<div class="infinity">
			<!-- Javascript in mian.js will add extra timeline segments here as needed. -->
			</div>
		</div><!-- #timeline -->
		<div id="timeline-sort-bar">
			<div class="sort-button filters" data-name="filters">Filters</div>
			<div class="sort-button selected" data-name="all">All Genres</div>
			<div class="sort-button" data-name="education">Education</div>
			<div class="sort-button" data-name="institutions">Institutions</div>
			<div class="sort-button" data-name="publications">Publications</div>
			<div class="sort-button" data-name="corporations">Corporations</div>
		</div><!-- #timeline-sort-bar -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
