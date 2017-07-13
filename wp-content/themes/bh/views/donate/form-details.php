<div class="form-group flow-details col-sm-offset-2 col-sm-8">
    <p class="amount-indicator"><?php esc_html_e('Amount', 'BH'); ?>: <em class="the-amount">₪<span id="amount-fig">200</span></em></p>
</div>

<fieldset id="your-details" class="flow-details col-sm-offset-3 col-sm-6">
    <legend class="your-details"><?php esc_html_e('Your Details', 'BH'); ?></legend>
    <p class="secure-connection"><small><?php esc_html_e('Beit Hatfutsot uses a secure connection for online credit card transactions', 'BH'); ?></small></p>


    <div class="row">

        <div class="col-sm-6">
            <div class="form-group">
                <label for="FName" class="required"><?php esc_html_e('First Name', 'BH'); ?></label>
                <input type="text" class="form-control" id="FName" name="fname" required="required">
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label for="LName" class="required"><?php esc_html_e('Last Name', 'BH'); ?></label>
                <input type="text" class="form-control" id="LName" name="lname" required="required">
            </div>
        </div>

    </div>

    <div id="need-name-on-receipt" class="form-group">
        <a href="#" role="button"><small><?php esc_html_e('Would you like the receipt to be put in someone else\'s name?', 'BH'); ?></small></a>
    </div>

    <div id="name-on-receipt" class="form-group hide">
        <label for="receipt-name"><?php esc_html_e('Name on the receipt', 'BH'); ?></label>
        <input type="text" class="form-control" id="receipt-name" name="full_name">
    </div>

    <div class="form-group">
        <label for="company"><?php esc_html_e('Company', 'BH'); ?></label>
        <input type="text" class="form-control" id="company" name="company">
    </div>

    <div class="form-group">
        <label for="country" class="required"><?php esc_html_e('Country', 'BH'); ?></label>
        <select class="form-control" id="country" name="customer_country" required="required">
            <?php $c_list = file_get_contents(dirname(dirname(__FILE__)) . '/components/country-list.html'); echo $c_list; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="address-line-1" class="required"><?php esc_html_e('Address', 'BH'); ?></label>
        <input type="text" class="form-control" name="customer_street" id="address-line-1" required="required">
    </div>

    <div class="form-group">
        <label for="address-line-2 sr-only"><?php esc_html_e('Address - line 2', 'BH'); ?></label>
        <input type="text" class="form-control" id="address-line-2" name="address-line-2" placeholder="<?php esc_html_e('Address line 2 (Optional)', 'BH'); ?>">
    </div>

    <div class="row">

        <div class="col-sm-6">
            <div class="form-group">
                <label for="city" class="required"><?php esc_html_e('City', 'BH'); ?></label>
                <input type="text" class="form-control" id="city" name="customer_city" required="required">
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label for="zip" class="required"><?php esc_html_e('Postal/Zip Code', 'BH'); ?></label>
                <input type="text" class="form-control" id="zip" name="customer_zip" required="required">
            </div>
        </div>

    </div>

    <div class="form-group">
        <label for="email" class="required"><?php esc_html_e('Email', 'BH'); ?></label>
        <input type="email" class="form-control" id="email" name="contact_email" required="required" placeholder="<?php esc_html_e('Your receipt will be sent to this address', 'BH'); ?>">
    </div>

    <div class="form-group">
        <label for="phone" class="required"><?php esc_html_e('Phone number', 'BH'); ?></label>
        <input type="tel" class="form-control" id="phone" name="contact_phone" required="required" placeholder="<?php esc_html_e('Or Mobile number', 'BH'); ?>">
    </div>

</fieldset>

<fieldset id="acceptance" class="flow-details col-sm-offset-3 col-sm-6">

    <div class="checkbox">
        <input type="checkbox" value="terms-accepted" name="terms-acceptance" id="terms-acceptance" required><label for="terms-acceptance"><?php esc_html_e('I\'ve read and accept the ', 'BH'); ?><a href="#" role="link" target="_blank"><?php esc_html_e('terms & conditions', 'BH') ?></a></label>
    </div>

    <div class="checkbox">
        <input type="checkbox" value="updates-accepted" name="m__updates-acceptance" id="updates-acceptance" checked><label for="updates-acceptance"><?php esc_html_e('Yes, I want to receive news and updates from the Museum', 'BH'); ?></label>
    </div>

</fieldset>

<fieldset id="submit" class="flow-details col-sm-offset-3 col-sm-6">

    <div class="form-group submit">
        <button type="submit" form="donate-form" class="btn orange-btn"><?php esc_html_e('Continue', 'BH'); ?></button>
    </div>

</fieldset>


