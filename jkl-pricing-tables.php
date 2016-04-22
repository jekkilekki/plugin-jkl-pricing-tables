<?php
/**
 * @since       1.3.0
 * @package     JKL_Pricing_Tables
 * @author      Aaron Snowberger <jekkilekki@gmail.com>
 * 
 * @wordpress-plugin
 * Plugin Name: JKL Pricing Tables
 * Plugin URI:  https://github.com/jekkilekki/plugin-jkl-pricing-tables
 * Description: A simple plugin to add pricing tables to your website using only unordered lists inside a shortcode.
 * Version:     1.3.0
 * Author:      Aaron Snowberger <jekkilekki@gmail.com>
 * Author URI:  http://www.aaronsnowberger.com
 * Text Domain: jkl-pricing-tables
 * Domain Path: /languages/
 * License:     GPL2
 * 
 * Requires at least: 3.5
 * Tested up to: 4.5.1
 */

/**
 * JKL Pricing Tables allows you to easily add pricing tables to your website using only unordered lists inside a shortcode.
 * Copyright (C) 2016  AARON SNOWBERGER (email: JEKKILEKKI@GMAIL.COM)
 * 
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

/*
 * Plugin Notes:
 */

/* Prevent direct access */
if ( ! defined( 'WPINC' ) ) die;

/*
 * The class that represents the MAIN JKL ADMIN settings page
 */

/*
 * The class that represents and defines the core plugin
 */
require_once plugin_dir_path( __FILE__ ) . 'inc/class-jkl-pricing-tables.php';

/*
 * The class that creates the Shortcode
 */
require_once plugin_dir_path( __FILE__ ) . 'inc/class-jkl-pricing-tables-shortcode.php';

/*
 * The function that creates a new JKL_Pricing_Tables object and runs the program
 */
function run_pricing_tables() {
    // Instantiate the plugin class
    $JKL_Pricing_Tables = new JKL_Pricing_Tables( 'jkl-pricing-tables', '1.3.0' );
}

run_pricing_tables();
