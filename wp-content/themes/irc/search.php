<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package irc
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<!-- Hero Banner -->
		<div class="parallax hero-banner" style="background-image: url(
		  <?php
		     echo get_stylesheet_directory_uri();
		     echo "/images/placeholders/placeholder.jpg";
		  ?>
		  );">
		  <div class="overlay">
		    <div class="overlay-wrapper">
		      <div class="overlay-content">
						  <h1>
								<span class="eyebrow">Search Results</span>
								 "<?php printf( esc_html__( '%s', 'irc' ), '<span>' . get_search_query() . '</span>' ); ?>"
							</h1>
							<a href="#search-results">
			          <button class="learn-more">
			            See results <span class="etmodules">&#x33;</span>
			          </button>
			        </a>
		      </div>
		    </div>
		  </div>
		</div>


		<div class="page-content" id="search-results">
			<!-- News CMS content -->
			<div class="page-cms">
				<div class="archive-flex">

					<?php
					if ( have_posts() ) : ?>

						<?php
						/* Start the Loop */
						while ( have_posts() ) : the_post();

							/**
							 * Run the loop for the search to output the results.
							 * If you want to overload this in a child theme then include a file
							 * called content-search.php and that will be used instead.
							 */
							get_template_part( 'template-parts/content', 'search' );

						endwhile;


					else :

						get_template_part( 'template-parts/content', 'none' );

					endif; ?>

				</div>
				<div class="info-footer">
					<?php if ( get_next_posts_link() ) : ?>
					<div class="older-posts">
						<h3><?php next_posts_link(__('View More Results', 'irc')); ?></h3>
					<?php endif; ?>
					<p>Not finding what you are looking for? <a href="/support/">Ask for help!</a></p>
				</div>
			</div>


		</div>	<!-- #post-content -->



		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();
