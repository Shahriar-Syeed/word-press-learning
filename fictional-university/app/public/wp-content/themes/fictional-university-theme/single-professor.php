<?php
get_header();
pageBanner();
?>
<!-- <div class="page-banner">
  <div class="page-banner__bg-image" style="background-image: url(<?php $pageBannerImage = get_field('page_banner_background_image');
                                                                  if ($pageBannerImage) {
                                                                    // echo $pageBannerImage['url'];
                                                                    echo $pageBannerImage['sizes']['pageBanner'];
                                                                  } else {
                                                                    echo get_theme_file_uri('images/ocean.jpg');
                                                                  } ?>)"></div>

  <div class="page-banner__content container container--narrow">
    <h1 class="page-banner__title"><?php the_title(); ?></h1>
    <div class="page-banner__intro">
      <p><?php if (the_field('page_banner_subtitle')) {
            the_field('page_banner_subtitle');
          } ?></p>
    </div>
  </div>
</div> -->
<div class="container container--narrow page-section">
  <!-- <?php print_r($pageBannerImage); ?> -->
  <?php
  while (have_posts()) {
    the_post();
  ?>
    <!-- <div class="metabox metabox--position-up metabox--with-home-link">
      <p>
        <a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('event'); ?>"><i class="fa fa-home" aria-hidden="true"></i> Events Home </a>
        <span class="metabox__main"><?php the_title(); ?></span>
      </p>
    </div> -->
    <div class="generic-content">
      <div class="row group">
        <div class="one-third">
          <?php the_post_thumbnail('professorPortrait'); ?>
        </div>
        <div class="two-third">
          <?php
          $likeCount =  new WP_Query(array(
            'post_type' => 'like',
            'meta_query' => array(
              array(
                'key' => 'liked_professor_id',
                'compare' => '=',
                'value' => get_the_ID(),
              ),
            ),
          ));

          $existStatus = 'no';

          if (is_user_logged_in()) {

            $existQuery =  new WP_Query(array(
              'author' => get_current_user_id(),
              'post_type' => 'like',
              'meta_query' => array(
                array(
                  'key' => 'liked_professor_id',
                  'compare' => '=',
                  'value' => get_the_ID(),
                ),
              ),
            ));

            if ($existQuery->found_posts) {
              $existStatus = 'yes';
            }
          }

          ?>
          <span class="like-box" data-professor="<?php the_ID(); ?>" data-exists="<?php echo $existStatus; ?>">
            <i class="fa fa-heart-o" aria-hidden="true"></i>
            <i class="fa fa-heart" aria-hidden="true"></i>
            <span class="like-count"><?php echo $likeCount->found_posts ?></span>
          </span>
          <?php the_content(); ?>
        </div>
      </div>
    </div>
    <?php
    $relatedPrograms = get_field('related_programs');
    if ($relatedPrograms) {
      // print_r($relatedPrograms);
      echo '<hr class="section-break">';
      echo '<h2 class="headline headline--medium">Subject(s) Taught</h2>';
      echo '<ul class="link-list min-list">';
      foreach ($relatedPrograms as $program) {
    ?>
        <li class><a href=" <?php the_permalink($program); ?>"><?php echo get_the_title($program); ?></a></li>

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