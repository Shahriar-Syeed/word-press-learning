<?php
get_header();
pageBanner();

?>
<!-- <div class="page-banner">
  <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/ocean.jpg'); ?>)"></div>
  <div class="page-banner__content container container--narrow">
    <h1 class="page-banner__title"><?php the_title(); ?></h1>
    <div class="page-banner__intro">
      <p>Keep up the latest news</p>
    </div>
  </div>
</div> -->
<div class="container container--narrow page-section">
  <?php
  while (have_posts()) {
    the_post();
  ?>
    <h2><?php the_title(); ?></h2>
    <div class="metabox metabox--position-up metabox--with-home-link">
      <p>
        <a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('event'); ?>"><i class="fa fa-home" aria-hidden="true"></i> Events Home </a>
        <span class="metabox__main"><?php the_title(); ?></span>
      </p>
    </div>
    <div class="generic-content"><?php the_content(); ?></div>
    <?php
    $relatedPrograms = get_field('related_programs');
    if ($relatedPrograms) {
      // print_r($relatedPrograms);
      echo '<hr class="section-break">';
      echo '<h2 class="headline headline--medium">Related Program(s)</h2>';
      echo '<ul class="link-list min-list">';
      foreach ($relatedPrograms as $program) {
    ?>
        <li class><a href="<?php the_permalink($program); ?>"><?php echo get_the_title($program); ?></a></li>

    <?php

      }
      echo '</ul>';
    }
    ?>

</div>

<?php
  }
  get_footer();
?>