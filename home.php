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
		global $featured_posts;
		query_posts('showposts=4');

		if ( have_posts() ) :
			$first = true;
			while ( have_posts() ) : the_post();
				if ( has_post_thumbnail() ) {
					if ( ! false == $first ) {

						get_template_part( 'template-parts/content-featured' );
						$featured_posts[] = $post->ID;
						$first = false;

					} else {

						get_template_part( 'template-parts/content-home' );
						$featured_posts[] = $post->ID;

					}
				}
			endwhile;
		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		wp_reset_query(); ?>
		</div>

		<div class="latest-feed archive">
			<?php
			if ( have_posts() ) :
				while ( have_posts() ) : the_post();
					
					get_template_part( 'template-parts/content', 'archive' );
				
				endwhile;
			
			harper_pagination();

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;
			?>
		</div>

		</main>
	</div>

<?php
get_footer();
