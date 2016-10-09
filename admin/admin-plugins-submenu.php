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
     * Submenu Settings
     * @since   1.3.1
     * @var     array   $settings   The array of settings for this admin subpage   
     */
    protected $settings;
    
    /**
     * Admin Menu
     * @since   1.3.1
     * @var     array   $admin_menu The array containing the MAIN JKL Plugins Admin menu   
     */
    protected $admin_menu;
    
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
    
    /**
     * Function to create the MAIN WordPress menu for JKL Plugins
     * @since   1.3.1
     */
    public function jkl_general_menu() {
        $this->admin_menu = JKL_Plugins_Admin_Menu::get_instance();
    } // END jkl_general_menu()
    
    public function add_menu_items() {
        
    } // END add_menu_items()
    
} // END class JKL_Plugins_Admin_Submenu

} // END if ( ! class_exists() )
