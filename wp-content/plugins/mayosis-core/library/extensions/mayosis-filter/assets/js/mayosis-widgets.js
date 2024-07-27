/*!
 * Mayosis Filter seo rules admin 1.7.1
 */
(function($) {
    "use strict";

    let itemNum = mayosisWidgets.mayosisItemNum;
    //@todo fix Elementor
    //@todo Create minifined version
    $(document).ready(function (){
        // Sorting widget
        $(document).on('click', '.mayosis-sorting-item-title', function (){
            $(this).parent('.mayosis-sorting-item-top').toggleClass('mayosis-opened');
        });

        $(document).on('click', '.mayosis-sorting-item-remove', function (){

            let item        = $(this);
            let sorting     = item.parents('div.mayosis-sorting-list');
            let mayosisSortingItems = sorting.find('.mayosis-sorting-item-wrapper');
            if( mayosisSortingItems.length < 2 ){
                return;
            }

            let widget      = item.parents('div.widget');
            let inside      = widget.children('.widget-inside');
            let saveButton  = inside.find( '.widget-control-save' );
            let widgetId    = inside.find( '.widget-id' ).val();
            let toRemove    = item.parents('.mayosis-sorting-item-wrapper');

            toRemove.remove();

            mayosisSortingItemsOrder(sorting);

            window.wpWidgets.dirtyWidgets[ widgetId ] = true;
            widget.addClass( 'widget-dirty' );
            saveButton.prop( 'disabled', false ).val( wp.i18n.__( 'Save' ) );
        });

        $(document).on('change', '.mayosis-orderby-select', function(e){
            let select       = $(this);
            let itemWrapper = select.parents('.mayosis-sorting-item-inside');
            let metaKeyWrapper = itemWrapper.find('.mayosis-sorting-item-meta-key-wrapper');

            if( select.val() === 'm' || select.val() === 'n' ){
                metaKeyWrapper.addClass('mayosis-opened');
            }else{
                metaKeyWrapper.removeClass('mayosis-opened');
            }

            return true;
        });

        $(document).on('input change', '.mayosis-sorting-item-label', function (){
            let input       = $(this);
            let itemWrapper = input.parents('.mayosis-sorting-item-wrapper');
            let itemParent  = itemWrapper.parents('.mayosis-sorting-list'); //.find('.mayosis-sorting-item-wrapper').length;
            let itemTitle   = itemWrapper.find('.mayosis-sorting-item-title');

            if( input.val() === '' ){
                let itemCurPos = itemWrapper.index();
                itemTitle.text( itemTitle.data('title') + (itemCurPos + 1) );
            }else{
                cpaLiveWrite( input, itemTitle );
            }

        });

        $(document).on('widget-added widget-updated', function (){
            mayosisMakeSortItemsSortable();

            $('.mayosis-help-tip').tipTip({
                'attribute': 'data-tip',
                'fadeIn':    50,
                'fadeOut':   50,
                'delay':     200,
                'keepAlive': true,
                'maxWidth': "220px",
            });
        });

        $(document).on('focus', '.mayosis-sorting-item-label', function (){
            let currentVal = $(this).val();
            let mayosisRegExp =  new RegExp("^" + itemNum + "[\\d]{1,100}$");
            let newVal = currentVal.replace(mayosisRegExp, '');
            $(this).val(newVal);
        });

        $(document).on('click', '.mayosis-add-sorting-item', function (e){
            e.preventDefault();
            let widgetContent = $(this).parents('.mayosis-add-sorting-item-wrapper').parent(); //('.widget-content');
            let sortingList   = widgetContent.find('.mayosis-sorting-list');
            let html          = widgetContent.find('.mayosis-new-sorting-item').html();
            let $el           = $(html);
            let label         = $el.find('.mayosis-sorting-item-title');
            let search        = 'mayosis_new_id';
            let replace       = (sortingList.find('.mayosis-sorting-item-wrapper').length + 1);

            let replaceAttr = function(i, value){
                return value.replace( search, replace );
            }

            $el.find('[id*="' + search + '"]').attr('id', replaceAttr);
            $el.find('[for*="' + search + '"]').attr('for', replaceAttr);
            $el.find('[name*="' + search + '"]').attr('name', replaceAttr);
            $el.find('[value*="' + search + '"]').attr('value', replaceAttr);
            //label.attr('data-title', replaceAttr);
            label.text(label.data('title') + replace);
            $el.attr('class', replaceAttr);
            $el.find('.mayosis-sorting-item-top').addClass('mayosis-opened');

            // Hack to make Save Button active
            $("input.mayosis-ballast").trigger('change');

            sortingList.append($el);
        });

        // Elementor compatibility
        if( typeof elementor !== 'undefined'){
            elementor.hooks.addAction( 'panel/widgets/wp-widget-mayosis_sorting_widget/controls/wp_widget/loaded', function( widget ) {
                // console.log( widget );
                // console.log( $( '.mayosis-sorting-list' ) );

                setTimeout(function() {
                    // console.log( $( '.mayosis-sorting-list' ) );
                    mayosisMakeSortItemsSortable();
                    $("input.mayosis-ballast").trigger('change');
                }, 500);
            } );
        }

        mayosisMakeSortItemsSortable();
        // End Sorting widget
    });

    function mayosisMakeSortItemsSortable(){

        $( '.mayosis-sorting-list' ).sortable({
            items: "> div.mayosis-sorting-item-wrapper",
            delay: 75,
            placeholder: "mayosis-filter-item-shadow",
            refreshPositions: true,
            cursor: 'move',
            handle: ".mayosis-sorting-item-handle",
            axis: 'y',
            update: function( event, ui ) {
                mayosisSortingItemsOrder(ui.item.parent('.mayosis-sorting-list'));
            },
            start: function ( event, ui ){
                let $this = ui.item,
                    head = ui.item.children('.mayosis-sorting-item-top'),
                    mayosisSortingItemHeight = (head.height() + 2);

                if (head.hasClass('mayosis-opened') ) {
                    head.removeClass('mayosis-opened')
                    $this.css('max-height', mayosisSortingItemHeight + 'px');
                    $(this).sortable('refreshPositions');
                }
            },
            stop: function ( event, ui ){
                ui.item.css('max-height', 'none');
            }
        });
    }

    function cpaLiveWrite( readFrom, writeTo ) {
        writeTo.text(readFrom.val());
    }

    function mayosisSortingItemsOrder( $el ){
        let sortingList = $el; //.parent('.mayosis-sorting-list');
        let itemTitles  =  sortingList.find('.mayosis-sorting-item-label');
        let titleVal    = '';
        let newTitleVal = '';
        let mayosisRegExp =  new RegExp("^" + itemNum + "[\\d]{1,100}$");

        if( itemTitles.length > 0 ){
            itemTitles.each( function ( index, element ) {
                titleVal = $(element).val();
                newTitleVal = titleVal.replace(mayosisRegExp, itemNum+(index+1) );
                $(element).val(newTitleVal)
                    .trigger('change');
            });
        }
    }

})(jQuery);