<?php


namespace FilterEverything\Filter;

if ( ! defined('WPINC') ) {
    wp_die();
}

class FilterFields
{

    const MYSIS_NEW_FILTER_ID = 'mayosis_new_id';

    const FILTER_FIELD_KEY = 'mayosis_filter_fields';

    private $defaultFields = [];

    private $fse;

    private $em;

    private $hooksRegistered = false;

    private $errors;

    public function __construct()
    {
        $this->fse = Container::instance()->getFilterService();
        $this->em  = Container::instance()->getEntityManager();
        $this->setupDefaultFields();
    }

    public function registerHooks()
    {
        if ( ! $this->hooksRegistered ) {
            add_filter( 'mayosis_input_type_select', [ $this, 'addSpinnerToSelect' ], 10, 2 );

            add_action( 'wp_ajax_mayosis-delete-filter',  [ $this, 'ajaxDeleteFilter' ] );
            add_action( 'wp_ajax_mayosis-load-exclude-terms', [ $this, 'sendExcludedTerms' ] );
            add_action( 'wp_ajax_mayosis-validate-filters', [ $this, 'ajaxValidateFilters' ] );
            add_action( 'after_delete_post', [ $this, 'deleteRelatedFilters' ], 10, 2 );

            $this->hooksRegistered = true;
        }
    }

    private function setupDefaultFields()
    {
        // maybe add filter in future to allow change default fields
        do_action( 'mayosis_before_setup_filter_fields' );
        $entity     = $this->em->getEntityByFilter( array('entity' => 'taxonomy', 'e_name' => 'category'), 'post' );

        $defaultFields = array(
            'ID' => array(
                'type'          => 'Hidden'
            ),
            'parent' => array(
                'type'          => 'Hidden'
            ),
            'menu_order' => array(
                'type'          => 'Hidden',
                'class'         => 'mayosis-menu-order-field'
            ),
            'entity' => array(
                'type'          => 'Select',
                'label'         => esc_html__(  'Filter by', 'mayosis-filter' ),
                'class'         => 'mayosis-field-entity',
                'options'       => $this->em->getPossibleEntities(),
                'default'       => 'taxonomy_category',
                'instructions'  => esc_html__(  'A thing by which posts will be filtered', 'mayosis-filter' ),
            'required'          => true
            ),
            'e_name' => array(
                'type'          => 'Text',
                'label'         => esc_html__(  'Meta Key', 'mayosis-filter' ),
                'class'         => 'mayosis-field-ename',
                'instructions'  => esc_html__( 'Name of the Custom Field. Please, see Popular Meta keys at the bottom', 'mayosis-filter'),
                'required'      => true
            ),
            'label' => array(
                'type'          => 'Text',
                'label'         => esc_html__( 'Filter Label', 'mayosis-filter' ),
                'class'         => 'mayosis-field-label',
                'placeholder'   => esc_html__( 'New Filter', 'mayosis-filter'),
                'instructions'  => esc_html__(  'Title which will appear in filter widget', 'mayosis-filter' )
            ),
            'slug' => array(
                'type'          => 'Text',
                'label'         => esc_html__( 'Var Name for URL', 'mayosis-filter' ),
                'class'         => 'mayosis-field-slug',
                'instructions'  => esc_html__( 'Name of a part of URL responsible for this filter', 'mayosis-filter'),
                'tooltip'       => wp_kses(
                    __( 'For example, in the URL path:<br />/?color=blue&size=large<br />"color" and "size" are the names of the URL vars.<br />In PRO version of the plugin the URL part after "?" becomes <br />/color-blue/size-large/', 'mayosis-filter'),
                    array( 'br' => array() )
                ),
                'required'      => true
            ), // Optional
            'view' => array(
                'type'          => 'Select',
                'label'         => esc_html__( 'View in Widget', 'mayosis-filter' ),
                'class'         => 'mayosis-field-view',
                'options'       => $this->getViewOptions(),
                'default'       => 'checkboxes',
                'instructions'  => ''
            ),
            'logic' => array(
                'type'          => 'Select',
                'label'         => esc_html__( 'Filter Logic', 'mayosis-filter' ),
                'class'         => 'mayosis-field-logic',
                'options'       => array('or' => esc_html__('OR', 'mayosis-filter' ), 'and' => esc_html__('AND', 'mayosis-filter') ),
                'default'       => 'or',
                'instructions'  => esc_html__( 'Determines how to select posts, when two or more terms of this filter selected', 'mayosis-filter' ),
                'tooltip'       => wp_kses(
                    __( '«OR» means to show posts if them are at least in one of selected terms. <br />«AND» means, that posts should belong to all selected terms at the same time.', 'mayosis-filter' ),
                    array( 'br' => array() )
                ),
            ), // AND
            'orderby' => array(
                'type'          => 'Select',
                'label'         => esc_html__( 'Sort Terms by', 'mayosis-filter' ),
                'class'         => 'mayosis-field-orderby',
                'options'       => $this->getOrderByOptions(),
                'default'       => 'default',
                'instructions'  => esc_html__('The order in which terms appear in widget', 'mayosis-filter'),
                'tooltip'       => wp_kses(
                    __( '"Default" option means that terms will be sorted in the order as they were received from DataBase<br />The "Menu order" option is available for WooCommerce attributes only.', 'mayosis-filter' ),
                    array( 'br' => array() )
                )
            ),
            'in_path' => array(
                'type'          => 'Checkbox',
                'label'         => esc_html__( 'In URL', 'mayosis-filter' ),
                'class'         => 'mayosis-field-path',
                'default'       => 'yes',
                'instructions'  => ''
            ),
            'exclude' => array(
                'type'          => 'Select',
                'label'         => esc_html__( 'Include/Exclude Terms', 'mayosis-filter' ),
                'class'         => 'mayosis-field-exclude',
                'options'       => $entity->getTermsForSelect(),
                'multiple'      => 'multiple',
                'instructions'  => '',
                'skip_view'     => true
            ),
            'include' => array(
                'type'          => 'Select',
                'label'         => '',
                'class'         => 'mayosis-field-include',
                'options'       => [ 'no' => esc_html__( 'exclude', 'mayosis-filter' ), 'yes' => esc_html__('include', 'mayosis-filter' ) ],
                'default'       => 'no',
                'instructions'  => esc_html__( 'Include selected terms only', 'mayosis-filter' ),
                'skip_view'     => true
            ),
            'collapse' => array(
                'type'          => 'Checkbox',
                'label'         => esc_html__( 'Folding', 'mayosis-filter' ),
                'class'         => 'mayosis-field-collapse',
                'default'       => 'no',
                'instructions'  =>  esc_html__( 'Makes filter collapsible in widget', 'mayosis-filter'),
                'tooltip'       => esc_html__( 'Useful in situation when the filter is rarely applied but takes up some space in widget. Collapsed by default.', 'mayosis-filter' )
            ),
            'hierarchy' => array(
                'type'          => 'Checkbox',
                'label'         => esc_html__( 'Show Hierarchy', 'mayosis-filter' ),
                'class'         => 'mayosis-field-hierarchy',
                'default'       => 'no',
                'instructions'  => esc_html__( 'Display the term hierarchy in the filter widget. Child terms will be collapsed by default', 'mayosis-filter' )
            ),
            'range_slider' => array(
                'type'          => 'Checkbox',
                'label'         => esc_html__( 'Enable Range Slider?', 'mayosis-filter' ),
                'class'         => 'mayosis-field-range-slider',
                'default'       => 'yes',
                'instructions'  => esc_html__( 'If disabled, visitors must type numeric values in text inputs', 'mayosis-filter' )
            ),
            'step'      => array(
                'type'          => 'Text',
                'label'         => esc_html__( 'Slider Step', 'mayosis-filter' ),
                'class'         => 'mayosis-field-value-step',
                'instructions'  => esc_html__( 'Determines how numeric value will be changed when you move slider controls', 'mayosis-filter' ),
                'tooltip'       => wp_kses(
                    __('Step 1 means possible values are 1,2,3,4 ...<br />Step 0.1 means possible values are 5.1, 5.2, 5.3, 5.4 ...<br />Step 15 means possible values are 15, 30, 45, 60...', 'mayosis-filter'),
                    array( 'br' => array() )
                ),
                'default'       => 1
            ),
            'search' => array(
                'type'          => 'Checkbox',
                'label'         => esc_html__( 'Search field', 'mayosis-filter' ),
                'class'         => 'mayosis-field-search',
                'default'       => 'no',
                'instructions'  => esc_html__( 'Adds search field above the terms list', 'mayosis-filter' )
            ),
            'parent_filter' => array(
                'type'          => 'Select',
                'label'         => esc_html__( 'Parent Filter', 'mayosis-filter' ),
                'class'         => 'mayosis-field-parent-filter',
                'options'       => [ 'no' => esc_html__( 'Please, add filters first', 'mayosis-filter' ) ],
                'instructions'  => esc_html__( 'If specified, current Filter terms become available only after parent Filter selected', 'mayosis-filter' )
            ),
            'hide_until_parent' => array(
                'type'          => 'Checkbox',
                'label'         => esc_html__( 'Hide until Parent selected', 'mayosis-filter' ),
                'class'         => 'mayosis-field-hide-until-parent',
                'default'       => 'no',
                'instructions'  => esc_html__( 'Do not show this Filter until a parent selected. Useful for step by step filtering', 'mayosis-filter' )
            ),
            'tooltip' => array(
                'type'          => 'Text',
                'label'         => esc_html__( 'Tooltip', 'mayosis-filter' ),
                'class'         => 'mayosis-field-tooltip',
                'instructions'  => esc_html__( 'Will appear next to the Filter Label', 'mayosis-filter' ),
                'default'       => ''
            ),
            'more_less' => array(
                'type'          => 'Checkbox',
                'label'         => esc_html__( 'More/Less', 'mayosis-filter' ),
                'class'         => 'mayosis-field-more-less',
                'default'       => 'no',
                'instructions'  => sprintf( esc_html__( 'Show a toggle link after %s terms', 'mayosis-filter' ), mysis_more_less_count() )
            ),
            'show_chips' => array(
                'type'          => 'Checkbox',
                'label'         => esc_html__( 'Show in Chips', 'mayosis-filter' ),
                'class'         => 'mayosis-field-show-chips',
                'default'       => 'yes',
                'instructions'  => esc_html__( 'Show filter selected terms in the list of all chosen items', 'mayosis-filter' )
            )
        );

        $this->defaultFields = apply_filters( 'mayosis_filter_default_fields', $defaultFields, $this );
    }

