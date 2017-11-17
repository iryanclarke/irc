<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package irc
 */

get_header('post'); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php
		while ( have_posts() ) : the_post();
		?>



		<div class="post-content">
			<div class="post-cms">
				<h2><?php the_title(); ?></h2>
				<div class="gravatar">
					<?php echo get_avatar( get_the_author_meta( 'ID' ), 32 ); ?>
				</div>
				<p class="author">
					by <?php echo get_the_author(); ?>
				</p>
				<p class="date-cat"><?php the_category( ', ', 'single' ); ?> | <?php echo get_the_date(); ?></p>

				<?php
				  if( has_post_thumbnail() ) {
						$image_url = get_the_post_thumbnail_url( null, 'large' );
						echo "<img class='featured-image' src='";
						echo $image_url;
						echo "' />";
					}
				?>

				<?php
				get_template_part( 'template-parts/content', 'page' );

				?>

			</div>
		</div>	<!-- #post-content -->
		<?php
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
