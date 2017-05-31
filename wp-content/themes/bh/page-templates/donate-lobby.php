<?php
/**
 * Template Name: Donate - Lobby
 */?>
<?php get_header(); ?>

<section id="donate-layout-lobby" class="donations-content">

    <?php

    /*******************/
    /* title & content */
    /*******************/

    get_template_part('views/donate/layout', 'lobbytop');

    /***************/
    /* lobby links */
    /***************/

    get_template_part('views/donate/layout', 'lobbybottom');

    ?>

</section>

<?php get_footer(); ?>