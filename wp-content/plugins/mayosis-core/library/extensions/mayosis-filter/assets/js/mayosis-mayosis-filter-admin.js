/*!
 * Mayosis Filter set admin 1.7.1
 */
(function($) {
    "use strict";
    let filtersFormValid = false;
    let postTypesTaxList = mayosisSetVars.postTypesTaxList;
    let numFieldNoTaxes  = mayosisSetVars.numFieldNoTaxes;
    let numFieldAttrs    = mayosisSetVars.numFieldAttrs;

    function validateFiltersForm( $el )
    {
        let $spinner = $('#publishing-action .spinner');
        let requestParams          = {};

        $spinner.addClass( 'is-active' );
        /**
         * @todo checkboxes does not validates correctly because they send the same value !!! IMPORTANT
         * independently from checked status
         */

        requestParams.validateData = mayosisSerialize( $el );

        wp.ajax.post( 'mayosis-validate-filters', requestParams )
            .always( function() {
                $spinner.removeClass( 'is-active' );
            })
            .done( function( response ) {
                filtersFormValid = true;
                $el.submit();
            })
            .fail( function( response ) {

                let notices = [];
                let filterContainer = '';

                if( typeof response.errors !== 'undefined' ){
                    $.each( response.errors, function ( index, error ){

                        if( typeof error.id !== 'undefined'){
                            addFieldError( error.id, error.message );

                            // Open filter container to show error
                            filterContainer = $('#'+error.id).parents('.mayosis-filter-item');
                            openFilter(filterContainer);

                            // Open additional fields if errors are there
                            if( $('#'+error.id).parents('.mayosis-filter-additional-fields').length > 0 ){
                                openAdditional(filterContainer);
                            }
                        }else{
                            notices.push( error.message );
                        }

                    });

                    if( notices.length < 1 ){
                        notices.push( 'Error: Set was not saved.' );
                    }

                    addNotice( notices );
                }
            });

        return false;
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

    function addNotice( messages )
    {
        let target = $('form#post');
        let text   = '';
        $.each( messages, function ( index, message ) {
            text += '<p>' + message + '</p>';
        });

        let html = '<div id="message" class="error notice notice-error is-dismissible">'
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

    function openFilter($el)
    {
        let head = $el.find('.mayosis-filter-head'),
            body = head.next('.mayosis-filter-body');
        head.addClass('mayosis-opened');
        body.slideDown({
            duration: 200,
            complete: function (){
                body.addClass('mayosis-opened');
            }
        });
    }

    function closeFilter($el)
    {
        let head = $el.find('.mayosis-filter-head'),
            body = head.next('.mayosis-filter-body');

        head.removeClass('mayosis-opened');
        body.slideUp({
            duration: 200,
            complete: function (){
                body.removeClass('mayosis-opened');
            }
        });
    }

    function closeAdditional($el)
    {
        $el.find('.mayosis-filter-additional-fields').slideUp({
            duration: 200,
            complete: function (){
                $(this).removeClass('mayosis-opened');
            }
        });
    }

    function openAdditional($el)
    {
        $el.find('.mayosis-filter-additional-fields').slideDown({
            duration: 200,
            complete: function (){
                $(this).addClass('mayosis-opened');
            }
        });
    }

    /**
     * Creates array with taxonomies that do not belong to the Post type
     * selected in Filter Set
     * @returns {[]|*[]}
     */
    function getForbiddenTaxes()
    {
        if( typeof mayosisSetVars.postTypesTaxList !== 'undefined'){
            let postType = $('#mayosis_set_fields-post_type').val();
            let allowedTaxes   = [];
            let forbiddenTaxes = [];

            if( typeof mayosisSetVars.postTypesTaxList[postType] !== 'undefined' ){
                $.each( mayosisSetVars.postTypesTaxList[postType], function ( iNdex, taxProps ){
                    allowedTaxes.push(taxProps['name']);
                });
            }

            $.each( mayosisSetVars.postTypesTaxList, function ( pType, taxesArray ){
                if( pType !== postType ){
                    $.each( taxesArray, function ( index, theTax ){
                        if( allowedTaxes.includes(theTax['name']) === false ){
                            forbiddenTaxes.push(theTax['name']);
                        }
                    } )
                }
            });

            return forbiddenTaxes;
        }

        return [];
    }

    /**
     * Retrieves already selected filter entities to disable double using of them
     * @param $inputs - select tags, where we collect used entities. Usually .mayosis-field-entity
     * @param excludeInput
     * @returns {boolean|[]}
     */
    function getUsedEntities( $inputs, excludeInput )
    {
        let usedEntities = [];
        let currentVal   = '';
        // Pass through these entities
        let doNotInclude = ['post_meta', 'post_meta_num', 'post_meta_exists', 'tax_numeric'];

        if ( $inputs.length > 0 ) {
            $inputs.each( function(){
                currentVal = $(this).val();

                // Continue
                if( $(this).attr('id') == excludeInput.attr('id') ){
                    return;
                }

                if( doNotInclude.includes( currentVal ) ){
                    return;
                }
                if( currentVal ) {
                    usedEntities.push( currentVal );
                }
            });

            return usedEntities;
        }
        return false;
    }

    /**
     * Pass through new filter entity options and set as disabled already used taxonomies
     * @param $theSelect - the select element with options to set. Usually it is .mayosis-field-entity
     * @param dropdownClass - class of the select element where we have to set option status
     * @param noChange
     * @returns {boolean}
     */
    function setAvailableEntities( $theSelect, noChange )
    {   // .mayosis-field-entity
        let currentVal      = '';
        let selectClass     = $theSelect.attr('class');
        let exclude         = getUsedEntities( $( '.'+selectClass ), $theSelect ); // Entities already selected in other filters
        let forbiddenTaxes  = getForbiddenTaxes(); // Entities that do not belong to the Post type

        $theSelect.find('option').each( function (){
            currentVal = $(this).val();

            if( currentVal === 'post_meta_exists' && ( mayosisSetVars.filtersPro < 1 ) ) {
                return;
            }
            if( currentVal === 'tax_numeric' && ( mayosisSetVars.filtersPro < 1 ) ) {
                return;
            }

            if( exclude.includes( currentVal ) || forbiddenTaxes.includes( currentVal ) ){
                $(this).attr( 'disabled', 'disabled' );
            }else{
                $(this).removeAttr( 'disabled' );
            }
        } );

        // If currently selected option is disabled, make first available option selected.
        let disabled = $theSelect.find('option:selected').attr('disabled');
        // if noChange === false this works
        if( disabled === 'disabled' && ! noChange ){
            $theSelect.find('option:not([disabled]):first').prop('selected', true)
                .trigger('change');
        }

        return true;
    }


    function passNewEntities( select )
    {
        let time = 0;

        $('.mayosis-new-filter-item .mayosis-field-entity').each( function () {
            let select   = $(this);
            let noChange = false;
            // Do not change current select tag
            if( $(this).attr('id') == select.attr('id') ) {
                noChange = true;
            }

            setTimeout( function(){ setAvailableEntities( select, noChange ); }, time);
            time += 100;
        });
    }

    $(document).ready(function (){

        $('form#post').on('submit', function(e){

            // Clear all errors
            removeElement( $('.mayosis-field-notice') );

            // Clear Notice
            removeElement( $('#message') );

            // Close All Filters
            closeFilter( $(".mayosis-filter-item") );

            if( ! filtersFormValid ){
                e.preventDefault();
                // Validate form. We will submit it from validation method
                validateFiltersForm($(this));
            }
        });

        $('.mayosis-add-filter').on('click', function (e){
            e.preventDefault();
            let html = $('#mayosis-new-filter').html();
            let $el = $(html);
            let search = 'mayosis_new_id';
            let replace = uniqId('filter_');
            let replaceAttr = function(i, value){
                return value.replace( search, replace );
            }
            let applyButtonPosition  = $("#mayosis_set_fields-apply_button_menu_order").val();
            let filtersListContainer = $('#mayosis-filters-list');
            let filtersLength        = filtersListContainer.find(".mayosis-filter-item").length.toString();
            let applyButtonItem      = $("#mayosis-filter-id-apply-button");

            $el.find('[id*="' + search + '"]').attr('id', replaceAttr);
            $el.find('[for*="' + search + '"]').attr('for', replaceAttr);
            $el.find('[name*="' + search + '"]').attr('name', replaceAttr);
            $el.data('fid', replace);
            $el.attr('id', 'mayosis-filter-id-'+replace);

            if( applyButtonPosition === filtersLength || applyButtonPosition === '-1' ){
                applyButtonItem.before($el);
            }else{
                filtersListContainer.append($el);
            }

            let select = $el.find('.mayosis-field-entity');

            syncEntityWithPrefix(select);
            handleMetaKeyField(select);
            setEntityTableClass(select);
            syncEntityWithView(select);
            syncEntityWithSortTerms(select);

            // Make already used entities unavailable to selection
            setAvailableEntities( select );
            handleHierarchyField( select );
            // handleUsedForVariationsField( select );

            $el.find('.mayosis-field-exclude').select2({
                width: '100%',
                placeholder: mayosisSetVars.excludePlaceholder,
            });

            // Fire this event to load exclude terms for first filter
            if( $(".mayosis-filter-item:not(.mayosis-filter-item-apply-button)").length === 1 ){
                select.trigger('change');
            }

            $('.mayosis-help-tip').tipTip({
                'attribute': 'data-tip',
                'fadeIn':    50,
                'fadeOut':   50,
                'delay':     200,
                'keepAlive': true,
                'maxWidth': "220px",
            });

            openFilter($el);

            renderMenuOrder();
            handleNoFiltersMessage();

            // Update Parent filter dropdown
            mayosisAddNewFilterToParentList();

            /**
             * @todo There is problem with down arrow when we adding new filter !!! IMPORTANT
             */

        });

        $('.mayosis-form-fields-table:not(.mayosis-filter-tax_numeric) .mayosis-field-exclude, .mayosis-form-fields-table:not(.mayosis-filter-post_meta_num) .mayosis-field-exclude, .mayosis-form-fields-table:not(.mayosis-filter-post_meta_exists) .mayosis-field-exclude').select2({
            width: '100%',
            placeholder: mayosisSetVars.excludePlaceholder
        });

        $('body').on('click', '.notice-dismiss', function(e){
            e.preventDefault();
            removeElement( $('#message') );
        });

        // Show delete buttons
        $('body').on('click', '.mayosis-button-link-delete', function(e){
            e.preventDefault();
            $(this).parents('.mayosis-filter-label-td')
                .next('.mayosis-filter-field-td')
                .children('.mayosis-filter-delete-wrapper').css('visibility', 'visible');
        });

        $('body').on('click', '.mayosis-filter-delete-cancel', function(e){
            e.preventDefault();
            removeElement( $('.mayosis-field-notice') );
            $(this).parents('.mayosis-filter-delete-wrapper').css('visibility', 'hidden');
        });

        $('body').on('click', '.mayosis-done-action', function(e){
            $(this).parents('.mayosis-filter-body').slideToggle(200)
                    .toggleClass('mayosis-opened')
                .children('.mayosis-filter-additional-fields').removeClass('mayosis-additional-opened')
                    .hide();
            $(this).parents('.mayosis-filter-body').prev('.mayosis-filter-head').toggleClass('mayosis-opened');
            // Hide delete buttons
            $(this).parents('.mayosis-filter-field-td')
                .next('.mayosis-filter-field-td')
                .find('.mayosis-filter-delete-wrapper').css('visibility', 'hidden');
        });

        $('body').on('click', '.mayosis-title-action', function(e){
            let head = $(this).parent('.mayosis-filter-head'),
                body = head.next('.mayosis-filter-body');
            head.toggleClass('mayosis-opened');
            body.slideToggle(200)
                    .toggleClass('mayosis-opened')
                .children('.mayosis-filter-additional-fields').removeClass('mayosis-additional-opened')
                    .hide();
            body.find('.mayosis-filter-delete-wrapper').css('visibility', 'hidden');

            let moreOptions = body.find('.mayosis-more-options-toggle');
            if( moreOptions.hasClass('mayosis-opened') ){
                moreOptions.trigger('click');
            }
        });

        $('body').on('click', '.mayosis-more-options-toggle', function(e){
            e.preventDefault();

            let moreText = $(this).text();

            if( moreText === mayosisSetVars.moreOptions ){
                $(this).text( mayosisSetVars.lessOptions);
            }else{
                $(this).text( mayosisSetVars.moreOptions);
            }

            $(this).toggleClass('mayosis-opened');
            $(this).parents('.mayosis-filter-body').find('.mayosis-filter-additional-fields').slideToggle(200)
            .toggleClass('mayosis-additional-opened');
        });

        $('body').on('change', 'select.mayosis-field-ename', function(e){
            let time = 0;
            // let fid = $(this).parents('.mayosis-filter-item').data('fid');

            $( $('.mayosis-new-filter-item select.mayosis-field-ename').get().reverse() ).each( function () {
                let eNameSelect = $(this);

                setTimeout( function(){ setAvailableEntities( eNameSelect, false ); }, time);
                time += 100;
            });
        });

        $('body').on('change', '.mayosis-field-entity', function(e){
            let thisSelect = $(this);
            let theTitle = '';

            // Set available entities again
            passNewEntities(thisSelect);
            syncEntityWithPrefix(thisSelect);
            handleMetaKeyField(thisSelect);
            handleLogicField(thisSelect);
            setEntityTableClass(thisSelect);
            syncEntityWithView(thisSelect);
            syncEntityWithSortTerms(thisSelect);

            handleHierarchyField(thisSelect);
            // handleUsedForVariationsField(select);

            // Load terms for exclude
            let entity = $(this).val();
            let fid    = $(this).parents('.mayosis-filter-item').data('fid');

            if ( entity === 'tax_numeric' ) {
                $('#mayosis_filter_fields-'+fid+'-e_name').trigger('change');
            }

            if( entity === 'tax_numeric' || entity === 'post_meta' || entity === 'post_meta_num' || entity === 'post_meta_exists' ){
                let target = $('#mayosis_filter_fields-'+fid+'-exclude');
                target.select2({
                    disabled: true,
                    width: '100%'
                });
            }else{
                loadExcludeItems(entity, fid);
            }

            let entityLabel = $(this).find('option:selected').text();
            let target = $(this).parents('.mayosis-filter-item').find('.mayosis-filter-head li.mayosis-filter-entity');
            target.text(entityLabel);

            theTitle = $("#mayosis_filter_fields-"+fid+"-label").val();

            if( ! theTitle ){
                theTitle = mayosisSetVars.newFilter;
            }

            $(".mayosis-field-parent-filter option[value='"+fid+"'").each(function (index, element){
                $(this).text( theTitle + " (" +mayosisShortenEname( entity )+ ")" );
                if( entity === 'post_meta_num' || entity === 'tax_numeric' ){
                    $(this).attr('disabled', 'disabled');
                }else{
                    $(this).removeAttr('disabled');
                }
            });
        });

        // Try to prepend slug if it already exists
        $('body').on('input change', '.mayosis-field-ename', function(){
                let ename = $(this).val();
                let fid = $(this).parents('.mayosis-filter-item').data('fid');
                let entity = $('#mayosis_filter_fields-'+fid+'-entity').val();
                let val = '';
                let slugs = mayosisSetVars.filterSlugs;

                if ( entity === 'post_meta_num' ) {
                    val = 'post_meta_num_' + ename;
                } else if ( entity === 'tax_numeric' ) {
                    val = 'tax_numeric_' + ename;
                } else if ( entity === 'post_meta_exists' ) {
                    val = 'post_meta_exists_' + ename;
                } else {
                    val = 'post_meta_' + ename;
                }

                if( typeof slugs[val] !== 'undefined' ){
                    $('#mayosis_filter_fields-'+fid+'-slug').val( slugs[val] )
                        .trigger('input');

                    // Do not load exclude terms for Post Meta Num and Tax Numeric
                    if( entity !== 'post_meta_num' && entity !== 'tax_numeric' ){
                        loadExcludeItems(entity, fid, ename);
                    }

                }else{
                    $('#mayosis_filter_fields-'+fid+'-slug').val('')
                        .trigger('input');
                    $('#mayosis_filter_fields-'+fid+'-exclude').select2({
                        disabled: true,
                        width: '100%',
                    });
                }
        });

        $('body').on('input', '.mayosis-field-value-step', function (){
            $(this).val( $(this).val().replace(/,/g, '.') );
            $(this).val( $(this).val().replace(/[^\d\.]/g, '') );
        });

        $('body').on('input keydown', '#mayosis_set_fields-apply_button_text', function (){
            let target = $("#mayosis-filter-id-apply-button").find('.mayosis-button-apply');
            cpaLiveWrite( $(this), target );
        });

        $('body').on('input keydown', '#mayosis_set_fields-reset_button_text', function (){
            let target = $("#mayosis-filter-id-apply-button").find('.mayosis-button-reset');
            cpaLiveWrite( $(this), target );
        });

        $('body').on('input keydown', '.mayosis-field-slug', function (){
            let target = $(this).parents('.mayosis-filter-item').find('.mayosis-filter-head li.mayosis-filter-slug');
            cpaLiveWrite( $(this), target );
        });

        $('body').on('input keydown', '.mayosis-field-label', function (){
            let target = $(this).parents('.mayosis-filter-item').find('.mayosis-filter-head li.mayosis-filter-label');
            cpaLiveWrite( $(this), target );

            let fid   = $(this).parents(".mayosis-filter-item").data('fid');
            let eName = $("#mayosis_filter_fields-"+fid+"-entity").val();
            eName = mayosisShortenEname( eName );
            let theTitle = $(this).val();

            $(".mayosis-field-parent-filter option[value='"+fid+"'").each(function (index, element){
                $(this).text( theTitle + " (" + eName + ")" );
            });
        });

        $('body').on('change', '.mayosis-field-view', function(){
            let optionName = $(this).find('option:selected').text();
            let optionVal  = $(this).find('option:selected').val();
            let $divFilterItem = $(this).parents('.mayosis-filter-item');
            let target = $divFilterItem.find('.mayosis-filter-head li.mayosis-filter-view');
            let allowedViews = ['checkboxes', 'radio', 'labels'];
            target.text(optionName);

            if( allowedViews.includes(optionVal) ){
                $divFilterItem.find('.mayosis-field-search-tr').show();
                $divFilterItem.find('.mayosis-field-more-less-tr').show();
            }else{
                $divFilterItem.find('.mayosis-field-search-tr').hide();
                $divFilterItem.find('.mayosis-field-more-less-tr').hide();
            }

            if( optionVal === 'checkboxes' ) {
                $divFilterItem.find('.mayosis-form-fields-table').addClass('mayosis-view-checkboxes');
            } else {
                $divFilterItem.find('.mayosis-form-fields-table').removeClass('mayosis-view-checkboxes');
            }

        });

        $( '.mayosis-mayosis-filter-wrapper .mayosis-filters-list' ).sortable({
            items: "> div.mayosis-filter-item",
            delay: 150,
            placeholder: "mayosis-filter-item-shadow",
            refreshPositions: true,
            cursor: 'move',
            handle: ".mayosis-filter-order",
            axis: 'y',
            update: function( event, ui ) {
                renderMenuOrder();
            },
            start: function ( event, ui ){
                var height, $this = $(this), // .mayosis-filters-list
                    head = ui.item.children('.mayosis-filter-head'),
                    inside = ui.item.children('.mayosis-filter-body');

                if (inside.hasClass('mayosis-opened') ) {
                    inside.removeClass('mayosis-opened')
                        .hide();
                    head.removeClass('mayosis-opened');
                    $(this).sortable('refreshPositions');
                }

                $('.mayosis-filter-item-shadow').css('min-height', head.height() + 'px');
            }

        });

        $('.mayosis-mayosis-filter-wrapper .mayosis-filters-list').keydown(function(e){
            if (e.keyCode == 65 && (e.ctrlKey || e.metaKey) ) {
                e.target.select()
            }
        })

        $( ".mayosis-filters-list" ).disableSelection();

        // Deleter filter
        $('body').on('click', '.mayosis-filter-delete', function (){
            removeElement( $('.mayosis-field-notice') );
            let $spinner = $(this).prev('.spinner');
            $spinner.addClass( 'is-active' );
            let requestParams          = {};
            requestParams._wpnonce = $("#mayosis_set_nonce").val();
            requestParams.fid   = $(this).data('fid');

            // @feature localize this var
            if( requestParams.fid === 'mayosis_new_id' ){
                let $filterItem = $(this).parents('.mayosis-filter-item');
                $filterItem.slideUp({
                    duration: 200,
                    complete: function (){
                        $(this).remove();
                        renderMenuOrder();
                        handleNoFiltersMessage();
                    }
                })
            }

            // Remove current filter from Parent filters list
            let dataFid = $(this).parents('.mayosis-filter-item').data('fid');
            mayosisDeleteFilterFromParentList( dataFid );

            wp.ajax.post( 'mayosis-delete-filter', requestParams )
                .always( function() {
                    $spinner.removeClass( 'is-active' );
                })
                .done( function( response ) {

                    if( typeof response !== 'undefined' && typeof response.fid !== 'undefined' ){
                        $("#mayosis-filter-id-"+response.fid).slideUp({
                            duration: 200,
                            complete: function (){
                                $(this).remove();
                                renderMenuOrder();
                                handleNoFiltersMessage();

                                // Set available entities again
                                // @todo doesn't work properly if there are several new filters exists on a page !!! IMPORTANT
                                // doesn't make some entities available, but should.
                                passNewEntities();

                            }
                        })
                    }
                })

                .fail( function(response) {
                    if( typeof response !== 'undefined'){
                        addFieldError( 'mayosis-filter-delete-wrapper-'+response.fid, response.message );
                    }
                });
        });

        // Get set location fields
        $('body').on('change', '#mayosis_set_fields-post_type', function (){

            let postType = $(this).val();
            $("#mayosis-filters-list").attr('data-posttype', postType );

            if( mayosisSetVars.filtersPro < 1 ){
                return true;
            }
            setAvailableEntities( $('.mayosis-new-filter-item .mayosis-field-entity') );

            removeElement( $('.mayosis-field-notice') );

            // Update Post type related location terms
            let selected = $('#mayosis_set_fields-wp_page_type').val();
            if( typeof selected !== 'undefined' /*&& selected === 'common:common'*/ ){
                mayosisGetLocationTerms( selected );
            }

            // Change options in all select.mayosis-field-ename
            let eNameSelect = $("select.mayosis-field-ename");
            if( eNameSelect.length > 0 ) {
                fillTaxNumSelect( eNameSelect, postType );
            }

        });

        // Filtered WP_Query location
        $('body').on('change', '#mayosis_set_fields-wp_page_type', function(){
            mayosisGetLocationTerms( $(this).val() );
        });

        // Apply button location
        $('body').on('change', '#mayosis_set_fields-apply_button_page_type', function(){
            mayosisGetApplyLocationTerms( $(this).val() );
        });

        $('body').on('change', '#mayosis_set_fields-post_name', function (e){
            let filterPagelink = $('option:selected', this).data('link');

            if( typeof filterPagelink !== 'undefined'){
                mayosisGetWpQueries( filterPagelink );
            }
        });

        $('body').on('change', '.mayosis-field-parent-filter', function (){
            let parentNo    = ['no', '-1'];
            let parentVal   = $(this).val();
            let fid         = $(this).parents('.mayosis-filter-item').data('fid');
            let hideTr      = $("#mayosis-filter-id-"+fid+" .mayosis-field-hide-until-parent-tr");

            if( parentNo.includes(parentVal) ){
                hideTr.removeClass('mayosis-opened');
            }else{
                hideTr.addClass('mayosis-opened');
            }
        });

        $('body').on('click', '#mayosis_set_fields-use_apply_button', function (){
            let applyButtonChecked = $(this).prop( "checked" );

            if( applyButtonChecked ){
                $("#mayosis-filter-id-apply-button").addClass('mayosis-opened');
                $(".mayosis-field-apply-button-text-tr").addClass('mayosis-opened');
                $(".mayosis-field-apply-button-page-type-tr").addClass('mayosis-opened');
                $(".mayosis-field-reset-button-text-tr").addClass('mayosis-opened');
                $('.mayosis-no-filters').hide();
            }else{
                $("#mayosis-filter-id-apply-button").removeClass('mayosis-opened');
                $(".mayosis-field-apply-button-text-tr").removeClass('mayosis-opened');
                $(".mayosis-field-apply-button-page-type-tr").removeClass('mayosis-opened');
                $(".mayosis-field-reset-button-text-tr").removeClass('mayosis-opened');

                if( $(".mayosis-filter-item:not(#mayosis-filter-id-apply-button)").length < 1 ){
                    $('.mayosis-no-filters').show();
                }
            }
        });

        let filterPagelink = $('option:selected', $('#mayosis_set_fields-post_name')).data('link');

        if( typeof filterPagelink !== 'undefined' && filterPagelink ){
            mayosisGetWpQueries( filterPagelink );
        }

        // Set correct position of the Apply button
        let applyButtonPosition = $("#mayosis_set_fields-apply_button_menu_order").val();
        if( applyButtonPosition === '-1' ){
            let filtersLength = $('#mayosis-filters-list').find(".mayosis-filter-item").length.toString();
            $("#mayosis_set_fields-apply_button_menu_order").val(filtersLength);
        }

    });

    function mayosisShortenEname( eName ){
        let shortenName = eName;

        if( eName.includes( 'taxonomy_' ) ){
            if( eName.slice(0, 9) === 'taxonomy_' ){
                shortenName = eName.slice(9);
            }
        }else if( eName.includes( 'author_' ) ){
            if( eName.slice(0, 7) === 'author_' ){
                shortenName = eName.slice(7);
            }
        }

        return shortenName;
    }

    function mayosisAddNewFilterToParentList(){
        let allIds = {};
        let theFid = 0;
        let theTitle = ''
        let theEname = '';
        let theNoVal = false;
        let possibleOption = false;
        let newOption      = false;

        $(".mayosis-filter-item:not(.mayosis-filter-item-apply-button)").each( function ( index, elem ){
            theFid      = $(this).data('fid');
            theTitle    = $("#mayosis_filter_fields-"+theFid+"-label").val();

            if( ! theTitle ){
                theTitle = mayosisSetVars.newFilter;
            }

            theEname = $("#mayosis_filter_fields-"+theFid+"-entity").val();
            // theEname = mayosisShortenEname(theEname);

            allIds[theFid] = { 'id' : theFid.toString(), 'title': theTitle, 'ename': theEname};
        } );

        // In case if there is only single filter in Set
        if( Object.keys(allIds).length < 2 ){
            //console.log('Less than 2');
            return;
        }

        // If there are 2 or more filters
        $.each( allIds, function ( index, elem ){

            theNoVal = $( "#mayosis_filter_fields-"+elem['id']+"-parent_filter > option[value='no']");
            if( theNoVal.length > 0 ){
                theNoVal.val( '-1' );
                theNoVal.text( mayosisSetVars.selectFilter );
            }

            $.each( allIds, function ( inindex, inelem ){
                if( elem['id'] === inindex ){
                    return;
                }

                possibleOption = $( "#mayosis_filter_fields-"+elem['id']+"-parent_filter > option[value='"+inindex+"']");
                if( possibleOption.length < 1 ){
                    newOption = $('<option>', {
                        value: inindex,
                        text: inelem['title']+" ("+mayosisShortenEname( inelem['ename'] )+")"
                    });

                    if( inelem['ename'] === 'post_meta_num' || inelem['ename'] === 'tax_numeric' ){
                        newOption.attr("disabled", "disabled");
                    }

                    $( "#mayosis_filter_fields-"+elem['id']+"-parent_filter").append( newOption );
                }
            });
        });
    }

    function mayosisDeleteFilterFromParentList( filterId )
    {
        let theOption = false;

        $(".mayosis-field-parent-filter option[value='"+filterId+"'").each(function (index, element){
            theOption = $(this);
            let theSelect = theOption.parents("select");

            if( theOption.is(':selected') ){
                theSelect.val( theSelect.find("option:first").val() );
            }

            theOption.remove();

            if( theSelect.find("option").length === 1 ){
                theOption = theSelect.find("option:first");
                theOption.val('no');
                theOption.text(mayosisSetVars.addFilter);
                theSelect.val('no');
            }

        });
    }

    function mayosisGetWpQueries( filterPagelink ){
        if( mayosisSetVars.filtersPro < 1){
            return true;
        }

        if( filterPagelink === '' ){
            return true;
        }

        removeElement( $('.mayosis-field-notice') );
        // 1 Get current Post type to try to find its query

        // let selected = $('#mayosis_set_fields-post_type').val();
        let $spinner = $( '.mayosis_set_fields-wp_filter_query-wrap' ).children( '.spinner' );
        let postType = $("#mayosis_set_fields-post_type").val();

        // Set up AJAX request
        let requestParams          = {};
        requestParams._wpnonce      = $("#mayosis_set_nonce").val();
        requestParams.wpPageType    = $('#mayosis_set_fields-wp_page_type').val();
        requestParams.postType      = postType;
        requestParams.postId        = $("#post_ID").val();
        requestParams.action        = 'mayosis_get_wp_queries';


        $.ajax({
            'method': 'POST',
            'data': requestParams,
            'url': filterPagelink,
            'dataType': 'html',
            beforeSend: function () {
                $spinner.addClass( 'is-active' );
                $(".mayosis-location-preview").attr('href', filterPagelink);
            },
            complete: function () {
                $spinner.removeClass( 'is-active' );
            },
            success: function (response) {
                let mayosisWpQueriesSelect = $(response).find('#mayosis_set_fields-wp_filter_query');
                let mayosisWpQueriesHidden = $(response).find('#mayosis_query_vars');

                if( mayosisWpQueriesSelect !== '' && mayosisWpQueriesSelect.length > 0 ){
                    $("#"+mayosisSetVars.wPQuerySelectId).replaceWith(mayosisWpQueriesSelect);
                }

                if( mayosisWpQueriesHidden.length > 0 ){
                    $('#mayosis_query_vars').replaceWith(mayosisWpQueriesHidden);
                }
            },

            error: function (response) {
                //
            }
        });
    }

    function mayosisGetApplyLocationTerms( selected ){

        let $spinner = $( '.mayosis_set_fields-apply_button_post_name-wrap' ).children( '.spinner' );
        $spinner.addClass( 'is-active' );
        // Clear all errors
        removeElement( $('.mayosis-field-notice') );
        let postType = $("#mayosis_set_fields-post_type").val();

        // Set up AJAX request
        let requestParams          = {};
        requestParams._wpnonce = $("#mayosis_set_nonce").val();
        requestParams.wpPageType = selected;
        requestParams.postType   = postType;
        requestParams.postId     = $("#post_ID").val();
        requestParams.fieldKey   = 'apply_button_post_name';

        wp.ajax.post( 'mayosis-get-set-location-terms', requestParams )
            .always( function() {
                $spinner.removeClass( 'is-active' );
            })
            .done( function( response ) {
                //
                let locationTermsSelect = $(response.html).find('#mayosis_set_fields-apply_button_post_name');
                $( '#mayosis_set_fields-apply_button_post_name' ).replaceWith(locationTermsSelect);
            })

            .fail( function(response) {
                // {"success":false}
                if( typeof response !== 'undefined'){
                    addFieldError('mayosis_set_fields-apply_button_post_name', response.message);
                }
            });
    }

    function mayosisGetLocationTerms( selected ){

        let $spinner = $( '.mayosis_set_fields-post_name-wrap' ).children( '.spinner' );
        $spinner.addClass( 'is-active' );
        // Clear all errors
        removeElement( $('.mayosis-field-notice') );
        let postType = $("#mayosis_set_fields-post_type").val();

        // Set up AJAX request
        let requestParams          = {};
        requestParams._wpnonce = $("#mayosis_set_nonce").val();
        requestParams.wpPageType = selected;
        requestParams.postType   = postType;
        requestParams.postId     = $("#post_ID").val();

        wp.ajax.post( 'mayosis-get-set-location-terms', requestParams )
            .always( function() {
                $spinner.removeClass( 'is-active' );
            })
            .done( function( response ) {
                //
                let locationTermsSelect = $(response.html).find('#mayosis_set_fields-post_name');
                $( '#mayosis_set_fields-post_name' ).replaceWith(locationTermsSelect);

                let filterPagelink = $('option:selected', $('#mayosis_set_fields-post_name') ).data('link');
                if( typeof filterPagelink !== 'undefined'){
                    mayosisGetWpQueries( filterPagelink );
                }
            })

            .fail( function(response) {
                // {"success":false}
                if( typeof response !== 'undefined'){
                    addFieldError('mayosis_set_fields-post_name', response.message);
                }
            });
    }

    function cpaLiveWrite( readFrom, writeTo ) {
        let cpaText;
        // readFrom.on('input', function() {
            cpaText = readFrom.val(); //$(this).val();
            writeTo.text(cpaText);
        // });
    }

    /**
     * Calculates correct menu order in accordance with filter position in list
     */
    function renderMenuOrder()
    {
        $(".mayosis-filter-item").each( function ( index, element ) {
            var num = index + 1;
            $(element).find('.mayosis-menu-order-field').attr( 'value', num );
            $(element).find('.mayosis-filter-order').attr( 'title', num );
        });
    }

    function handleNoFiltersMessage()
    {
        if( $(".mayosis-filter-item:not(#mayosis-filter-id-apply-button)").length > 0 ){
            $('.mayosis-no-filters').hide();
        }else{
            $('.mayosis-no-filters').show();
        }
    }

    function setEntityTableClass( entitySelect )
    {
        let val = entitySelect.val();
        let fid = entitySelect.parents('.mayosis-filter-item').data('fid');
        let additionalClass = '';

        if( val.startsWith('taxonomy_pa_') ){
            additionalClass = ' taxonomy-product-attribute';
        }

        if( val.indexOf('taxonomy') !== -1 ){
            val = 'taxonomy';
        }

        $("#mayosis-filter-id-"+fid+" .mayosis-form-fields-table").attr('class', 'mayosis-form-fields-table mayosis-filter-'+val+additionalClass);
    }

    function syncEntityWithPrefix( entitySelect )
    {
        let val = entitySelect.val();
        let fid = entitySelect.parents('.mayosis-filter-item').data('fid');

        if( typeof mayosisSetVars.filterSlugs[val] !== 'undefined'){
            let prefix = mayosisSetVars.filterSlugs[val];
            $('#mayosis_filter_fields-'+fid+'-slug').val(prefix)
                .attr('readonly', 'readonly')
                .trigger('input');
        } else {
            $('#mayosis_filter_fields-'+fid+'-slug').val('')
                .removeAttr('readonly')
                .trigger('input');
        }

    }

    function syncEntityWithSortTerms( entitySelect ){
        let val = entitySelect.val();
        let fid = entitySelect.parents('.mayosis-filter-item').data('fid');

        if( ! val.includes('taxonomy_pa') ) {
            $('#mayosis_filter_fields-'+fid+'-orderby option[value="menuasc"]').attr('disabled', 'disabled');
            $('#mayosis_filter_fields-'+fid+'-orderby option[value="menudesc"]').attr('disabled', 'disabled');
        }else{
            $('#mayosis_filter_fields-'+fid+'-orderby option[value="menuasc"]').removeAttr('disabled');
            $('#mayosis_filter_fields-'+fid+'-orderby option[value="menudesc"]').removeAttr('disabled');
        }
    }

    function syncEntityWithView( entitySelect ){
        let val = entitySelect.val();
        let fid = entitySelect.parents('.mayosis-filter-item').data('fid');

        if( val === 'post_meta_num' || val === 'tax_numeric' ) {
            $('#mayosis_filter_fields-'+fid+'-view option:not([value="range"])').attr('disabled', 'disabled');
            $('#mayosis_filter_fields-'+fid+'-view option[value="range"]').removeAttr('disabled')
                .prop('selected', true);
            $('#mayosis_filter_fields-'+fid+'-view').trigger('change');

        }else{
            $('#mayosis_filter_fields-'+fid+'-view option').removeAttr('disabled')
            $('#mayosis_filter_fields-'+fid+'-view option:not([disabled]):first').prop('selected', true);
            $('#mayosis_filter_fields-'+fid+'-view option[value="range"]').attr('disabled', 'disabled');
            $('#mayosis_filter_fields-'+fid+'-view').trigger('change');
        }
    }


    function handleLogicField( entitySelect )
    {
        let val = entitySelect.val();
        let fid = entitySelect.parents('.mayosis-filter-item').data('fid');

        if ( val === 'author_author' || val === 'post_meta_exists' ) {
            $( '#mayosis_filter_fields-' + fid + '-logic option[value="and"]' ).attr( 'disabled', 'disabled' );
            $( '#mayosis_filter_fields-' + fid + '-logic option[value="or"]' ).prop( 'selected', true );
        } else if ( val === 'post_meta_num' || val === 'tax_numeric' ) {
            // If filter is numeric logic can be AND only
            $( '#mayosis_filter_fields-' + fid + '-logic option[value="or"]' ).attr( 'disabled', 'disabled' );
            $( '#mayosis_filter_fields-' + fid + '-logic option[value="and"]' ).prop( 'selected', true );
        } else {
            $( '#mayosis_filter_fields-'+fid+'-logic option[value="and"]' ).removeAttr( 'disabled' );
            $( '#mayosis_filter_fields-'+fid+'-logic option[value="or"]' ).removeAttr( 'disabled' );
        }

        return true;
    }

    function handleHierarchyField( entitySelect )
    {
        let val = entitySelect.val();
        let $divFilterItem = entitySelect.parents('.mayosis-filter-item');

        if( val.indexOf('taxonomy') !== -1 ){
            $.each( mayosisSetVars.postTypesTaxList, function ( pType, taxesArray ){
                $.each( taxesArray, function ( index, theTax ){
                    if( theTax['name'] === val ){
                        if( theTax['hierarchical'] ){
                            $divFilterItem.find('.mayosis-form-fields-table').addClass('taxonomy-hierarchical');
                        }else{
                            $divFilterItem.find('.mayosis-form-fields-table').removeClass('taxonomy-hierarchical');
                        }
                    }
                });
            });
        } else {
            $divFilterItem.find('.mayosis-form-fields-table').removeClass('taxonomy-hierarchical');
        }
    }

    function handleMetaKeyField( entitySelect )
    {
        let val = entitySelect.val();
        let fid = entitySelect.parents('.mayosis-filter-item').data('fid');

        if ( val === 'post_meta' || val === 'post_meta_num' || val === 'post_meta_exists' ) {
            let eNameTag = $('#mayosis_filter_fields-'+fid+'-e_name');

            if ( eNameTag.prop("tagName").toLowerCase() === 'select' ) {
                let eNameInput = $('<input>');
                let postType = $("#mayosis_set_fields-post_type").val();

                eNameInput.attr( 'class', eNameTag.attr('class') )
                    .attr( 'type', 'text' )
                    .attr( 'name', eNameTag.attr('name') )
                    .attr( 'id', eNameTag.attr('id') );

                eNameTag.val('');
                eNameTag.removeAttr('readonly');
                eNameTag.replaceWith(eNameInput);

                eNameInput.parents('.mayosis-field-ename-tr').show();
            } else {
                eNameTag.val('');
                eNameTag.parents('.mayosis-field-ename-tr').show();
            }

            $('#mayosis-filter-id-'+fid+' .mayosis-field-ename-tr p.mayosis-field-description').text( numFieldAttrs['post_meta_num']['description'] );
            $('#mayosis-filter-id-'+fid+' .mayosis-field-ename-tr label.mayosis-filter-label span.mayosis-label-text').text( numFieldAttrs['post_meta_num']['label'] );
            $('#mayosis-filter-id-'+fid+' .mayosis-field-ename-tr p.description').css('visibility', 'visible');

        } else if ( val === 'tax_numeric' ) {
            let eNameTag = $('#mayosis_filter_fields-'+fid+'-e_name');
            let postType = $("#mayosis_set_fields-post_type").val();

            if ( eNameTag.prop("tagName").toLowerCase() === 'input' ) {
                let eNameSelect = $('<select>');

                eNameSelect.attr( 'class', eNameTag.attr('class') )
                    .attr( 'name', eNameTag.attr('name') )
                    .attr( 'id', eNameTag.attr('id') );

                eNameTag.removeAttr( 'readonly' );
                eNameTag.replaceWith( eNameSelect );
                //@todo - if already existing tax_numeric slug presents, it should be inserted as usual
                //@todo - if filter by this tax numeric entity exists, it should be deactivated in the Tax num dropdown
                fillTaxNumSelect( eNameSelect, postType );
                eNameSelect.parents('.mayosis-field-ename-tr').show();
            } else {
                fillTaxNumSelect( eNameTag, postType );
                eNameTag.parents('.mayosis-field-ename-tr').show();
            }

            $('#mayosis-filter-id-'+fid+' .mayosis-field-ename-tr p.mayosis-field-description').text( numFieldAttrs['tax_numeric']['description'] );
            $('#mayosis-filter-id-'+fid+' .mayosis-field-ename-tr label.mayosis-filter-label span.mayosis-label-text').text( numFieldAttrs['tax_numeric']['label'] );
            $('#mayosis-filter-id-'+fid+' .mayosis-field-ename-tr p.description').css('visibility', 'hidden');

        } else {
            $('#mayosis_filter_fields-'+fid+'-e_name').parents('.mayosis-field-ename-tr').hide();
        }

        // Numeric values can not be in URL path
        if( val === 'post_meta_num' || val === 'tax_numeric' ){
            $('#mayosis_filter_fields-'+fid+'-in_path').prop( "checked", false );
            // $('#mayosis_filter_fields-'+fid+'-show_chips').prop( "checked", false );
        }else{
            $('#mayosis_filter_fields-'+fid+'-in_path').prop( "checked", true );
            // $('#mayosis_filter_fields-'+fid+'-show_chips').prop( "checked", true );
        }
    }

    function loadExcludeItems( entity, fid, ename )
    {
        removeElement( $('.mayosis-field-notice') );
        let requestParams          = {};
        let target              = $('#mayosis_filter_fields-'+fid+'-exclude');
        requestParams._wpnonce  = $("#mayosis_set_nonce").val();
        requestParams.fid       = fid;
        requestParams.entity    = entity;

        if( typeof ename !== 'undefined' ){
            requestParams.ename = ename;
        }

        let $spinner = target.parent('.mayosis-after-spinner-container').prev( '.spinner' );
        $spinner.addClass( 'is-active' );

        wp.ajax.post( 'mayosis-load-exclude-terms', requestParams )
            .always( function() {
                $spinner.removeClass( 'is-active' );
            })
            .done( function( response ) {
                if( typeof response.fid !== 'undefined' ){
                    target.select2('destroy');
                    target.html('');
                    target.select2({
                        width: '100%',
                        placeholder: mayosisSetVars.excludePlaceholder,
                        data: response.terms,
                        disabled: false
                    })
                }
            })

            .fail( function(response) {
                // if( typeof response !== 'undefined'){
                //     addFieldError( 'mayosis_filter_fields-'+response.fid+'-exclude', response.message );
                // }
            });

    }

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

    /**
     * Fills Tax Num Select with options
     * @param $el (object) The select element
     * @param postType Post type selected to filter
     */
    function fillTaxNumSelect( $el, postType ) {
        $el.find('option')
            .remove()
            .end();

        if ( postType in postTypesTaxList ) {
            $( postTypesTaxList[ postType ] ).each( function() {
                $el.append( $("<option>").attr('value', this.name ).text( this.label ) );
            });
        } else {
            $el.append( $("<option>").attr('value', -1 ).text( numFieldNoTaxes ) );
        }
    }

})(jQuery);

// Important!!!
// When field Filter by is selected, it is required to make AJAX request to find the same
// entity in filters already. And if it is exists, to predefine field "slug" defined in previous
// selection of

function uniqId (prefix, moreEntropy) {
    //  discuss at: https://locutus.io/php/uniqid/
    // original by: Kevin van Zonneveld (https://kvz.io)
    //  revised by: Kankrelune (https://www.webfaktory.info/)
    //      note 1: Uses an internal counter (in locutus global) to avoid collision
    //   example 1: var $id = uniqid()
    //   example 1: var $result = $id.length === 13
    //   returns 1: true
    //   example 2: var $id = uniqid('foo')
    //   example 2: var $result = $id.length === (13 + 'foo'.length)
    //   returns 2: true
    //   example 3: var $id = uniqid('bar', true)
    //   example 3: var $result = $id.length === (23 + 'bar'.length)
    //   returns 3: true

    if (typeof prefix === 'undefined') {
        prefix = '';
    }

    var retId;
    var _formatSeed = function (seed, reqWidth) {
        seed = parseInt(seed, 10).toString(16); // to hex str
        if (reqWidth < seed.length) {
            // so long we split
            return seed.slice(seed.length - reqWidth);
        }
        if (reqWidth > seed.length) {
            // so short we pad
            return Array(1 + (reqWidth - seed.length)).join('0') + seed;
        }
        return seed;
    }

    var $global = (typeof window !== 'undefined' ? window : global);
    $global.$locutus = $global.$locutus || {}
    var $locutus = $global.$locutus;
    $locutus.php = $locutus.php || {}

    if (!$locutus.php.uniqidSeed) {
        // init seed with big random int
        $locutus.php.uniqidSeed = Math.floor(Math.random() * 0x75bcd15);
    }
    $locutus.php.uniqidSeed++;

    // start with prefix, add current milliseconds hex string
    retId = prefix;
    retId += _formatSeed(parseInt(new Date().getTime() / 1000, 10), 8);
    // add seed hex string
    retId += _formatSeed($locutus.php.uniqidSeed, 5);
    if (moreEntropy) {
        // for more entropy we add a float lower to 10
        retId += (Math.random() * 10).toFixed(8).toString();
    }

    return retId;
}