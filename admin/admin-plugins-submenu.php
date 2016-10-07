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
    
    /**
     * Build a new WP Submenu page with the passed in arguments
     * @since   1.3.1
     * @var     array   $args       The arguments used to create the submenu page
     */
    public function __construct( $args ) {
        // Create the MAIN Menu (if it doesn't exist)
        $this->jkl_general_menu();
        
        // Add a submenu Page to the Main Menu
        $this->settings = add_submenu_page(
                $args[ 'parent_slug' ],
                $args[ 'page_title' ],
                $args[ 'menu_title' ],
                $args[ 'capability' ],
                $args[ 'menu_slug' ],
                $args[ 'callback' ]
        );
        
        // Submenu Page content (view)
        $this->add_menu_items();
        // add_action( 'load-' . $this->settings, array( $this, 'jklpc_add_tabs' ) );
    }
    
    public function jkl_general_menu() {
        global $menu, $jkl_general_menu_exist;
        
        if( ! $jkl_general_menu_exist ) {
            // check also menu exists in global array as in old plugins 
            // custom code here we probably don't need
            add_menu_page(
                    __( 'JKL Plugins MAIN', 'jkl-reviews' ),    // $page_title
                    __( 'JKL Plugins', 'jkl-reviews' ),         // $menu_title
                    'manage_options',                           // $capability
                    'jkl-plugins-main-menu',                    // $menu_slug
                    'jkl_plugins_main_page',                    // $function
                    'dashicons-admin-plugins'                   // $icon
            );
            // add_submenu_page();
            
            $jkl_general_menu_exist = true;
        }
    } // END jkl_general_menu()
    
    public function add_menu_items() {
        
    } // END add_menu_items()
    
} // END class JKL_Plugins_Admin_Submenu

} // END if ( ! class_exists() )
