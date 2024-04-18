<?php
/*
Template Name: Listing Search Results
*/
get_header();



$args = array(
    'post_type'      => 'listing', 
    'posts_per_page' => -1, 

);

$listings_query = new WP_Query($args);

if ($listings_query->have_posts()) : ?>
    <div class="listing-area-wrapper">
        <?php while ($listings_query->have_posts()) : $listings_query->the_post(); ?>
            <div id="post-<?php the_ID(); ?>" <?php post_class('single-listing-area'); ?>>
                <div class="single-listing-img">
                    <?php the_post_thumbnail('full'); ?>
                </div>
                <div class="single-listing-desc">
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <p><?php echo wp_trim_words(get_the_content(), 15, ''); ?></p>
                    <a href="<?php the_permalink(); ?>" class="read-more-btn"><?php echo esc_html__('Read More', 'booking') ?></a>
                </div>
            </div>
        <?php endwhile; ?>
    </div>



<?php
else :
    echo esc_html__('No Listings Found', 'booking');
endif;

get_footer();
?>
