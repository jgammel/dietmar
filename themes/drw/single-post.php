<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Dietmar_Winkler
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content-single-post', get_post_type() );

			?>
			<div class="visually-hidden">
			<?php the_post_navigation();?>
			</div>
			
			<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php


in_category('reflections-follies') ? get_sidebar() : null;

in_category(array('influences','colleagues','history','philosophy','curriculum','lectures','articles','papers','presentations','design-criticisms','opinions')) ? get_sidebar('sidebar-2') : null;

get_footer('overview');
