<?php
$hero_desktop   = get_field('hero_img_desktop', 'option');
$hero_mobile    = get_field('hero_img_mobile', 'option');
$passage        = esc_html_x('Deeds of giving are the very foundations of the world', 'donation-quote', 'BH');
$ref            = esc_html_x('Mishna, Pirkei Avot 1:2', 'donation-quote', 'BH');
$slug           = get_queried_object()->post_name;
$back_link      = BH_get_donation_page_url('main');
?>

<section id="donate-process-top" class="donate-process-layout">

	<?php if ($slug == 'options') : ?>
    <div class="container">

        <div class="back-link">
            <a href="<?php echo $back_link; ?>" role="link"><?php esc_html_e('Back to support page', 'BH') ?></a>
        </div>

	</div>
    <?php endif; ?>

    <div class="title">
        <h1 id="process-title"><?php esc_html_e('Thank You for Your Support', 'BH') ?></h1>
    </div>

    <div id="passage">
        <p><?php echo $passage . ' <small>' . $ref . '</small>'; ?></p>
    </div>


    <div class="hero">
        <picture>
            <source media="(max-width: 480px)" srcset="<?php echo $hero_mobile['url']; ?>">
            <img src="<?php echo $hero_desktop['url']; ?>" alt="<?php echo $hero_desktop['alt']; ?>">
        </picture>
        <h2 class="hero-label text-uppercase black-overlay-bg"><?php esc_html_e('Donate/Payment Method', 'BH') ?></h2>
    </div>

</section>