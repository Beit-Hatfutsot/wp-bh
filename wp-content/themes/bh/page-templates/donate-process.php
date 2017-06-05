<?php
/**
 * Template Name: Donate - Process
 */

get_header(); ?>

<section role="main" id="donate-layout-process" class="donations-content">

    <?php

    /*******************/
    /* process header  */
    /*******************/

    get_template_part('views/donate/process', 'top');

    /****************/
    /* process flow */
    /****************/

    get_template_part('views/donate/process', 'flow');

    /****************/
    /* process view */
    /****************/

    get_template_part('views/donate/process', 'options');

    /******************/
    /* process footer */
    /******************/

    get_template_part('views/donate/process', 'bottom');

    ?>

</section>

<?php get_footer(); ?>