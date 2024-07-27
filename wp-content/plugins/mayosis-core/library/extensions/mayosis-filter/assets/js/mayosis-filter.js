/*!
 * Mayosis Filter 1.7.1
 */
(function ($) {
    "use strict";
    let mayosisAjax                     = mayosisFilterFront.mayosisAjaxEnabled;
    let mayosisStatusCookieName         = mayosisFilterFront.mayosisStatusCookieName;
    let mayosisMoreLessCookieName       = mayosisFilterFront.mayosisMoreLessCookieName;
    let mayosisWidgetStatusCookieName   = mayosisFilterFront.mayosisWidgetStatusCookieName;
    let mayosisHierachyListCookieName   = mayosisFilterFront.mayosisHierarchyListCookieName;
    let mayosisMobileWidth              = mayosisFilterFront.mayosisMobileWidth;
    let mayosisPostContainers           = mayosisFilterFront.mayosisPostContainers;
    let mayosisAutoScroll               = mayosisFilterFront.mayosisAutoScroll;
    let mayosisAutoScrollOffset         = mayosisFilterFront.mayosisAutoScrollOffset;
    let mayosisWaitCursor               = mayosisFilterFront.mayosisWaitCursor;
    let mayosisPostsPerPage             = mayosisFilterFront.mayosisPostsPerPage;
    let mayosisUseSelect2               = mayosisFilterFront.mayosisUseSelect2;
    let mayosisPopupCompatMode          = mayosisFilterFront.mayosisPopupCompatMode;
    let mayosisApplyButtonSets          = mayosisFilterFront.mayosisApplyButtonSets;
    let mayosisQueryOnThePageSets       = mayosisFilterFront.mayosisQueryOnThePageSets;
    let mayosisWidgetContainer          = '.mayosis-filters-widget-main-wrapper';
    let mayosisIsMobile                 = false;
    let toReplaceSEO                = true;
    let prevState                   = false; // Contains SEO Rule availability on a page
    let currentState                = false; // Contains SEO Rule availability on a page

    let seoRuleId = $('#mayosis-seo-rule-id').data( 'seoruleid' );
    if ( seoRuleId > 0 ) {
        prevState = true;
    }

    function removeElement($el)
    {
        $el.fadeTo(100, 0, function() {
            $el.slideUp(100, function() {
                $el.remove();
            });
        });
    }

    $(document).on('click', '.mayosis-filter-content input[type="radio"],.mayosis-filter-content input[type="checkbox"]', function (e) {
        let mayosisLink = $(this).data('mayosis-link');
        let $el     = $(this).parents(mayosisWidgetContainer);
        let setId   = $el.data('set');
        let applyButtonMode = false;

        if( setId > 0 && mayosisApplyButtonSets.length > 0 && mayosisApplyButtonSets.includes(setId) ){
            applyButtonMode = true;
        }

        if( mayosisAjax || applyButtonMode ){
            e.preventDefault();
            mayosisSendFilterRequest( mayosisLink, $el, applyButtonMode );
        }else{
            location.href = mayosisLink;
        }
    });

    $(document).on('change', '.mayosis-orderby-select', function (){
        let mayosisSortingForm = $(this).parents('form.mayosis-sorting-form');
        // let mayosisSortingVal  = $(this).val();
        let search = '';
        //@todo bug on mobile force AJAX
        search = '?' + mayosisSortingForm.serialize();

        let mayosisLink = mayosisSortingForm.attr('action') + search;

        if( mayosisFilterFront.mayosisAjaxEnabled ) {
            $('.mayosis-filters-widget-main-wrapper').each(function (index, element) {
                let $el = $(element);
                mayosisSendFilterRequest(mayosisLink, $el, false);
            });
        }else{
            mayosisSortingForm.attr('action', mayosisLink);
            // window.location.href = mayosisLink;
            mayosisSortingForm.submit();
        }
    });

    $(document).on('change', '.mayosis-filter-content select', function (e) {
        var mayosisLink = $(this).find('option:selected').data('mayosis-link');
        let $el     = $(this).parents(mayosisWidgetContainer);
        let setId   = $el.data('set');
        let applyButtonMode = false;

        if( setId > 0 && mayosisApplyButtonSets.length > 0 && mayosisApplyButtonSets.includes(setId) ){
            applyButtonMode = true;
        }

        if( mayosisAjax || applyButtonMode ){
            e.preventDefault();
            mayosisSendFilterRequest( mayosisLink, $el, applyButtonMode );
        }else{
            location.href = mayosisLink;
        }
    });

    $(document).on('click', '.mayosis-filter-chip a', function (e){
        let mayosisLink = $(this).attr('href');
        let setId   = $(this).parents('.mayosis-filter-chips-list').data('set');
        let $el     = $('.mayosis-mayosis-filter-'+setId);
        let applyButtonMode = false;

        if( setId > 0 && mayosisApplyButtonSets.length > 0 && mayosisApplyButtonSets.includes(setId) ){
            if( $(this).parents('.mayosis-mayosis-filter-'+setId).length > 0 ){
                applyButtonMode = true;
            }
        }

        if( mayosisAjax || applyButtonMode ) {
            e.preventDefault();
            mayosisSendFilterRequest( mayosisLink, $el, applyButtonMode );
        }else{
            return true;
        }
    });

    $(document).on('click', 'a.mayosis-filters-submit-button', function (e){

        if( $(this).hasClass('on-hold') ){
            e.preventDefault();
            return false;
        }

        let mayosisLink = $(this).attr('href');
        let setId   = $(this).parents('.mayosis-filters-widget-main-wrapper').data('set');
        let $el     = $('.mayosis-mayosis-filter-'+setId);

        if( mayosisAjax && mayosisQueryOnThePageSets.includes( setId ) ) {
            e.preventDefault();
            mayosisSendFilterRequest( mayosisLink, $el, false );
        }else{
            return true;
        }
    });

    $(document).on('click', 'a.mayosis-filters-reset-button', function (e){

        if( $(this).hasClass('on-hold') ){
            e.preventDefault();
            return false;
        }

        let mayosisLink = $(this).attr('href');
        let setId   = $(this).parents('.mayosis-filters-widget-main-wrapper').data('set');
        let $el     = $('.mayosis-mayosis-filter-'+setId);
        var t = e(".product-masonry");

        if( mayosisAjax ) {
            e.preventDefault();
            if( mayosisQueryOnThePageSets.includes( setId ) ){
                mayosisSendFilterRequest( mayosisLink, $el, false );
            }else{
                mayosisSendFilterRequest( mayosisLink, $el, true );
            }
        }else{
            return true;
            // mayosisSendFilterRequest( mayosisLink, $el, true );
        }
        
          setTimeout(function () {
                                t.isotope("layout");
                            }, 500)
    });

    $(document).on('click', 'i.mayosis-toggle-children-list', function (){
        let tid = $(this).data('tid');
        let $targetLi = $(this).parent(".mayosis-term-item-content-wrapper").parent('li');
        let $targetFilter = $(this).parents('.mayosis-filters-section');

        if ( $targetLi.hasClass( 'mayosis-opened' ) ) {
            $targetLi.removeClass( 'mayosis-opened' )
                .addClass( 'mayosis-closed' );
            setStatusCookie( -tid, mayosisHierachyListCookieName );
        } else if ( $targetLi.hasClass( 'mayosis-closed' ) ) {
            $targetLi.removeClass( 'mayosis-closed' )
                .addClass( 'mayosis-opened' );
            setStatusCookie( tid, mayosisHierachyListCookieName );
        } else {
            if ( $targetFilter.hasClass( 'mayosis-filter-hierarchy-reverse' ) ) {
                $targetLi.removeClass( 'mayosis-opened' ) // For any case
                    .addClass( 'mayosis-closed' );
                setStatusCookie( -tid, mayosisHierachyListCookieName );
            } else {
                $targetLi.removeClass( 'mayosis-closed' ) // For any case
                    .addClass( 'mayosis-opened' );
                setStatusCookie( tid, mayosisHierachyListCookieName );
            }
        }
    });

    $(document).on('click', '.mayosis-filters-overlay', function (){
        let setId = $('body').data('set');
        mayosisCloseFiltersContainer(setId);
    })

    $(document).on('change', '.mayosis-filter-range-form input[type="number"]', function (e) {
        let form = $(this).parents('.mayosis-filter-range-form');

        let $min    = form.find('.mayosis-filters-range-min');
        let $max    = form.find('.mayosis-filters-range-max');

        var curMinVal = parseFloat($min.val());
        var curMaxVal = parseFloat($max.val());

        var initialMin = $min.data('min');
        var initialMax = $max.data('max');

        if( form.hasClass('mayosis-form-has-slider') ){
            let $slider = form.find('.mayosis-filters-range-slider-control');
            $slider.slider("option", "values", [curMinVal, curMaxVal]);
        }

        if (curMinVal === initialMin) {
            $min.attr('disabled', true);
        }

        if (curMaxVal === initialMax) {
            $max.attr('disabled', true);
        }

        let $el = form.parents(mayosisWidgetContainer);
        let setId = $el.data('set');
        let applyButtonMode = false;

        if( setId > 0 && mayosisApplyButtonSets.length > 0 && mayosisApplyButtonSets.includes(setId) ){
            applyButtonMode = true;
        }

        if( mayosisAjax || applyButtonMode ){
            let search  = form.serialize();
            let mayosisLink = form.attr('action') + '?' + search;

            mayosisSendFilterRequest( mayosisLink, $el, applyButtonMode );

            $min.attr('disabled', false);
            $max.attr('disabled', false);
        } else {
            form.submit();
        }

    });

    $(document).on( 'click','.mayosis-open-close-filters-button', function (e){
        e.preventDefault();
        let openCloseButton = $(this);
        let mayosisSetId        = openCloseButton.data('wid');
        let widgetContent   = $('.mayosis-mayosis-filter-'+mayosisSetId+' .mayosis-filters-widget-content');

        if( widgetContent.is(':visible') ){
            widgetContent.slideUp({
                duration: 100,
                complete: function (){
                    $(this).addClass('mayosis-closed')
                        .removeClass('mayosis-opened');
                    openCloseButton.removeClass('mayosis-opened');
                    mayosisSetCookie(mayosisWidgetStatusCookieName, null, {path: '/', 'max-age': 2592000});
                }
            });
        }else{
            widgetContent.slideDown({
                duration: 100,
                complete: function (){
                    $(this).addClass('mayosis-opened')
                        .removeClass('mayosis-closed');
                    openCloseButton.addClass('mayosis-opened');
                    mayosisSetCookie(mayosisWidgetStatusCookieName, mayosisSetId, {path: '/', 'max-age': 2592000});
                }
            });
        }
    });

    $(document).on('click', '.mayosis-widget-close-icon', function (e){
        e.preventDefault();
        let $wrapper    = $( this ).parents( mayosisWidgetContainer );
        let setId       = $wrapper.data( 'set' );
        mayosisCloseFiltersContainer(setId);
    });

    $(document).on('click', '.mayosis-filters-apply-button', function (e){
        e.preventDefault();
        let $wrapper    = $( this ).parents( mayosisWidgetContainer );
        let setId       = $wrapper.data( 'set' );
        let $content    = $( '.mayosis-mayosis-filter-'+setId+' .mayosis-filters-widget-content' );
        let href        = $(this).attr( 'href' );
        let mayosisReload   = ! $(this).hasClass('mayosis-posts-loaded');
        let mayosisZindex   = '';
        let $currentTag = false;

        $wrapper.removeClass('mayosis-container-opened');
        $('html').removeClass('mayosis-overlay-visible');
        $content.removeClass('mayosis-filters-widget-opened');
        $('.mayosis-open-button-'+setId+' .mayosis-filters-open-widget').removeClass('mayosis-opened');

        if( mayosisPopupCompatMode ) {
            setTimeout(() => {
                $content.parents().each(function (index, tag) {
                    $currentTag = $(tag);
                    mayosisZindex = $currentTag.data('mayosiszindex');

                    // Saved z-index for
                    if (mayosisZindex !== 'undefined') {
                        $currentTag.css('z-index', mayosisZindex);
                    }

                    if ($currentTag.hasClass('mayosis-force-visibility')) {
                        $currentTag.removeClass('mayosis-force-visibility');
                    }
                });

                setTimeout(() => {
                    $(".mayosis-was-invisible").css('opacity', '1')
                        .removeClass('mayosis-was-invisible');
                }, 300);

            }, 260);
        }

        if( mayosisReload ) {
            location.href = href;
        }
    });

    $(document).on('submit', '.mayosis-filter-range-form', function (e) {
        submitSliderForm(e, $(this));
    });

    $(document).on('click', '.mayosis-filter-content a', function (e) {
        e.preventDefault();
        let mayosisInputId = $(this).closest('label').attr('for');
        $(this).closest('label').parent('.mayosis-term-item-content-wrapper').parent('.mayosis-term-item').find('#'+mayosisInputId).trigger('click');
    });

    $(document).on('click', '.mayosis-filters-open-widget', function (e) {
        e.preventDefault();
        let setId = $(this).data('wid');
        mayosisOpenContainer( setId );
    });

    $(document).on('click', '.mayosis-filters-close-button', function (e) {
        e.preventDefault();
        let wrapper = $(this).parents(mayosisWidgetContainer);
        let setId   = wrapper.data('set');

        if( mayosisAjax && mayosisFilterFront.mayosisAjaxEnabled ){
            let cancelLink      = $(this).attr('href');
            let applyLink       = $('.mayosis-mayosis-filter-'+setId+' .mayosis-filters-apply-button').attr('href');

            if( cancelLink !== applyLink ){
                mayosisSendFilterRequest( cancelLink, wrapper, false,'mayosisCloseFiltersContainer' );
                return;
            }
        }

        mayosisCloseFiltersContainer(setId);
    });

    $(document).on('click', 'a.mayosis-toggle-a', function (e){
        e.preventDefault();
        let fid            = $(this).data('fid');
        let $filterSection = $( ".mayosis-filters-section-" + fid );
        //$( ".mayosis-filters-section-" + fid ).toggleClass( 'mayosis-show-more' );

        if ( $filterSection.hasClass('mayosis-show-more' ) ) {
            $filterSection.removeClass( 'mayosis-show-more' )
                .addClass( 'mayosis-show-less' );
            setStatusCookie( -fid, mayosisMoreLessCookieName );
        } else if ( $filterSection.hasClass('mayosis-show-less' ) ) {
            $filterSection.removeClass( 'mayosis-show-less' )
                .addClass( 'mayosis-show-more' );
            setStatusCookie( fid, mayosisMoreLessCookieName );
        } else {
            // No status class detected
            if( $filterSection.hasClass( 'mayosis-filter-has-selected' ) || $filterSection.hasClass( 'mayosis-show-more-reverse' ) ) {
                $filterSection.removeClass( 'mayosis-show-more' ) // For any case
                    .addClass( 'mayosis-show-less' );
                setStatusCookie( -fid, mayosisMoreLessCookieName );
            } else {
                $filterSection.removeClass( 'mayosis-show-less' ) // For any case
                    .addClass( 'mayosis-show-more' );
                setStatusCookie( fid, mayosisMoreLessCookieName );
            }
        }
    });

    $(document).on('click', '.mayosis-filter-title-widbar button', function (e) {
        e.preventDefault();
        let $filterSection = $(this).parents('.mayosis-filters-section');
        let filterId       = $filterSection.data( 'fid' );

        if ( $filterSection.hasClass( 'mayosis-opened' ) ) {
            $filterSection.removeClass( 'mayosis-opened' )
                .addClass( 'mayosis-closed' );
            setStatusCookie( -filterId, mayosisStatusCookieName );
        } else if ( $filterSection.hasClass( 'mayosis-closed' ) ) {
            $filterSection.removeClass( 'mayosis-closed' )
                .addClass( 'mayosis-opened' );
            setStatusCookie( filterId, mayosisStatusCookieName );
        } else {
           if( $filterSection.hasClass( 'mayosis-filter-has-selected' ) || $filterSection.hasClass( 'mayosis-filter-collapsible-reverse' ) ) {
                $filterSection.removeClass( 'mayosis-opened' )
                    .addClass( 'mayosis-closed' );
               setStatusCookie( -filterId, mayosisStatusCookieName );
           } else {
               $filterSection.removeClass( 'mayosis-closed' )
                   .addClass( 'mayosis-opened' );
               setStatusCookie( filterId, mayosisStatusCookieName );
           }
        }
    });

    $( window ).resize(function() {
        if( window.innerWidth <= mayosisMobileWidth ){
            mayosisIsMobile = true;
            if( mayosisFilterFront.showBottomWidget === 'yes' ) {
                mayosisAjax = true;
            }
        }else{
            mayosisAjax     = mayosisFilterFront.mayosisAjaxEnabled;
            mayosisIsMobile = false;
        }

        if( mayosisUseSelect2 === 'yes' ){
            $(mayosisWidgetContainer).each( function ( index, widget ){
                let widgetSet = $(widget).data('set');
                let widgetClass = 'mayosis-mayosis-filter-'+widgetSet;
                mayosisInitSelect2(widgetClass);
            });
        }
    });

    if ($.support.pjax) {
        $(document).on('pjax:end', function() {
            setTimeout(() => {
                mayosisInitiateAll();
            }, 300);
        });
    }

    $(document).ready(function (){
        mayosisInitiateAll();
    });

    $(document).on('input', '.mayosis-filter-search-field',function (e){
        let $search  = $(this).val().toString().toLowerCase();
        let $section = $(this).parents('.mayosis-filters-section');
        let fid      = $section.data('fid');

        if( $search !== '' ){
            $(".mayosis-filter-search-wrapper-"+fid+" .mayosis-search-clear").show();
            $section.addClass('mayosis-search-active');
        }else{
            $(".mayosis-filter-search-wrapper-"+fid+" .mayosis-search-clear").hide();
            $section.removeClass('mayosis-search-active');
        }

        $(".mayosis-filters-list-"+fid+" li").each(function( index, value ) {
            let $li = $(value);
            let $termName = $(value).find('label a').text().toLowerCase();
            if ($termName.indexOf($search) > -1) {
                $li.addClass('showli');
            } else {
                $li.removeClass('showli');
            }
        });
    });

    $(document).on( 'click', '.mayosis-search-clear', function (e){
        e.preventDefault();
        let $searchField = $(this).parent(".mayosis-filter-search-wrapper").find(".mayosis-filter-search-field");
        $searchField.val('')
            .trigger('input');
        // $(this).hide();
    })

    function mayosisInitiateAll(){
        $('.mayosis-filter-range-form').each( function ( index, form ){
            $.fn.mayosisInitSlider( $(form) );
        });

        if (window.innerWidth <= mayosisMobileWidth) {
            mayosisIsMobile = true;
            if( mayosisFilterFront.showBottomWidget === 'yes' ) {
                mayosisAjax = true;
            }
        }

        if( mayosisUseSelect2 === 'yes' ){
            $(mayosisWidgetContainer).each( function ( index, widget ){
                let widgetSet = $(widget).data('set');
                let widgetClass = 'mayosis-mayosis-filter-'+widgetSet;
                mayosisInitSelect2(widgetClass);
            });
        }

        $('.mayosis-help-tip').tipTip({
            'attribute': 'data-tip',
            'fadeIn':    50,
            'fadeOut':   50,
            'delay':     200,
            'keepAlive': true,
            'maxWidth': "220px",
        });
    }

    function mayosisInitSelect2( widgetClass ) {
        if( typeof $.fn.select2 === 'undefined'){
            return;
        }

        let mayosisUserAgent = navigator.userAgent.toLowerCase();
        let mayosisIsAndroid = mayosisUserAgent.indexOf("android") > -1;
        let mayosisAllowSearchField = 0;
        if(mayosisIsAndroid) {
            mayosisAllowSearchField = Infinity;
        }

        $('.mayosis-filters-widget-select').select2({
            dropdownCssClass: 'mayosis-mayosis-filter-dropdown',
            dropdownParent: $('.'+widgetClass+' .mayosis-filters-widget-content'),
            templateResult: function(data) {
                // We only really care if there is an element to pull classes from
                if (!data.element) {
                    return data.text;
                }
                let $dr_element = $(data.element);
                let $dr_wrapper = $('<span></span>');
                $dr_wrapper.addClass($dr_element[0].className);
                $dr_wrapper.text(data.text);

                return $dr_wrapper;
            },
            minimumResultsForSearch: mayosisAllowSearchField
        });

        $('.mayosis-orderby-select').select2({
            dropdownCssClass: 'mayosis-mayosis-filter-dropdown',
            dropdownParent: $('.mayosis-after-sorting-form'),
            templateResult: function(data) {
                // We only really care if there is an element to pull classes from
                if (!data.element) {
                    return data.text;
                }
                let $dr_element = $(data.element);
                let $dr_wrapper = $('<span></span>');
                $dr_wrapper.addClass($dr_element[0].className);
                $dr_wrapper.text(data.text);

                return $dr_wrapper;
            },
            minimumResultsForSearch: Infinity
        });
    }


    function mayosisGetCookie(name) {
        var matches = document.cookie.match(new RegExp(
            "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
        ))
        return matches ? decodeURIComponent(matches[1]) : undefined
    }

    //Example: mayosisSetCookie('user', 'John', {secure: true, 'max-age': 3600});
    function mayosisSetCookie(name, value, props) {
        props = props || {}
        let exp = props.expires
        if (typeof exp == "number" && exp) {
            let d = new Date()
            d.setTime(d.getTime() + exp*1000)
            exp = props.expires = d
        }

        if(exp && exp.toUTCString) { props.expires = exp.toUTCString() }
        value = encodeURIComponent(value)

        let updatedCookie = name + "=" + value
        for(let propName in props){
            updatedCookie += "; " + propName
            let propValue = props[propName]
            if(propValue !== true){ updatedCookie += "=" + propValue }
        }
        document.cookie = updatedCookie
    }

    function setStatusCookie( fid, mayosisListCookieName )
    {
        let status = mayosisGetCookie(mayosisListCookieName);
        let _fids  = new Array();

        fid = fid.toString();

        // In case there is no Cookies yet
        if( typeof status === 'undefined' ){
            status = '';
        }else{
            status = status.trim();
            _fids = status.split(',');
        }

        // Filter from empty elements
        _fids = _fids.filter(function (el) {
            return el != '';
        });

        // Remove possible existing closed/opened to avoid double commands e.g. 151 and -151
        let reversal = -fid;
        let pos = _fids.indexOf( reversal.toString() );

        if ( pos !== -1 ) {
            _fids.splice(pos, 1);
        }

        if( _fids.indexOf(fid) === -1 ){
            _fids.push(fid);

            let newStatus = '';

            if( _fids.length === 0 ){
                newStatus = fid;
            }else{
                newStatus = _fids.join();
            }

            mayosisSetCookie( mayosisListCookieName, newStatus, {path: '/', 'max-age': 2592000} )
        }

    }

    function mayosisCloseFiltersContainer(setId)
    {
        let $wrapper = $('.mayosis-mayosis-filter-'+setId);
        let $content = $('.mayosis-mayosis-filter-'+setId+' .mayosis-filters-widget-content');
        $('.mayosis-open-button-'+setId+' .mayosis-filters-open-widget').removeClass('mayosis-opened');
        $('html').removeClass('mayosis-overlay-visible');
        $content.removeClass('mayosis-filters-widget-opened');

        if( mayosisPopupCompatMode ) {
            setTimeout(() => {

                let mayosisZindex = '';
                let $currentTag = false;

                $content.parents().each(function (index, tag) {
                    $currentTag = $(tag);
                    mayosisZindex = $currentTag.data('mayosiszindex');
                    // Saved z-index for
                    if (mayosisZindex !== 'undefined') {
                        $currentTag.css('z-index', mayosisZindex);
                    }

                    if ($currentTag.hasClass('mayosis-force-visibility')) {
                        $currentTag.removeClass('mayosis-force-visibility');
                    }
                });

                setTimeout(() => {
                    $(".mayosis-was-invisible").css('opacity', '1')
                        .removeClass('mayosis-was-invisible');
                }, 300);

            }, 260);
        }

        $wrapper.removeClass('mayosis-container-opened');
    }

    function mayosisOpenFiltersContainer(setId)
    {
        let $wrapper    = $('.mayosis-mayosis-filter-'+setId);
        let $content    = $('.mayosis-mayosis-filter-'+setId+' .mayosis-filters-widget-content');
        let mayosisZindex   = '';
        let mayosisVisibility = '';
        let mayosisTransform = '';
        let $currentTag = false;

        if( $content.length < 1 ){
            return true;
        }

        if( mayosisPopupCompatMode ) {
            $content.parents().each(function (index, tag) {
                $currentTag     = $(tag);
                mayosisZindex       = $currentTag.css('z-index');
                mayosisVisibility   = $currentTag.is(":visible");
                mayosisTransform    = $currentTag.css('transform');

                // Save current z-index for future
                if (mayosisZindex !== 'auto') {
                    $currentTag.data('mayosiszindex', mayosisZindex);
                }

                $currentTag.css('z-index', 'auto');

                // Save current display, opacity and visibility values
                if (!mayosisVisibility || mayosisTransform !== 'none') {
                    if (!$currentTag.hasClass('widget_mayosis_filters_widget')
                        &&
                        !$currentTag.hasClass('mayosis-filters-widget-main-wrapper')
                    ) {
                        $currentTag.css('opacity', '0');
                        $currentTag.addClass('mayosis-force-visibility mayosis-was-invisible');
                    }
                }
            });

            if( mayosisUseSelect2 === 'yes' ){
                mayosisInitSelect2( 'mayosis-mayosis-filter-'+setId );
            }
        }

        $('.mayosis-open-button-'+setId+' .mayosis-filters-open-widget').addClass('mayosis-opened');
        $('html').addClass('mayosis-overlay-visible');
        $('body').data('set', setId);

        $content.addClass('mayosis-filters-widget-opened');
        $wrapper.addClass('mayosis-container-opened');
        $('.mayosis-mayosis-filter-'+setId+' .mayosis-filters-close-button').attr('href', window.location.href);

    }

    function mayosisOpenContainer( setId ) {
        let $wrapper = $( '.mayosis-mayosis-filter-'+setId );

        if( $wrapper.length < 1 ){
            alert('There is no filter widget with ID '+setId+' on this page');
            return;
        }

        if( $wrapper.hasClass('mayosis-container-opened') ){
            mayosisCloseFiltersContainer(setId);
        }else{
            mayosisOpenFiltersContainer(setId);
        }
    }

    function mayosisLockApplyButton( setId )
    {
        $(".mayosis-mayosis-filter-"+setId).addClass('is-active');
        $(".mayosis-mayosis-filter-"+setId+" .mayosis-filters-submit-button").addClass('on-hold');
        $(".mayosis-mayosis-filter-"+setId+" .mayosis-filters-reset-button").addClass('on-hold');
        // $(".mayosis-filters-section-"+setId).addClass('is-active');
    }

    function mayosisUnlockApplyButton( setId )
    {
        $(".mayosis-mayosis-filter-"+setId).removeClass('is-active');
        $(".mayosis-mayosis-filter-"+setId+" .mayosis-filters-submit-button").removeClass('on-hold');
        $(".mayosis-mayosis-filter-"+setId+" .mayosis-filters-reset-button").removeClass('on-hold');
        // $(".mayosis-filters-section-"+setId).removeClass('is-active');
    }

    function mayosisShowSpinner()
    {
        $('.mayosis-spinner, html').addClass('is-active');
    }

    function mayosisHideSpinner()
    {
        $('.mayosis-spinner, html').removeClass('is-active');
    }

    $.fn.mayosisInitSlider = function ( form ) {

        // Default valued at start
        let $min = form.find('.mayosis-filters-range-min');
        let $max = form.find('.mayosis-filters-range-max');
        let $slider = form.find('.mayosis-filters-range-slider-control');
        let step = parseFloat( $min.attr('step') );

        let initialMinVal = parseFloat( $min.data('min') );
        let initialMaxVal = parseFloat( $max.data('max') );

        // Values after applying filter
        let curMinVal = parseFloat( $min.val() );
        let curMaxVal = parseFloat( $max.val() );

        // Setting value into form inputs when slider is moving
        $slider.slider({
            min: initialMinVal,
            max: initialMaxVal,
            values: [curMinVal, curMaxVal],
            range: true,
            step: step,
            slide: function (event, elem) {
                let instantMinVal = elem.values[0];
                let instantMaxVal = elem.values[1];

                $min.val(instantMinVal);
                $max.val(instantMaxVal);
            },
            change: function (event) {
                // It is better always to submit slider automatically to avoid empty intersection occurrence
                submitSliderForm(event, form);
            }
        });

        form.submit(function (e) {
            //Remove ? sign if form is empty
            if (($(this).serialize().length === 0)) {
                e.preventDefault();
                window.location.assign(window.location.pathname);
            }
        });
    }

    function submitSliderForm(event, form) {

        if (event.originalEvent) {

            let $min    = form.find('.mayosis-filters-range-min');
            let $max    = form.find('.mayosis-filters-range-max');
            let $slider = form.find('.mayosis-filters-range-slider-control');

            var minVal = parseFloat($min.val());
            var maxVal = parseFloat($max.val());

            var initialMin = $slider.slider('option', 'min');
            var initialMax = $slider.slider('option', 'max');

            if (minVal === initialMin) {
                $min.attr('disabled', true);
            }

            if (maxVal === initialMax) {
                $max.attr('disabled', true);
            }

            let $el = form.parents(mayosisWidgetContainer);
            let setId = $el.data('set');
            let applyButtonMode = false;

            if( setId > 0 && mayosisApplyButtonSets.length > 0 && mayosisApplyButtonSets.includes( setId ) ){
                applyButtonMode = true;
            }

            if ( mayosisAjax || applyButtonMode ) {
                event.preventDefault();
                let search  = form.serialize();
                let mayosisLink = form.attr('action') + '?' + search;

                mayosisSendFilterRequest(mayosisLink, $el, applyButtonMode);

                $min.attr('disabled', true);
                $max.attr('disabled', true);

            } else if( event.originalEvent ) {
                form.trigger('submit');
            }

        }
    }

    // Jiboshit' jak treba!
    function mayosisSendFilterRequest( link, widget, applyButtonMode, onComplete ){

        onComplete = (typeof onComplete !== 'undefined') ? onComplete : false;
        removeElement($('.mayosis-front-error'));

        let requestParams               = {};
        requestParams.mysis_ajax_link    = link;
        requestParams.mayosisAjaxAction     = 'filter';
        let setId                       = widget.data('set');
        let widgetClass                 = 'mayosis-mayosis-filter-'+setId;
        let targetPostsContainer        = mayosisPostContainers['default'];

        if( typeof mayosisPostContainers[setId] !== "undefined" ){
            targetPostsContainer = mayosisPostContainers[setId];
        }

        // Disable Apply button for Pop-up widget as its behavior is the same
        if( applyButtonMode ){
            if( $("body").hasClass("mayosis_show_bottom_widget") ){
                if( window.innerWidth <= mayosisMobileWidth ){
                    applyButtonMode = false;
                }
            }
        }

        $.ajax({
            'method': 'POST',
            'data': requestParams,
            'url': link,
            'dataType': 'html',
            beforeSend: function () {
                if( mayosisWaitCursor ){
                    $('html, body').css("cursor", "wait");
                }

                let $a_el = $(widget).find('.mayosis-filters-apply-button');

                $a_el.removeClass('mayosis-posts-loaded');

                let oldLink = $a_el.attr('href');

                $a_el.attr('href', link);
                $a_el.data('href', oldLink);

                // $(".mayosis-filters-section-"+setId).find(".mayosis-filters-submit-button").attr('href', link);

                if( applyButtonMode ){
                    mayosisLockApplyButton( setId );
                }else{
                    mayosisShowSpinner();
                }
            },
            complete: function () {
                if(onComplete !== false){
                    eval(onComplete+'(setId)');
                }
                if( mayosisWaitCursor ) {
                    $('html, body').css("cursor", "auto");
                }

                mayosisInitiateAll();

                if( applyButtonMode){
                    mayosisUnlockApplyButton(setId);
                }else{
                    mayosisHideSpinner();
                }

            },
            success: function ( response ) {
                if ( typeof response !== 'undefined' ) {
                    // Products
                    // Wrap response to allow .find method search inner elements.
                    response                    = '<div class="responseWrapper">'+response+'</div>';
                    let $response               = $(response);
                    let $responsePostsContainer = $response.find(targetPostsContainer);
                    let currentSeoRuleId        = $response.find('#mayosis-seo-rule-id').data('seoruleid');
                    let isFilterRequest         = $response.find('.mayosis-filters-widget-main-wrapper').hasClass('mayosis-filter-request');

                    if ( currentSeoRuleId > 0 ) {
                        currentState = true;
                    } else {
                        currentState = false;
                    }

                    if ( ! currentState && ! prevState ) {
                        toReplaceSEO = false;
                    } else {
                        toReplaceSEO = true;
                    }

                    if( applyButtonMode ){
                        // Filters Widget
                        mayosisReloadFiltersWidget( $response, widgetClass );
                        return;
                    }

                    if( ( $responsePostsContainer.length > 0 ) && mayosisFilterFront.mayosisAjaxEnabled && mayosisQueryOnThePageSets.includes( setId ) ){

                        if( isFilterRequest ) {
                            $("body").addClass('mayosis_is_filter_request');
                        } else {
                            $("body").removeClass('mayosis_is_filter_request');
                        }
                        // But this works on TV also
                        $(targetPostsContainer).html( $responsePostsContainer.html() );
                        // mayosisPostsWereLoaded = true;

                        // Mark the "Show" button to not reload content
                        $(widget).find('.mayosis-filters-apply-button').addClass('mayosis-posts-loaded');

                        //@todo update selected terms if them outside of posts container

                        if ( toReplaceSEO ) {
                            let responseTitle     = $response.find('title').text();
                            let responseCanonical = $response.find('link[rel="canonical"]').attr('href');

                            // If h1 outside of posts container
                            if( $responsePostsContainer.find('h1').length < 1 ){
                                if( $response.find('h1').length > 0){
                                    $('h1')[0].replaceWith( $response.find('h1')[0] );
                                }
                            }

                            // If seoText container is outside from posts container
                            if( $responsePostsContainer.find('.mayosis-page-seo-description').length < 1 ){
                                let mayosisSeoTextContainer = $response.find('.mayosis-page-seo-description');
                                let originalSeoTextContainer = $('.mayosis-page-seo-description');
                                if( mayosisSeoTextContainer.length > 0 && originalSeoTextContainer.length > 0){
                                    $('.mayosis-page-seo-description')[0].replaceWith( mayosisSeoTextContainer[0] );
                                }
                            }

                            // Replace title
                            if( typeof responseTitle !== 'undefined' && responseTitle !== '' ){
                                $(document).attr( 'title', responseTitle );
                            }

                            // Handle <meta name="description" /> tag
                            handleMetaTag('description', response);

                            // Handle <meta name="robots" /> tag
                            handleMetaTag('robots', response);

                            // Handle Canonical
                            if( typeof responseCanonical !== 'undefined' && responseCanonical !== '' ){
                                // Replace content if tag exists
                                if( $('link[rel="canonical"]').length > 0 ){
                                    $('link[rel="canonical"]').attr('href', responseCanonical );
                                } else {
                                    // Append meta tag
                                    $('head').append('<link rel="canonical" href="'+responseCanonical+'" />');
                                }
                            }else{
                                if( $('link[rel="canonical"]').length > 0 ){
                                    $('link[rel="canonical"]').remove();
                                }
                            }
                        }

                        // If Filters open button outside of posts container
                        if( $responsePostsContainer.find('.mayosis-open-button-'+setId).length < 1 ) {
                            let mayosisButtonInnerContent = $response.find('.mayosis-open-button-'+setId+' .mayosis-button-inner');
                            if( mayosisButtonInnerContent.length > 0 ) {
                                // let mayosisButtonInnerContent = $response.find('.mayosis-open-button-'+setId+' .mayosis-button-inner')[0];
                                $('.mayosis-open-button-'+setId+' .mayosis-button-inner').replaceWith( mayosisButtonInnerContent[0] );
                            }
                        }

                        window.history.pushState({mayosisHandler: 'mayosisFilterEverything'}, null, link);

                        // console.log( 'toReplace ' + toReplaceSEO );
                        // console.log( 'prevState ' + prevState );
                        // console.log( 'currentState ' + currentState );

                        prevState = currentState;
                    }

                    let mayosisPostsFound   = $response.find('.'+widgetClass).find('.mayosis-posts-found').data('found');
                    mayosisPostsFound       = parseFloat( mayosisPostsFound );

                    // Chips
                    mayosisReloadChips( $response );

                    // Sorting widget
                    mayosisReloadSorting( $response );

                    // Filters Widget. It modifies $response so it is better to fire it in the end
                    mayosisReloadFiltersWidget( $response, widgetClass );

                    //trigger events
                    $(document).trigger( 'ready' );
                    $(window).trigger( 'scroll' );
                    $(window).trigger( 'resize' );

                    // a3 Lazy Load support
                    $(window).trigger( 'lazyshow' );

                    mayosisFixWoocommerceOrder();

                    let applyButtonFilterSet = false;
                    if( setId > 0 && mayosisApplyButtonSets.length > 0 && mayosisApplyButtonSets.includes( setId ) ){
                        applyButtonFilterSet = true;
                    }

                    if( ! mayosisIsMobile && mayosisAutoScroll && ( mayosisPostsFound < mayosisPostsPerPage[setId] || applyButtonFilterSet ) ){
                        if( targetPostsContainer.length > 0 ){
                            $('body, html').animate({ scrollTop:$(targetPostsContainer).offset().top - mayosisAutoScrollOffset });
                        }
                    }

                    // Re-init Elementor actions
                    if( typeof( elementorFrontend ) !== 'undefined' ){
                        $(targetPostsContainer+' .elementor-element').each(
                            function() {
                                elementorFrontend.elementsHandler.runReadyTrigger( $( this ) );
                            }
                        );
                    }
                }
            },

            error: function (response) {
                mayosisHideSpinner();
                let $a_el = $(widget).find('.mayosis-filters-apply-button');
                let oldLink = $a_el.data('href');
                $a_el.attr('href', oldLink );
            }
        });

    }

    function handleMetaTag( tagName, response )
    {

        let tagContent = $(response).find('meta[name="'+tagName+'"]').attr('content');
        if( typeof tagContent !== 'undefined' ){
            // Replace content if tag exists
            if( $('meta[name="'+tagName+'"]').length > 0 ){
                $('meta[name="'+tagName+'"]').attr('content', tagContent );
            } else {
                // Append meta tag
                $('head').append('<meta name="'+tagName+'" content="'+tagContent+'" />');
            }
        }else{
            if( $('meta[name="'+tagName+'"]').length > 0 ){
                $('meta[name="'+tagName+'"]').remove();
            }
        }
    }

    function mayosisFixWoocommerceOrder() {
        $('.woocommerce-ordering').on('change', 'select.orderby', function () {
            $(this).closest('form').submit();
        });
    }

    function mayosisReloadFiltersWidget( $response, widgetClass ){
        // Replace parts
        // let targetWidget = '.'+widgetClass;
        // let $response    = $response;
        // It seems we need to reload all widgets available on the page
        if( mayosisIsMobile === true && (mayosisFilterFront.showBottomWidget === 'yes') ){

            $(mayosisWidgetContainer).each( function ( index, widget ){
                let widgetSet = $(widget).data('set');
                let widgetClass = '.mayosis-mayosis-filter-'+widgetSet;

                // .mayosis-filters-scroll-container
                // .mayosis-filters-widget-containers-wrapper
                let newWidget       = $response.find(widgetClass+' .mayosis-filters-scroll-container');
                let newPostsFound   = $response.find(widgetClass+' .mayosis-filters-found-posts');

                // Replace all filters and chips
                if( newWidget.length > 0 ){
                    $(widgetClass).find('.mayosis-filters-scroll-container').replaceWith( newWidget );
                }
                // Replace found posts number
                if( newPostsFound.length > 0  ){
                    $(widgetClass).find('.mayosis-filters-found-posts').replaceWith( newPostsFound );
                }

                if( mayosisApplyButtonSets.includes( widgetSet ) ){
                    let applyLink = $(widgetClass+" .mayosis-filters-submit-button").attr('href');
                    if( applyLink !== '' ){
                        $(".mayosis-filters-widget-controls-container .mayosis-filters-submit-button").attr('href', applyLink);
                    }
                }
            });

        } else {
            $(mayosisWidgetContainer).each( function ( index, widget ) {
                let widgetSet = $(widget).data('set');
                let widgetClass = '.mayosis-mayosis-filter-'+widgetSet;

                let newWidget = $response.find(widgetClass);
                if (newWidget.length > 0) {
                    $(widgetClass).replaceWith(newWidget);
                }
            });
        }
    }

    function mayosisReloadSorting( $response ){
        let mayosisSortingForms   = $response.find('.mayosis-sorting-form');
        if ( mayosisSortingForms.length < 1 ) {
            return;
        }
        let originalSortingForms = $(".mayosis-sorting-form");

        if( mayosisSortingForms.length > 0 ){
            mayosisSortingForms.each( function ( index, elem ){
                originalSortingForms[index].replaceWith(elem);
            });
        }
    }

    function mayosisReloadChips( $response ){
        let $chips = $(".mayosis-filter-chips-list");
        if ( $chips.length < 1 ) {
            return;
        }

        $chips.each( function ( index, chipsWidget ) {
            let chipsSet            = $(chipsWidget).data('set');
            let chipsWidgetClass    = '.mayosis-filter-chips-'+chipsSet;
            let newWidgets          = $response.find(chipsWidgetClass);

            $(chipsWidgetClass).each( function ( innerIndex, theChipsWidget ) {
                let $theChipsWidget = $(theChipsWidget);

                if (newWidgets.length > 0) {
                    $theChipsWidget.replaceWith(newWidgets[innerIndex]);
                }
            });

        });

        //$(".mayosis-chips-locked").removeClass("mayosis-chips-locked");
    }

    window.addEventListener( 'popstate', function ( e ) {
        // @todo the last history step sometimes doesn't reload
        if( e.state !== null && e.state.hasOwnProperty('mayosisHandler') ){
            if( e.state.mayosisHandler === 'mayosisFilterEverything' ){
                window.location.reload(true);
            }
        }
    });

    $.fn.tipTip = function(options) {
        var defaults = {
            activation: "hover",
            keepAlive: false,
            maxWidth: "200px",
            edgeOffset: 3,
            defaultPosition: "bottom",
            delay: 400,
            fadeIn: 200,
            fadeOut: 200,
            attribute: "title",
            content: false, // HTML or String to fill TipTIp with
            enter: function(){},
            exit: function(){}
        };
        var opts = $.extend(defaults, options);

        // Setup tip tip elements and render them to the DOM
        if($("#tiptip_holder").length <= 0){
            var tiptip_holder = $('<div id="tiptip_holder" style="max-width:'+ opts.maxWidth +';"></div>');
            var tiptip_content = $('<div id="tiptip_content"></div>');
            var tiptip_arrow = $('<div id="tiptip_arrow"></div>');
            $("body").append(tiptip_holder.html(tiptip_content).prepend(tiptip_arrow.html('<div id="tiptip_arrow_inner"></div>')));
        } else {
            var tiptip_holder = $("#tiptip_holder");
            var tiptip_content = $("#tiptip_content");
            var tiptip_arrow = $("#tiptip_arrow");
        }

        return this.each(function(){
            var org_elem = $(this);
            if(opts.content){
                var org_title = opts.content;
            } else {
                var org_title = org_elem.attr(opts.attribute);
            }
            if(org_title != ""){
                if(!opts.content){
                    org_elem.removeAttr(opts.attribute); //remove original Attribute
                }
                var timeout = false;

                if(opts.activation == "hover"){
                    org_elem.hover(function(){
                        active_tiptip();
                    }, function(){
                        if(!opts.keepAlive || !tiptip_holder.is(':hover')){
                            deactive_tiptip();
                        }
                    });
                    if(opts.keepAlive){
                        tiptip_holder.hover(function(){}, function(){
                            deactive_tiptip();
                        });
                    }
                } else if(opts.activation == "focus"){
                    org_elem.focus(function(){
                        active_tiptip();
                    }).blur(function(){
                        deactive_tiptip();
                    });
                } else if(opts.activation == "click"){
                    org_elem.click(function(){
                        active_tiptip();
                        return false;
                    }).hover(function(){},function(){
                        if(!opts.keepAlive){
                            deactive_tiptip();
                        }
                    });
                    if(opts.keepAlive){
                        tiptip_holder.hover(function(){}, function(){
                            deactive_tiptip();
                        });
                    }
                }

                function active_tiptip(){
                    opts.enter.call(this);
                    tiptip_content.html(org_title);
                    tiptip_holder.hide().removeAttr("class").css("margin","0");
                    tiptip_arrow.removeAttr("style");

                    var top = parseInt(org_elem.offset()['top']);
                    var left = parseInt(org_elem.offset()['left']);
                    var org_width = parseInt(org_elem.outerWidth());
                    var org_height = parseInt(org_elem.outerHeight());
                    var tip_w = tiptip_holder.outerWidth();
                    var tip_h = tiptip_holder.outerHeight();
                    var w_compare = Math.round((org_width - tip_w) / 2);
                    var h_compare = Math.round((org_height - tip_h) / 2);
                    var marg_left = Math.round(left + w_compare);
                    var marg_top = Math.round(top + org_height + opts.edgeOffset);
                    var t_class = "";
                    var arrow_top = "";
                    var arrow_left = Math.round(tip_w - 12) / 2;

                    if(opts.defaultPosition == "bottom"){
                        t_class = "_bottom";
                    } else if(opts.defaultPosition == "top"){
                        t_class = "_top";
                    } else if(opts.defaultPosition == "left"){
                        t_class = "_left";
                    } else if(opts.defaultPosition == "right"){
                        t_class = "_right";
                    }

                    var right_compare = (w_compare + left) < parseInt($(window).scrollLeft());
                    var left_compare = (tip_w + left) > parseInt($(window).width());

                    if((right_compare && w_compare < 0) || (t_class == "_right" && !left_compare) || (t_class == "_left" && left < (tip_w + opts.edgeOffset + 5))){
                        t_class = "_right";
                        arrow_top = Math.round(tip_h - 13) / 2;
                        arrow_left = -12;
                        marg_left = Math.round(left + org_width + opts.edgeOffset);
                        marg_top = Math.round(top + h_compare);
                    } else if((left_compare && w_compare < 0) || (t_class == "_left" && !right_compare)){
                        t_class = "_left";
                        arrow_top = Math.round(tip_h - 13) / 2;
                        arrow_left =  Math.round(tip_w);
                        marg_left = Math.round(left - (tip_w + opts.edgeOffset + 5));
                        marg_top = Math.round(top + h_compare);
                    }

                    var top_compare = (top + org_height + opts.edgeOffset + tip_h + 8) > parseInt($(window).height() + $(window).scrollTop());
                    var bottom_compare = ((top + org_height) - (opts.edgeOffset + tip_h + 8)) < 0;

                    if(top_compare || (t_class == "_bottom" && top_compare) || (t_class == "_top" && !bottom_compare)){
                        if(t_class == "_top" || t_class == "_bottom"){
                            t_class = "_top";
                        } else {
                            t_class = t_class+"_top";
                        }
                        arrow_top = tip_h;
                        marg_top = Math.round(top - (tip_h + 5 + opts.edgeOffset));
                    } else if(bottom_compare | (t_class == "_top" && bottom_compare) || (t_class == "_bottom" && !top_compare)){
                        if(t_class == "_top" || t_class == "_bottom"){
                            t_class = "_bottom";
                        } else {
                            t_class = t_class+"_bottom";
                        }
                        arrow_top = -12;
                        marg_top = Math.round(top + org_height + opts.edgeOffset);
                    }

                    if(t_class == "_right_top" || t_class == "_left_top"){
                        marg_top = marg_top + 5;
                    } else if(t_class == "_right_bottom" || t_class == "_left_bottom"){
                        marg_top = marg_top - 5;
                    }
                    if(t_class == "_left_top" || t_class == "_left_bottom"){
                        marg_left = marg_left + 5;
                    }
                    tiptip_arrow.css({"margin-left": arrow_left+"px", "margin-top": arrow_top+"px"});
                    tiptip_holder.css({"margin-left": marg_left+"px", "margin-top": marg_top+"px"}).attr("class","tip"+t_class);

                    if (timeout){ clearTimeout(timeout); }
                    timeout = setTimeout(function(){ tiptip_holder.stop(true,true).fadeIn(opts.fadeIn); }, opts.delay);
                }

                function deactive_tiptip(){
                    opts.exit.call(this);
                    if (timeout){ clearTimeout(timeout); }
                    tiptip_holder.fadeOut(opts.fadeOut);
                }
            }
        });
    }

})(jQuery);