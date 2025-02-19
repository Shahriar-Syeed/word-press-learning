<?php
get_header();

?>
<div class="page-banner">
  <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/ocean.jpg'); ?>)"></div>
  <div class="page-banner__content container container--narrow">
    <h1 class="page-banner__title"><?php the_title(); ?></h1>
    <div class="page-banner__intro">
      <p>Keep up the latest news</p>
    </div>
  </div>
</div>
<div class="container container--narrow page-section">
  <?php
  while (have_posts()) {
    the_post();
  ?>
    <h2><?php the_title(); ?></h2>
    <div class="metabox metabox--position-up metabox--with-home-link">
      <p>
        <a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('program'); ?>"><i class="fa fa-home" aria-hidden="true"></i> All Programs</a>
        <span class="metabox__main"><?php the_title(); ?></span>
      </p>
    </div>
    <div class="genetic-content"><?php the_content(); ?></div>

    <?php
    $today = date('Ymd');

    $relatedProfessors = new WP_Query(array(
      'posts_per_page' => -1,
      'post_type' => 'professor',
      // 'orderby' => 'title',
      // 'orderby' => 'rand',
      // 'meta_key' => 'professor_date',
      'orderby' => 'title',
      // 'order' => 'DESC',
      'order' => 'ASC',
      'meta_query' => array(
        array(
          'key' => 'related_programs',
          'compare' => 'LIKE',
          'value' => '"' .  get_the_ID() . '"',
        ),
      ),
    ));

    if ($relatedProfessors->have_posts()) {
      echo '<hr class="section-break">';
      echo '<h2 class="headline headline--medium"> ' . get_the_title() . ' Professor(s)</h2>';
      echo '<ul class="professor-cards">';
      while ($relatedProfessors->have_posts()) {
        $relatedProfessors->the_post();
    ?>
        <li class="professor-card__list-item">
          <a class="professor-card" href="<?php echo the_permalink(); ?>">
            <img src="<?php the_post_thumbnail_url(); ?>" alt="" class="professor-card__image">
            <span class="professor-card__name"><?php the_title(); ?></span>
          </a>
        </li>

      <?php
      }
      echo '</ul>';
      wp_reset_postdata();
    }

    $homepageEvents = new WP_Query(array(
      'posts_per_page' => 2,
      'post_type' => 'event',
      // 'orderby' => 'title',
      // 'orderby' => 'rand',
      'meta_key' => 'event_date',
      'orderby' => 'meta_value',
      // 'order' => 'DESC',
      'order' => 'ASC',
      'meta_query' => array(
        array(
          'key' => 'event_date',
          'compare' => '>=',
          'value' => $today,
          'type' => 'numeric',
        ),
        array(
          'key' => 'related_programs',
          'compare' => 'LIKE',
          'value' => '"' .  get_the_ID() . '"',
        ),
      ),
    ));

    if ($homepageEvents->have_posts()) {
      echo '<hr class="section-break">';
      echo '<h2 class="headline headline--medium">Upcoming ' . get_the_title() . ' Event(s)</h2>';
      while ($homepageEvents->have_posts()) {
        $homepageEvents->the_post();
      ?>
        <div class=" event-summary">
          <a class="event-summary__date t-center" href="<?php the_permalink() ?>">
            <span class="event-summary__month"><?php
                                                // the_field('event_date');
                                                $eventDate = new DateTime(get_field('event_date'));
                                                echo $eventDate->format('M');
                                                ?></span>
            <span class="event-summary__day"><?php
                                              echo $eventDate->format('d');
                                              ?></span>
          </a>
          <div class="event-summary__content">
            <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h5>
            <p><?php
                if (has_excerpt()) {
                  echo get_the_excerpt();
                } else {
                  echo wp_trim_words(get_the_content(), 12);
                }
                ?><a href="<?php the_permalink() ?>" class="nu gray">Learn more</a></p>
          </div>
        </div>

    <?php
      }
      wp_reset_postdata();
    }

    ?>
</div>

<?php
  }
  get_footer();
?>