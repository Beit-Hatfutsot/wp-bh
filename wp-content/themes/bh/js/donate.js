(function( $ ) {
'use strict';

    var $flowStrip = $('#donate-process-flow'),
        $csRadio = $('#custom-amount-radio'),
        $csHotspot = $('.cs-hotspot'),
        $csField = $('#custom-amount-field');

    function updateExampleImage() {
        $('#certificate-example').attr({
            'src': examplesUrls[activeType][activeLang]['src'],
            'alt': examplesUrls[activeType][activeLang]['alt']
        });
    }

    $(document).ready(function () {
        $('.flow-details').hide();
        $('#donate-layout-options').find($flowStrip).hide();
    });

    $('#show-tribute').click(function(){

        var $tributeOnDemand = $('#tribute-gift').find('.on-demand');

        $tributeOnDemand.toggleClass('hide');
        $tributeOnDemand.attr( 'aria-expanded', function (i, currentState) {
            console.log(currentState);
            var newState = currentState == 'false' ? 'true' : 'false';
            return newState.toString();
        } );

    });

    $('#tribute-type').change(function () {
        activeType = $(this).val();
        $('#tribute-text').attr( 'placeholder', tribute_text_placehoder[activeType] );
        updateExampleImage();
    });

    $('#certificate-language').change(function () {
        activeLang = $(this).val();
        updateExampleImage();
    });

    $('#cont-to-details').click(function (event) {

        var $tabContentArea = $('#donate-process-options').find('.tab-content'),
            $scrollTarget = $('#process-title').position(),
            $donationAmount = $('input[name="donationAmount"]:checked').val();

        $flowStrip.show();
        $('#donate-option-tabs').hide();
        $('.flow-amount').hide().prop('required',false);
        $tabContentArea.css('margin-top', '0');
        $('.tax-deduct').hide();
        $('.flow-details').show();
        $('#amount-fig').text($donationAmount);

        $('html, body').animate({
            scrollTop: $scrollTarget.top - 120}, 800);
        return false;
    });

    $('#need-name-on-receipt').click(function (event) {
        event.preventDefault();
        $('#name-on-receipt').removeClass('hide');
        $('#need-name-on-receipt').addClass('hide');
    });

    $csField.click(function () {
        $csRadio.prop("checked", true);
    });

    $csHotspot.click(function () {
        $csRadio.prop("checked", true);
    });

    $csField.keyup(function () {
        var cs = $csField.val();
        $csRadio.val(cs);
    });

})(jQuery);