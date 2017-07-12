<?php
$src = BH_donation_form_url($_POST);
var_dump($src);
?>

<section id="donate-process-iframe" class="donate-process-layout">
    <iframe src="<?php echo $src; ?>" frameborder="0" scrolling="no" width="100%" height="1750" name="icount" class="icount"></iframe>
</section>