    public static function getViewOptions()
    {
        $viewOptions = array(
            'checkboxes'    => esc_html__('Checkboxes', 'mayosis-filter'),
            'radio'         => esc_html__('Radio buttons', 'mayosis-filter'),
            'labels'        => esc_html__('Labels list', 'mayosis-filter'),
            'dropdown'      => esc_html__('Dropdown', 'mayosis-filter'),
            'range'         => esc_html__('Range', 'mayosis-filter')
        );

        return $viewOptions;
    }

    public function getOrderByOptions()
    {
        $orderBy = array(
            'default'       => esc_html__( 'Default (no sorting)', 'mayosis-filter' ),
            'nameasc'       => esc_html__( 'Term name &laquo;abc&raquo;', 'mayosis-filter' ),
            'postcountasc'  => esc_html__( 'Posts count &laquo;123&raquo;', 'mayosis-filter' ),
            'idasc'         => esc_html__( 'Term ID &laquo;123&raquo;', 'mayosis-filter' ),
            'menuasc'       => esc_html__( 'Menu order &laquo;123&raquo;', 'mayosis-filter' ),
            'namedesc'      => esc_html__( 'Term name &laquo;cba&raquo;', 'mayosis-filter' ),
            'postcountdesc' => esc_html__( 'Posts count &laquo;321&raquo;', 'mayosis-filter' ),
            'iddesc'        => esc_html__( 'Term ID &laquo;321&raquo;', 'mayosis-filter' ),
            'menudesc'      => esc_html__( 'Menu order &laquo;321&raquo;', 'mayosis-filter' )
        );

        return $orderBy;
    }

    public function getFieldsByType($type, $configuredFields = [] )
    {
        $selected = [];
        $type = ucfirst($type);

        foreach ( $configuredFields as $key => $field) {
            if ( isset( $field['type'] ) && ( $field['type'] === $type ) ) {
                $selected[$key] = $field;
            }
        }

        return $selected;

    }

    private function getFilterNames( $set_id )
    {
        $filternames = [];

        if( ! $set_id ){
            return $filternames;
        }

        $filters = $this->em->selectOnlySetFilters( $set_id );

        if( ! empty( $filters ) ) {
            if ( count( $filters ) > 1 ) {
                $filternames['-1'] = esc_html__( '— Select Filter —', 'mayosis-filter' ) ;
            } else {
                $filternames['no'] = esc_html__( 'Please, add filters first', 'mayosis-filter' );
            }

            foreach ( $filters as $filter ) {

                if ( in_array( $filter['entity'], [ 'post_meta_num', 'tax_numeric' ] ) ) {
                    continue;
                }

                if ( isset( $filter['ID'] ) ) {
                    $filternames[ $filter['ID'] ] = $filter['label'] .' (' . $filter['e_name'] .')';
                }
            }
        }

        return $filternames;
    }

