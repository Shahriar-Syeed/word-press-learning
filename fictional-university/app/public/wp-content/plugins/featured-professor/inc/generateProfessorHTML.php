<?php

function generateProfessorHTML($profId)
{
  $profPost = new WP_Query(array(
    'post_type' => 'professor',
    'p' => $profId
  ));

  while ($profPost->have_posts()) {
    $profPost->the_post();
    ob_start(); ?>
    <div class="professor-callout">
      <div class="professor-callout__photo" style="background-image: url(<?php the_post_thumbnail_url('professorPortrait') ?>);"></div>
      <div class="professor-callout__text">
        <h5><?php echo wp_strip_all_tags(html_entity_decode(get_the_title())); ?></h5>
        <p><?php echo wp_trim_words(get_the_content(), 30) ?></p>
        <?php
        $relatedPrograms = get_field('related_programs');
        if ($relatedPrograms) { ?>
          <p><?php echo strip_tags(get_the_title()); ?> teaches:
            <?php
            foreach ($relatedPrograms as $key => $program) {
              echo esc_html(get_the_title($program));
              if ($key != array_key_last($relatedPrograms) && count($relatedPrograms) > 1) {
                echo ', ';
              }
            } ?>.
          </p>
        <?php }
        ?>

        <p><strong><a href="<?php the_permalink(); ?>">Learn more about <?php echo strip_tags(get_the_title()); ?> &raquo;</a></strong></p>
      </div>
    </div>
<?php
    wp_reset_postdata();
    return ob_get_clean();
  }
}
