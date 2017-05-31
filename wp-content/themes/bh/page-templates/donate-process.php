<?php
/**
 * Template Name: Donate - Process
 */?>
<?php get_header(); ?>

<section class="donations-content">

    <?php

    /*******************/
    /* process header  */
    /*******************/

    get_template_part('views/donate/process/layout', 'top');

    /****************/
    /* process view */
    /****************/

    get_template_part('views/donate/process/layout', 'options');

    /******************/
    /* process footer */
    /******************/

    get_template_part('views/donate/process/layout', 'bottom');

    ?>

</section>

<?php get_footer(); ?>