    public function getEmptyFilterObject( $set_id )
    {
        $defaults = new \stdClass();
        $defaults->ID = self::MYSIS_NEW_FILTER_ID;
        $defaults->post_parent = '';
        $defaults->menu_order = 0;
        $defaults->post_title = '';
        $defaults->post_content = '';
        $defaults->post_name = '';

        $filter = $this->em->prepareFilter( $defaults );

        return $this->prepareFilterInputsToDisplay( $filter, $this->getFilterNames( $set_id ) );
    }

    public function getFiltersInputs( $set_id )
    {
        $preparedFilters = [];

        if( ! $set_id || empty( $set_id ) ){
            return $preparedFilters;
        }

        $filters = $this->em->selectOnlySetFilters( $set_id );
        foreach ( $filters as $field_key => $filter ){
            $preparedFilters[] = $this->prepareFilterInputsToDisplay( $filter, $this->getFilterNames( $set_id ) );
        }

        return $preparedFilters;
    }

    private function prepareFilterInputsToDisplay( $filter, $filternames )
    {
        $postTypes  = false;
        $terms      = [];
        // Used for filter table class in filter set fields.
        // E.g. post_meta, taxonomy, author.

        $short_entity   = $filter['entity'] ? $filter['entity'] : 'taxonomy';

        if ( $short_entity === 'taxonomy' ) {
            // Add hierarchical class
            if ( is_taxonomy_hierarchical( $filter['e_name'] ) ) {
                $short_entity .= ' taxonomy-hierarchical';
            }

            // Add product attribute class
            if ( strpos( $filter['e_name'], 'pa_' ) === 0 ) {
                $short_entity .= ' taxonomy-product-attribute';
            }
        }

        $short_entity .= isset( $filter['view'] ) ? ' mayosis-view-'.$filter['view'] : '';

        $belongs = $this->filterBelongsToPostType( $filter['parent'], $filter['entity'], $filter['e_name'] );

        $postType = '';
        // For post_meta_num entity postType is critical value so we have to set it up
        if ( in_array( $filter['entity'], array( 'post_meta_num', 'post_meta_exists' ) ) ) {
            $fss  = Container::instance()->getFilterSetService();
            $set =  $fss->getSet( $filter['parent'] );
            if( isset( $set['post_type']['value'] ) ){
                $postType = $set['post_type']['value'];
            }
        }

        $entity = $this->em->getEntityByFilter( $filter, $postType );

        if( $entity ){
            $terms = $entity->getTermsForSelect();
        }

        // This is required only for filter fields inputs
        $filter = $this->fse->combineEntityNameInFilter( $filter );

        foreach( $this->getFieldsMapping() as $fieldKey => $fieldData ){

            if( isset( $filter[$fieldKey] ) ){

                if( $fieldKey === 'parent_filter' ){
                    // Exclude current filter
                    if( isset( $filternames[ $filter['ID'] ] ) ){
                        unset( $filternames[ $filter['ID'] ] );
                    }

                    if( ! empty( $filternames ) ){
                        $fieldData['options'] = $filternames;
                    }
                }

                $default_value = isset( $fieldData['default'] ) ? $fieldData['default'] : '';

                $multiple = ( $fieldKey === 'exclude' && ! in_array( $filter['entity'], [ 'post_meta_num', 'tax_numeric' ] ) );

                $fieldData['name']     = $this->generateInputName( $filter['ID'], $fieldKey, $multiple );
                $fieldData['id']       = $this->generateInputID( $filter['ID'], $fieldKey );

                $fieldData['value']    = ( $filter[$fieldKey] ) ? $filter[$fieldKey] : $default_value;

                if( $fieldKey === 'hide_until_parent' ){
                    if( $filter['parent_filter'] > 0 ){
                        $fieldData['additional_class'] = 'mayosis-opened';
                    }
                }

                if ( $fieldKey === 'slug' && $fieldData['value'] ) {
                    $fieldData['readonly'] = 'readonly';
                }

                if ( $fieldKey === 'e_name' && $fieldData['value'] ) {
                    unset( $fieldData['options'] );
                    $fieldData['readonly']  = 'readonly';
                    $fieldData['type']      = 'Text';

                    if ( $filter['entity'] === 'tax_numeric' ) {
                        $fieldData['label']        = esc_html__(  'Taxonomy', 'mayosis-filter' );
                        $fieldData['instructions'] = esc_html__(  'Taxonomy with numeric values you need to filter by', 'mayosis-filter' );
                    }
                }

                if( $fieldKey === 'entity' ) {
                    $fieldData['short_entity'] = $short_entity;

                    if ( $filter['ID'] === self::MYSIS_NEW_FILTER_ID ) {
                        $fieldData['entity_belongs'] = true;
                    } else {
                        $fieldData['entity_belongs'] = $belongs;
                    }

                    // Add instead-entity field
                    if( $filter['ID'] !== self::MYSIS_NEW_FILTER_ID ){

                        /**
                         * @feature maybe move this to separate method
                         * @bug slug wasn't saved for new filter
                         */
                        // For existing filters we need to forbid changing entity value
                        // And we need to show input instead select
                        $fieldData['type'] = 'Text';
                        // To make it compatible with Text field
                        unset( $fieldData['options'] );
                        // Forbid to edit field
                        $fieldData['readonly'] = 'readonly';

                        $flatEntities = $this->em->getFlatEntities();

                        $insteadEntityVal = isset( $flatEntities[ $fieldData['value'] ] ) ? $flatEntities[ $fieldData['value'] ] : '';

                        if( $fieldData['value'] === 'post_meta_exists' && ! defined('MYSIS_FILTERS_PRO') ){
                            $insteadEntityVal = esc_html__('Available in PRO', 'mayosis-filter');
                        }

                        if( $fieldData['value'] === 'tax_numeric' && ! defined('MYSIS_FILTERS_PRO') ){
                            $insteadEntityVal = esc_html__('Available in PRO', 'mayosis-filter');
                        }

                        // Field, that will be visible instead of entity, that will be hidden.
                        $prepared[ 'instead-entity' ] = $this->getInsteadEntityField( $filter['ID'], $insteadEntityVal );

                    }

                    if ( $filter['ID'] === self::MYSIS_NEW_FILTER_ID ) {
                        if ( ! defined('MYSIS_FILTERS_PRO') ) {
                            $fieldData['disabled'] = array( 'post_meta_exists', 'tax_numeric' );
                        }
                    }

                }

                if( $fieldKey === 'exclude' ){
                    // We always add terms even they are empty array to fill Select2 with related terms.
                    $fieldData['options'] = $terms;

                    if( in_array( $filter['entity'], [ 'post_meta_num', 'tax_numeric' ] ) ) {
                        $fieldData['options'] = [];
                    }
                }

                // Set disabled fields for some situations
                if( in_array( $filter['entity'], array( 'author_author', 'post_meta_exists' ) ) /* $filter['entity'] === 'author_author'*/ && $fieldKey === 'logic' ){
                    $fieldData['disabled'] = array('and');
                }

                if( in_array( $filter['entity'], [ 'post_meta_num', 'tax_numeric' ] ) && $fieldKey === 'logic' ){
                    $fieldData['disabled'] = array('or');
                }

                if( in_array( $filter['entity'], [ 'post_meta_num', 'tax_numeric' ] ) && $fieldKey === 'view' ){
                    $fieldData['disabled'] = array('checkboxes', 'dropdown', 'radio', 'labels', 'colors', 'image');
                } else if ( ! in_array( $filter[ 'entity' ], [ 'post_meta_num', 'tax_numeric' ] ) && $fieldKey === 'view' ) {
                    $fieldData['disabled'] = array( 'range' );
                }

                if( $fieldKey === 'orderby' && ( mb_strpos( $filter['entity'], 'taxonomy_pa' ) === false ) ){
                    $fieldData['disabled'] = ['menuasc', 'menudesc'];
                }
            }

            $prepared[ $fieldKey ] = $fieldData;
        }

        return $prepared;
    }

