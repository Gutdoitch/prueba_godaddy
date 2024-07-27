(function ($) {

   'use strict';

    var MAYOSISLIB;

    MAYOSISLIB = {

        init: function () {

            window.elementor.on(
                'document:loaded',
                window._.bind(MAYOSISLIB.onPreviewLoaded, MAYOSISLIB)
            );
        },

        onPreviewLoaded: function () {

            var main_wrap = $('#elementor-preview-iframe').contents();
            var wrapper_html = "<div style='display:none;' class='lib-wrap'>"
                                    +"<div class='lib-inner'>"
                                        +"<div class='header'>"
                                            +"<div class='lhead'>"
                                                +"<h2 class='lib-logo'>Mayosis Library</h2>"
                                                +"<h2 class='back-to-home'>Back to template</h2>"
                                            +"</div>"
                                            +"<div class='rhead'>"
                                                +"<i class='eicon-sync'></i>"
                                                +"<i class='lib-close eicon-close'></i>"
                                            +"</div>"                                            
                                        +"</div>"
                                        +"<div class='lib-inner'>"
                                            +"<div class='lib-content'>"
                                            +"</div>"
                                            +"<div class='live-preview'>"
                                            +"</div>"
                                            +"<div class='xl-loader'>"
                                                +"<div class='loader'>"
                                                +"</div>"
                                            +"</div>"
                                        +"</div>"
                                    +"</div>"
                                    +"<div class='xl-settings'></div>"
                                +"</div>";

            main_wrap.find('.elementor-add-template-button').after("<div class='elementor-add-section-area-button xltab-add-section-btn' style='background:#e7eff7;margin-left:10px;'><img src='http://api.themepreview.xyz/mayosis/wp-content/uploads/2021/12/icon-1.png' style='width:16px;'></div>");

            $('#elementor-editor-wrapper').append(wrapper_html);

            main_wrap.find('.xltab-add-section-btn').click(function(){

                $('#elementor-editor-wrapper').find('.lib-wrap').show();
                var ajax_data = {
                    page : '1',
                    category:'',
                };
                process_data(ajax_data);

            });

            $(document).on('click', '.insert-tmpl', function(e) {
                var tmpl_id = $(this).data('id');
                $('.xl-loader').show();
                $.ajax({
                    type: 'POST',
                    url: ajaxurl,
                    data: {
                      action: 'mayosis_lib_import_template',
                      id: tmpl_id,
                    },
                    success: function(data, textStatus, XMLHttpRequest) {
                        var xl_data = JSON.parse(data); 
                        elementor.getPreviewView().addChildModel(xl_data, {silent: 0});
                        $('.xl-loader').hide();
                        $('#elementor-editor-wrapper').find('.lib-wrap').hide();
                    },
                  });
            });

            $(document).on('click', '.rhead .eicon-sync', function(e) {
                $('.xl-loader').show();
                $.ajax({
                    type: 'POST',
                    url: ajaxurl,
                    data: {
                      action: 'mayosis_lib_reload_template',
                    },
                    success: function(data, textStatus, XMLHttpRequest) {
                        $('.xl-loader').hide();
                        var ajax_data = {
                            page : '1',
                            category:'',
                        };
                        process_data(ajax_data);                        
                    },
                  });
            });

            $(document).on('click', '.lib-img-wrap', function(e) {
                $('.xl-loader').show();
                var live_link = $(this).data('preview');
                $('.lib-content').hide();
                $('.lib-logo').hide();
                $('.back-to-home').show();
                $.ajax({
                    type: 'POST',
                    url: ajaxurl,
                    data: {
                      action: 'live_preview',
                      preview: live_link,
                    },

                    success: function(data, textStatus, XMLHttpRequest) {
                        $('.xl-loader').hide();
                        $('.live-preview').html(data);
                    },

                  });
            });

            $(document).on('click', '.back-to-home', function(e) {
            
                $('.live-preview').html('');
                $('.back-to-home').hide();
                $('.lib-content').show();
                $('.lib-logo').show();

            });

            $(document).on('click', '.page-link', function(e) {
                $('.xl-loader').show();
                var page_no = $(this).data('page-number');
                var category = $('#elementor-editor-wrapper').find('.xl-settings').attr('data-catsettings');
                $('#elementor-editor-wrapper').find('.xl-settings').attr('data-pagesettings', page_no);
                var ajax_data = {
                    page: page_no,
                    category: category,
                };
                process_data(ajax_data);
            });

            $(document).on('click', '.filter-wrap a', function(e) {
                
                var category = $(this).data('cat');
                $('#elementor-editor-wrapper').find('.xl-settings').attr('data-catsettings', category);
                $('.xl-loader').show();
                var ajax_data = {
                    page : '1',
                    category:category,
                };
                process_data(ajax_data);
            });
           
           
 
            
           

            function process_data($data){

                  $.ajax({
                    type: 'POST',
                    url: ajaxurl,
                    data: {
                      action: 'process_ajax',
                      category: $data['category'],
                      page:$data['page'],
                    },

                    success: function(data, textStatus, XMLHttpRequest) {
                        $('.xl-loader').hide();
                            $('.lib-content').html(data);

                    $('.item-wrap').masonry({
                        itemSelector: '.item',
                        isAnimated: false,
                        transitionDuration: 0
                    });

                    $('.item-wrap').masonry('reloadItems');
                    $('.item-wrap').masonry('layout');

                    $('.item-wrap').imagesLoaded( function() {
                      $('.item-wrap').masonry('layout');
                    });

                    },

                  });

            }

            $('#elementor-editor-wrapper').find('.lib-close').click(function(){
                $('#elementor-editor-wrapper').find('.lib-wrap').hide();
                $('.live-preview').html('');
                $('.lib-content').show();
                $('.back-to-home').hide();
            });

        },

    };

    $(window).on('elementor:init', MAYOSISLIB.init);

})(jQuery);