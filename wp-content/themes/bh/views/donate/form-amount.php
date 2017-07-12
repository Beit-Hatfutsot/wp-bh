<fieldset class="flow-amount col-sm-offset-2 col-sm-8">
    <legend><?php esc_html_e('Amount', 'BH'); ?></legend>

    <div class="radio other">
        <input type="radio" name="donationAmount" id="custom-amount-radio" value="other">
        <label for="custom-donation-amount">
            <span><span></span></span>
            <input type="number" class="form-control" name="customDonationAmount" id="custom-amount-field" placeholder="<?php esc_html_e('How much would you like to give? (In NIS)', 'BH'); ?>">
        </label>
    </div>
    <div class="radio">
        <input type="radio" name="donationAmount" id="100" value="100" title="<?php esc_html_e('Donate 100 Shekels', 'BH'); ?>">
        <label for="100"><span><span></span></span>
            <em>100 <?php esc_html_e('NIS', 'BH'); ?></em><?php esc_html_e('will help expand our Jewish identity outreach program to IDF soldiers', 'BH') ; ?>
        </label>
    </div>
    <div class="radio">
        <input type="radio" name="donationAmount" id="200" value="200" title="<?php esc_html_e('Donate 200 Shekels', 'BH'); ?>">
        <label for="200"><span><span></span></span>
            <em>200 <?php esc_html_e('NIS', 'BH'); ?></em><?php esc_html_e('will help expand our rich database of Jewish family trees, names and places', 'BH') ; ?>
        </label>
    </div>
    <div class="radio">
        <input type="radio" name="donationAmount" id="500" value="500" title="<?php esc_html_e('Donate 500 Shekels', 'BH'); ?>">
        <label for="500"><span><span></span></span>
            <em>500 <?php esc_html_e('NIS', 'BH'); ?></em><?php esc_html_e('will go towards developing educational materials for school groups', 'BH') ; ?>
        </label>
    </div>
    <div class="radio">
        <input type="radio" name="donationAmount" id="1000" value="1000" title="<?php esc_html_e('Donate 1000 Shekels', 'BH'); ?>">
        <label for="1000"><span><span></span></span>
            <em>1000 <?php esc_html_e('NIS', 'BH'); ?></em><?php esc_html_e('will help bring a group of visitors with special needs to Beit Hatfusot', 'BH') ; ?>
        </label>
    </div>

    <div class="checkbox">
        <input type="checkbox" id="annual-donation" name="annual-donation" value="annual">
        <label for="annual-donation" class="annual-donation"><span></span>
            <em class="accent"><?php esc_html_e('I would like this to be a regular annual donation', 'BH'); ?></em>
        </label>
    </div>

    <p class="large-donations"><?php echo esc_html__("A gift of over 100,000 NIS will be recognized on", "BH") . ' <a href="#" role="link">' . esc_html__("Beit Hatfutsot's central Donor's Wall", "BH"). '</a>'; ?>.</p>

</fieldset>

<fieldset id="tribute-gift" class="flow-amount col-sm-offset-2 col-sm-6">
    <legend><?php esc_html_e('Tribute Gift', 'BH'); ?></legend>

    <div class="form-group">
        <div class="checkbox">
            <label>
                <input id="show-tribute" name="show-tribute" type="checkbox" value="show-tribute"> <em><?php esc_html_e('Print your certificate in honor, memory or support of someone', 'BH'); ?></em>
            </label>
        </div>
    </div>

    <div class="form-group on-demand hide" aria-expanded="false">
        <label for="tribute-type"><?php esc_html_e('Tribute Type', 'BH'); ?></label>
        <select id="tribute-type" name="tribute_type" class="form-control in-tribute">
            <option><?php esc_html_e('In honor', 'BH'); ?></option>
            <option><?php esc_html_e('In memory', 'BH'); ?></option>
            <option><?php esc_html_e('In support of someone', 'BH'); ?></option>
        </select>
    </div>

    <div class="form-group on-demand hide" aria-expanded="false">
        <label for="tribute-to"><?php esc_html_e('Full Name', 'BH'); ?></label>
        <input type="text" class="form-control" id="tribute-to" name="tribute_to" aria-describedby="certificateHelp">
        <span id="certificateHelp" class="help-block"><?php esc_html_e('A Printable certificate will be sent to you', 'BH'); ?></span>
    </div>


</fieldset>

<div class="form-group flow-amount col-sm-offset-2 col-sm-8">
    <button type="button" id="cont-to-details" class="btn orange-btn"><?php esc_html_e('Continue', 'BH'); ?></button>
</div>