<?php
namespace Elementor;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/*--------------------------
*   Class Iconic Icon Manager
* -------------------------*/
class mayosis_zero_icon_Manager{

    private static $instance = null;

    public static function instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    function __construct(){
        $this->init();
    }

    public function init() {

        // Custom icon filter
        add_filter( 'elementor/icons_manager/additional_tabs', [ $this,'mayosis_zero_icon'] );  

    }

	public function mayosis_zero_icon( $zero_icons_args = array() ) {

	    // Append new icons
	    $zero_icons = array(
			'home',
			'search',
			'cart',
			'cart-ii',
			'download',
			'upload',
			'settings',
			'link',
			'share',
			'eye',
			'map-pin',
			'globe',
			'pencil',
			'edit',
			'edit-ii',
			'lock',
			'tag',
			'timer',
			'bars',
			'grid',
			'cube',
			'heart',
			'heart-alt',
			'envelope',
			'archive',
			'star',
			'star-alt',
			'fire',
			'plus',
			'plus-ii',
			'minus',
			'minus-ii',
			'quote-left',
			'quote-left-alt',
			'quote-right',
			'quote-right-alt',
			'external-link',
			'external-link-ii',
			'comment',
			'user',
			'check',
			'check-ii',
			'check-ii-alt',
			'check-iii-alt',
			'cross',
			'cross-ii',
			'cross-ii-alt',
			'circle',
			'circle-alt',
			'square',
			'square-alt',
			'sign-in',
			'sign-out',
			'phone',
			'folder',
			'support',
			'layers',
			'clock',
			'circle-dot',
			'arrow-up',
			'arrow-right',
			'arrow-down',
			'arrow-left',
			'chevron-up',
			'chevron-right',
			'chevron-down',
			'chevron-left',
			'sign-in',
			'sign-in',
			'sign-in',
			'sign-in',
	    );
	    
	    $zero_icons_args['mayosis_zero_icon_box'] = array(
	        'name'          => 'mayosis_zero_icon_box',
	        'label'         => esc_html__( 'Zero Icons', 'skb_cife' ),
	        'labelIcon'     => 'zil zi-pencil',
	        'prefix'        => 'zi-',
	        'displayPrefix' => 'zil',
	        'url'           => MAYOSIS_PL_ASSETS . 'css/zero-icon-line.css',
	        'icons'         => $zero_icons,
	        'ver'           => 1,
	    );

	    return $zero_icons_args;
	}



}
mayosis_zero_icon_Manager::instance();