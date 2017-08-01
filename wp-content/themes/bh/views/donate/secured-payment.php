<?php
$src = BH_donation_form_url($_POST);
$subscription = 'No acceptance registered';

if ( isset($_POST['updates-acceptance']) && 'on' == $_POST['updates-acceptance'] ) {
    // TODO This is a placeholder function - no actual API call is made (See Inside)
    $subscription = BH_subscribe_donor($_POST);
}

?>

<section id="donate-process-iframe" class="donate-process-layout">
    <iframe src="<?php echo $src; ?>" frameborder="0" scrolling="no" width="100%" height="1750" name="icount" class="icount-iframe"></iframe>
</section>