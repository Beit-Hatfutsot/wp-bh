<?php
$passage = esc_html_x('Deeds of giving are the very foundations of the world', 'donation-quote', 'BH');
$ref = esc_html_x('Mishna, Pirkei Avot 1:2', 'donation-quote', 'BH');
$slug = get_queried_object()->post_name;
?>

<section id="donate-process-top" class="donate-process-layout">

	<?php if ($slug == 'options') : ?>
    <div class="container">

        <div class="back-link">
            <a href="/donate/" role="link"><?php esc_html_e('Back to support page', 'BH') ?></a>
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
        <img src="http://test.bh.org.il/wp-content/uploads/photo-by-Nir-Shaanani-400a.jpg">
        <h2 class="hero-label text-uppercase black-overlay-bg"><?php esc_html_e('Donate/Payment Method', 'BH') ?></h2>
    </div>

</section>