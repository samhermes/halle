<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Halle
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'halle' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header>

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'archive' );

			endwhile;

			halle_pagination();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main>
	</section>

<?php
get_footer();