    public function sanitizeFilterFields( $filter )
    {
        if( is_array( $filter ) ){
            $sanitizedFilter = [];
            $not_esc_html    = [ 'e_name', 'tooltip' ];

            foreach( $filter as $key => $value ){

                if( in_array( $key, $not_esc_html, true ) ){
                    // Why? because meta_key field can contain any different characters
                    $sanitizedFilter[ $key ] = $value;
                }else{

                    if( is_array( $value ) ){
                        array_map( 'esc_html', $value );
                        $sanitizedFilter[ $key ] = $value;
                    } else {
                        $sanitizedFilter[ $key ] = esc_html( $value );
                    }

                }
            }

            if( isset( $sanitizedFilter['menu_order'] ) ){
                $sanitizedFilter['menu_order'] = mysis_sanitize_int( $sanitizedFilter['menu_order'] );
            }

            if( isset( $sanitizedFilter['label'] ) ){
                $sanitizedFilter['label'] = sanitize_text_field( $sanitizedFilter['label'] );
            }

            if( isset( $sanitizedFilter['slug'] ) ){
                $sanitizedFilter['slug'] = preg_replace( '/[^a-z0-9\-\_]+/', '', mb_strtolower($sanitizedFilter['slug']) );
                $sanitizedFilter['slug'] = trim($sanitizedFilter['slug'], '-');
            }

            if( isset( $sanitizedFilter['step'] ) ){
                $sanitizedFilter['step'] = preg_replace('/[^\d\.]+/', '', $sanitizedFilter['step'] );
                if( ! $sanitizedFilter['step'] ){
                    $sanitizedFilter['step'] = 1;
                }
            }

            if( isset( $sanitizedFilter['tooltip'] ) ){
                $sanitizedFilter['tooltip'] = wp_kses(
                    $sanitizedFilter['tooltip'],
                    array(
                        'br'        => array(),
                        'span'      => array('class' => true, 'id' => true),
                        'em'        => array(),
                        'strong'    => array('class' => true),
                        'i'         => array(),
                        'b'         => array()
                    )
                );
            }

            return $sanitizedFilter;
        }

        return $filter;
    }

