<?php

if (!empty($attributes['themeimage'])) {
  $attributes['imageURL'] = get_theme_file_uri('/images/' . $attributes['themeimage']);
}

if (!isset($attributes['imageURL'])) {
  $attributes['imageURL'] = get_theme_file_uri('/images/library-hero.jpg');
}

?>
<div class="hero-slider">
  <div data-glide-el="track" class="glide__track">
    <div class="glide__slides">
      <?php echo $content; ?>
    </div>
    <div class="slider__bullets glide__bullets" data-glide-el="controls[nav]"></div>
  </div>
</div>