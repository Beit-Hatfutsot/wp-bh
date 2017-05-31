<?php
/**
 * Template Name: Donate - Lobby
 */?>
<?php get_header(); ?>

<section class="page-content">

    <?php

    /*******************/
    /* title & content */
    /*******************/

    get_template_part('views/donate/layout', 'content');

    /***************/
    /* lobby links */
    /***************/

    get_template_part('views/donate/layout', 'links');

    ?>

</section>

<?php get_footer(); ?>