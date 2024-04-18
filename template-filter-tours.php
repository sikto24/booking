<?php get_header(); ?>

<div class="filter-area-wrapper">
    <form action="<?php echo esc_url( home_url('/search') ); ?>" method="get">
        <div class="filter-by-destination">
            <h4><?php echo esc_html__( 'Destinations', 'booking' )?></h4>
            <?php
            $locations = get_terms(array(
                'taxonomy' => 'locations', 
                'hide_empty' => true, 
            ));
            foreach ($locations as $location) {
            ?>
                <input type="checkbox" id="<?php echo esc_attr($location->name); ?>" name="location[]" value="<?php echo esc_attr($location->slug); ?>">
                <label for="<?php echo esc_attr($location->name); ?>"> <?php echo esc_html($location->name); ?> </label><br>
            <?php } ?>
        </div>
        <div class="filter-by-duration">
            <h4><?php echo esc_html__( 'Duration', 'booking' )?></h4>
            <label for="mindays">Min Days</label>
            <input type="number" id="duration min-duration" name="mindays" min="3" max="10" />
            <label for="maxdays">Max Days</label>
            <input type="number" id="duration max-duration" name="maxdays" min="16" max="30" />
        </div>
        <div class="filter-by-Taken">
            <h4><?php echo esc_html__( 'Taken', 'booking' )?></h4>
            <label for="mintaken">Min Taken</label>
            <input type="number" id="Taken min-taken" name="mintaken" min="16000" max="50000" step="1000"/>
            <label for="maxtaken">Max Taken</label>
            <input type="number" id="Taken max-taken" name="maxtaken" min="50000" max="95 000" step="1000"/>
        </div>
        <button type="submit"><?php echo esc_html__('Use filters', 'booking'); ?></button>
    </form>
</div>

<?php get_footer(); ?>
