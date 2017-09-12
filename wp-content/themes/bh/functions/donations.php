<?php
/**
 * Created by Itay Banner (itay@ibanner.co.il).
 * Date: 12/07/2017
 * Time: 10:01
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * BH_donation_form_url
 *
 * Returns the URL for the iCount Billing iFrame.
 *
 * @param	$formdata   array   Data submitted by the local form
 * @return	$src        The URL with all the relevant parameters
 */

function BH_donation_form_url($formdata) {

    // 1. Get the base URL
    $src = BH_donation_get_base_url($formdata);

    // 2. Construct the query parameters
    $query = BH_donation_build_query($formdata);

    // 3. Make sure the query exists and put it where it belongs
    if ( !empty($query) ) {
        $src .= '?' . $query;
    }

    // 4. Return outcome
    return $src;
};

    /**
     * BH_donation_get_base_url
     *
     * Returns the base URL for the relevant iCount form for the selected donation frequency (one-time or annual).
     *
     * @param	$formdata  array   Data submitted by the local form
     *
     * @return	string      URL of the relevant form
     */

    function BH_donation_get_base_url($formdata) {

        // 1. Is it an annual donation? default to one-time if not.
        $frequency = isset( $formdata['annual-donation'] ) ? 'annual' : 'one-time';

        // 2. Get the form URL from the Donations Settings options page
        $src_base = get_field('acf-options_' . $frequency . '_d_form', 'option');

        // 3. Return the relevant base URL
        return $src_base;
    };

    /**
     * BH_donation_build_query
     *
     * Builds the query parameters for the iFrame URL
     *
     * @param	$formdata   array   Data submitted by the local form
     *
     * @return	string      The final query to be attached to the iFrame src URL
     */

    function BH_donation_build_query($formdata) {

        $params = array();

        if ( is_rtl() ) {
            $params['lng'] = 'he';
        }

        foreach ($formdata as $key => $value) {
            switch ($key) {
                case 'donationAmount':
                    $params['cs'] = $value;
                    break;
                case 'fname':
                    $params['ccfname'] = ucfirst( $value );
                    break;
                case 'lname':
                    $params['cclname'] = ucfirst( $value );
                    break;
                case 'full_name':
                    if ( empty($formdata['receipt-name']) ) {
                        $params['full_name'] = ucfirst( $formdata['fname'] ) . ' ' . ucfirst( $formdata['lname'] );
                    } else {
                        $params['full_name'] = ucfirst( $value );
                    }
                    break;
                case 'annual-donation':
                case 'customDonationAmount':
                case 'terms-acceptance':
                    break;
                default:
                    $params[$key] = $value;
            }
        }

        return http_build_query($params);
    };

/**
 * BH_get_donor_certificate_templates
 *
 * Returns the required data about certificate template images from the ACF repeater fields.
 *
 * @return	array $certificate_templates        The URL with all the relevant parameters
 */

function BH_get_donor_certificate_templates() {

    $cert_types = BH_get_donor_certificate_types();
    $certificate_templates = array();

    foreach ( $cert_types as $cert_slug => $cert_type ) {

        $cert_type_versions = get_field( $cert_slug, 'option');

        foreach ( $cert_type_versions as $cert_type_version ) {
            $certificate_templates[$cert_slug][$cert_type_version['language']] = $cert_type_version['template']['sizes']['medium'];
        }
    }

    return $certificate_templates;
};


/**
 * BH_get_donor_certificate_examples
 *
 * Returns the required data about certificate example images from the ACF repeater fields.
 *
 * @return	array $certificate_examples        The URL with all the relevant parameters
 */

function BH_get_donor_certificate_examples() {

    $cert_types = BH_get_donor_certificate_types();

    $certificate_examples = array();

    foreach ( $cert_types as $cert_slug => $cert_type ) {

        $cert_type_versions = get_field( $cert_slug, 'option');

        foreach ( $cert_type_versions as $cert_type_version ) {
            $certificate_examples[$cert_slug][$cert_type_version['language']]['src'] = $cert_type_version['example']['sizes']['medium'];
            $certificate_examples[$cert_slug][$cert_type_version['language']]['class'] = 'certificate-example  ' . $cert_slug . '  ' . $cert_type_version['language'];
        }
    }

    $example_alts = array(
        'appreciation'  => esc_html__('Certificate of Appreciation example', 'BH'),
        'memory'        => esc_html__('In Loving Memory Certificate example', 'BH'),
        'thankyou'      => esc_html__('Thank You Certificate example', 'BH'),
    );

    foreach ( $example_alts as $cert_slug => $alt ) {
        $certificate_examples[$cert_slug]['alt'] = $alt;
    }

    return $certificate_examples;
};


/**
 * BH_get_donor_certificate_languages
 *
 * Returns an array with the 2-letter codes of languages available for certificates.
 *
 * @return	array $cert_language_codes
 */

