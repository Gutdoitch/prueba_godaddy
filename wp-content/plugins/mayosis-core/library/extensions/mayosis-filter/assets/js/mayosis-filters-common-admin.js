/*!
 * Mayosis Filter common admin 1.7.1
 */
(function($) {
    "use strict";

    $(document).ready(function (){
        // Common JS code
        $(document).on('click', '#show_bottom_widget', function (e){
            if( $(this).is(':checked') ){
                $('#show_open_close_button').parent('label').addClass('mayosis-inactive-settings-field');
                $('.mayosis-bottom-widget-compatibility').addClass('mayosis-opened');
            }else{
                $('#show_open_close_button').parent('label').removeClass('mayosis-inactive-settings-field');
                $('.mayosis-bottom-widget-compatibility').removeClass('mayosis-opened');
            }
        });

        $('#mayosis_primary_color').wpColorPicker({
            defaultColor: '',
            palettes: [ '#0570e2', '#f44336', '#E91E63', '#007cba', '#65BC7B', '#FFEB3B', '#FFC107', '#FF9800', '#607D8B'],
        });

        $('.mayosis-help-tip').tipTip({
            'attribute': 'data-tip',
            'fadeIn':    50,
            'fadeOut':   50,
            'delay':     200,
            'keepAlive': true,
            'maxWidth': "220px",
        });

        $( '.mayosis-sortable-table' ).sortable({
            items: "tr.pro-version.mayosis-sortable-row",
            delay: 150,
            placeholder: "mayosis-filter-field-shadow",
            refreshPositions: true,
            cursor: 'move',
            handle: ".mayosis-order-sortable-handle-icon",
            axis: 'y',
            update: function( event, ui ) {
                renderTableOrder();
            },

        });

        $(document).on( 'click', '.free-version .mayosis-field-sortable-handle', function (){
            alert( mayosisFiltersAdminCommon.prefixesOrderAvailableInPro );
        });

        let mayosisUserAgent = navigator.userAgent.toLowerCase();
        let mayosisIsAndroid = mayosisUserAgent.indexOf("android") > -1;
        let mayosisAllowSearchField = 0;
        if(mayosisIsAndroid) {
            mayosisAllowSearchField = Infinity;
        }

        $("#show_terms_in_content").select2({
            width: '80%',
            placeholder: mayosisFiltersAdminCommon.chipsPlaceholder,
            minimumResultsForSearch: mayosisAllowSearchField,
            tags: true
        });

        $('body').on('click', '.mayosis-notice-dismiss', function (e){
            e.preventDefault();

            let requestParams      = {};
            requestParams._wpnonce = $(this).data('nonce');

            wp.ajax.post( 'mayosis_dismiss_license_notice', requestParams )
                .always( function( response ) {
                    // $spinner.removeClass( 'is-active' );
                    var $el = $( '.license-notice' );
                    $el.fadeTo( 100, 0, function() {
                        $el.slideUp( 100, function() {
                            $el.remove();
                        });
                    });
                })
        });

    }); // End $(document).ready();

    $(document).on('click', '.mayosis-error.is-dismissible > .notice-dismiss', function (e){
            e.preventDefault();

            let $button = $( this );
            let $el = $button.parent('.mayosis-error');

            $el.fadeTo( 100, 0, function() {
                $el.slideUp( 100, function() {
                    $el.remove();
                });
            });
            $el.append( $button );
    });

    function renderTableOrder()
    {
        let num = 0;
        $("tr.mayosis-sortable-row").each( function ( index, element ) {
            num = (index + 1);
            $(element).find('.mayosis-order-td').text(num);
        });
    }

})(jQuery);