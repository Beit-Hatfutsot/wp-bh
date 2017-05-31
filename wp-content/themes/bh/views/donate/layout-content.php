<section class="donate-layout donate-layout-content">

	<div class="container">
	
		<?php
			if (have_posts()) : the_post();
				echo '<div class="title">';
					the_title();
				echo '</div>';
				echo '<div class="content">';
					the_content();
				echo '</div>';
			endif;
		?>
		
	</div>
	
	<?php
        $cta = get_field("donate_cta_text");
        $target = get_field("donate_page");

        echo '<div class="hero">';
            the_post_thumbnail();
            echo '<h2>';
                echo '<a href="'. $target->guid . '" alt="'. $target->post_title . '">';
                    echo $cta;
                echo '<a>';
            echo '<h2>';
        echo '</div>';

	?>
	
</section>