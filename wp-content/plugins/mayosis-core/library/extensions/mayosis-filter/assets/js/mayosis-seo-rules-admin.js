/*!
 * Mayosis Filter seo rules admin 1.7.1
 */
(function($) {
    "use strict";
    let seoRulesFormValid = false;

    function validateSeoRulesForm( $el )
    {
        let $spinner = $('#publishing-action .spinner');
        let requestParams          = {};

        $spinner.addClass( 'is-active' );
        /**
         * @todo checkboxes does not validates correctly because they send the same value !!! IMPORTANT
         * independently from checked status
         */

        requestParams.validateData = mayosisSerialize( $el );

        wp.ajax.post( 'mayosis-validate-seo-rules', requestParams )
            .always( function() {
                $spinner.removeClass( 'is-active' );
            })
            .done( function( response ) {
                seoRulesFormValid = true;
                $el.submit();
            })
            .fail( function( response ) {

                let notices = [];

                if( typeof response.errors !== 'undefined' ){
                    $.each( response.errors, function ( index, error ){
                        notices.push( error.message );
                    });

                    if( notices.length < 1 ){
                        notices.push( 'Error: Set was not saved.' );
                    }

                    addNotice( notices );
                }
            });

        return false;
    }

    function addNotice( messages )
    {
        let target = $('form#post');
        let text   = '';
        $.each( messages, function ( index, message ) {
            text += '<p>' + message + '</p>';
        });

        let html = '<div id="message" class="mayosis-error notice notice-error is-dismissible">'
            + text +
            '<button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button>' +
            '</div>';
        if( typeof target !== 'undefined' ){
            if( $("#message").length > 0 ){
                $("#message").remove();
            }
            target.before( html );
        }
    }

    function removeElement($el)
    {
        $el.fadeTo(100, 0, function() {
            $el.slideUp(100, function() {
                $el.remove();
            });
        });
    }

    function addFieldError( fieldId, message )
    {
        let target = $('#'+fieldId);
        let html = '<div class="mayosis-field-notice mayosis-field-notice-error"><p>'+message+'</p></div>';
        if( typeof target !== 'undefined' ){
            target.before( html );
        }
    }

    $.fn.getCursorPosition = function() {
        var input = this.get(0);
        if (!input) return; // No (input) element found
        if ('selectionStart' in input) {
            // Standard-compliant browsers
            return input.selectionStart;
        } else if (document.selection) {
            // IE
            input.focus();
            var sel = document.selection.createRange();
            var selLen = document.selection.createRange().text.length;
            sel.moveStart('character', -input.value.length);
            return sel.text.length - selLen;
        }
    }

    $.fn.createSeoVarsList = function( seoVars )
    {
        let html = '<ul class="mayosis-seo-vars-list">';

        if( Object.keys(seoVars).length > 0 ){
            $.each( seoVars, function ( slug, label ){
                html += '<li data-seovar="{'+slug+'}">'+label+'</li>';
            });
        }else{
            html += '<li>'+mayosisSeoVars.noSeoVarsMsg+'</li>';
        }

        html += '</ul>';
        $(this).replaceWith(html);
        return true;
    }

    $(document).mouseup(function(e)
    {
        let $mayosisContainer = $('.mayosis-vars-container');
        if( $mayosisContainer.length > 0 ){
            // var container = $('.mayosis-vars-container');
            // if the target of the click isn't the container nor a descendant of the container
            if (! $mayosisContainer.is(e.target) && $mayosisContainer.has(e.target).length === 0)
            {
                $mayosisContainer.hide();
            }
        }
    });

    $(document).ready(function (){

        $('form#post').on('submit', function(e){

            // Clear all errors
            removeElement( $('.mayosis-field-notice') );

            // Clear Notice
            removeElement( $('#message') );

            if( ! seoRulesFormValid ){
                e.preventDefault();
                // Validate form. We will submit it from validation method
                validateSeoRulesForm($(this));
            }
        });

        $('.mayosis-seo-vars-list').createSeoVarsList( mayosisSeoVars.seovars );

        $('body').on('click', '.mayosis-open-container', function (e){
            e.preventDefault();
            let link = $(this);
            let fieldId = link.data('field');
            let mayosisContainer = $('#mayosis-vars-container-'+fieldId );
            $('#mayosis_seo_rules-'+fieldId).focus();
            mayosisContainer.toggle();
        });

        $('body').on('focus keypress blur', '.mayosis-vars-insertable', function (e){
            let mayosisPosition = $(this).getCursorPosition();
            $(this).data('caret', mayosisPosition);
        });

        $('body').on('click', '.mayosis-seo-vars-list li', function (){
            let seoVar = $(this).data('seovar');

            let mayosisContainer = $(this).parents('.mayosis-vars-container');

            if( typeof seoVar !== 'undefined' ){
                let inputField = $('#mayosis_seo_rules-'+mayosisContainer.data('container'));
                let caretPos   = inputField.data('caret');

                if( caretPos === '' ){
                    caretPos = inputField.val().length;
                }

                if( caretPos === 0 ){
                    seoVar = seoVar+' ';
                }else if( caretPos === inputField.val().length ){
                    seoVar = ' '+seoVar;
                }else{
                    seoVar = ' '+seoVar+' ';
                }

                insertAtCaret( inputField, seoVar, caretPos );
            }

            mayosisContainer.hide();
        });

        $('body').on('change', '#mayosis_seo_rules-rule_post_type', function (){
            removeElement( $('.mayosis-field-notice') );
            let selected = $(this).val();
            let $spinner = $( '.mayosis-intersection-fields-wrapper' ).children( '.spinner' );
            $spinner.addClass( 'is-active' );
            let requestParams          = {};
            requestParams._wpnonce = $("#mayosis_seo_rule_nonce").val();
            requestParams.postType = selected;
            requestParams.postId   = $("#post_ID").val();

            wp.ajax.post( 'mayosis-get-indexed-filters', requestParams )
                .always( function() {
                    $spinner.removeClass( 'is-active' );
                })
                .done( function( response ) {

                    $( '#mayosis-intersections-table' ).replaceWith( response.html );
                    $('.mayosis-seo-vars-list').createSeoVarsList( response.seovars );
                })

                .fail( function(response) {
                    if( typeof response !== 'undefined'){
                        addFieldError( 'mayosis-intersection-fields-container', response.message );
                    }
                });
        });
    });

    function mayosisSerialize( $el ){

        var obj = {};
        var inputs = $el.find('select, textarea, input').serializeArray();

        for( var i = 0; i < inputs.length; i++ ) {
            mayosisBuildObject( obj, inputs[i].name, inputs[i].value );
        }
        return obj;
    };

    function mayosisBuildObject( obj, name, value ){
        name = name.replace('[]', '[%%index%%]');

        var keys = name.match(/([^\[\]])+/g);
        if( !keys ) return;
        var length = keys.length;
        var ref = obj;

        for( var i = 0; i < length; i++ ) {
            var key = String( keys[i] );
            if( i == length - 1 ) {
                if( key === '%%index%%' ) {
                    ref.push( value );
                } else {
                    ref[ key ] = value;
                }
            } else {
                if( keys[i+1] === '%%index%%' ) {
                    if( !mayosisIsArray(ref[ key ]) ) {
                        ref[ key ] = [];
                    }
                } else {
                    if( !mayosisIsObject(ref[ key ]) ) {
                        ref[ key ] = {};
                    }
                }
                ref = ref[ key ];
            }
        }
    };

    function mayosisIsArray( a ){
        return Array.isArray(a);
    };

    function mayosisIsObject( a ){
        return ( typeof a === 'object' );
    }

})(jQuery);

function insertAtCaret( target, text, caretPos )
{
    let textAreaTxt = target.val();
    let result = textAreaTxt.substring(0, caretPos) + text + textAreaTxt.substring(caretPos);
    result = result.replace(/ +(?= )/g,'');
    target.val(result);

    return true;
}