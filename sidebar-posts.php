<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Harper
 */
?>

<aside id="secondary" class="widget-area" role="complementary">
	<div class="latest-posts">
		<?php
			if ( is_single() ) {
				$exclude = array( get_the_ID() );
			}

			$args = array(
				'posts_per_page' => 4,
				'post__not_in' => $exclude,
			);
			$the_query = new WP_Query( $args );

			if ( $the_query->have_posts() ) {
				
				echo '<h2>Latest Posts</h2>';

				echo '<ul>';

				while ( $the_query->have_posts() ) {
					$the_query->the_post();

					echo '<li>';
					
					if ( get_the_post_thumbnail() ) {
						echo '<a href="' . get_the_permalink() . '">';
						the_post_thumbnail( 'post-3x2' );
					} else {
						echo '<a href="' . get_the_permalink() . '">';
					}

					echo '<h3>' . get_the_title() . '</h3></a>';

					echo '<div class="entry-meta">';
						harper_posted_on();
					echo '</div>';
					
					echo '</li>';
				}

				echo '</ul>';

				wp_reset_postdata();
			}
		?>
	</div>
</aside>
