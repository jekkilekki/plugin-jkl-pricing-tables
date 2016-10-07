<?php
if ( ! defined( 'ABSPATH' ) ) exit;
if ( ! class_exists( 'JKL_Plugins_Admin' ) ) {
    
/** 
 * JKL Plugins Admin
 * 
 * Creates a Main Menu if none exists
 * 
 * @author Aaron Snowberger
 */
    
if( ! function_exists( 'jkl_general_menu' ) ) {
    function jkl_general_menu() {
        global $menu, $jkl_general_menu_exist;
        
        if( ! $jkl_general_menu_exist ) {
            // check also menu exists in global array as in old plugins 
            // custom code here we probably don't need
            add_menu_page(
                    __( 'JKL Plugins MAIN', 'jkl-reviews' ),    // $page_title
                    __( 'JKL Plugins', 'jkl-reviews' ),         // $menu_title
                    'manage_options',                           // $capability
                    'jkl-plugins-main-menu',                    // $menu_slug
                    'jkl_plugins_main_page',    // $function
                    'dashicons-admin-plugins'                   // $icon
            );
            // add_submenu_page();
            
            $jkl_general_menu_exist = true;
        }
    }
}

class JKL_Plugins_Admin {

    /**
     * CONSTRUCTOR !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
     */
    public function __construct() {

        // add_action( 'admin_menu', array( &$this, 'jkl_general_menu' ) );
        
    } // END __construct()
    
    /**
     * ADD MAIN PLUGIN MENU ----------------------------------------------------
     */
    public function jkl_add_plugins_menu() {

        /**
         * Create a top-level menu item
         */
        if ( empty ( $GLOBALS[ 'admin_page_hooks' ][ 'jkl-plugins-main-menu' ] ) ) 
            add_menu_page(
                    __( 'JKL Plugins MAIN', 'jkl-reviews' ),     // $page_title
                    __( 'JKL Plugins', 'jkl-reviews' ),     // $menu_title
                    'manage_options',                       // $capability
                    'jkl-plugins-main-menu',                // $menu_slug
                    array( $this, 'jkl_plugins_main_page' ),                // $function
                    'dashicons-admin-plugins'               // $icon
            );
         
    }
    
    /**
     * MAIN PLUGIN PAGE --------------------------------------------------------
     */
    public function jkl_plugins_main_page() { ?>
        
        <div class="jkl-wrap">
            <div class="header">
                <nav role="navigation" class="header-nav drawer-nav nav-horizontal">
                    <ul class="main-nav">
                        <li class="jkl-logo">
                            <a href="#" title="JKL Plugins" class="current">
                                <span>JKL Plugins</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="wrapper">
                <div class="background"></div>
                <div class="page-content landing">
                    <div class="jkl-content">
                        <h1 title="Just Keep Learning (JKL) Plugins">Just Keep Learning (JKL) Plugins</h1>
                        <p class="jkl-intro">Just Keep Learning. Never stop learning.</p>
                        <div class="row">
                            <div class="col">
                                Something
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php   
    }
    
} // END JKL_Plugins_Admin
} // END if ( ! class_exists( 'JKL_Plugins_Admin' )