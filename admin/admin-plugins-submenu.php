<?php
if ( ! defined( 'ABSPATH' ) ) exit;
if ( ! class_exists( 'JKL_Plugins_Admin_Submenu' ) ) {
    
/** 
 * JKL Plugins Admin
 * 
 * Creates a Main Menu if none exists
 * 
 * @author  Aaron Snowberger
 * @since   1.3.1
 */
    
class JKL_Plugins_Admin_Submenu {

    /**
     * Settings
     * @since   1.3.1
     * @var     array   $settings   The array of settings for this admin subpage   
     */
    protected $settings;
    
    public function __construct( $args ) {
        jkl_general_menu();
        $this->settings = add_submenu_page(
                $args[ 'parent_slug' ],
                $args[ 'page_title' ],
                $args[ 'menu_title' ],
                $args[ 'capability' ],
                $args[ 'menu_slug' ],
                $args[ 'callback' ]
        );
        // $this->add_menu_items();
        add_action( 'load-' . $this->settings, array( $this, 'jklpc_add_tabs' ) );
    }
    
} // END class JKL_Plugins_Admin_Submenu

} // END if ( ! class_exists() )