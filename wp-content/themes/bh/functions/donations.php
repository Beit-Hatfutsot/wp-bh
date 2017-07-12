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
