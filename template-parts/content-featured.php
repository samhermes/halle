<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Halle
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'home-featured' ); ?>>
	<header class="entry-header">
		<?php
		echo '<div class="image-wrap"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">';
		
		if ( has_post_thumbnail() ) {
			the_post_thumbnail( 'halle-post-3x2' );
		}
		
		echo '</a></div>';
		?>

		<div class="detail-wrap">
		<?php
		if ( 'post' === get_post_type() ) :

		echo '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">';

		the_title( '<h2 class="entry-title">', '</h2>' );
		
		echo '</a>';
		?>

		<div class="entry-meta">
			<?php halle_posted_on(); ?>
			<?php halle_posted_by(); ?>
		</div>
		<?php
		endif;

		the_excerpt(); ?>
		</div>
	</header>
</article>
