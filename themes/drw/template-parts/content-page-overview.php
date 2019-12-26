<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Dietmar_Winkler
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			$short_content = get_field('preview_text');
			if($short_content){
				echo("<p class=\"preview-text\">");
				the_field('preview_text');
				echo("&nbsp;");
				echo("<a class=\"read-more\">More</a>");
				echo("</p>");
				echo("<div class=\"hide-the-content\">");
				the_content();
				echo("<a class=\"read-less\">Less</a>");
				echo("</div>");
			}
			else{
				the_content();
			}

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'drw' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php 
		$portfolio_shortcode = get_field('portfolio_shortcode');
		if ($portfolio_shortcode) : ?>
		<footer class="entry-footer">
			<?php
				echo do_shortcode($portfolio_shortcode);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
