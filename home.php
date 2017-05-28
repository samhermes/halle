<?php
/**
 * The template for displaying an overview of posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Harper
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<div class="intro-posts">
		<?php
		query_posts('showposts=5');

		if ( have_posts() ) :

			$first = true;

			while ( have_posts() ) : the_post();

				if ( has_post_thumbnail() ) {

					if ( ! false == $first ) {

						get_template_part( 'template-parts/content-featured' );

						$first = false;

					} else {

						get_template_part( 'template-parts/content-home' );

					}

				}

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		wp_reset_query(); ?>
		</div>

		</main>
	</div>

<?php
get_footer();
