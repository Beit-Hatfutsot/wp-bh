<?php
/**
 * Template Name: Donate - Process
 */

$slug = get_queried_object()->post_name;

if ('thank-you' !== $slug) {
    get_header();
}

?>


<main role="main" id="donate-layout-<?php echo $slug; ?>" class="donations-content donations-content-<?php echo $slug; ?>">

    <?php

    if ('thank-you' !== $slug) {
        get_template_part('views/donate/process', 'top');       // Shared visual header for the process views
    }

    switch ($slug) {
        case "options":
            get_template_part('views/donate/process', 'flow');      // Process stage indicator
            get_template_part('views/donate/process', 'options');   // Tabbed layout for donation options
            get_template_part('views/donate/process', 'bottom');    // Additional info for the process sections
            break;
        case "secured-payment":
            get_template_part('views/donate/process', 'flow');      // Process stage indicator
            get_template_part('views/donate/secured-payment');      // iCount iFrame
            break;
        case "thank-you":
            get_template_part('views/donate/process', 'flow');      // Process stage indicator
            get_template_part('views/donate/thank-you');            // Naked Thank You message for redirection from iCount after success.
            break;
    }

    ?>

</main>

<?php

if ('thank-you' !== $slug) {
    get_footer();
}

?>

