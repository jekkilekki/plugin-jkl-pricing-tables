<?php
/**
 * Plugin Name: JKL Pricing Tables
 * Plugin URI: https://github.com/jekkilekki/plugin-jkl-pricing-tables
 * Description: A simple plugin to add pricing tables to your website using only unordered lists inside a shortcode.
 * Version: 1.2.0
 * Author: Aaron Snowberger <jekkilekki@gmail.com>
 * Author URI: http://www.aaronsnowberger.com
 * Text Domain: jkl-pricing-tables/languages
 * License: GPL2
 */

/**  
    Copyright 2015-2016  Aaron Snowberger <jekkilekki@gmail.com>

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

function jkl_pricing_table( $attr, $content = "" ) {
    /* Add CSS */
    wp_register_style( 'jklpt_style', plugin_dir_url( __FILE__ ) . '/css/pricing-tables.css', false, '1.0.0' );
    wp_enqueue_style( 'jklpt_style' );
    
    /* Add JS */
    wp_register_script( 'jklpt_add_classes', plugin_dir_url( __FILE__ ) . 'js/pricing-tables.js', array( 'jquery' ) );
    wp_enqueue_script( 'jklpt_add_classes' );
    
    $output = '<div class="pricing-tables">' . $content . '</div><div class="clear"></div>';
    
    return $output;
}
add_shortcode( 'jkl-pricing-table', 'jkl_pricing_table');

