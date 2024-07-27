<?php


namespace FilterEverything\Filter;

if ( ! defined('WPINC') ) {
    wp_die();
}

class AdminHooks
{

    public function __construct()
    {
        add_filter( 'manage_edit-'.MYSIS_FILTERS_SET_POST_TYPE.'_columns', array( $this, 'filterSetPostTypeCol' ) );
        add_action( 'manage_'.MYSIS_FILTERS_SET_POST_TYPE.'_posts_custom_column', array( $this, 'filterSetPostTypeColContent'), 10, 2 );

        add_filter( 'manage_edit-'.MYSIS_FILTERS_SET_POST_TYPE.'_sortable_columns', array( $this, 'filterSetSortableColumn') );
        add_action( 'pre_get_posts', array( $this, 'filterSetOrderby' ) );

        add_action('admin_notices', [$this, 'adminNotices'] );
        add_action('admin_notices', [$this, 'checkForbiddenPrefixes'] );

        add_filter( 'plugin_action_links_' . MYSIS_PLUGIN_BASENAME, [$this,'actionsLink'] );

        add_action( 'current_screen', [$this, 'currentScreen' ] );
        //add_action( 'mayosis_admin_toolbar_right', [$this, 'aboutPro' ] );
    }

    public function aboutPro()
    {
       

        $this->addHelpTab();

    }

    public function addHelpTab() {
        $screen = get_current_screen();

        if( is_null( $screen ) ){
            return false;
        }

        // Overview tab.
        $screen->add_help_tab(
            array(
                'id'      => 'overview',
                'title'   => esc_html__( 'Overview', 'mayosis-filter' ),
                'content' =>
                    '<p><strong>' . esc_html__( 'Overview', 'mayosis-filter' ) . '</strong></p>' .
                    '<p>' . esc_html__( 'Mayosis Filter — WordPress & WooCommerce product filter plugin, that allows you to design flexible filtering system.', 'mayosis-filter' ) . '</p>'.
                    '<p>' . esc_html__( 'It is fast, convenient and intuitive, and also contains unique features for SEO (in PRO version).', 'mayosis-filter' ) . '</p>'
            )
        );

        // Help tab.
        $screen->add_help_tab(
            array(
                'id'      => 'help',
                'title'   => esc_html__( 'Help & Support', 'mayosis-filter' ),
                'content' =>
                    '<p><strong>' . esc_html__( 'Help & Support', 'mayosis-filter' ) . '</strong></p>' .
                    '<ul>' .
                    '<li>' . wp_kses( sprintf(
                                        __( '<a href="%s" target="_blank">Documentation</a>. Common information how to work with the plugin can be found in our documentation.', 'mayosis-filter' ),
                                        'https://teconce.com/resources/'
                                        ),
                                        array(
                                            'a' => array( 'href' => true, 'target' => true )
                                        )
                        ). '</li>' .
                    '<li>' . wp_kses(
                                sprintf(
                                    __( '<a href="%s" target="_blank">Support</a>. Create a technical support request if you are unable to resolve the issue yourself.', 'mayosis-filter' ),
                                    'https://teconce.com/support/'
                                ),
                                array(
                                    'a' => array( 'href' => false, 'target' => true )
                                )
                    ). '</li>' .
                    '</ul>'
            )
        );

        // Sidebar.
        $screen->set_help_sidebar(
            '<p><strong>' . esc_html__( 'Information', 'mayosis-filter' ) . '</strong></p>' .
            '<p><span class="dashicons dashicons-admin-plugins"></span> ' . sprintf( esc_html__( 'Version %s', 'mayosis-filter' ), MYSIS_PLUGIN_VER ) . '</p>' .
            '<p><span class="dashicons dashicons-wordpress"></span> <a href="https://wordpress.org/plugins/mayosis-filter/" target="_blank">' . esc_html__( 'View details', 'mayosis-filter' ) . '</a></p>' .
            '<p><span class="dashicons dashicons-admin-home"></span> <a href="https://teconce.com/" target="_blank" target="_blank">' . esc_html__( 'Visit website', 'mayosis-filter' ) . '</a></p>' .
            ''
        );
    }

    public function currentScreen( $screen )
    {
        $screenList = [MYSIS_FILTERS_SET_POST_TYPE];

        if( defined( 'MYSIS_SEO_RULES_POST_TYPE' ) ){
            $screenList[] = MYSIS_SEO_RULES_POST_TYPE;
        }

        if( isset( $screen->post_type ) && in_array( $screen->post_type, $screenList ) ){
            add_action( 'in_admin_header', [ $this, 'inAdminHeader' ] );
        }
    }

    public function inAdminHeader()
    {
        $templateManager = Container::instance()->getTemplateManager();
        $templateManager->includeAdminView( 'header-navigation' );
    }

