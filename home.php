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
		global $featured_posts;

		$args = array(
			'posts_per_page' => 4,
			'meta_query' => array(
				array(
					'key' => '_thumbnail_id'
				)
			),
		);

		$the_query = new WP_Query( $args );

		if ( $the_query->have_posts() && !is_paged() ) :
			echo '<div class="intro-posts">';
			$first = true;
			while ( $the_query->have_posts() ) : $the_query->the_post();
				if ( ! false == $first ) {

					get_template_part( 'template-parts/content-featured' );
					$featured_posts[] = $post->ID;
					$first = false;

				} else {

					get_template_part( 'template-parts/content-home' );
					$featured_posts[] = $post->ID;

				}
			endwhile;
			echo '</div>';
		endif;
		wp_reset_query(); ?>

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
