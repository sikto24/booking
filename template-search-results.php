<?php
/*
Template Name: Search Results Template
*/
get_header();

// Get search query
$location_query = isset($_GET['location']) ? $_GET['location'] : '';
$min_duration_query = isset($_GET['mindays']) ? intval($_GET['mindays']) : '';
$max_duration_query = isset($_GET['maxdays']) ? intval($_GET['maxdays']) : '';
$min_taken_query = isset($_GET['mintaken']) ? intval($_GET['mintaken']) : '';
$max_taken_query = isset($_GET['maxtaken']) ? intval($_GET['maxtaken']) : '';

$args = array(
    'post_type' => 'listing',
    'posts_per_page' => -1, 
    'tax_query' => array(),
    'meta_query' => array(),
);

// Add taxonomy query for locations
if (!empty($location_query)) {
    $args['tax_query'][] = array(
        'taxonomy' => 'locations',
        'field' => 'slug',
        'terms' => $location_query,
    );
}

// Add meta query for duration
if (!empty($min_duration_query) || !empty($max_duration_query)) {
    $duration_query = array();
    if (!empty($min_duration_query)) {
        $duration_query['value'] = $min_duration_query;
        $duration_query['compare'] = '>=';
    }
    if (!empty($max_duration_query)) {
        $duration_query['value'] = $max_duration_query;
        $duration_query['compare'] = '<=';
    }
    $duration_query['key'] = 'duration';
    $duration_query['type'] = 'NUMERIC';
    $args['meta_query'][] = $duration_query;
}

// Add meta query for taken
if (!empty($min_taken_query) || !empty($max_taken_query)) {
    $taken_query = array();
    if (!empty($min_taken_query)) {
        $taken_query['value'] = $min_taken_query;
        $taken_query['compare'] = '>=';
    }
    if (!empty($max_taken_query)) {
        $taken_query['value'] = $max_taken_query;
        $taken_query['compare'] = '<=';
    }
    $taken_query['key'] = 'taken';
    $taken_query['type'] = 'NUMERIC';
    $args['meta_query'][] = $taken_query;
}

$listings_query = new WP_Query($args);

// Display search results
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
    // No listings found
    echo 'No listings found.';
endif;

get_footer();
