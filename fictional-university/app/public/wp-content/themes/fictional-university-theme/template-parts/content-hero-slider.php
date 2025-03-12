<?php
$slide = array(
  'post_type' => 'slide',
  'posts_per_page'
);

$heroSlide = new WP_Query($slide);

if ($heroSlide->have_posts()) {
?>
  <div class="hero-slider" id="glideSlider">
    <div data-glide-el="track" class="glide__track">
      <div class="glide__slides">
        <?php
        while ($heroSlide->have_posts()) {
          $heroSlide->the_post();

        ?>
          <div class="hero-slider__slide" style="background-image: url(<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>)">
            <div class="hero-slider__interior container">
              <div class="hero-slider__overlay">
                <h2 class="headline headline--medium t-center"><?php the_title(); ?></h2>
                <p class="t-center"><?php
                                    if (has_excerpt()) {
                                      echo get_the_excerpt();
                                    } else {
                                      echo wp_trim_words(get_the_content(), 10);
                                    }
                                    ?></p>
                <p class="t-center no-margin"><a href="<?php the_permalink(); ?>" class="btn btn--blue">Learn more</a></p>
              </div>
            </div>
          </div>
          <!-- <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('images/apples.jpg'); ?>)">
            <div class="hero-slider__interior container">
              <div class="hero-slider__overlay">
                <h2 class="headline headline--medium t-center">An Apple a Day</h2>
                <p class="t-center">Our dentistry program recommends eating apples.</p>
                <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
              </div>
            </div>
          </div>
          <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('images/bread.jpg'); ?>)">
            <div class="hero-slider__interior container">
              <div class="hero-slider__overlay">
                <h2 class="headline headline--medium t-center">Free Food</h2>
                <p class="t-center">Fictional University offers lunch plans for those in need.</p>
                <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
              </div>
            </div>
          </div> -->
        <?php
        }
        wp_reset_postdata();
        ?>
      </div>
      <div class="slider__bullets glide__bullets" data-glide-el="controls[nav]"></div>
    </div>
  </div>

<?php

}

?>