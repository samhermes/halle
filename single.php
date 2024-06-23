<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Halle
 */

$post_layout  = get_theme_mod( 'post_layout' );
$layout_class = 'full-width' === $post_layout ? ' is-full-width' : '';

get_header(); ?>

<div id="content" class="site-content<?php echo esc_attr( $layout_class ); ?>">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_format() );

			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile;
		?>

		</main>
	</div>

	<?php get_sidebar( 'posts' ); ?>
</div>
<?php
get_footer();
