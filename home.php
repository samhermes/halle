<?php
/**
 * The template for displaying an overview of posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Halle
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		
		<?php
		$intro_query = new WP_Query( halle_get_featured_args() );

		if ( $intro_query->have_posts() && !is_paged() ) :
			echo '<div class="intro-posts">';
			$first = true;
			while ( $intro_query->have_posts() ) : $intro_query->the_post();
				if ( ! false == $first ) {

					get_template_part( 'template-parts/content', 'featured' );
					$first = false;

				} else {

					get_template_part( 'template-parts/content', 'home' );

				}
			endwhile;
			wp_reset_postdata();
			echo '</div>';
		endif; ?>

		<?php if ( have_posts() ) : ?>
		<div class="latest-feed archive">
			<h2 class="latest-heading"><?php esc_html_e( 'Latest', 'halle' ); ?></h2>
			<?php
			
				while ( have_posts() ) : the_post();
					
					get_template_part( 'template-parts/content', 'archive' );
				
				endwhile;
			
			halle_pagination(); ?>

		</div>
		<?php endif; ?>

		</main>
	</div>

<?php
get_footer();
