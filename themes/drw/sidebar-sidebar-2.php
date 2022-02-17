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

<aside id="secondary" class="widget-area">
	<div class="site-branding">
	<?php

	$description = get_bloginfo( 'description', 'display' );
	if ( $description || is_customize_preview() ) : ?>
		<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
	<?php
	endif; ?>
</div><!-- .site-branding -->
	<?php $categories = get_the_category(); 
	$catID = $categories[0]->cat_ID;  ?>
	<?php dynamic_sidebar( 'sidebar-2' ); ?>
	<?php // WP_Query arguments
	$args = array(
		'post_type'              => array( 'post' ),
		'order'                  => 'DESC',
		'orderby'                => 'date',
		'tax_query' 			 => array(
	        array(
	            'taxonomy' => 'category',
	            'field'    => 'term_id',
	            'terms'    => $catID,
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
	?>
</aside><!-- #secondary -->
