<?php
/*
Template Name: Contact Us
*/
get_header();

$preselected_package = isset($_GET['package']) ? sanitize_text_field($_GET['package']) : '';

?>


<div class="contact-form-area">
    <?php if($preselected_package):?>
    <h1>Contact information</h1>

    <form method="post" action="<?php echo esc_url(admin_url('admin-post.php'));?>">
    
            <div class="form-information">
                <!-- First Name -->
                <label for="first_name"><?php echo esc_html__('First Name *', 'booking'); ?></label>
                <input type="text" id="first_name" name="first_name" required>

                <!-- Surname -->
                <label for="surname"><?php echo  esc_html__('Surname *', 'booking'); ?></label>
                <input type="text" id="surname" name="surname" required>

                <!-- Phone (Day) -->
                <label for="phone"><?php echo esc_html__('Phone (Day)', 'booking'); ?></label>
                <input type="tel" id="phone" name="phone" required>

                <!-- Email -->
                <label for="email"><?php echo esc_html__('Email *', 'booking'); ?></label>
                <input type="email" id="email" name="email" required>
            </div>

            <!-- Package Name  -->
            <?php if($preselected_package):?>
                <div class="pre-selected-package">
                    <div class="pre-selected-package-desc">
                        <h4><?php echo esc_html__('Selected Trip', 'booking');?></h4>
                        <h1><?php echo $preselected_package;?></h1>
                    </div>
                    
                </div>
            <?php endif;?>


            <div class="form-submit-data">
                <!-- Accept Privacy Policy -->
                    <div class="checkbox-area">
                        <input type="checkbox" id="privacy_policy" name="privacy_policy" required>
                        <label for="privacy_policy"><?php echo  esc_html__('I accept the Privacy Policy', 'booking'); ?></label>
                    </div>
                    <!-- Submit Button -->
                    <button type="submit"><?php echo esc_html__('Send', 'booking'); ?></button>
                    <input type="hidden" name="action" value="submit_contact_form">
                    <input type="hidden" name="package" value="<?php echo esc_attr($preselected_package); ?>">


            </div>
    </form>
    <?php else:?>
        <h4><?php echo esc_html__('Please Selecte a Trip Frist', 'booking');?></h4>
    <?php endif;?>
</div>

<?php get_footer();?>