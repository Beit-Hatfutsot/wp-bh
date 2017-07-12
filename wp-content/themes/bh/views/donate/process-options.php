<section id="donate-process-options" class="donate-process-layout">

    <div>

        <!-- Option tabs -->
        <ul id="donate-option-tabs" class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#online" aria-controls="online" role="tab" data-toggle="tab"><span>Online</span></a></li>
            <li role="presentation"><a href="#check" aria-controls="check" role="tab" data-toggle="tab"><span>By Check</span></a></li>
            <li role="presentation"><a href="#transfer" aria-controls="transfer" role="tab" data-toggle="tab"><span>Bank Transfer</span></a></li>
            <li role="presentation"><a href="#phone" aria-controls="phone" role="tab" data-toggle="tab"><span>By Phone</span></a></li>
        </ul>

        <!-- Option panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="online">
                <p class="tax-deduct">
                    <strong><?php echo esc_html__('Your gift is tax deductible in Israel.', 'BH') . ' '; ?></strong>
                    <a href="https://co.clickandpledge.com/sp/d1/default.aspx?wid=39977" role="link" target="_blank" rel="nofollow" class="us-donation">Make a tax deductible gift in the United States instead</a>
                </p>

                <form id="donate-form" class="donate-form container" method="post" action="<?php echo site_url() . '/donate/secured-payment/'; ?>">

                    <?php
                    get_template_part('views/donate/form', 'amount');
                    get_template_part('views/donate/form', 'details');
                    ?>

                </form>

            </div>
            <div role="tabpanel" class="tab-pane container" id="check">
                <p>
                    <strong><?php esc_html_e('Please make check payable to Beit Hatfutsot and send to:', 'BH'); ?></strong>
                </p>
                <address>
                    <?php
                    $email = 'racheli@bh.org.il';
                    $email_link = '<a href="' . $email . '">' . $email . '</a>';
                    $address = sprintf(
                            __('P.O.B %1$s Tel-Aviv<br/>%2$s Israel<br/>For more information please contact us at %3$s' , 'BH'),
                            '39359' , '6139202', $email_link );
                    echo $address;
                    ?>
                </address>
            </div>
            <div role="tabpanel" class="tab-pane container" id="transfer">
                <p>
                    <strong><?php esc_html_e('If you wish to make a bank transfer from within Israel:', 'BH'); ?></strong>
                </p>
                <p>
                    <?php
                    $email = 'racheli@bh.org.il';
                    $email_link = '<a href="' . $email . '">' . $email . '</a>';
                    $address = sprintf( __('Bank Mizrahi-Tefahot<br/>Branch: %1$s<br/>Account: %2$s' , 'BH'), '493' , '387660' );
                    echo $address;
                    ?>
                </p>
                <p>
                    <?php echo __('For more information please contact us at', 'BH') . ' ' . $email_link; ?>
                </p>
            </div>
            <div role="tabpanel" class="tab-pane container" id="phone">
                <div class="container">
                    <p>
                        <strong><?php esc_html_e('Please call us on this number:<br/>+972 3 7457841', 'BH'); ?></strong>
                    </p>
                </div>
            </div>
        </div>

    </div>


</section>