function BH_get_donor_certificate_languages() {

    $cert_types = BH_get_donor_certificate_types();
    $cert_language_codes = array( ICL_LANGUAGE_CODE, ); // Assuming we must have certificate in our interface languages (HE/EN).

    foreach ( $cert_types as $cert_slug => $cert_type ) {

        $cert_type_versions = get_field( $cert_slug, 'option');

        foreach ( $cert_type_versions as $cert_type_version ) {

            if ( !in_array( $cert_type_version['language'], $cert_language_codes )) {
                $cert_language_codes[] = $cert_type_version['language'];
            }
        }
    }

    return $cert_language_codes;
};


/**
 * BH_get_donor_certificate_data
 *
 * @return	array $certificate_data
 */

function BH_get_donor_certificate_data() {

    $cert_types = BH_get_donor_certificate_types();
    $certificate_data = array();

    foreach ( $cert_types as $key => $cert_type ) {
        $certificate_data[] = get_field( $key, 'option');
    }

    return $certificate_data;
};


/**
 * BH_get_donor_certificate_types
 *
 * Returns the currently supported certificate types (with their labels).
 *
 * @return	array $cert_types
 */

function BH_get_donor_certificate_types() {

    $cert_types = array(
        'appreciation'  => esc_html__('Certificate of Appreciation', 'BH'),
        'memory'        => esc_html__('In Loving memory of', 'BH'),
        'thankyou'      => esc_html__('Thank You', 'BH'),
    );

    return $cert_types;
};

/**
 * BH_get_donation_page_url
 *
 * Gets the URL for a specific donation page, as set in the options page.
 *
 * @return	string $url
 */

function BH_get_donation_page_url($page) {

    $err = 'No page is set for this language yet (' . $page . ')';

    $option_name = 'acf-options_donations_' . $page . '_page';
    $option_val = get_field($option_name, 'option');
    $url = $option_val ? get_the_permalink( $option_val ) : $err;

    return $url;
};

/**
 * BH_get_donation_pages
 *
 * Gets all the pages set in the options page into a single array
 *
 * @return	array $donation_pages
 */

function BH_get_donation_pages() {

    // identifiers for the required pages
    $donation_pages = array(
        'main'      =>  '',
        'options'      =>  '',
        'iframe'    =>  '',
        'thankyou'  =>  '',
    );

    // put the permalinks in a array
    foreach ( $donation_pages as $s => $p ) {
        $donation_pages[$s] = BH_get_donation_page_url($s);
    }

    return $donation_pages;
};

/**
 * BH_subscribe_donor
 *
 * Extracts the relevant data from the donation form, and to subscribe the donor to the relevant mailing list
 *
 * @param array $postdata
 *
 * @return string $res
 */

function BH_subscribe_donor($postdata) {

    define('TEST_MODE', true);

    $groupId    = ''; //TODO Add group ID
    $authId     = ''; //TODO Add AuthID (Token)
    $url        = 'http://webapi.mymarketing.co.il/api/groups/' . $groupId . '/members';

    //open connection
    $ch = curl_init();

    //Preprate headers
    $header = array();
    $header[] = 'Content-type: application/json';
    $header[] = 'Authorization: ' . $authId;

    //Prepare POST body
    $params = array(
        'email'         => $postdata['contact_email'],
        'first_name'    => $postdata['fname'],
        'last_name'     => $postdata['lname'],
    );

    //set the url, number of POST vars, POST data
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

    // TODO uncomment this when things are clearer
    //execute post
    //$result = curl_exec($ch);

    //close connection
    //curl_close($ch);

    // check request results

    $res = TEST_MODE ? 'Test Mode hypothetical success' : '0';

    // TODO uncomment this when things are clearer
    /*
    if (!$result) :
        $res = '1';	// error 1 => at least one process has failed
    endif;
    */
    return $res;

};

/**
 * BH_donation_email_certificate_task
 *
 * When a donation is made in tribute, this function is triggered to send the necessary details to the relevant team member
 *
 * @param array $args
 *
 * @return string $res
 */

function BH_donation_email_certificate_task($args) {

    $message_head =
    '<head>'.
        '<style>'.
        // @TODO add styling (optional)
        '</style>'.
    '</head>';

    $title = 'Donation certificate task';
    $subject = $title . ' (' . $args['code'] . ')';

    $message_body = '<h2>' . $title .'</h2>' .
    '<ul>';

    foreach ($args as $label => $value) {
        $message_body .= '<li><strong>' . $label . ':</strong> ' . $value . '</li>';
    }

    $message_body .= '<ul>';

    $message = '<html>' . $message_head . '<body>' . $message_body . '</body>' . '</html>';

    $to = 'itay@ibanner.co.il';

    $headers  = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type: text/html; charset=utf-8" . "\r\n";
    $headers .= "From: donate@bh.org.il" . "\r\n"; //@TODO setup this mailbox, or perhaps use a different address?

    return @wp_mail($to, $subject, $message, $headers);
};