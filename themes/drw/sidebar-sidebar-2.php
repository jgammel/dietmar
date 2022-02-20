<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Dietmar_Winkler
 */

if ( ! is_active_sidebar( 'sidebar-2' ) ) {
	return;
}
?>

<aside id="sidebar-2" class="widget-area">
	<div class="site-branding">
	<?php

	$description = get_bloginfo( 'description', 'display' );
	if ( $description || is_customize_preview() ) : ?>
		<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
	<?php
	endif; ?>
</div><!-- .site-branding -->

<?php 

	if (is_archive() ){
		echo '<h2 class="widget-title">'.get_the_archive_title().' Archive</h2>';
		$archive_id = get_queried_object_id();
		//if the archive is not "Reflections + Follies, we can query all the posts in JUST this archive"
		if($archive_id !== 50){
			// WP_Query arguments
		$args = array(
			'post_type'              => array( 'post' ),
			'order'                  => 'DESC',
			'orderby'                => 'date',
			'tax_query' 			 => array(
		        array(
		            'taxonomy' => 'category',
		            'field'    => 'term_id',
		            'terms'    => $archive_id,
		        ),
		    ),
		);

		// The Query
		$cat_archive_query = new WP_Query( $args );

		// The Loop
		if ( $cat_archive_query->have_posts() ) {
			echo '<ul class="jaw_widget">';
			while ( $cat_archive_query->have_posts() ) {
				$cat_archive_query->the_post();
				echo '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
			}
			echo '</ul>';
		} else {
			// no posts found
		}

		// Restore original Post Data
		wp_reset_postdata();
		}

	}
?>

	<?php 

	if (is_single() ){

	 $categories = get_the_category();
	// for each $cat in $categories, get the cat_ID and store it in a strong we can pass to terms
	foreach($categories as $cat){
		if ($cat->cat_name !== 'Reflections + Follies'){
		// WP_Query arguments
		$args = array(
			'post_type'              => array( 'post' ),
			'order'                  => 'DESC',
			'orderby'                => 'date',
			'tax_query' 			 => array(
		        array(
		            'taxonomy' => 'category',
		            'field'    => 'term_id',
		            'terms'    => $cat->cat_ID,
		        ),
		    ),
		);

		// The Query
		$cat_archive_query = new WP_Query( $args );

		// The Loop
		if ( $cat_archive_query->have_posts() ) {
			echo '<h2 class="widget-title">'.$cat->cat_name.' Archive</h2>';
			echo '<ul class="jaw_widget">';
			while ( $cat_archive_query->have_posts() ) {
				$cat_archive_query->the_post();
				echo '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
			}
			echo '</ul>';
		} else {
			// no posts found
		}

		// Restore original Post Data
		wp_reset_postdata();
		}
	}

	}
	?>
</aside><!-- #secondary -->