    public function actionsLink( $actions ) {
        $actionsLink = array(
            '<a href="' . admin_url( 'post-new.php?post_type=mayosis-filter' ) . '">'.esc_html__('Add Filters', 'mayosis-filter').'</a>',
            '<a href="' . admin_url( 'edit.php?post_type=mayosis-filter&page=filters-settings' ) . '">'.esc_html__('Settings', 'mayosis-filter').'</a>'
        );

        $actions = array_merge( $actionsLink, $actions );

        return $actions;
    }

    public function checkForbiddenPrefixes()
    {
        $forbiddenPrefixes  = mysis_get_forbidden_prefixes();
        $savedPrefixes      = get_option( 'mayosis_filter_permalinks', [] );
        $warningPrefixes    = [];

        foreach( $forbiddenPrefixes as $prefix ){
            if( in_array( $prefix, $savedPrefixes ) ){
                $warningPrefixes[] = $prefix;
            }
        }

        $permalinkOptionsUrl    = admin_url( 'edit.php?post_type=mayosis-filter&page=filters-settings&tab=prefixes' );
        $permalinksTab          = new PermalinksTab();
        $permalinksTabLabel     = strtolower( $permalinksTab->getLabel() );

        if( ! empty( $warningPrefixes ) ){

            $message = wp_kses(
                            sprintf(
                                _n(
                                'Error: <strong>%s</strong> filter prefix is not allowed and must be changed on the Filter %s settings <a href="%s" target="_blank">page</a>. Otherwise this site will not work properly.',
                                'Error: following filter prefixes <strong>%s</strong> are not allowed and must be changed on the Filter %s settings <a href="%s" target="_blank">page</a>. Otherwise this site will not work properly.',
                                count($warningPrefixes),
                                'mayosis-filter'
                                ), implode( ', ', $warningPrefixes ), $permalinksTabLabel, $permalinkOptionsUrl
                            ),
                            array(
                                'strong' => array(),
                                'a' => array('href' => true, 'target' => true)
                            )
                        );

            ?>
            <div class="notice mayosis-error is-dismissible">
                <p><?php echo $message; // Already escaped ?></p>
            </div>
            <?php

        }

    }

    public function adminNotices()
    {
        $get = Container::instance()->getTheGet();

        if( ! isset( $get['message'] ) ){
            return false;
        }

        $messageNum = sanitize_key($get['message']); // no need to escape
        $errors     = FilterFields::getErrorsList();

        ?>
        <?php foreach ( $errors  as $id => $message ) : ?>
            <?php if( isset( $errors[$messageNum] ) ): // no need to escape ?>
            <div class="mayosis-error is-dismissible">
                <p><?php echo $errors[$messageNum]; ?></p>
                <button type="button" class="notice-dismiss">
                    <span class="screen-reader-text"><?php esc_html_e('Dismiss this notice.'); ?></span>
                </button>
            </div>
            <?php break; endif; ?>
        <?php endforeach; ?>
        <?php
    }

    public function filterSetOrderby( $query ) {
        if( ! is_admin() )
            return;

        if( $query->get('post_type') !== MYSIS_FILTERS_SET_POST_TYPE ){
            return;
        }

        $orderby = $query->get( 'orderby' );

        if( $orderby === 'menu_order title' ){
            $query->set( 'orderby', 'date' );
            $query->set( 'order', 'DESC' );
        }

        if( 'set_post_type' == $orderby ) {
            $query->set( 'meta_key', 'mayosis_filter_set_post_type' );
            $query->set( 'orderby', 'meta_value' );
        }

    }

    public function filterSetSortableColumn( $columns )
    {
        $columns['set_post_type'] = 'set_post_type';
        return $columns;
    }

    public function filterSetPostTypeCol( $columns )
    {
        $newColumns = [];

        foreach ( $columns as $columnId => $columnName ) {

            if( $columnId === 'date' ){
                continue;
            }

            $newColumns[$columnId] = $columnName;
            if( $columnId === 'title' ){
                $newColumns['set_post_type'] = esc_html__( 'Post type', 'mayosis-filter' );
            }
        }

        return $newColumns;
    }

    public function filterSetPostTypeColContent( $column_name, $post_id )
    {
        if( 'set_post_type' == $column_name ){
            $fss        = Container::instance()->getFilterSetService();
            $theSet     = $fss->getSet( $post_id );

            $postTypeSelected   = isset( $theSet['post_type']['value'] ) ? $theSet['post_type']['value'] : '';
            $postTypes          = isset( $theSet['post_type']['options'] ) ? $theSet['post_type']['options'] : '';
            $postType           = isset( $postTypes[ $postTypeSelected ] ) ? $postTypes[ $postTypeSelected ] : '';

            echo esc_html( $postType );
        }
    }

}

new AdminHooks();