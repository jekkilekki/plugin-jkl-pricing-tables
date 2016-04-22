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
            
            // Create the shortcode
            $this->make_shortcode();
            
            // Load the plugin and supplementary files
            $this->load();
            
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
         * Loads translation directory
         * Adds the call to enqueue styles and scripts
         * 
         * @since   1.3.0
         */
        protected function load() {
            
            load_plugin_textdomain( 'jkl-pricing-tables', false, basename( dirname( __FILE__ ) ) . '/languages/' );
            add_action( 'wp_enqueue_scripts', array( $this, 'jkl_pt_scripts_styles' ) );
            
        }
        
        /**
         * Enqueues Styles and Scripts
         * 
         * @since   1.3.0
         */
        public function jkl_pt_scripts_styles() {
            
            // Selectively load styles and scripts only when the shortcode is active on a page
            global $post;
            if( has_shortcode( $post->post_content, 'jkl-pricing-table' ) || has_shortcode( $post->post_content, 'jkl-pricing-tables' ) ) {

                wp_enqueue_style( 'jklpt_style', plugins_url( '../css/pricing-tables.css', __FILE__ ) );
                wp_enqueue_script( 'jklpt_add_classes', plugins_url( '../js/pricing-tables.js', __FILE__ ), array( 'jquery' ), '20160422', true );

            }
            
        }
        
    } // END class JKL_Pricing_Tables
    
} // END if ( ! class_exists() )