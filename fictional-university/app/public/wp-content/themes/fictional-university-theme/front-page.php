<?php get_header() ?>
<?php
// function myFirstFunction()
// {
//   echo 2 + 2;
//   echo "<h3>This is my first function.</h3>";
// }
// myFirstFunction();
// myFirstFunction();
// function greet($name, $color)
// {
//   echo
//   " <p>Hi, my name is $name and my favorite color is $color.</p>";
// }
// greet('John', 'orange');
// greet('Jane', 'red');
// associate array
// $animalSound = array(
//   'cat' => 'meow',
//   'dog' => 'bark',
//   'pig' => 'oink',
//   'bird' => 'chip',
// );
// echo $animalSound['pig'];
?>
<!-- <h1> -->
<?php
// bloginfo('name'); 
?>
<!-- </h1> -->
<!-- <p> -->
<?php
// bloginfo('description'); 
?>
<!-- </p> -->

<?php
// $names = array('Brad', 'John', 'Jane', 'Meowsalot', 'alif', 'sultan');
// $count = 0;
// echo "<ol>";
// while ($count < count($names)) {
//   echo "<li>Hi my name is $names[$count]</li>";
//   $count++;
// }
// echo "</ol>"
?>
<!-- <p>Hi my name is  -->
<?php
// echo $names[3]; 
?>
<!-- .</p> -->
<?php

// function doubleMe($numb){
//  echo $numb * 5;
//  return $numb;
// }
// echo doubleMe(8);
// while (have_posts()) {
//   the_post();
?>
<!-- <h2><a href=" -->
<?php
// the_permalink(); 
?>
<!-- "> -->
<?php
// the_title(); 
?>
<!-- </a></h2>
  <p> -->
<?php
// the_content(); 
?>
<!-- </p>
  <hr> -->
<div class="page-banner">
  <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/library-hero.jpg') ?>)"></div>
  <div class="page-banner__content container t-center c-white">
    <h1 class="headline headline--large">Welcome!</h1>
    <h2 class="headline headline--medium">We think you&rsquo;ll like it here.</h2>
    <h3 class="headline headline--small">Why don&rsquo;t you check out the <strong>major</strong> you&rsquo;re interested in?</h3>
    <a href="<?php get_post_type_archive_link('program'); ?>" class="btn btn--large btn--blue">Find Your Major</a>
  </div>
</div>

<div class="full-width-split group">
  <div class="full-width-split__one">
    <div class="full-width-split__inner">
      <h2 class="headline headline--small-plus t-center">Upcoming Events</h2>
      <?php
      $today = date('Ymd');
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
        ),
      ));
      while ($homepageEvents->have_posts()) {
        $homepageEvents->the_post();
        get_template_part('template-parts\content', 'event'); //event-excerpt
      ?>
        <!-- <div class="event-summary">
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
        </div>  -->

      <?php
      }
      wp_reset_postdata();
      ?>
      <!-- <div class="event-summary">
        <a class="event-summary__date t-center" href="#">
          <span class="event-summary__month">Mar</span>
          <span class="event-summary__day">25</span>
        </a>
        <div class="event-summary__content">
          <h5 class="event-summary__title headline headline--tiny"><a href="#">Poetry in the 100</a></h5>
          <p>Bring poems you&rsquo;ve wrote to the 100 building this Tuesday for an open mic and snacks. <a href="#" class="nu gray">Learn more</a></p>
        </div>
      </div>
      <div class="event-summary">
        <a class="event-summary__date t-center" href="#">
          <span class="event-summary__month">Apr</span>
          <span class="event-summary__day">02</span>
        </a>
        <div class="event-summary__content">
          <h5 class="event-summary__title headline headline--tiny"><a href="#">Quad Picnic Party</a></h5>
          <p>Live music, a taco truck and more can found in our third annual quad picnic day. <a href="#" class="nu gray">Learn more</a></p>
        </div>
      </div> -->

      <p class="t-center no-margin"><a href="<?php echo get_post_type_archive_link('event'); ?>" class="btn btn--blue">View All Events</a></p>
    </div>
  </div>
  <div class="full-width-split__two">
    <div class="full-width-split__inner">
      <h2 class="headline headline--small-plus t-center">From Our Blogs</h2>
      <?php
      $homepagePosts = new WP_Query(array(
        'posts_per_page' => 2,
        // 'category_name' => 'awards',
        // 'post_type' => 'page'
      ));

      while ($homepagePosts->have_posts()) {
        $homepagePosts->the_post();
      ?>

        <div class="event-summary">
          <a class="event-summary__date event-summary__date--beige t-center" href="<?php the_permalink(); ?>">
            <span class="event-summary__month"><?php the_time('M'); ?></span>
            <span class="event-summary__day"><?php the_time('d'); ?></span>
          </a>
          <div class="event-summary__content">
            <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"> <?php the_title(); ?></a></h5>
            <p><?php
                if (has_excerpt()) {
                  echo get_the_excerpt();
                } else {
                  echo wp_trim_words(get_the_content(), 12);
                }
                ?> <a href="<?php the_permalink(); ?>" class="nu gray">Read more</a></p>
          </div>
        </div>
      <?php
      }
      wp_reset_postdata();
      ?>

      <!-- <div class="event-summary">
        <a class="event-summary__date event-summary__date--beige t-center" href="#">
          <span class="event-summary__month">Jan</span>
          <span class="event-summary__day">20</span>
        </a>
        <div class="event-summary__content">
          <h5 class="event-summary__title headline headline--tiny"><a href="#">We Were Voted Best School</a></h5>
          <p>For the 100th year in a row we are voted #1. <a href="#" class="nu gray">Read more</a></p>
        </div>
      </div>
      <div class="event-summary">
        <a class="event-summary__date event-summary__date--beige t-center" href="#">
          <span class="event-summary__month">Feb</span>
          <span class="event-summary__day">04</span>
        </a>
        <div class="event-summary__content">
          <h5 class="event-summary__title headline headline--tiny"><a href="#">Professors in the National Spotlight</a></h5>
          <p>Two of our professors have been in national news lately. <a href="#" class="nu gray">Read more</a></p>
        </div>
      </div> -->

      <p class="t-center no-margin"><a href="<?php echo site_url('/blog'); ?>" class="btn btn--yellow">View All Blog Posts</a></p>
    </div>
  </div>
</div>

<!-- <div class="hero-slider">
  <div data-glide-el="track" class="glide__track">
    <div class="glide__slides">
      <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('images/bus.jpg'); ?>)">
        <div class="hero-slider__interior container">
          <div class="hero-slider__overlay">
            <h2 class="headline headline--medium t-center">Free Transportation</h2>
            <p class="t-center">All students have free unlimited bus fare.</p>
            <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
          </div>
        </div>
      </div>
      <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('images/apples.jpg'); ?>)">
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
      </div>
    </div>
    <div class="slider__bullets glide__bullets" data-glide-el="controls[nav]"></div>
  </div>
</div> -->


<?php
$slide = array(
  'post_type' => 'slide',
  'posts_per_page' => -1,
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
// }

get_footer();
?>