<form id="donate-form-amount" class="donate-form container">

    <fieldset class="col-sm-offset-2 col-sm-8">
        <legend><?php _e('Amount', 'BH'); ?></legend>

        <div class="radio">
            <label>
                <input type="radio" name="donationAmount" id="other" value="other">
                <?php _e('How much would you like to give?', 'BH'); ?>
            </label>
        </div>
        <div class="radio">
            <label>
                <input type="radio" name="donationAmount" id="100" value="100" title="<?php _e('Donate 100 Shekels', 'BH'); ?>">
                <em>
                    100 <?php _e('NIS', 'BH'); ?>
                </em><?php _e('will help expand our Jewish identity outreach program to IDF soldiers', 'BH') ; ?>
            </label>
        </div>
        <div class="radio">
            <label>
                <input type="radio" name="donationAmount" id="200" value="200" title="<?php _e('Donate 200 Shekels', 'BH'); ?>">
                <em>
                    200 <?php _e('NIS', 'BH'); ?>
                </em><?php _e('will help expand our rich database of Jewish family trees, names and places', 'BH') ; ?>
            </label>
        </div>
        <div class="radio">
            <label>
                <input type="radio" name="donationAmount" id="500" value="500" title="<?php _e('Donate 500 Shekels', 'BH'); ?>">
                <em>
                    500 <?php _e('NIS', 'BH'); ?>
                </em><?php _e('will go towards developing educational materials for school groups', 'BH') ; ?>
            </label>
        </div>
        <div class="radio">
            <label>
                <input type="radio" name="donationAmount" id="1000" value="1000" title="<?php _e('Donate 1000 Shekels', 'BH'); ?>">
                <em>
                    1000 <?php _e('NIS', 'BH'); ?>
                </em><?php _e('will help bring a group of visitors with special needs to Beit Hatfusot', 'BH') ; ?>
            </label>
        </div>

        <div class="checkbox">
            <label>
                <input type="checkbox"> <em><?php _e('I would like this to be a regular annual donation', 'BH'); ?></em>
            </label>
        </div>

    </fieldset>

    <fieldset class="col-sm-offset-2 col-sm-8">
        <legend><?php _e('Tribute Gift', 'BH'); ?></legend>

        <div class="form-group">
            <div class="checkbox">
                <label>
                    <input type="checkbox"> <em><?php _e('Print your certificate in honor, memory or support of someone', 'BH'); ?></em>
                </label>
            </div>
        </div>

        <div class="form-group">
            <select class="form-control">
                <option><?php _e('In honor', 'BH'); ?></option>
                <option><?php _e('In memory', 'BH'); ?></option>
                <option><?php _e('In support of someone', 'BH'); ?></option>
            </select>
        </div>

        <div class="form-group">
            <label for="certificateFullName"><?php _e('Full Name', 'BH'); ?></label>
            <input type="text" class="form-control" id="certificateFullName"  aria-describedby="certificateHelp">
            <span id="certificateHelp" class="help-block"><?php _e('A Printable certificate will be sent to you', 'BH'); ?></span>
        </div>


    </fieldset>
    <div class="form-group col-sm-offset-2 col-sm-8">
        <button type="submit" class="btn btn-default "><?php _e('Continue', 'BH'); ?></button>
        <p>
            <?php
            echo __('A gift of over $5,000 will be recognized on Beit Hatfutsot\'s central donor\'s wall', 'BH') .
                '<br/>' .
                '<a href="">' .
                __('For additional information', 'BH') .
                '</a>';
            ?>
        </p>
    </div>

</form>