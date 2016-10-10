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
        $this->admin_menu = JKL_Plugins_Admin_Menu::get_instance();

        // Add a submenu Page to the Main Menu
        $this->settings = add_submenu_page(
                $args[ 'parent_slug' ],
                $args[ 'page_title' ],
                $args[ 'menu_title' ],
                $args[ 'capability' ],
                $args[ 'menu_slug' ],
                array( $this, $args[ 'callback' ] )
        );
        // echo "Hello eburybody!~";
        // Submenu Page content (view)
        // $this->add_menu_items();
        // add_action( 'load-' . $this->settings, array( $this, 'jklpt_add_tabs' ) );
    }
    
    public function add_menu_items() {
        
    } // END add_menu_items()
    
    public function jklpt_add_tabs() {
        echo "Hello eburybody!~";
    }
    
    public function jklpt_settings_page() {
        include_once( '../views/view-jkl-pricing-table-options.php' );
    }
    
} // END class JKL_Plugins_Admin_Submenu

} // END if ( ! class_exists() )
