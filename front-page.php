<?php
get_header(); 

?>


<div class="search-container-area">
    <form action="<?php echo esc_url( home_url('/search') ); ?>" method="get">
        <?php
        $locations = get_terms(array(
            'taxonomy' => 'locations', 
            'hide_empty' => true, 
        ));
        ?>
        <select name="location" id="location">
            <option value=""><?php echo esc_html__('Select Destination', 'booking'); ?></option>
            <?php foreach ($locations as $location) { ?>
                <option value="<?php echo esc_attr($location->slug); ?>"><?php echo esc_html($location->name); ?></option>
            <?php } ?>
        </select>
        <button type="submit"><?php echo esc_html__('View available trips', 'booking'); ?></button>
    </form>

</div>








<?php
get_footer();