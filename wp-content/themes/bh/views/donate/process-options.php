<?php
$form_target = BH_get_donation_page_url('iframe');
$afbh_link = get_field('acf-options_afbh_d_form', 'option');

$tab_labels = array(
    'online'    => esc_html_x('Online', 'donation-tabs-default', 'BH'),
    'check'     => esc_html_x('By Check', 'donation-tabs-default', 'BH'),
    'bank'      => esc_html_x('Bank Transfer', 'donation-tabs-default', 'BH'),
    'phone'     => esc_html_x('By Phone', 'donation-tabs-default', 'BH'),
);

if ( wp_is_mobile() ) {
    $tab_labels['check']    = esc_html_x('Check', 'donation-tabs-mobile', 'BH');
    $tab_labels['bank']     = esc_html_x('Bank', 'donation-tabs-mobile', 'BH');
    $tab_labels['phone']    = esc_html_x('Phone', 'donation-tabs-mobile', 'BH');
}

?>

<section id="donate-process-options" class="donate-process-layout">

    <div>

        <!-- Option tabs -->
        <ul id="donate-option-tabs" class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#online" aria-controls="online" role="tab" data-toggle="tab"><span><?php echo $tab_labels['online']; ?></span></a></li>
            <li role="presentation"><a href="#check" aria-controls="check" role="tab" data-toggle="tab"><span><?php echo $tab_labels['check']; ?></span></a></li>
            <li role="presentation"><a href="#transfer" aria-controls="transfer" role="tab" data-toggle="tab"><span><?php echo $tab_labels['bank']; ?></span></a></li>
            <li role="presentation"><a href="#telephone" aria-controls="telephone" role="tab" data-toggle="tab"><span><?php echo $tab_labels['phone']; ?></span></a></li>
        </ul>

        <!-- Option panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="online">
                <p class="tax-deduct">
                    <strong><?php echo esc_html__('Your gift is tax deductible in Israel.', 'BH') . ' '; ?></strong>
                    <?php if ($afbh_link): ?>
                    <a href="https://co.clickandpledge.com/sp/d1/default.aspx?wid=39977" role="link" target="_blank" rel="nofollow" class="us-donation"><?php esc_html_e('Make a tax deductible gift in the United States instead', 'BH') ?></a>
                    <?php endif; ?>
                </p>

                <form id="donate-form" class="donate-form container" method="post" action="<?php echo $form_target; ?>">

                    <?php
                    get_template_part('views/donate/form', 'amount');
                    get_template_part('views/donate/form', 'details');
                    ?>

                </form>

            </div>
            <div role="tabpanel" class="tab-pane container" id="check">

                <?php if( get_field('donate_by_check', 'option') ):

                    the_field('donate_by_check', 'option');

                endif; ?>

            </div>
            <div role="tabpanel" class="tab-pane container" id="transfer">

                <?php if( get_field('donate_by_bank_transfer', 'option') ):

                    the_field('donate_by_bank_transfer', 'option');

                endif; ?>

            </div>
            <div role="tabpanel" class="tab-pane container" id="telephone">

                <?php if( get_field('donate_by_phone', 'option') ):

                    the_field('donate_by_phone', 'option');

                endif; ?>

            </div>
        </div>

    </div>


</section>