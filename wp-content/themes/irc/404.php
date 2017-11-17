<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package irc
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<!-- Hero Banner -->
				<div class="parallax hero-banner" style="background-image: url(
				  <?php
				     echo get_stylesheet_directory_uri();
				     echo "/images/placeholders/404.jpg";
				  ?>
				  );">
				<div class="overlay">
			    <div class="overlay-wrapper">
			      <div class="overlay-content">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logos/dld-logo.svg" alt="irc logo">
			        <h1><?php _e("You got lost!", 'irc'); ?></h1>
			        <a href="/">
			          <button class="learn-more">
			            Back to home
			          </button>
			        </a>
			      </div>
			    </div>
			  </div>
			</div>
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
