<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _businessportfolio
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
      <?php
      if ( is_active_sidebar( 'footer-1' ) ) {
        dynamic_sidebar( 'footer-1' );
      } else { ?>
  			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'businessportfolio' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'businessportfolio' ), 'WordPress' ); ?></a>
  			<span class="sep"> | </span>
  			<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'businessportfolio' ), 'Business Portfolio', '<a href="http://carlalberto.ml/" rel="designer">Carl Alberto</a>' );
      } ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