    public function validateTheFilter( $filter, $id = false ) {

        $valid          = true;
        $newFilter      = false;
        $filterID       = false;
        $validEntity    = true;
        $validator      = new Validator();

        if( $filter['ID'] === self::MYSIS_NEW_FILTER_ID ){
            $newFilter = true;
            $filterID  = $id;
        }else{
            $filterID  = $filter['ID'];
        }

        // Check all fields are our fields
        $defaultFields = $this->getFieldsMapping();
        // To make compatible with this field
        $defaultFields['instead-entity'] = true;

        foreach( $filter as $fieldKey => $fieldValue ){
            if( ! isset( $defaultFields[ $fieldKey ] ) ){
                $this->pushError(32); // Invalid fields present
                $valid = false;
            }
        }

        /**
         * Check required field data, that should be not empty
         */
        if( isset( $filter['ID'] ) ){
            // We need to check post type for current ID otherwise we can override any existing post
            if( $filter['ID'] !== self::MYSIS_NEW_FILTER_ID ){
                $savedFilter = get_post( $filter['ID'] );

                // Filter post doesn't exist
                if( ! $savedFilter ){
                    $this->pushError(33); // Invalid filter ID
                    $valid = false;
                }
                // Other post type
                if( ! isset( $savedFilter->post_type ) || $savedFilter->post_type !== MYSIS_FILTERS_POST_TYPE ){
                    $this->pushError(33); // Invalid filter ID
                    $valid = false;
                }
            }

        } else {
            $this->pushError(33); // Invalid filter ID
            $valid = false;
        }

        /**
         * Parent field aka Set ID
         */
        if( isset( $filter['parent'] ) ){

            if( $filter['ID'] !== self::MYSIS_NEW_FILTER_ID ) {
                $savedSet = get_post($filter['parent']);

                // Set post doesn't exist
                if (!$savedSet) {
                    $this->pushError(34); // Invalid Set ID
                    $valid = false;
                }
                // Other post type
                if ( ! isset( $savedSet->post_type ) || $savedSet->post_type !== MYSIS_FILTERS_SET_POST_TYPE) {
                    $this->pushError(34); // Invalid Set ID
                    $valid = false;
                }
            }

        }else{
            $this->pushError( 34); // Invalid Set ID
            $valid = false;
        }

        /**
         * Entity
         */
        if( isset( $filter['entity'] ) ){
            if( ! $validator->validatePossibleEntity( $filter['entity'] ) ){
                $this->pushError( 35, $filterID, 'entity' ); // Invalid Entity
                $this->pushError( 35, $filterID, 'instead-entity' );
                $validEntity = false;
                $valid = false;
            }

        }else{
            $this->pushError( 35, $filterID, 'entity' ); // Invalid Entity
            $this->pushError( 35, $filterID, 'instead-entity' );
            $validEntity = false;
            $valid = false;
        }

        /**
         * Slug validations
         */
        if( isset( $filter['slug'] ) ){
            $existingSlugs = get_option('mayosis_filter_permalinks', []);
            $prefix = $filter['slug'];

            // Check this only for new filters
            if( $filter['ID'] === self::MYSIS_NEW_FILTER_ID && $validEntity ) {
                $fs = Container::instance()->getFilterService();
                $newEntityKey = $fs->getEntityKey($filter['entity'], $filter['e_name']);
                // Prohibit using the same slug for another entity
                if (!$validator->validateExistingPrefix($prefix, $existingSlugs, $newEntityKey)) {
                    $this->pushError( 36, $filterID, 'slug' ); // Prefix is already used
                    $valid = false;
                }
            }

            // Ensure, that prefix contains at least one alphabetic character
            // Also this prevents from empty prefix
            if ( ! $validator->validateAlphabCharsExists( $prefix ) ) {
                $this->pushError( 37, $filterID, 'slug' ); // Invalid prefix. Has to contain at least one alphabetic symbol
                $valid = false;
            }

            // Check hyphens problem when cat and cat-x exists
            if ( ! $validator->validatePrefixHyphens( $prefix, $existingSlugs ) ) {
                $this->pushError( 39, $filterID, 'slug' ); // Invalid prefix. Incorrect hyphens.
                $valid = false;
            }

            // Check for slugs, that matches with native WP Entities
            if ( ! $validator->validateAllowedPrefixes( $prefix, $filter ) ) {
                $errorCode = 3991;
                if ( defined( 'MYSIS_FILTERS_PRO' ) && MYSIS_FILTERS_PRO ) {
                    $errorCode = 399;
                }
                $this->pushError( $errorCode, $filterID, 'slug' ); // Invalid prefix. Equal to wp entity.
                $valid = false;
            }

        } else {
            $this->pushError( 38, $filterID, 'slug' ); // Invalid prefix. Empty.
            $valid = false;
        }

        /**
         * E_name validations
         */
        if ( isset( $filter['e_name'] ) ) {

            if( isset( $filter['entity'] ) ) {
                if ( in_array( $filter['entity'], array( 'post_meta', 'post_meta_num', 'post_meta_exists', 'tax_numeric' ) ) ) {
                    $e_name = $filter['e_name'];

                    if ( $e_name === '' ) {
                        $this->pushError( 401, $filterID, 'e_name' ); // Select or Enter meta key.
                        $valid = false;
                    } else {

                        if ( $filter['entity'] === 'tax_numeric' ) {
                            // Validate taxonomy
                            $taxonomies      = $this->em->getPossibleTaxonomies();
                            $taxonomy_e_name = $filter[ 'e_name' ];

                            if( mb_strpos( $filter[ 'e_name' ], 'taxonomy_' ) === false ){
                                $taxonomy_e_name = 'taxonomy_' . $filter[ 'e_name' ];
                            }

                            if ( ! isset( $taxonomies[ $taxonomy_e_name ] ) ) {
                                $this->pushError( 402, $filterID, 'e_name' ); // Invalid E_name.
                                $valid = false;
                            }
                        } else {
                            // Should not be empty and should contain at least one alphabetic character
                            if ( ! $validator->validateAlphabCharsExists( $e_name ) ) {
                                $this->pushError( 40, $filterID, 'e_name' ); // Invalid E_name.
                                $valid = false;
                            }

                            // Should not contain characters that escaped by esc_attr
                            if ( ! $validator->validateEscAttrCharacters( $e_name ) ) {
                                $this->pushError( 40, $filterID, 'e_name' ); // Invalid E_name.
                                $valid = false;
                            }

                            // Some meta keys should be prohibited to use
                            $excludedMetaKeys = mysis_get_forbidden_meta_keys();
                            if ( in_array( $e_name, $excludedMetaKeys, true ) ) {
                                $this->pushError(  40, $filterID, 'e_name' ); // Invalid E_name.
                                $valid = false;
                            }
                        }
                    }
                }
            }

        }else{
            $this->pushError( 40, $filterID, 'e_name' ); // Invalid E_name.
            $valid = false;
        }

        /**
         * View validations
         */
        if( isset( $filter['view'] ) ){
            $viewOptions = array_keys( $this->getViewOptions() );

            if( ! $validator->validateView( $filter, $viewOptions ) ){
                $this->pushError( 41, $filterID, 'view' ); // Invalid View.
                $valid = false;
            }

        } else {
            $this->pushError( 41, $filterID, 'view' ); // Invalid View.
            $valid = false;
        }

        /**
         * Logic validations
         */
        if( isset( $filter['logic'] ) ){

            if( ! in_array( $filter['logic'], array( 'or', 'and' ), true ) ){
                $this->pushError( 42, $filterID, 'logic' ); // Invalid Logic.
                $valid = false;
            }

            // For author and post_meta_exists entities logic can be only OR
            if( in_array( $filter['entity'], array( 'author_author', 'post_meta_exists' ) )  ){
                if( $filter['logic'] !== 'or' ){
                    $this->pushError( 45, $filterID, 'logic' ); // Not acceptable logic.
                    $valid = false;
                }
            }

            // For author entity logic can be only OR
            if ( in_array( $filter['entity'], [ 'post_meta_num', 'tax_numeric' ] ) ) {
                if( $filter['logic'] !== 'and' ){
                    $this->pushError( 47, $filterID, 'logic' ); // Not acceptable logic.
                    $valid = false;
                }
            }

        } else {
            $this->pushError( 42, $filterID, 'logic' ); // Invalid Logic.
            $valid = false;
        }

        /**
         * Orderby validations
         */
        if( isset( $filter['orderby'] ) ){
            $orderBy = array_keys( $this->getOrderByOptions() );
            if( ! in_array( $filter['orderby'], $orderBy, true ) ){
                $this->pushError( 43, $filterID, 'orderby' ); // Invalid Orderby.
                $valid = false;
            }
        } else {
            $this->pushError( 43, $filterID, 'orderby' ); // Invalid Orderby.
            $valid = false;
        }

        /**
         * In path and Collapse doesn't require validations
         * because their values are prepended in code
         */

        /**
         * Exclude validations
         */
        if( isset( $filter['exclude'] ) && $validEntity ){
            if( ! $validator->validateExcludeTerms( $filter['exclude'], $filter ) ){
                $this->pushError( 44, $filterID, 'exclude' ); // Invalid Exclude.
                $valid = false;
            }
        }

        if( isset( $filter['include'] ) ){
            if( ! in_array( $filter['include'], ['yes', 'no'] ) ){
                $this->pushError( 441, $filterID, 'exclude' ); // Invalid Exclude.
                $valid = false;
            }
        }

        // In case when checkbox is not checked there is no $_POST['in_path'] parameter
        if( isset( $filter['in_path'] ) ){
            if( in_array( $filter['entity'], [ 'post_meta_num', 'tax_numeric' ] ) && $filter['in_path'] === 'yes' ){
                $this->pushError( 46, $filterID, 'in_path' ); // Invalid In Path for Post meta num.
                $valid = false;
            }
        }

        // Check data types if they are correct
        /**
         * @todo validate range_slider, show_chips, step fields !!! IMPORTANT
         */

        // Check combinations of different data
        /**
         * The unique slug and entity problem
         */
        // The slug and entity pair should be the same between all filters in all sets!
        // Otherwise we will have different slugs and URLs in different categories for the same Post type.
        // If user adding new slug for the same entity, it should be notified, that this new slug
        // will be changed for all same entities.

        // Obligatorily sanitize all data. Maybe separate method for that.
        // If entity is taxonomy, field e_name should be empty.

        // Filter slugs should not be from blacklist. Blacklist - typical Wordpress entities /categories, tags etc

        // Slugs should be checked for non UTF symbols and maybe converted to latin UTF symbols
        // Because user can add slug = категория and also user can add slug 'cheap' where 'c' will be cyrillic or other.

        return $valid;
    }

