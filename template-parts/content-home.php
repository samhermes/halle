<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Harper
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('home-small'); ?>>
	<header class="entry-header">
		<?php
		if ( get_the_post_thumbnail() ) {
			echo '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">';
			the_post_thumbnail( 'post-3x2-small' );
		} else {
			echo '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">';
		}
		
		the_title( '<h2 class="entry-title">', '</h2></a>' );

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php harper_posted_on(); ?>
			<?php harper_byline(); ?>
		</div>
		<?php
		endif; ?>
	</header>
</article>
