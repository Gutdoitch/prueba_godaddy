<?php


namespace FilterEverything\Filter;

if ( ! defined('WPINC') ) {
    wp_die();
}

class Admin
{
    public $tabRenderer;

    public function __construct()
    {
        add_action( 'admin_menu', array($this, 'adminMenu'), 9);
        $this->tabRenderer = Container::instance()->getTabRenderer();
        $filterSet = Container::instance()->getFilterSetService();

        add_action( 'pre_post_update', [$filterSet, 'preSaveSet'], 10, 2 );
        add_action( 'save_post', array( $filterSet, 'saveSet' ), 10, 2 );

        add_action( 'init', array( $this, 'initTabs' ), 11 );

        add_action( 'admin_init', array( $this, 'init' ) );

        add_filter( 'mayosis_general_filters_settings', [$this, 'generalFilterSettings'] );
    }

    public function init()
    {
        $filterFields = Container::instance()->getFilterFieldsService();
        $filterFields->registerHooks();

        // Check permissions before to show these screens
        add_action( 'load-post.php', [ $this, 'checkPermissions' ] );
        add_action( 'load-edit.php', [ $this, 'checkPermissions' ] );
        add_action( 'load-post-new.php', [ $this, 'checkPermissions' ] );

    }

    public function adminMenu()
    {
        $page = 'edit.php?post_type=' . MYSIS_FILTERS_SET_POST_TYPE;

        add_menu_page( esc_html__('Filters', 'mayosis-filter'), esc_html__('Filters', 'mayosis-filter'), 'manage_options', $page, false,  $this->get_icon_svg(), '85');

        add_submenu_page( $page, esc_html__('Filter Sets', 'mayosis-filter'), esc_html__('Filter Sets', 'mayosis-filter'), 'manage_options', $page);
        add_submenu_page( $page, esc_html__('Add New', 'mayosis-filter'), esc_html__('Add New', 'mayosis-filter'), 'manage_options', 'post-new.php?post_type=' . MYSIS_FILTERS_SET_POST_TYPE);

        do_action('mayosis_add_submenu_pages');

        add_submenu_page( $page, esc_html__('Settings', 'mayosis-filter'), esc_html__('Settings', 'mayosis-filter'), 'manage_options', 'filters-settings', array($this, 'filterSettingsPage'));

        do_action('mayosis_after_add_submenu_pages');
    }

    public function filterSettingsPage()
    {
        $this->tabRenderer->render();
    }

    public function initTabs()
    {
        $this->tabRenderer->register(new SettingsTab());
        $this->tabRenderer->register(new PermalinksTab());

        do_action( 'mayosis_setttings_tabs_register', $this->tabRenderer );

        $this->tabRenderer->register(new ExperimentalTab());

       

        $this->tabRenderer->init();
    }

    public function get_icon_svg()
    {
        return mysis_get_icon_svg();
    }

    public function checkPermissions()
    {
        $screen     = get_current_screen();
        $post_types = [ MYSIS_FILTERS_SET_POST_TYPE, MYSIS_FILTERS_POST_TYPE ];

        if( defined('MYSIS_FILTERS_PRO') && MYSIS_FILTERS_PRO ){
            $post_types[] = MYSIS_SEO_RULES_POST_TYPE;
        }

        if( ! is_null( $screen ) && property_exists( $screen, 'post_type' ) && in_array( $screen->post_type, $post_types, true ) ){
            if( ! current_user_can( 'manage_options' ) ) {
                wp_die( esc_html__( 'Sorry, you are not allowed to access this page.' ) );
            }
        }
    }

    public function generalFilterSettings( $settings )
    {
        $result_terms   = [];

        // Chips hooks
        $maybe_saved_terms  = mysis_get_option('show_terms_in_content', []);
        $theme_dependencies = mysis_get_theme_dependencies();

        $current_terms = $settings['common_settings']['fields']['show_terms_in_content']['options'];

        if( mysis_is_woocommerce() ){
            $woocommerce_terms = array(
                'woocommerce_archive_description' => esc_html__('WooCommerce archive description', 'mayosis-filter' ),
                'woocommerce_no_products_found' => esc_html__('WooCommerce no products found', 'mayosis-filter' ),
                'woocommerce_before_shop_loop' => esc_html__('WooCommerce before Shop loop', 'mayosis-filter' ),
                'woocommerce_before_main_content' => esc_html__('WooCommerce before main content', 'mayosis-filter' )
            );

            $result_terms = array_merge( $current_terms, $woocommerce_terms );
        }

        if( $maybe_saved_terms && is_array( $maybe_saved_terms )){
            foreach ($maybe_saved_terms as $hook ){
                if( ! in_array( $hook, array_keys( $result_terms ) ) ){
                    $result_terms[$hook] = $hook;
                }
            }
        }

        if( isset( $theme_dependencies['chips_hook'] ) && ! empty( $theme_dependencies['chips_hook'] )){
            foreach ($theme_dependencies['chips_hook'] as $hook ){
                if( ! in_array( $hook, array_keys( $result_terms ) ) ){
                    $result_terms[$hook] = $hook;
                }
            }
        }

        $settings['common_settings']['fields']['show_terms_in_content']['options'] = $result_terms;

        return $settings;
    }

}