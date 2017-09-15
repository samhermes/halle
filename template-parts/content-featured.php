<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Harper
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'home-featured' ); ?>>
	<header class="entry-header">
		<?php
		echo '<div class="image-wrap"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">';
		the_post_thumbnail( 'post-3x2' );
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
			<?php harper_posted_on(); ?>
			<?php harper_byline(); ?>
		</div>
		<?php
		endif;

		the_excerpt(); ?>
		</div>
	</header>
</article>
