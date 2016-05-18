<?php
/**
 * Template Name: Homeslider
 */

get_header(); ?>
<?php get_template_part( 'template-parts/content', 'slider' ); ?>

<div class="container<?php echo get_fluid_toggle() ?>">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div>
<?php
get_sidebar();
get_footer();
