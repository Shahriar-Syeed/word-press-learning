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
        <a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('campus'); ?>"><i class="fa fa-home" aria-hidden="true"></i> All Campuses</a>
        <span class="metabox__main"><?php the_title(); ?></span>
      </p>
    </div>
    <div class="genetic-content"><?php the_content(); ?></div>

    <?php
    $today = date('Ymd');

    $relatedPrograms = new WP_Query(array(
      'posts_per_page' => -1,
      'post_type' => 'program',
      'orderby' => 'title',
      // 'orderby' => 'rand',
      // 'meta_key' => 'professor_date',
      'orderby' => 'title',
      // 'order' => 'DESC',
      'order' => 'ASC',
      'meta_query' => array(
        array(
          'key' => 'related_campus',
          'compare' => 'LIKE',
          'value' => '"' .  get_the_ID() . '"',
        ),
      ),
    ));

    if ($relatedPrograms->have_posts()) {
      echo '<hr class="section-break">';
      echo '<h2 class="headline headline--medium"> ' . get_the_title() . ' Program(s) Available At This Campus</h2>';
      echo '<ul class="min-list link-list">';
      while ($relatedPrograms->have_posts()) {
        $relatedPrograms->the_post();
    ?>
        <li>
          <a href="<?php the_permalink(); ?>">
            <?php the_title(); ?>
          </a>
        </li>

    <?php
      }
      echo '</ul>';
    }
    wp_reset_postdata();

    ?>
</div>

<?php
  }
  get_footer();
?>