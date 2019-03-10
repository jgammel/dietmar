<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Dietmar_Winkler
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h2 class="entry-title">', '</h2>' );
		else :
			the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
		endif;
		
		if ( 'post' === get_post_type() ) : ?>
		<?php
		endif; 
		$body_text = apply_filters( 'the_content', get_the_content() );
		$the_date = get_post_meta($post->ID, 'drw_box_year', true);
		?>
		<div class="portfolio-details">
			<?php echo $body_text; ?>
			<p><?php echo $the_date; ?></p>
		<div class="post-navigtion">
		<?php 
		//Portfolio Navigation by Client or genre
		if(isset($_GET["nav_by"])){
			$page_tax = $_GET["nav_by"];
			$page_term = $_GET["term"];
		?>
			<div class="post-navigation-next">
		<?php
			next_post_link('%link', '▲', true, ' ', $page_tax);
		?>
			</div>
			<div class="post-navigation-prev">
		<?php
			previous_post_link('%link', '▼', true, ' ', $page_tax);
		?>
			</div>
		<?php
		}
		else{
		?>
		<div class="post-navigation-next">
		<?php
			next_post_link();
		?>
		</div>
		<div class="post-navigation-prev">
		<?php
			previous_post_link();
		?>
		</div>
		<?php
		}
		?>
		</div>
		</div>
		
		
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			$client_tax_array = get_the_terms(get_the_ID(), 'client'); //Client tag, i.e "M.I.T"
			if($client_tax_array == true){
				foreach ($client_tax_array as $client_object){
					$output = "<span class=\"client-term\">";
					$output .= ($client_object->{'name'});
					$output .= "</span>";
					echo $output;
				}
			}
			?>
			<div id="portfolio-slider">
				<?php
					$portfolio_nav_ids = get_post_meta( get_the_ID(), '_easy_image_gallery_v2', true ); //gets the IDs of media in the gallery
					$portfolio_shortcode_id = $portfolio_nav_ids[0]["SHORTCODE"];
					$portfolio_nav_array = $portfolio_nav_ids[0]["DATA"];
					foreach ($portfolio_nav_array as $portfolio_nav_item){
						echo("<div class=\"portfolio-main-item\">");
						echo("<p>");
						echo wp_get_attachment_image($portfolio_nav_item, "full", false);
						echo("</p>");
						echo("</div>");
					}
				?>
			</div><!-- #portfolio-slider -->
			<?php
			if( function_exists( 'easy_image_gallery' ) ) {
				echo easy_image_gallery($portfolio_shortcode_id);
			}
		?>
		
	<footer class="entry-footer">
		<?php drw_entry_footer(); ?>
	</footer><!-- .entry-footer -->
	
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
