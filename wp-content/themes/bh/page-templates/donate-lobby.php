<?php
/**
 * Template Name: Donate - Lobby
 */
get_header(); ?>

<main role="main" id="donate-layout-lobby" class="donations-content">

    <?php

    /*******************/
    /* title & content */
    /*******************/

    get_template_part('views/donate/lobby', 'top');

    /***************/
    /* lobby links */
    /***************/

    get_template_part('views/donate/lobby', 'bottom');

    ?>

</main>

<?php get_footer(); ?>