<section class="donate-layout donate-layout-links">
	
    <?php

    $lobby_links = get_field('donate_lobby_links');

    if (is_array($lobby_links)):
        echo '<div id="lobby-links" class="row">';

        foreach ($lobby_links as $lobby_link):

            $target = get_permalink($lobby_link['target_page']);
            $target_title = get_the_title($lobby_link['target_page']);
            $thumb = $lobby_link['image'];
            // var_dump($thumb);

            echo '<article class="col-sm-3 box">';

                echo '<figure>';

                    echo '<a href="' . $target . '" title="' . $target_title . '">';
                        echo '<img src="' . $thumb['sizes']['thumbnail'] . '" alt="' . $thumb['title'] . '">';
                    echo '</a>';

                echo '</figure>';

                echo '<div class="details">';

                    echo '<h3 class="box-title">';
                    echo $lobby_link['link_title'];
                    if ($lobby_link['link_subtitle']):
                        echo '<small>' . $lobby_link['link_subtitle'] . '</small>';
                    endif;
                    echo '</h3>';

                echo '</div>';

            echo '</article>';

        endforeach;

        echo '</div>';
    endif;
    ?>
	
</section>