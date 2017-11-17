<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package irc
 */

get_header();

//Default image url
$hero_background_url = get_stylesheet_directory_uri() . "/images/placeholders/placeholder.jpg";

//Get the category
$cats = get_the_category();
$category = ( !empty( $cats ) ) ? $cats[0] : false;

?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<!-- Hero Banner -->
			<div class="parallax hero-banner" style="background-image: url(<?php echo $hero_background_url; ?>);">
				<div class="overlay">
				    <div class="overlay-wrapper">
						<div class="overlay-content">
							<h1>
								<span class="eyebrow"><?php _e('News'); ?></span>
								<?php if ( $category ) echo $category->name; ?>
							</h1>
							<?php if ( $category && !empty( $category->description ) ) : ?>
							<p><?php _e( $category->description ); ?></p>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>

			<div class="page-content" id="learn-more-target">
				<!-- News CMS content -->
				<div class="page-cms">

					<?php get_template_part( 'template-parts/layout', 'blog-nav' ); ?>

					<div class="archive-flex">

						<?php
							while( have_posts() ) : the_post();

								get_template_part( 'template-parts/content', 'archive-item' );

						?>

						<?php endwhile; ?>
					</div>

					<div class="post-footer">
						<?php if( get_next_posts_link() ) : ?>
						<div class="older-posts">
							<h3><?php next_posts_link( __( 'Older Posts', 'irc' ) ); ?></h3>
						</div>
						<?php endif; ?>

						<!-- Begin MailChimp Signup Form -->
						<div id="mc_embed_signup">
							<form action="//dataexpedition.us15.list-manage.com/subscribe/post?u=79e61588cf5527d323bf4d397&amp;id=29168bb634" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
								<div id="mc_embed_signup_scroll">
									<div class="mc-field-group">
										<input type="email" value="" name="EMAIL" placeholder="Your email" class="required email" id="mce-EMAIL">
										<input type="submit" value="Subscribe for new posts" name="subscribe" id="mc-embedded-subscribe" class="button">
									</div>
									<div id="mce-responses" class="clear">
										<div class="response" id="mce-error-response" style="display:none"></div>
										<div class="response" id="mce-success-response" style="display:none"></div>
									</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
									<div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_01757fc79264d77a22b8685e2_1d90dffd5d" tabindex="-1" value=""></div>
								</div>
							</form>
						</div>
						<!--End mc_embed_signup-->
					</div>



				</div>
			</div>	<!-- #post-content -->


		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
