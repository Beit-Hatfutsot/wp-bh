<fieldset class="flow-amount col-md-offset-2 col-md-10 col-sm-12">
    <legend><?php esc_html_e('Amount', 'BH'); ?></legend>

    <div class="radio other">
        <input type="radio" name="donationAmount" id="custom-amount-radio" value="other" class="cs-hotspot"><label for="custom-donation-radio" class="cs-hotspot">
            <input type="number" class="form-control" name="customDonationAmount" id="custom-amount-field" placeholder="<?php esc_html_e('How much would you like to give? (In NIS)', 'BH'); ?>">
        </label>
    </div>
    <div class="radio">
        <input type="radio" name="donationAmount" id="100" value="100" title="<?php esc_html_e('Donate 100 Shekels', 'BH'); ?>"><label for="100"><em>100 <?php esc_html_e('NIS', 'BH'); ?></em><?php esc_html_e('will help expand our Jewish identity outreach program to IDF soldiers', 'BH') ; ?>
        </label>
    </div>
    <div class="radio">
        <input type="radio" name="donationAmount" id="200" value="200" title="<?php esc_html_e('Donate 200 Shekels', 'BH'); ?>"><label for="200"><em>200 <?php esc_html_e('NIS', 'BH'); ?></em><?php esc_html_e('will help expand our rich database of Jewish family trees, names and places', 'BH') ; ?>
        </label>
    </div>
    <div class="radio">
        <input type="radio" name="donationAmount" id="500" value="500" title="<?php esc_html_e('Donate 500 Shekels', 'BH'); ?>"><label for="500"><em>500 <?php esc_html_e('NIS', 'BH'); ?></em><?php esc_html_e('will go towards developing educational materials for school groups', 'BH') ; ?>
        </label>
    </div>
    <div class="radio">
        <input type="radio" name="donationAmount" id="1000" value="1000" title="<?php esc_html_e('Donate 1000 Shekels', 'BH'); ?>"><label for="1000"><em>1000 <?php esc_html_e('NIS', 'BH'); ?></em><?php esc_html_e('will help bring a group of visitors with special needs to Beit Hatfusot', 'BH') ; ?>
        </label>
    </div>

    <div class="checkbox">
        <input type="checkbox" id="annual-donation" name="annual-donation" value="annual"><label for="annual-donation" class="annual-donation"><em class="accent"><?php esc_html_e('I would like this to be a regular annual donation', 'BH'); ?></em>
        </label>
    </div>

    <p class="large-donations"><?php echo esc_html__("A gift of over 100,000 NIS will be recognized on", "BH") . ' <a href="#" role="link">' . esc_html__("Beit Hatfutsot's central Donor's Wall", "BH"). '</a>'; ?>.</p>

</fieldset>

<fieldset id="tribute-gift" class="flow-amount col-md-offset-2 col-md-10 col-sm-12">
    <legend><?php esc_html_e('Tribute Gift', 'BH'); ?></legend>

    <div class="form-group">
        <div class="checkbox">
            <input id="show-tribute" name="show-tribute" type="checkbox" value="show-tribute"><label for="show-tribute" ><em><?php esc_html_e('Print your certificate in honor, memory or support of your loved one', 'BH'); ?></em></label>
        </div>
    </div>

    <div class="form-group on-demand hide" aria-expanded="false">
        <label for="tribute-type"><?php esc_html_e('Tribute Type', 'BH'); ?></label>
        <select id="tribute-type" name="tribute_type" class="form-control in-tribute">
            <?php

            $cert_types = array(
                'appreciation'  => esc_html__('Certificate of Appreciation', 'BH'),
                'memory'        => esc_html__('In Loving memory of', 'BH'),
                'thankyou'      => esc_html__('Thank You', 'BH'),
            );

            $certificate_examples = array();
            $cert_language_codes = array( ICL_LANGUAGE_CODE, ); // Assuming we must have certificate in our interface languages (HE/EN).

            foreach ( $cert_types as $cert_type => $cert_title ) {
                $cert_type_versions = get_field( $cert_type, 'option');

                echo '<option value="' . $cert_type . '">' . $cert_title . '</option>';

                foreach ( $cert_type_versions as $cert_type_version ) {

                    $certificate_examples[$cert_type][$cert_type_version['language']]['src'] = $cert_type_version['example']['sizes']['medium'];
                    $certificate_examples[$cert_type][$cert_type_version['language']]['class'] = 'certificate-example  ' . $cert_type . '  ' . $cert_type_version['language'];

                    if ( !in_array( $cert_type_version['language'], $cert_language_codes )) {
                        $cert_language_codes[] = $cert_type_version['language'];
                    }
                }
            }


            ?>

        </select>
    </div>

    <div class="form-group on-demand hide" aria-expanded="false">
        <label for="certificate-language"><?php esc_html_e('Certificate Language', 'BH'); ?></label>
        <select id="certificate-language" name="m__certificate_language" class="form-control in-tribute">
            <?php

                foreach ($cert_language_codes as $code) {
                    $t_name = apply_filters( 'wpml_translated_language_name', NULL, $code, $code );
                    echo '<option value="' . $code . '">' . $t_name . '</option>';
                }

            ?>

        </select>
    </div>

    <div class="form-group on-demand hide" aria-expanded="false">
        <label for="tribute-text"><?php esc_html_e('Your Text', 'BH'); ?> <small><?php esc_html_e('(Up to 50 characters)', 'BH'); ?></small></label>
        <textarea class="form-control" id="tribute-text" name="m__tribute_text" aria-describedby="certificateHelp" placeholder="<?php esc_html_e('Bar Mitzvah boy Mordechai ben Ester', 'BH'); ?>"></textarea>
        <div class="certificate-example-box">

            <?php

            $example_alts = array(
                'appreciation'  => esc_html__('Certificate of Appreciation example', 'BH'),
                'memory'        => esc_html__('In Loving Memory Certificate example', 'BH'),
                'thankyou'      => esc_html__('Thank You Certificate example', 'BH'),
            );

            foreach ( $example_alts as $slug => $alt ) {
                $certificate_examples[$slug]['alt'] = $alt;
            }

            $default_cert = $certificate_examples['appreciation'][ICL_LANGUAGE_CODE];

            echo '<img id="certificate-example" src="' . $default_cert['src'] . '" class="' . $default_cert['class'] . '" alt="' . $example_alts[$slug] . '">';

            ?>

        </div>

        <script type="text/javascript">
            var examplesUrls = <?php echo json_encode( $certificate_examples ); ?>,
                activeLang = "<?php echo ICL_LANGUAGE_CODE; ?>",
                activeType = "appreciation";
        </script>

        <span id="certificateHelp" class="help-block"><?php esc_html_e('A Print version of the certificate will be sent to you, your name and date will be automatically updated.', 'BH'); ?></span>
    </div>


</fieldset>

<div class="form-group flow-amount col-sm-offset-2 col-sm-8">
    <button type="button" id="cont-to-details" class="btn orange-btn"><?php esc_html_e('Continue', 'BH'); ?></button>
</div>