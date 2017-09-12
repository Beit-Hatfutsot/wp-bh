<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

    <?php
    get_template_part('views/header/header', 'meta');
    wp_head();

    if ( isset($_GET['show-tribute']) && 1 ==  $_GET['show-tribute'] ) {
        $args = array(
            'code'          => $_GET['confirmation_code'],
            'name'          => $_GET['customer_name'],
            'email'         => $_GET['customer_email'],
            'phone'         => $_GET['customer_phone'],
            'type'          => $_GET['tribute_type'],
            'lang'          => $_GET['certificate_language'],
            'text'          => $_GET['tribute_text'],
            'date'          => current_time('d/m/Y'),
        );

        $tribute_task = BH_donation_email_certificate_task($args);
    }
    ?>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <style>
        html {
            background: none;
        }

        body {
            box-shadow: none;
            width: 100%;
        }

        #wpadminbar {
            display: none;
        }

        .donations-content {
            margin-top: 0;
        }
    </style>

    <script>
        var paymentLabel    = parent.document.getElementById('step--payment');
        var completeLabel   = parent.document.getElementById('step--complete');

        paymentLabel.className = paymentLabel.className.replace( ' current-step', '' );
        completeLabel.className += ' current-step';

    </script>

</head>

<body <?php body_class(); ?>>

<section id="donate-process-thank-you" class="donate-process-layout">
    <h1 id="thank-you-title"><?php the_title() ?></h1>
    <?php the_content() ?>
</section>


<?php

// Get variables
$wpml_lang = function_exists('icl_object_id') ? ICL_LANGUAGE_CODE : '';

// Globals
global $globals;

?>

<script>

    var js_globals = {};
    js_globals.template_url	= "<?php echo TEMPLATE; ?>";
    js_globals.wpml_lang	= "<?php echo $wpml_lang; ?>";
    js_globals.ajaxurl		= "<?php echo $wpml_lang ? str_replace( "/$wpml_lang/", "/", admin_url( "admin-ajax.php" ) ) : admin_url( "admin-ajax.php" ); ?>";		// workaround for WPML bug
    js_globals.galleries	= '<?php echo json_encode( $globals['_galleries'] ); ?>';

</script>

<?php

// get_template_part( 'views/footer/footer' );

wp_enqueue_script( 'bootstrap' );
wp_enqueue_script( 'general' );
wp_enqueue_script( 'donate' );

wp_footer();

?>

</body>
</html>