<?php
if ( ! defined( 'ABSPATH' ) ) exit;
if ( ! class_exists( 'JKL_Plugins_Admin_Menu' ) ) {
    
/** 
 * JKL Plugins Admin
 * 
 * Creates a Main Menu if none exists
 * 
 * @author Aaron Snowberger
 */
    

class JKL_Plugins_Admin_Menu {
    
    private static $_instance = null;

    /**
     * CONSTRUCTOR !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
     */
    public function __construct() {
        
        $this->jkl_add_plugins_menu();
        
    } // END __construct()
    
    public static function get_instance() {
        if( ! self::$_instance ) {
            self::$_instance = new JKL_Plugins_Admin_Menu();
        }
        return self::$_instance;
    }
    
    /**
     * ADD MAIN PLUGIN MENU ----------------------------------------------------
     */
    public function jkl_add_plugins_menu() {

        /**
         * Create a top-level menu item
         */
        add_menu_page(
                __( 'JKL Plugins MAIN', 'jkl-reviews' ),    // $page_title
                __( 'JKL Plugins', 'jkl-reviews' ),         // $menu_title
                'manage_options',                           // $capability
                'jkl-plugins-admin',                        // $menu_slug
                array( $this, 'jkl_plugins_admin_render' ), // $function
                'dashicons-admin-plugins'                   // $icon
        );
        add_action( 'admin_enqueue_scripts', array( $this, 'jkl_plugins_admin_scripts' ) );
         
    }
    
    /**
     * MAIN PLUGIN PAGE --------------------------------------------------------
     */
    public function jkl_plugins_admin_render() { 
        include_once( 'admin-plugins-view.php' );
    }
    
    public function jkl_plugins_admin_scripts() {
        wp_enqueue_style( 'jkl_admin_menu_style', plugins_url( '/css/admin.css', __FILE__ ) );
    }
    
} // END JKL_Plugins_Admin
} // END if ( ! class_exists( 'JKL_Plugins_Admin' )