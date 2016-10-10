<?php
/**
 * The main plugin class that handles all other plugin parts.
 * 
 * Defines the plugin name, version, and hooks for enqueuing the stylesheet and JavaScript files
 * 
 * @package     JKL_Pricing_Tables
 * @subpackage  JKL_Pricing_Tables/inc
 * @author      Aaron Snowberger <jekkilekki@gmail.com>
 */

/* Prevent direct access */
if ( ! defined( 'ABSPATH' ) ) exit;
if ( ! class_exists( 'JKL_Pricing_Tables' ) ) {
    
    class JKL_Pricing_Tables {
        
        /**
         * The ID of this plugin.
         * 
         * @since   1.3.0
         * @access  private
         * @var     string  $name       The ID of this plugin.
         */
        private $name;
        
        /**
         * Current version of the plugin.
         * 
         * @since   1.3.0
         * @access  private
         * @var     string  $version    The current version of this plugin.
         */
        private $version;
        
        /**
         * Shortcode
         * 
         * @since   1.3.0
         * @access  private
         * @var     JKL_Pricing_Tables_Shortcode    $shortcode  A reference to the shortcode.
         */
        private $shortcode;
        
        /**
         * WordPress Options Menu Page
         * 
         * @since 1.3.1
         * @access private
         * @var     JKL_Plugins_Admin_Submenu        $options_page   A reference to the options page.
         */
        private $options_page;
        
        /**
         * CONSTRUCTOR !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
         * Initializes the JKL_Pricing_Tables object and sets its properties
         * 
         * @since   1.3.0
         * @var     string  $name       The name of this plugin.
         * @var     string  $version    The version of this plugin.
         */
        public function __construct( $name, $version ) {
            
            // Set the name and version number
            $this->name     = $name;
            $this->version  = $version;
            
            // Load the plugin and supplementary files
            $this->load();
            
            // Create the shortcode
            $this->make_shortcode();
            
        }
        
        /**
         * Loads translation directory
         * Adds the call to enqueue styles and scripts
         * 
         * @since   1.3.0
         */
        protected function load() {
            
            load_plugin_textdomain( 'jkl-pricing-tables', false, basename( dirname( __FILE__ ) ) . '/languages/' );
            add_action( 'admin_menu', array( $this, 'jklpt_admin_menu' ) );
            add_action( 'wp_enqueue_scripts', array( $this, 'jklpt_scripts_styles' ) );
            
        }
        
        /**
         * Creates the Shortcode
         * 
         * @since   1.3.0
         * @return  object  $shortcode  The Shortcode
         */
        protected function make_shortcode() {
            
            //if ( is_null( $this->shortcode ) ) {
                $this->shortcode = new JKL_Pricing_Tables_Shortcode();
            //}
            return $this->shortcode;
            
        }
        
        /**
         * Creates the Admin Menu Page for this plugin
         * 
         * @since   1.3.1
         * @return  object  $options_page   The WP Options Page
         */
        public function jklpt_admin_menu() {
            $args = array(
                'parent_slug'   => 'jkl_panel',
                'page_title'    => __( 'JKL Pricing Tables', 'jkl-pricing-tables' ),
                'menu_title'    => __( 'Pricing Tables', 'jkl-pricing-tables' ),
                'capability'    => 'manage_options',
                'menu_slug'     => 'jklpt_settings',
                'callback'      => 'jkl_plugin_settings'
            );
            $this->options_page = new JKL_Plugins_Admin_Submenu( $args );
            //return $this->options_page; // A moot point?
        }
        
        /**
         * Enqueues Styles and Scripts
         * 
         * @since   1.3.0
         */
        public function jklpt_scripts_styles() {
            
            // Selectively load styles and scripts only when the shortcode is active on a page
            global $post;
            if( has_shortcode( $post->post_content, 'jkl-pricing-table' ) || has_shortcode( $post->post_content, 'jkl-pricing-tables' ) ) {

                wp_enqueue_style( 'jklpt_style', plugins_url( '../css/pricing-tables.css', __FILE__ ) );
                wp_enqueue_script( 'jklpt_add_classes', plugins_url( '../js/pricing-tables.js', __FILE__ ), array( 'jquery' ), '20160422', true );

            }
            
        }
        
    } // END class JKL_Pricing_Tables
    
} // END if ( ! class_exists() )