<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Harper
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		if ( get_the_post_thumbnail() ) {
			echo '<div class="featured-image">';
			the_post_thumbnail( 'post-3x2' );
			echo '</div>';
		}
	?>

	<header class="entry-header">
		<?php
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php harper_posted_on(); ?>
			<?php harper_byline(); ?>
		</div>
		<?php
		endif; ?>
	</header>

	<div class="entry-content">
		<?php
			the_excerpt();
		?>
	</div>
</article>
