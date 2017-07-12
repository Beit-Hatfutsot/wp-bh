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
	
	<?php
        $cta = get_field("donate_cta_text");
        $target = get_field("donate_page");

        echo '<div id="donate-lobby" class="hero">';
            the_post_thumbnail();
            echo '<div class="btn-wrapper">';
                echo '<div class="btn inline-btn cyan-btn big lobby-main">';
                    echo '<h2><a href="'. $target->post_name . '" title="'. $target->post_title . '" class="">';
                        echo $cta;
                    echo '</a></h2>';
                echo '</div>';
            echo '</div>';
        echo '</div>';

	?>
	
</section>