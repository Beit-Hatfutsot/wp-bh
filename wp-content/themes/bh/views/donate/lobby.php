<?php
$target         = BH_get_donation_page_url('options');
$hero_desktop   = get_field('hero_img_desktop', 'option');
$hero_mobile    = get_field('hero_img_mobile', 'option');
$lobby_links    = get_field('donate_main_page_links', 'option');
?>

<section id="lobby-top" class="donate-layout">
	
		<?php
			if (have_posts()) : the_post();
				echo '<h1 id="lobby-title">';
					the_title();
				echo '</h1>';
				echo '<div id="lobby-subtitle">';
				    the_content();
				echo '</div>';
			endif;
		?>

    <div id="donate-lobby" class="hero">
        <picture>
            <source media="(max-width: 480px)" srcset="<?php echo $hero_mobile['url']; ?>">
            <img src="<?php echo $hero_desktop['url']; ?>" alt="<?php echo $hero_desktop['alt']; ?>">
        </picture>
        <div class="lobby-label--wrapper">

            <h2 class="lobby-label">
                <a href="<?php echo $target; ?>" role="link"><?php esc_html_e('Donate', 'BH') ?></a>
            </h2>

        </div>

    </div>
	
</section>

<section id="lobby-bottom" class="donate-layout">

    <?php if (is_array($lobby_links)): ?>

        <div id="lobby-links" class="row">

            <?php foreach ($lobby_links as $lobby_link):

                $target_href = get_permalink($lobby_link['target_page']);
                $target_title = get_the_title($lobby_link['target_page']);
                $thumb = $lobby_link['image'];
                $target_cta = $lobby_link['link_title'];

                if ( $lobby_link['link_subtitle'] ) {
                    $target_cta .= ' <span class="subtitle">' . $lobby_link['link_subtitle'] . '</span>';
                }

                ?>

                <div class="article-box col-sm-3">
                    <article class="lobby-link">

                        <?php if ($thumb): ?>
                            <img src="<?php echo $thumb['sizes']['medium']; ?>" alt="<?php echo $thumb['title']; ?>">
                        <?php endif; ?>

                        <div class="lobby-label--wrapper">
                            <h3 class="lobby-label <?php echo ( $lobby_link['link_subtitle'] ) ? 'has-sub' : ''; ?>">
                                <a href="<?php echo $target_href; ?>" role="link"><?php echo $target_cta; ?></a>
                            </h3>
                        </div>

                    </article>
                </div>

            <?php endforeach; ?>

        </div>

    <?php endif; ?>

</section>