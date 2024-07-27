<?php

namespace FilterEverything\Filter;

if ( ! defined('WPINC') ) {
    wp_die();
}

class ExperimentalTab extends BaseSettings
{
    protected $page = 'mayosis-filter-experimental-settings';

    protected $group = 'mayosis_filter_experimental';

    protected $optionName = 'mayosis_filter_experimental';

    public function init()
    {
        add_action('admin_init', array($this, 'initSettings'));
    }

    public function initSettings()
    {
        register_setting($this->group, $this->optionName);

        $settings = array(
            'ajax_settings' => array(
                    'label'  => esc_html__('AJAX', 'mayosis-filter'),
                    'fields' => array(
                        'use_loader' => array(
                            'type'  => 'checkbox',
                            'title' => esc_html__('AJAX loading icon (on desktop only)', 'mayosis-filter'),
                            'id'    => 'use_loader',
                            'label' => esc_html__('Show icon', 'mayosis-filter'),
                        ),
                        'use_wait_cursor' => array(
                            'type'  => 'checkbox',
                            'title' => esc_html__('Wait Cursor (on desktop only)', 'mayosis-filter'),
                            'id'    => 'use_wait_cursor',
                            'label' => esc_html__('Use Wait Cursor for AJAX', 'mayosis-filter'),
                        ),
                        'dark_overlay' => array(
                            'type'  => 'checkbox',
                            'title' => esc_html__('Dark Overlay (on desktop only)', 'mayosis-filter'),
                            'id'    => 'dark_overlay',
                            'label' => esc_html__('Use dark transparent overlay instead of white', 'mayosis-filter'),
                        ),
                        'auto_scroll' => array(
                            'type'  => 'checkbox',
                            'title' => esc_html__('Smart Auto Scroll (on desktop only)', 'mayosis-filter'),
                            'id'    => 'auto_scroll',
                            'label' => esc_html__('Automatically Scroll to the top of posts grid', 'mayosis-filter'),
                        )
                    )
                ),
                'layout_settings' => array(
                    'label'  => esc_html__('Appearance', 'mayosis-filter'),
                    'fields' => array(
                        'styled_inputs' => array(
                            'type'  => 'checkbox',
                            'title' => esc_html__('Styled checkboxes and radio buttons', 'mayosis-filter'),
                            'id'    => 'styled_inputs',
                            'label' => esc_html__('Enable styling', 'mayosis-filter'),
                        ),
                        'select2_dropdowns' => array(
                            'type'  => 'checkbox',
                            'title' => esc_html__('Improved dropdowns', 'mayosis-filter'),
                            'id'    => 'styled_inputs',
                            'label' => esc_html__('Use improved dropdowns instead of regular ones (jQuery plugin Select2)', 'mayosis-filter'),
                        ),
                    )
                )
        );

        if( mysis_is_woocommerce() ){
            $settings['woocommerce_settings'] = array(
                'label'  => esc_html__('WooCommerce', 'mayosis-filter'),
                'fields' => array(
                    'disable_woo_orderby' => array(
                        'type'  => 'checkbox',
                        'title' => esc_html__('Woocommerce Order By dropdown', 'mayosis-filter'),
                        'id'    => 'disable_woo_orderby',
                        'label' => esc_html__('Hide Woocommerce default sorting dropdown', 'mayosis-filter'),
                    ),
                )
            );
        }

        $settings['customization'] = array(
                    'label'  => esc_html__('Customization', 'mayosis-filter'),
                    'fields' => array(
                        'custom_css'        => array(
                            'type'  => 'textarea',
                            'title' => esc_html__('Custom CSS', 'mayosis-filter'),
                            'id'    => 'custom_css',
                            'label' => ''
                        )
                    )
                );

        $settings = apply_filters('mayosis_experimental_filters_settings', $settings);

        $this->registerSettings($settings, $this->page, $this->optionName);
    }

    public function getLabel()
    {
        return esc_html__('Experimental', 'mayosis-filter');
    }

    public function getName()
    {
        return 'experimental';
    }

    public function valid()
    {
        return true;
    }
}