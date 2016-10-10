<?php
/**
 * The class that creates the plugin Shortcode.
 * 
 * Sets up the shortcode and its attributes
 * 
 * @since       1.3.0
 * @package     JKL_Pricing_Tables
 * @subpackage  JKL_Pricing_Tables/inc
 * @author      Aaron Snowberger <jekkilekki@gmail.com>
 */

/* Prevent direct access */
if ( ! defined( 'ABSPATH' ) ) exit;
if ( ! class_exists( 'JKL_Timezones_Shortcode' ) ) {
    
    class JKL_Pricing_Tables_Shortcode {
        
        /**
         * The number of instances of this plugin on a single post/page.
         * 
         * @since   1.3.0
         * @access  protected
         * @var     string  $count      The number of shortcodes on a page.
         */
        protected $count;
        
        /**
         * Builds the shortcode object
         * 
         * @since   1.3.0
         */
        public function __construct() {
            
            $this->count = 1;
            $this->register();
            
        }
        
        /**
         * Registers the shortcode with WordPress
         * 
         * @since   1.3.0
         */
        protected function register() {
            add_shortcode( 'jkl-pricing-table', array( $this, 'jkl_pricing_table_make_shortcode' ) );
            add_shortcode( 'jkl-pricing-tables', array( $this, 'jkl_pricing_tables_make_shortcode' ) );
        }
        
        /**
         * SINGULAR Version of the shortcode
         * Creates the front-end portion of the shortcode
         * 
         * Only allows ONE instance of the shortcode per page (include_once)
         * 
         * @since   1.3.0
         * @global  post    $post   A reference to the current WordPress Post
         */
        public function jkl_pricing_table_make_shortcode( $atts, $content = "" ) {
            
            // Set Default attributes
            $pricing_atts = shortcode_atts( array( 
                // If we want to set any attributes later
            ), $atts );
            
            $output = '<div id="pricing-tables-' . $this->count++ . '" class="pricing-tables">';
            $output .= $content . '</div><div class="clear"></div>';
            return $output;
            
        }
        
        /**
         * PLURAL Version of the shortcode (handles the situation a user types "s" on the end)
         * Creates the front-end portion of the shortcode
         * 
         * Only allows ONE instance of the shortcode per page (include_once)
         * 
         * @since   1.3.0
         * @global  post    $post   A reference to the current WordPress Post
         */
        public function jkl_pricing_tables_make_shortcode( $atts, $content = "" ) {
            
            // Set Default attributes
            $pricing_atts = shortcode_atts( array( 
                // If we want to set any attributes later
            ), $atts );
            
            $output = '<div id="pricing-tables-' . $this->count++ . '" class="pricing-tables">';
            $output .= $content . '</div><div class="clear"></div>';
            return $output;
            
        }
        
    } // END class JKL_Pricing_Tables_Shortcode
    
} // END if ( ! class_exists() )

