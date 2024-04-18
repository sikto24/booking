<?php

get_header();

 

$days = get_field("duration") ? get_field("duration") : '';
$taken = get_field("taken") ? get_field("taken") : '';
$package_name = get_the_title();

?>



    <div class="single-listing-details">
        <div class="single-listing-top">
            <div class="title">
                <h1><?php the_title();?></h1>
            </div>
            <div class="social-share">
                <p>Share on</p>
            </div>
        </div>
        <div class="single-listing-middle">
            <div class="single-listing-img">
                <?php the_post_thumbnail('full');?>
            </div>
            <div class="single-listing-info">
                <div class="booking-info">
                    <p><?php echo $days . esc_html__( ' Days incl. travel days', 'booking' );?> </p>
                    <h3>
                        <?php echo   esc_html__( 'From ', 'booking' );?>  
                            <bold><?php echo $taken; ?></bold> 
                        <?php echo esc_html__( 'SEK per person', 'booking' );?>  
                        </h3>
                        <a href="<?php echo esc_url( home_url('/contact') ); ?>?package=<?php echo urlencode($package_name); ?>" class="btn">
                            <?php echo esc_html__('Contact us for travel suggestions', 'booking');?>
                        </a>
                </div>
            </div>
        </div>
        <div class="single-listing-bottom">
            <div class="overview-area">
                <div class="over-view-booking">
                    <h1><?php echo esc_html__('Overview', 'booking');?></h1>
                    <a href="<?php echo esc_url( home_url('/contact') ); ?>?package=<?php echo urlencode($package_name); ?>" class="btn">
                        <?php echo esc_html__('Contact us for travel suggestions', 'booking');?>
                    </a>
                </div>
                <div class="over-view-desc">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </div>



<?php
get_footer();