<form id="donate-form-details" class="donate-form container">

    <p>
        <?php _e('Amount', 'BH'); ?>: <em>₪200</em>
    </p>

    <fieldset class="col-sm-offset-2 col-sm-8">
        <small><?php _e('Beit Hatfutsot uses a secure connection for online credit card transactions', 'BH'); ?></small>
        <legend><?php _e('Your Details', 'BH'); ?></legend>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="FName"><?php _e('First Name', 'BH'); ?></label>
                    <input type="text" class="form-control" id="FName">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="LName"><?php _e('Last Name', 'BH'); ?></label>
                    <input type="text" class="form-control" id="LName">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="company"><?php _e('Company', 'BH'); ?></label>
            <input type="text" class="form-control" id="company">
        </div>
        <div class="form-group">
            <label for="country"><?php _e('Country', 'BH'); ?></label>
            <select class="form-control" id="country">
                <?php get_template_part('views/components/country-list.html'); ?>
            </select>
        </div>


        <div class="checkbox">
            <label>
                <input type="checkbox"> <em><?php _e('I would like this to be a regular annual donation', 'BH'); ?></em>
            </label>
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