    public function validateFilters( $filters ) {

        if ( ! $filters ) {
            return false;
        }
        $valid = true;

        // Check permissions
        if ( ! current_user_can( 'manage_options' ) ) {
            // An error occurred. You do not have permissions to edit this.
            $this->pushError(202);
            $valid = false;
        }

        // Check for equal filters
        foreach ( (array) $filters as $filter ) {
            if( isset( $filter['entity'] ) && isset( $filter['e_name'] ) ) {
                // To avoid few filters with the same meta key
                if ( in_array( $filter['entity'], array( 'post_meta', 'post_meta_num', 'post_meta_exists' ), true ) ) {
                    $keys[] = 'post_meta' . $filter['e_name'];
                } elseif ( $filter['entity'] === 'tax_numeric' ) {
                    $keys[] = $filter['entity'] .'_'. $filter['e_name'];
                } else {
                    $keys[] = $filter['entity'] . $filter['e_name'];
                }
            }
        }

        if ( mysis_array_contains_duplicate( $keys ) ) {
            $this->pushError(31); // Equal filters
            $valid = false;
        }

        return apply_filters( 'mayosis_validate_filter_fields', $valid, $this );
    }

    public function ajaxValidateFilters()
    {
        $postData   = Container::instance()->getThePost();
        $data       = isset( $postData['validateData'] ) ? $postData['validateData'] : false;
        $response   = [];

        if( ! $data ){
            $this->pushError(20);
        }

        if( ! isset( $data['_mysis_nonce'] ) || ! wp_verify_nonce( $data['_mysis_nonce'], FilterSet::NONCE_ACTION ) ){
            $this->pushError(20); // Default common error
        }

        // Validate all filters
        // If no one filter it's ok
        if( isset( $data['mayosis_filter_fields'] ) ){

            $this->validateFilters( $data['mayosis_filter_fields'] );

            // Set up checkbox fields if they are empty
            $filterConfiguredFields = $this->getFieldsMapping();

            // Validate each filter separately
            foreach ( (array) $data['mayosis_filter_fields'] as $filterId => $filter ) {
                $filter = $this->prepareFilterCheckboxFields($filter, $this->getFieldsByType('checkbox', $filterConfiguredFields));
                $this->validateTheFilter( $filter, $filterId );
            }

        }


        $this->fillErrorsMessages();
        $errors = $this->getErrors();
        // Send errors if they exist
        if( $errors && ! empty( $errors ) ){
            $response['errors'] = $errors;
            wp_send_json_error($response);
        }

        /**
         * @feature it is better to validate all fields and collect all errors to show them simultaneously.
         */

        wp_send_json_success();
    }

    function saveFilter( $filter ) {
        // May have been posted. Remove slashes.
        $filter = wp_unslash( $filter );

        $filter = apply_filters( 'mayosis_pre_save_filter', $filter );

        unset( $filter['instead-entity'] );
        // Make a backup of field data and remove some args.
        $_filter = $filter;
        mysis_extract_vars( $_filter, array( 'ID', 'label', 'parent', 'menu_order', 'slug' ) );

        $_filter = $this->fse->splitEntityFullNameInFilter( $_filter );

        // Create array of data to save.
        $to_save = array(
            'ID'			=> $filter['ID'],
            'post_status'	=> 'publish',
            'post_type'		=> MYSIS_FILTERS_POST_TYPE,
            'post_title'	=> $filter['label'],
            'post_content'	=> maybe_serialize( $_filter ),
            'post_parent'	=> $filter['parent'],
            'menu_order'	=> $filter['menu_order'] ? $filter['menu_order'] : 0,
            'post_name'     => $filter['slug'],
            'post_excerpt'  => $filter['entity']
        );

        // Unhook wp_targeted_link_rel() filter from WP 5.1 corrupting serialized data.
        remove_filter( 'content_save_pre', 'wp_targeted_link_rel' );

        do_action( 'mayosis_pre_save_post_filter', $to_save, $filter );

        add_filter( 'pre_wp_unique_post_slug', 'mysis_force_non_unique_slug', 10, 2 );

        // Slash data.
        // WP expects all data to be slashed and will unslash it (fixes '\' character issues).
        $to_save = wp_slash( $to_save );

        // Update or Insert.
        if( $filter['ID'] === self::MYSIS_NEW_FILTER_ID ){
            $filter['ID'] = wp_insert_post( $to_save );
        }else{
            wp_update_post( $to_save );
        }

        remove_filter( 'pre_wp_unique_post_slug', 'mysis_force_non_unique_slug', 10 );

        // Return field.
        return $filter;
    }

    public function prepareFilterCheckboxFields( $filter, $configuredFields = [] )
    {
        foreach ( $configuredFields as $key => $checkbox ){
            if( ! isset( $filter[ $key ] ) ){
                $filter[ $key ] = 'no';
            }else{
                $filter[ $key ] = 'yes';
            }
        }

        return $filter;
    }

    public function getFieldsMapping()
    {
        return $this->defaultFields;
    }

    public function deleteFilter( $ID, $force = false )
    {
        if( ! $ID ){
            return false;
        }

        if( $force ){
            return wp_delete_post( $ID, true );
        }else{
            return wp_trash_post( $ID );
        }

    }

    public function deleteRelatedFilters( $postid, $post )
    {
        if( $post->post_type !== MYSIS_FILTERS_SET_POST_TYPE ){
            return $postid;
        }

        $args = array(
            'post_type'         => MYSIS_FILTERS_POST_TYPE,
            'posts_per_page'    => -1,
            'post_parent'       => $postid,
            'post_status'		=> array('any'),
        );

        $setFilters = get_posts( $args );

        if( ! empty( $setFilters ) ){
            foreach ( $setFilters as $filter ) {
                $this->deleteFilter( $filter->ID, true );
            }
        }

        return $postid;
    }

