<?php

// Display of an individual events article - to be used within "the loop"

?>
<div class="archive-item">
    <div class="row">
        <div class="archive-content">
            <a href="<?php the_permalink(); ?>">
              <div class="featured-title">
                <h3><?php the_title(); ?></h3>
            </a>
            </div><!-- .featured-title -->
            <div class="featured-meta">
              <?php echo get_avatar( get_the_author_meta( 'ID' ), 32 ); ?>
              <p class="author">
                by <?php echo get_the_author(); ?>&nbsp;&nbsp;| &nbsp;

                <?php the_category( ', ', 'single' ); ?> &nbsp;  | &nbsp;  <?php echo get_the_date(); ?>
              </p>
            </div>
            <div class="featured-excerpt">
                <?php the_excerpt(); ?>
            </div><!-- .featured-excerpt -->
            <div class="featured-more">
                <a href="<?php the_permalink(); ?>"><?php echo apply_filters( 'irc_read_more_text', __( 'Keep reading', BFRP_TEXT_DOMAIN ), get_the_ID() ); ?><span class="etmodules"> &#x35;</span></a>
            </div><!-- .featured-more -->
        </div>
    </div><!-- .row -->
</div><!-- End .events-item -->
