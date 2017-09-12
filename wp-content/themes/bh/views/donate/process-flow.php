<?php
$slug = get_queried_object()->post_name;

switch ($slug) {
    case "secured-payment":
        $current_step = 'payment';
        break;
    case "thank-you":
        $current_step = 'complete';
        break;
    default:
        $current_step = 'your-details';
}

$steps = array(
    'amount'            => __('Amount', 'BH'),
    'your-details'      => __('Details', 'BH'),
    'payment'           => __('Payment', 'BH'),
    'complete'          => __('Complete', 'BH'),
);

?>
<section id="donate-process-flow" class="donate-process-layout">

    <div class="container">
        <nav>
            <ul class="donation-flow">

                <?php
                foreach ($steps as $step_slug => $step_title) {
                    $step_class = 'donation-step';
                    if ($current_step === $step_slug) {
                        $step_class .= ' current-step';
                    }
                    echo '<li id="step--' . $step_slug . '" class="' . $step_class . '">' . $step_title . '</li>';
                    if ('complete' !== $step_slug) {
                        echo ' ' . esc_html__('&gt;', 'BH') . ' ';
                    }
                }
                ?>

            </ul>
        </nav>
    </div>
	
</section>