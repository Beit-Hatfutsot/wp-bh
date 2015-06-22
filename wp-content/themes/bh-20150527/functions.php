<?php
/**
 * Functions
 *
 * @author 		Beit Hatfutsot
 * @package 	bh
 * @version     1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// theme params
require_once('functions/config.php');

// theme support
require_once('functions/theme.php');

// scripts & styles registration
require_once('functions/scripts-n-styles.php');

// admin header section
require_once('functions/admin/header.php');	// should be outside is_admin() because of the login screen

if ( is_admin() ) {
	require_once('functions/admin/footer.php');
}

// post types
require_once('functions/post-types.php');
require_once('functions/taxonomies.php');

// https
require_once('functions/https.php');

// transients
// require_once('functions/transients.php');

// sidebars
require_once('functions/sidebars.php');

// widgets
require_once('functions/widgets.php');

// menus
require_once('functions/menus.php');

// template
require_once('functions/template.php');

// other
require_once('functions/utils.php');

// shortcodes
require_once('functions/shortcodes.php');

// ACF field groups
require_once('functions/acf-field-groups.php');

// woocommerce
require_once('functions/woocommerce/classes/class-bh-wc-admin-taxonomies.php');
require_once('functions/woocommerce/woocommerce-functions.php');
require_once('functions/woocommerce/woocommerce-hooks.php');

// wpml
require_once('functions/wpml.php');

// events
require_once('functions/events.php');

// Yoast breadcrumbs
// require_once('functions/yoast-breadcrumbs.php');

// Gravity Forms
// require_once('functions/forms.php');

// Contact Form 7 hooks
require_once('functions/forms/wpcf7-hooks.php');