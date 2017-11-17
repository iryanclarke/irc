<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package irc
 */

?>

<div class="archive-item">
    <div class="row">
        <div class="archive-content">
            <a href="<?php the_permalink(); ?>">
              <div class="featured-title">
                  <h3><?php the_title(); ?></h3>
              </div><!-- .featured-title -->
            </a>
            <div class="featured-excerpt">
                <?php the_excerpt(); ?>
            </div><!-- .featured-excerpt -->
            <div class="featured-more">
                <a href="<?php the_permalink(); ?>"><?php echo apply_filters( 'irc_read_more_text', __( 'Visit Page', BFRP_TEXT_DOMAIN ), get_the_ID() ); ?><span class="etmodules"> &#x35;</span></a>
            </div><!-- .featured-more -->
        </div>
    </div><!-- .row -->
</div><!-- End .events-item -->
