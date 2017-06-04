<?php
/**
 * Template Name: Donate - Lobby
 */?>
<?php get_header(); ?>

<section role="main" id="donate-layout-lobby" class="donations-content">

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

</section>

<?php get_footer(); ?>