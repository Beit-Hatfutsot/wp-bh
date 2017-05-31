<section id="lobby-bottom" class="donate-layout">
	
    <?php

    $lobby_links = get_field('donate_lobby_links');

    if (is_array($lobby_links)):
        echo '<div id="lobby-links" class="row">';

        foreach ($lobby_links as $lobby_link):

            $target = get_permalink($lobby_link['target_page']);
            $target_title = get_the_title($lobby_link['target_page']);
            $thumb = $lobby_link['image'];
            ?>

            <div class="article-box col-sm-3">
                <article>
                    <figure>
                        <?php echo '<img src="' . $thumb['sizes']['thumbnail'] . '" alt="' . $thumb['title'] . '">'; ?>
                    </figure>
                    <div class="btn inline-btn cyan-btn flex-center">
                        <h3>
                            <a href="#">
                                <?php
                                echo $lobby_link['link_title'];
                                if ($lobby_link['link_subtitle']):
                                    echo '<span>' . $lobby_link['link_subtitle'] . '</span>';
                                endif;
                                ?>
                            </a>
                        </h3>
                    </div>
                </article>
            </div>

            <?php

            /*echo '<article class="col-sm-3 box">';

                echo '<figure>';

                    echo '<a href="' . $target . '" title="' . $target_title . '">';
                        echo '<img src="' . $thumb['sizes']['thumbnail'] . '" alt="' . $thumb['title'] . '">';
                    echo '</a>';

                echo '</figure>';

                echo '<div class="details">';

                    echo '<div class="box-title btn inline-btn cyan-btn">';
                    echo '<h3><a href="' . $target . '" class="">';
                    echo $lobby_link['link_title'];
                    if ($lobby_link['link_subtitle']):
                        echo '<small>' . $lobby_link['link_subtitle'] . '</small>';
                    endif;
                    echo '</a></h3>';
                    echo '</div>';

                echo '</div>';

            echo '</article>';*/

        endforeach;

        echo '</div>';
    endif;
    ?>
	
</section>