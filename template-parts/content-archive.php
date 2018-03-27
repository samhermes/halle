<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Halle
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		if ( has_post_thumbnail() ) {
			echo '<div class="featured-image">';
			the_post_thumbnail( 'halle-post-3x2-small' );
			echo '</div>';
		}
	?>

	<header class="entry-header">
		<?php
		if ( is_home() ) {
			the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
		} else {
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		}
			
		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php halle_posted_on(); ?>
			<?php halle_posted_by(); ?>
		</div>
		<?php
		endif; ?>
	</header>
</article>
