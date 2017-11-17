<?php

// To display a hero banner used within a page/post/cpt

?>
<!-- Hero Banner -->
<div class="parallax hero-banner" style="background-image: url(
  <?php
   if(has_post_thumbnail()) {
     $thumb_url = the_post_thumbnail_url();
     echo $thumb_url;
   }
   else {
     echo get_stylesheet_directory_uri();
     echo "/images/placeholders/placeholder.jpg";
   }
  ?>
  );">
  <div class="overlay">
    <div class="overlay-wrapper">
      <div class="overlay-content">
        <h1>
          <span class="eyebrow">
            <?php
                  $hero_title = get_post_meta( $post->ID, 'hero_title', true );
                  if ($hero_title) {
                    echo $hero_title;
                  }
                  else {
                    the_title();
                  }
            ?>
          </span>
          <?php
            $hero_subtitle = get_post_meta( $post->ID, 'hero_subtitle', true );
            if ($hero_subtitle) {
              echo $hero_subtitle;
            }
          ?>
        </h1>
        <p class="large">
          <?php
          $hero_paragraph_text = get_post_meta( $post->ID, 'hero_paragraph_text', true );

          if ($hero_paragraph_text) {
            echo $hero_paragraph_text;
          }

          ?>
        </p>
      </div>
    </div>
  </div>
</div>
