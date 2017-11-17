<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package irc
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-header">
		<?php
				the_title( '<h3 class="entry-title">', '</h3>' );

		if ( 'post' === get_post_type() ) : ?>

		<?php
		endif; ?>
	</div><!-- .entry-header -->

	<div class="entry-content">
		<?php
			the_excerpt();
		?>
	</div><!-- .entry-content -->

	<div class="entry-footer">
		<a href="<?php the_permalink() ?>" rel="bookmark">Read More</a>
	</div><!-- .entry-footer -->
</article><!-- #post-## -->
