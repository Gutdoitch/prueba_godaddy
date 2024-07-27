<?php

// If this file is called directly, abort.
if ( ! defined('WPINC') ) {
    wp_die();
}

if( ! class_exists( 'MysisFilter' ) ):

    class MysisFilter{

        public function init()
        {
            global $mysis_sets, $mayosis_not_fired;

            $mayosis_not_fired = true;
            $mysis_sets     = [];

            $this->define( 'MYSIS_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );
            $this->define( 'MYSIS_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );
            $this->define( 'MYSIS_PLUGIN_BASENAME', plugin_basename(__FILE__) );
            $this->define( 'MYSIS_PLUGIN_SLUG', 'mayosis-filter-pro' );
            $this->define( 'MYSIS_PLUGIN_VER', '1.0' );
            $this->define( 'MYSIS_PLUGIN_URL', 'https://teconce.com' );
            $this->define( 'MYSIS_PLUGIN_TESTED_TO', '6.0.2' );
            $this->define( 'MYSIS_PLUGIN_DEBUG', false );
            $this->define( 'MYSIS_TEMPLATES_DIR_NAME', 'filters' );

            $this->define( 'MYSIS_FILTERS_SET_POST_TYPE', 'mayosis-filter' );
            $this->define( 'MYSIS_FILTERS_POST_TYPE', 'filter-field' );
            $this->define( 'MYSIS_PREFIX_SEPARATOR', '-' );
            $this->define( 'MYSIS_QUERY_TERMS_SEPARATOR', ';' );
            $this->define( 'MYSIS_FOLDING_COOKIE_NAME', 'mayosisContainersStatus' );
            $this->define( 'MYSIS_MORELESS_COOKIE_NAME', 'mayosisMoreLessStatus' );
            $this->define( 'MYSIS_HIERARCHY_LIST_COOKIE_NAME', 'mayosisHierarchyListStatus' );
            $this->define( 'MYSIS_OPEN_CLOSE_BUTTON_COOKIE_NAME', 'mayosisWidgetStatus' );
            $this->define( 'MYSIS_APPLY_BUTTON_META_KEY', 'mayosis_filter_set_apply_button_post_name' );
            $this->define( 'MYSIS_TRANSIENT_PERIOD_HOURS', 12 );
            $this->define( 'MYSIS_BEAVER_BUILDER_VAR', 'fl_builder' );

            $this->define( 'MYSIS_LICENSE_KEY', 'mayosis_filter_license' );

            require_once MYSIS_PLUGIN_DIR_PATH . 'src/mayosis-helpers.php';

            mysis_include('src/mayosis-compat.php');
            mysis_include('src/mayosis-default-hooks.php');
            mysis_include('src/mayosis-third-party.php');

            mysis_include('src/Plugin.php');
            mysis_include('src/PostTypes.php');
            mysis_include('src/Settings/TabInterface.php');
            mysis_include('src/Settings/BaseSettings.php');
            mysis_include('src/Settings/TabRenderer.php');
            mysis_include('src/Settings/Container.php');

            mysis_include('src/Entities/Entity.php');

            mysis_include('src/Entities/TaxonomyEntity.php');
            mysis_include('src/Entities/PostMetaEntity.php');
            mysis_include('src/Entities/PostMetaNumEntity.php');
            mysis_include('src/Entities/AuthorEntity.php');

            // Include PRO
//            mysis_include('pro/filters-pro.php');

            mysis_include('src/Entities/DefaultEntity.php');
            mysis_include('src/Entities/EntityManager.php');

            mysis_include('src/Settings/Tabs/SettingsTab.php');
            mysis_include('src/Settings/Tabs/PermalinksTab.php');
            mysis_include('src/Settings/Tabs/ExperimentalTab.php');

            mysis_include('src/Settings/Filter.php');

            mysis_include('src/RequestParser.php');
            mysis_include('src/UrlManager.php');
            mysis_include('src/Chips.php');
            mysis_include('src/Sorting.php');

            mysis_include('src/Walkers/WalkerCheckbox.php');

            mysis_include('src/TemplateManager.php');
            mysis_include('src/WpManager.php');

            mysis_include('src/Admin/FilterSet.php');
            mysis_include('src/Admin/FilterFields.php');
            mysis_include('src/Admin/Admin.php');
            mysis_include('src/Admin/AdminHooks.php');
            mysis_include('src/Admin/MetaBoxes.php');
            mysis_include('src/Admin/Widgets/FiltersWidget.php');
            mysis_include('src/Admin/Widgets/ChipsWidget.php');
            mysis_include('src/Admin/Widgets/SortingWidget.php');
            mysis_include('src/Admin/Widgets.php');
            mysis_include('src/Admin/Shortcodes.php');
            mysis_include('src/Admin/Validator.php');

            mysis_include('src/FormFields/Input.php');
            mysis_include('src/mayosis-api.php');

            $this->registerHooks();

            if( mysis_get_experimental_option( 'disable_woo_orderby' ) === 'on' ) {
                if( ! function_exists('woocommerce_catalog_ordering') ){
                    function woocommerce_catalog_ordering()
                    {
                        return false;
                    }
                }
            }
        }

        public function registerHooks()
        {
            // Convert old post_name format to new. Since v1.1.24
            add_action( 'init', [$this, 'convertSetLocations'], -1 );

            // Backward compatibility. From v1.3.2
            add_action( 'init', [$this, 'convertShowChipsInContent'], -1 );

            add_action( 'init', [ $this, 'oneTwoThreeGo' ] );

            add_action( 'init', [$this, 'loadTextdomain'], 0 );

            add_action( 'after_setup_theme', [$this, 'afterSetupTheme'] );

            register_activation_hook(__FILE__, ['FilterEverything\Filter\Plugin', 'activate']);

            register_uninstall_hook(__FILE__, ['FilterEverything\Filter\Plugin', 'uninstall']);

            add_action('after_switch_theme', ['FilterEverything\Filter\Plugin', 'switchTheme'] );
        }

        public function convertShowChipsInContent()
        {
            // Backward compatibility. From v1.3.2
            $filter_settings = get_option('mayosis_filter_settings');

            if (isset($filter_settings['show_terms_in_content']) && $filter_settings['show_terms_in_content'] === 'on') {
                $new_chips_hooks = [];
                $theme_dependencies = mysis_get_theme_dependencies();

                if (mysis_is_woocommerce()) {
                    $new_chips_hooks[] = 'woocommerce_no_products_found';
                    $new_chips_hooks[] = 'woocommerce_archive_description';
                }

                if (isset($theme_dependencies['chips_hook']) && is_array($theme_dependencies['chips_hook'])) {
                    foreach ($theme_dependencies['chips_hook'] as $compat_chips_hook) {
                        $new_chips_hooks[] = $compat_chips_hook;
                    }
                }

                $filter_settings['show_terms_in_content'] = $new_chips_hooks;
                update_option('mayosis_filter_settings', $filter_settings);
            }
        }

        public function convertSetLocations()
        {
            if( is_admin() ) {

                global $wpdb;

                // Convert separator from ":" to "___" and from -1 to 1
                $sql   = [];
                $sql[] = "SELECT {$wpdb->posts}.ID, {$wpdb->posts}.post_name";
                $sql[] = "FROM {$wpdb->posts}";
                $sql[] = "WHERE {$wpdb->posts}.post_type = '%s'";
                $sql[] = "AND {$wpdb->posts}.post_name REGEXP '[\:]+'";
                $sql[] = "OR {$wpdb->posts}.post_name = '-1'";

                $sql = implode(" ", $sql);
                $sql = $wpdb->prepare($sql, MYSIS_FILTERS_SET_POST_TYPE);

                $results = $wpdb->get_results($sql, ARRAY_A);

                if (!empty($results)) {

                    foreach ($results as $row) {
                        $update = [];

                        if (!isset($row['post_name']) || !isset($row['ID'])) {
                            continue;
                        }

                        if( $row['post_name'] == '-1' ){
                            $new_post_name = '1';
                        }else{
                            $new_post_name = str_replace(":", "___", $row['post_name']);
                        }

                        $update[] = "UPDATE {$wpdb->posts}";
                        $update[] = "SET {$wpdb->posts}.post_name = '%s'";
                        $update[] = "WHERE {$wpdb->posts}.ID = %s";

                        $updateSql = implode(" ", $update);

                        $updateSql = $wpdb->prepare($updateSql, $new_post_name, $row['ID']);

                        $wpdb->query($updateSql);
                    }
                }

            }

        }

        public function loadTextdomain()
        {
            load_plugin_textdomain( 'mayosis-filter', false, dirname(MYSIS_PLUGIN_BASENAME) . '/lang' );
        }

        public function oneTwoThreeGo()
        {
            new \FilterEverything\Filter\Plugin();
        }

        /**
         * @since 1.6.1
         */
        public function afterSetupTheme()
        {
            $this->define( 'MYSIS_ALLOW_PLL_TRANSLATIONS', true );
        }

        public function define( $name, $value = true )
        {
            if( ! defined( $name ) ) {
                define( $name, $value );
            }
        }

    }

    function mysis_filter()
    {
        global $mayosisFilter;

        if( ! isset( $mayosisFilter ) ) {
            $mayosisFilter = new MysisFilter();
            $mayosisFilter->init();
        }

        return $mayosisFilter;

    }

    mysis_filter();

endif;