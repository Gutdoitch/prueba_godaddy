<?php

namespace FilterEverything\Filter;

if ( ! defined('WPINC') ) {
    wp_die();
}

class SettingsTab extends BaseSettings
{
    protected $page = 'mayosis-filter-admin-settings';

    protected $group = 'mayosis_filter';

    protected $optionName = 'mayosis_filter_settings';

    public function init()
    {
        add_action('admin_init', array($this, 'initSettings'));
    }

    public function initSettings()
    {
        register_setting($this->group, $this->optionName);
        /**
         * @see https://developer.wordpress.org/reference/functions/add_settings_field/
        */
        $defaultPostsContainer = mysis_default_posts_container();
        $defaultPrimaryColor   = mysis_default_theme_color();

        $settings = array(
            'mobile_devices' => array(
                'label'  => esc_html__('Mobile devices', 'mayosis-filter'),
                'fields' => array(
                    'show_open_close_button'        => array(
                        'type'  => 'checkbox',
                        'title' => esc_html__('Collapse Filters Widget on Mobile devices', 'mayosis-filter'),
                        'id'    => 'show_open_close_button',
                        'label' => esc_html__('Collapse widget and show the Filters opening button', 'mayosis-filter'),
                    ),
                    'try_move_to_top_sidebar' => array(
                        'type'  => 'checkbox',
                        'title' => esc_html__('Sidebar on top', 'mayosis-filter'),
                        'id'    => 'try_move_to_top_sidebar',
                        'label' => esc_html__('Try to move sidebar to top on mobile devices', 'mayosis-filter'),
                    )
                )
            ),
            'ajax' => array(
                'label'  => esc_html__('AJAX', 'mayosis-filter'),
                'fields' => array(
                    'enable_ajax'        => array(
                        'type'  => 'checkbox',
                        'title' => esc_html__('AJAX for Filters', 'mayosis-filter'),
                        'id'    => 'enable_ajax',
                        'label' => esc_html__('Try to use AJAX', 'mayosis-filter'),
                        'description' => esc_html__( 'Please enable this option only after you have ensured that the filtering is working correctly', 'mayosis-filter' ),
                    ),
                    'posts_container' => array(
                        'type'      => 'text',
                        'title'     => esc_html__('CSS id or class of the Posts Container', 'mayosis-filter'),
                        'id'        => 'posts_container',
                        'default'   => $defaultPostsContainer,
                        'description' => esc_html__( 'e.g. .mayosis-archive-wrapper', 'mayosis-filter' ),
                        'label'     => '',
                    )
                )
            ),
            'common_settings' => array(
                'label'  => esc_html__('Other', 'mayosis-filter'),
                'fields' => array(
                    'primary_color' => array(
                        'type'    => 'text',
                        'title'   => esc_html__('Widget Primary Color', 'mayosis-filter'),
                        'id'      => 'mayosis_primary_color',
                        'default' => $defaultPrimaryColor,
                        'label'   => '',
                    ),
                    'container_height' => array(
                        'type'  => 'text',
                        'title' => esc_html__('Filter Container max height, px', 'mayosis-filter'),
                        'id'    => 'container_height',
                        'label' => '',
                    ),
                    'show_terms_in_content' => array(
                        'type'  => 'select',
                        'title' => esc_html__('Selected Filters (Chips) integration', 'mayosis-filter'),
                        'id'    => 'show_terms_in_content',
                        'label' => esc_html__('Try to show selected terms above the posts container', 'mayosis-filter'),
                        'options' => array(),
                        'multiple' => true,
                        'description' => esc_html__( 'Select where to show Chips on your site. Or enter your theme\'s hooks. For example: before_main_content', 'mayosis-filter' )
                    ),
                    'widget_debug_messages' => array(
                        'type'  => 'checkbox',
                        'title' => esc_html__('Debug mode', 'mayosis-filter'),
                        'id'    => 'widget_debug_messages',
                        'label' => esc_html__('Enable debugging messages to help to configure filters', 'mayosis-filter'),
                    )
                )
            )
        );

        $settings = apply_filters('mayosis_general_filters_settings', $settings);

        $this->registerSettings($settings, $this->page, $this->optionName);
    }

    public function getLabel()
    {
        return esc_html__('General', 'mayosis-filter');
    }

    public function getName()
    {
        return 'settings';
    }

    public function valid()
    {
        return true;
    }
}

