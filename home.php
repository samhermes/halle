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
		
		<?php
		$args = array(
			'posts_per_page' => 4,
			'meta_query' => array(
				array(
					'key' => '_thumbnail_id'
				)
			),
		);
		$intro_query = new WP_Query( $args );

		if ( $intro_query->have_posts() && !is_paged() ) :
			echo '<div class="intro-posts">';
			$first = true;
			while ( $intro_query->have_posts() ) : $intro_query->the_post();
				if ( ! false == $first ) {

					get_template_part( 'template-parts/content-featured' );
					$first = false;

				} else {

					get_template_part( 'template-parts/content-home' );

				}
			endwhile;
			echo '</div>';
		endif; ?>

		<div class="latest-feed archive">
			<h3 class="latest-heading">Latest</h3>
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