    public function ajaxDeleteFilter()
    {
        $postData   = Container::instance()->getThePost();
        $filterId   = isset( $postData['fid'] ) ? $postData['fid'] : false;
        if( $filterId === self::MYSIS_NEW_FILTER_ID ){
            wp_send_json_success();
        }

        $nonce          = isset( $postData['_wpnonce'] ) ? $postData['_wpnonce'] : false;
        $errorResponse  = array(
            'fid' => $filterId,
            'message' => esc_html__('An error occured. Please, refresh the page and try again.', 'mayosis-filter')
        );

        if( ! wp_verify_nonce( $nonce, FilterSet::NONCE_ACTION ) ){
            wp_send_json_error( $errorResponse );
        }

        if( ! $filterId ){
            wp_send_json_error( $errorResponse );
        }

        $filter = get_post( $filterId );

        if( ! isset( $filter->post_type ) || ( $filter->post_type !== MYSIS_FILTERS_POST_TYPE ) ){
            wp_send_json_error( $errorResponse );
        }

        if( $filterPost = $this->deleteFilter( $filterId, true ) ){
            $response['fid'] = $filterPost->ID;
            wp_send_json_success( $response );
        }else{
            wp_send_json_error( $errorResponse );
        }
    }

    public function sendExcludedTerms()
    {
        $container  = Container::instance();
        $postData   = $container->getThePost();
        $validator  = new Validator();
        $filterId   = isset( $postData['fid'] ) ? $postData['fid'] : false;
        $nonce      = isset( $postData['_wpnonce'] ) ? $postData['_wpnonce'] : false;
        $entity     = isset( $postData['entity'] ) ? $postData['entity'] : false;
        $e_name     = isset( $postData['ename'] ) ? $postData['ename'] : false;

        $errorResponse  = array(
            'fid' => $filterId,
            'message' => esc_html__('An error occured. Please, refresh the page and try again.', 'mayosis-filter')
        );

        if( ! wp_verify_nonce( $nonce, FilterSet::NONCE_ACTION ) ){
            wp_send_json_error( $errorResponse );
        }

        if( ! $validator->validatePossibleEntity( $entity ) ){
            wp_send_json_error( $errorResponse );
        }

        $em = $container->getEntityManager();
        if( $e_name ){
            $filterEntity['entity'] = $entity;
            $filterEntity['e_name'] = $e_name;
        }else{
            $fse = $container->getFilterService();
            $filterEntity = $fse->splitEntityFullNameInFilter( array( 'entity' => $entity ) );
        }

        $entity = $em->getEntityByFilter( $filterEntity );
        $terms  = $entity->getTermsForSelect2();

        if( ! empty( $terms ) ){
            $response['terms']  = $terms;
            $response['fid']    = $filterId;
            wp_send_json_success( $response );
        }else{
            wp_send_json_error( $errorResponse );
        }

    }

    public function addSpinnerToSelect( $html, $attributes )
    {
        if( isset( $attributes['class'] ) ){
            $requiredIds = array(
                $this->generateInputID( self::MYSIS_NEW_FILTER_ID, 'exclude' ),
            );

            if( in_array( $attributes['id'], $requiredIds ) ){

                $spinner        = '<span class="spinner"></span>'."\r\n";
                $openContainer  = '<div class="mayosis-after-spinner-container">'."\r\n";

                $closeContainer = '</div>'."\r\n";

                $html = $spinner . $openContainer . $html . $closeContainer;

            }
        }
        return $html;
    }

    private function getInsteadEntityField( $filterId, $insteadEntityVal )
    {
        $insteadEntity = array(
            'type'          => 'Text',
            'label'         => esc_html__( 'Filter by', 'mayosis-filter' ),
            'class'         => 'mayosis-field-instead-entity',
            'name'          => $this->generateInputName( $filterId, 'instead-entity' ),
            'id'            => $this->generateInputID( $filterId, 'instead-entity' ),
            'value'         => $insteadEntityVal,
            'readonly'      => 'readonly',
            'default'       => '',
            'instructions'  => esc_html__( 'A thing by which posts will be filtered', 'mayosis-filter'),
            'tooltip'       => esc_html__( 'An already selected value cannot be changed. But you always can delete the current one and create new filter if you need.', 'mayosis-filter' ),
            'required'      => true
        );

        return $insteadEntity;
    }


    /**
     * @return true|false
     */
    public function filterBelongsToPostType( $parent, $entity, $e_name )
    {
        if( ! isset( $parent ) ){
            return false;
        }

        $fss  = Container::instance()->getFilterSetService();
        $set =  $fss->getSet( $parent );

        if( ! isset( $set['post_type']['value'] ) ){
            return false;
        }

        $post_type = $set['post_type']['value'];

        return $this->entityBelongsToPostType( $post_type, $entity, $e_name );
    }

    /**
     * @return true|false
     */
    private function entityBelongsToPostType( $post_type, $entity, $e_name )
    {
        if ( empty( $post_type ) ){
            return false;
        }

        if( in_array( $entity, array(
            'author',
            'date',
            'post_meta',
            'post_meta_num',
            ) ) ){
            return true;
        }

        if( in_array( $entity, array( 'post_meta_exists', 'tax_numeric' ) ) && defined( 'MYSIS_FILTERS_PRO' ) ){
            return true;
        }

        if( $entity === 'taxonomy' || $entity === 'tax_numeric' ){
            if ( $entity === 'tax_numeric' ) {
                if ( ! defined( 'MYSIS_FILTERS_PRO' ) ) {
                    return false;
                }
                // We have to cut e_name to make correct verification
                if ( mb_strpos( $e_name, 'taxonomy_' ) !== false ) {
                    $e_name = mb_strcut( $e_name, strlen( 'taxonomy_' ) );
                }
            }

            return $this->isTaxonomyBelongsToPostType( $post_type, $e_name );
        }

        return false;
    }

    public function getErrorMessage( $code = 20 )
    {
        $messages = $this->getErrorsList();

        if( isset( $messages[$code] ) ){
            return $messages[$code];
        }

        return $messages[20];
    }

    public function pushError( $errorCode, $filterId = false, $filterKey = '' )
    {
        $to_add = true;
        $error  = array(
            'code' => $errorCode
        );

        if( $filterId && $filterKey ){
            $error['id'] = $this->generateInputID( $filterId, $filterKey );
        }

        if ( ! empty( $this->errors ) ) {
            foreach ( $this->errors as $single_error ) {
                if ( isset( $single_error['code'] ) && $single_error['code'] == $errorCode ) {
                    $to_add = false;
                    break;
                }
            }
        }

        if ( $to_add ) {
            $this->errors[] = $error;
            return $error;
        }

        return false;
    }

    public function getErrors()
    {
        if( ! empty( $this->errors ) ) {
            return $this->errors;
        }

        return false;
    }

    public function fillErrorsMessages()
    {
        if( ! empty( $this->errors ) ){
            $errorsWithMessages = [];
            $messagesList = $this->getErrorsList();

            foreach ( $this->errors as $index => $error ){
                if( isset( $error['code'] ) && isset( $messagesList[ $error['code'] ] ) ){
                    $errorsWithMessages[$index] = $error;
                    $errorsWithMessages[$index]['message'] =  $messagesList[ $error['code'] ];
                }
            }

            $this->errors = $errorsWithMessages;
            return true;
        }

        return false;
    }

    public function getErrorCodes()
    {
        $codes = [];

        if( ! empty( $this->errors ) ){
            foreach( $this->errors as $error ){
                $codes[] = $error['code'];
            }
        }

        return $codes;
    }


    /**
     * @return true|false
     */
    private function isTaxonomyBelongsToPostType( $post_type, $taxonomy = null )
    {
        if ( is_object( $post_type ) )
            $post_type = $post_type->post_type;

        if ( empty( $post_type ) ){
            return false;
        }

        $taxonomies = get_object_taxonomies( $post_type );

        return in_array( $taxonomy, $taxonomies );
    }

    public function generateInputID( $ID, $key )
    {
        return self::FILTER_FIELD_KEY . '-' . $ID . '-' . $key;
    }

    public function generateInputName( $ID, $key, $multiple = false )
    {
        $name = self::FILTER_FIELD_KEY . '['. $ID .']['. $key . ']';
        if( $multiple ){
            $name .= '[]';
        }
        return $name;
    }

    public static function getErrorsList()
    {
        $errors = array(
            // Set errors
            20 => esc_html__('An error occurred. Set fields were not saved, please try again.', 'mayosis-filter'),
            201 => esc_html__('An error occurred. Rule fields were not saved, please try again.', 'mayosis-filter'),
            202 => esc_html__('An error occurred. You do not have permissions to edit this.', 'mayosis-filter'),
            211 => esc_html__( 'Error: invalid WP Page type.', 'mayosis-filter' ),
            21 => esc_html__( 'Error: invalid post type.', 'mayosis-filter' ),
            22 => esc_html__( 'Error: invalid value of the Where to filter? field.', 'mayosis-filter' ),
            221 => esc_html__( 'Error: invalid query.', 'mayosis-filter' ),
            23 => esc_html__( 'Error: invalid Hide empty field.', 'mayosis-filter' ),
            24 => esc_html__( 'Error: invalid Show count field.', 'mayosis-filter' ),
            242 => esc_html__( 'Error: invalid Apply Button mode field.', 'mayosis-filter' ),
//            241 => esc_html__( 'Error: invalid Order field.', 'mayosis-filter' ),
            // Filters errors
            31 => esc_html__( 'Error: two or more filters with equal Filter By and Meta key values are forbidden in the same Set. Please, remove or change equal filters.', 'mayosis-filter' ),
            32 => esc_html__( 'Error: invalid fields present.', 'mayosis-filter' ),
            33 => esc_html__( 'Error: invalid filter ID.', 'mayosis-filter' ),
            34 => esc_html__( 'Error: invalid set ID.', 'mayosis-filter' ),
            35 => esc_html__( 'Error: invalid filter entity.', 'mayosis-filter' ),
            36 => esc_html__( 'Error: filter prefix is already used for another entity.', 'mayosis-filter' ),
            37 => esc_html__( 'Error: filter prefix should has at least one alphabetic symbol.', 'mayosis-filter' ),
            38 => esc_html__( 'Error: filter prefix should not be empty.', 'mayosis-filter' ),
            39 => esc_html__( 'Error: prefix part before "-" character can not be equal with other existing prefix.', 'mayosis-filter' ),
            399 => esc_html__( 'Error: this prefix is not allowed because it matches a taxonomy or term name already in use on your site. Please use a different prefix.', 'mayosis-filter' ),
            3991 => esc_html__( 'Error: var name is not allowed because it matches a taxonomy or term name already in use on your site.', 'mayosis-filter' ),
            40 => esc_html__( 'Error: invalid Meta key value', 'mayosis-filter' ),
            401 => esc_html__( 'Error: you must enter Meta Key', 'mayosis-filter' ),
            402 => esc_html__( 'Error: invalid Taxonomy', 'mayosis-filter' ),
            41 => esc_html__( 'Error: invalid View parameter.', 'mayosis-filter' ),
            42 => esc_html__( 'Error: invalid Logic parameter', 'mayosis-filter' ),
            43 => esc_html__( 'Error: invalid Orderby parameter', 'mayosis-filter' ),
            44 => esc_html__( 'Error: invalid exclude terms', 'mayosis-filter' ),
            441 => esc_html__( 'Error: invalid include checkbox value', 'mayosis-filter' ),
            45 => esc_html__( 'Error: for filter Post Author logic OR is acceptable only.', 'mayosis-filter' ),
            46 => esc_html__( 'Error: numeric filter can not be in URL path.', 'mayosis-filter' ),
            47 => esc_html__( 'Error: only AND logic is supported for numeric filters.', 'mayosis-filter' ),
            48 => esc_html__( 'Error: Range slider is acceptable for Post Meta Num filters only.', 'mayosis-filter' ),
            50 => esc_html__( 'Error: SEO Rule must have specified Post Type.', 'mayosis-filter' ),
            51 => esc_html__( 'Error: SEO Rule must contain at least one filter.', 'mayosis-filter' ),
            52 => esc_html__( 'Error: all SEO data fields could not be empty.', 'mayosis-filter' ),
            53 => esc_html__( 'Error: invalid or forbidden filter presents.', 'mayosis-filter' ),
            54 => esc_html__( 'Error: invalid SEO Rule ID.', 'mayosis-filter' ),
            55 => esc_html__( 'Error: SEO rule with selected Filters Combination already exists.', 'mayosis-filter' ),
            90 => wp_kses(
                sprintf(
                    __('Error: you can not update settings because Mayosis Filter Pro plugin is locked. Please, enter your <a href="%1$s" target="_blank">license key</a> to unlock it.', 'mayosis-filter' ),
                    admin_url( 'edit.php?post_type=mayosis-filter&page=filters-settings&tab=license' ) ),
                array(
                    'a' => array(
                        'href'=> true,
                        'target' => true
                    )
                )
            )
        );

        return $errors;
    }
}