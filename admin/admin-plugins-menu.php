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
    
    /**
     * THE instance of the JKL_Plugins_Admin_Menu
     * Using the Singleton pattern to prevent creating more than one JKL_Plugins_Admin_Menu Object
     * 
     * @since   1.3.1
     * 
     * @var     Object  $_instance  THE instance of the JKL_Plugins_Admin_Menu
     */
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

        // Create a top-level menu item
        add_menu_page(
                __( 'JKL Plugins Admin', 'jkl-pricing-tables' ),// $page_title
                __( 'JKL Plugins', 'jkl-pricing-tables' ),      // $menu_title
                'manage_options',                               // $capability
                'jkl_panel',                                    // $menu_slug
                array( $this, 'jkl_plugins_admin_render' ),     // $function
                'dashicons-admin-plugins'                       // $icon
        );
        add_action( 'admin_enqueue_scripts', array( $this, 'jkl_plugins_admin_scripts' ) );
         
    }
    
    /**
     * MAIN PLUGIN PAGE --------------------------------------------------------
     * @link    https://wordpress.org/plugins/plugin-cards/
     */
    public function jkl_plugins_admin_render() { 
        
        // Load our basic page
        require_once( ABSPATH . 'wp-admin/includes/plugin-install.php' );
        include_once( 'admin-plugins-view.php' );
        
        // Set up queriable attributes
        $atts = array( 
            'max_results'       => 50,
            'slug'              => false,
            'author'            => 'jekkilekki',
            'tag'               => false,
            'browse'            => false,
            'user'              => false,
            'search'            => false,
        );

        // Set up query fields
        $fields = array( 
            'banners'           => true,
            'icons'             => true,
            'reviews'           => false,
            'rating'            => true,
            'num_ratings'       => true,
            'downloaded'        => true,
            'active_installs'   => true,
            'short_description' => true,
            'sections'          => false,
            'downloadlink'      => true,
            'last_updated'      => true,
            'homepage'          => true,
        );
        
        // Set how long to cache results
        $expiration = 120 * MINUTE_IN_SECONDS;
        
        // Allow expiration to be filtered.
        // $expiration = apply_filters( 'plugin_cards_cache_expiration', $expiration, $atts );
        
        // Make sure $plugin_info is always defined to prevent a PHP notice
        $plugin_info = false;
        
        /*
         * Do query using passed in params.
         */
        $custom_query_args = null;
        if( $custom_query_args ) {
            $plugin_info = plugins_api( 
                    'query_plugins',
                    $custom_query_args
            );
        } else {
            $plugin_info = $this->jkl_load_plugins( $atts, $fields, $plugin_info, $expiration );
        }
        
        // Default $output
        $output = '';
        
        // Confirm the call to plugins_api worked
        if ( is_object( $plugin_info ) && ! is_wp_error( $plugin_info ) ) {
                
                // We have multiple results.
                $output .= '<div id="the-list" class="plugin-cards">';
                
                foreach( $plugin_info as $plugin ) {
                    $output .= $this->jkl_render_plugin_card( $plugin );
                }
                
                $output .= '</div>';
                echo $output;
            
        }

    }
    /**
     * @link    https://thomasgriffin.io/how-to-use-the-new-wordpress-plugin-favorites-api/
     * @link    http://danieliser.com/fetching-active-install-count-plugins-api/
     * @link    https://plugins.svn.wordpress.org/i-make-plugins/tags/1.2.3/i-make-plugins.php
     * @link    https://code.tutsplus.com/tutorials/communicating-with-the-wordpressorg-plugin-api--wp-33069
     * 
     * @param type $atts
     * @param type $fields
     * @param type $plugin_info
     * @param type $expiration
     */
    public function jkl_load_plugins( $atts, $fields, $plugin_info, $expiration ) {
        
        // Prepare our query
        $plugins = plugins_api( 'query_plugins', array( 'author' => 'jekkilekki', 'fields' => $fields ) );
        
        // Check for Errors and Display the results
        if( is_wp_error( $plugins ) ) {
            echo '<pre>Hey! ' . print_r( $plugins->get_error_message(), true ) . '</pre>';
        } else {
            foreach( $plugins->plugins as $plugin ) {
                $this->jkl_render_plugin_card( $plugin );
            }
        }
       
    }
    
    public function jkl_render_plugin_card( $plugin ) {
        
        // Enqueue styles maybe??
        
        // Sometimes the Plugin URI hasn't been set, so let's fallback to building it manually
        $plugin_url = esc_url( $plugin->homepage );
        if ( ! $plugin_url ) {
            $plugin_url = 'https://wordpress.org/plugins/' . esc_attr( $plugin->slug ) . '/';
        }
        
        // And allow it to be filtered
        $plugin_url = apply_filters( 'plugin_cards_plugin_url', $plugin_url, $plugin );
        
        // ob_start();
        
        ?>
        <div class="plugin-card plugin-card-<?php echo esc_attr( $plugin->slug ) ?>">
            <div class="plugin-card-top">
                <div class="name column-name plugin-name">
                    <h3>
                    <a href="<?php echo esc_url( $plugin_url ); ?>" class="thickbox open-plugin-details-modal" 
                       title="<?php echo esc_attr( $plugin->name ); ?>">
                        <?php echo esc_html( apply_filters( 'plugin_cards_plugin_name', $plugin->name, $plugin ) ); ?>
                        <?php $plugin_icons = $plugin->icons; ?>
                        <?php 
                        // Allow this whole section to be overridden
                        $plugin_icon = apply_filters( 'plugins_cards_plugin_icon', false, $plugin, $plugin_url );

                        // Use the override if it's there, otherwise output the standard icon
                        if( $plugin_icon ) {
                            echo wp_kses_post( $plugin_icon );
                        } else {
                        ?>
                            <img class="plugin-icon" src="<?php 
                                if( ! empty( $plugin_icons[ 'svg' ] ) ) { echo $plugin_icons[ 'svg' ]; }
                                elseif( ! empty( $plugin_icons[ '2x' ] ) ) { echo $plugin_icons[ '2x' ]; }
                                elseif( ! empty( $plugin_icons[ '1x' ] ) ) { echo $plugin_icons[ '1x' ]; } 
                                elseif( ! empty( $plugin_icons[ 'default' ] ) ) { echo $plugin_icons[ 'default' ]; } 
                            ?>"/>
                        <?php } ?>
                    </a>
                    </h3>
                </div>
                
                <?php 
                // Allow this whole section to be overridden.
                $action_links = apply_filters( 'plugin_cards_action_links', false, $plugin );
                if( $action_links ) {
                    echo $action_links;
                } else {
                    ?>
                    <div class="action-links">
                        <ul class="plugin-action-buttons">
                            <li>
                                <a href="<?php echo esc_url( $plugin->download_link ); ?>" class="button">
                                    <?php _e( 'Download', 'jkl-pricing-tables' ); ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <?php
                }
                ?>
                
                <div class="desc column-description">
                    <p>
                        <?php echo wp_kses_post( apply_filters( 'plugin_cards_short_description', $plugin->short_description, $plugin ) ); ?>
                    </p>
                    <p class="authors">
                        <cite><?php _e( 'By', 'jkl-pricing-tables' ); ?> <?php echo wp_kses_post( apply_filters( 'plugin_cards_plugin_author', $plugin->author, $plugin ) ); ?></cite>
                    </p>
                </div>
            </div>
            
            <div class="plugin-card-bottom">
                <div class="vers column-rating">
                    <?php
                    // Allow this whole section to be overridden
                    $plugin_rating = apply_filters( 'plugin_cards_plugin_rating', false, $plugin );
                    
                    if( $plugin_rating ) {
                        echo wp_kses_post( $plugin_rating );
                    } else {
                    ?>
                        <div class="star-rating">
                            <?php $rating = (int)$plugin->rating; ?>
                            
                            <span class="star star-<?php
                                if( $rating >= 20 ) echo 'full';
                                elseif( $rating >= 10 ) echo 'half';
                                else echo 'empty';
                            ?>"></span>
                            <span class="star star-<?php
                                if( $rating >= 40 ) echo 'full';
                                elseif( $rating >= 30 ) echo 'half';
                                else echo 'empty';
                            ?>"></span>
                            <span class="star star-<?php
                                if( $rating >= 60 ) echo 'full';
                                elseif( $rating >= 50 ) echo 'half';
                                else echo 'empty';
                            ?>"></span>
                            <span class="star star-<?php
                                if( $rating >= 80 ) echo 'full';
                                elseif( $rating >= 70 ) echo 'half';
                                else echo 'empty';
                            ?>"></span>
                            <span class="star star-<?php
                                if( $rating >= 100 ) echo 'full';
                                elseif( $rating >= 90 ) echo 'half';
                                else echo 'empty';
                            ?>"></span>

                        </div>
                        <span class="num-ratings">(<?php echo '<a href="https://wordpress.org/support/view/plugin-reviews/' . esc_attr( $plugin->slug ) . '" target="_blank">' 
                                . number_format_i18n( $plugin->num_ratings ) . '</a>'; ?>)
                        </span>
                        <?php   
                    } ?>
                </div>
                <div class="column-updated">
                    <?php 
                    // Allow this whole section to be overridden
                    $last_updated = apply_filters( 'plugin_cards_last_updated', false, $plugin );
                    
                    if( $last_updated ) {
                        echo wp_kses_post( $last_updated );
                    } else {
                    ?>
                        <strong><?php _e( 'Last Updated', 'jkl-pricing-tables' ); ?>:</strong> <span> 
                                <?php printf( __( '%s ago', 'jkl-pricing-tables' ), human_time_diff( strtotime( $plugin->last_updated ) ) ); ?>
                        </span>
                    <?php
                    } ?>
                </div>
                <div class="column-downloaded">
                    <?php
                    // Allow this whole section to be overridden
                    $install_count = apply_filters( 'plugin_cards_install_count', false, $plugin );
                    
                    if( $install_count ) {
                        echo wp_kses_post( $install_count );
                    } else {
                        if( $plugin->active_installs >= 1000000 ) {
                            $active_installs_text = _x( '1+ Million', 'Active plugin installs', 'jkl-pricing-tables' );
                        } else {
                            $active_installs_text = number_format_i18n( $plugin->active_installs ) . '+';
                        }
                        printf( __( '%s Active Installs', 'jkl-pricing-tables' ), $active_installs_text );
                    }
                    ?>
                </div>
                <div class="column-compatibility">
                    <?php
                    // Allow this whole section to be overridden
                    $compatibility = apply_filters( 'plugin_cards_plugin_compatibility', false, $plugin );
                    
                    if( $compatibility ) {
                        echo wp_kses_post( $compatibility );
                    } else {
                        if( ! empty( $plugin->tested ) ) {
                            echo '<span class="compatibility-compatible"><strong>' . __( 'Compatible up to', 'jkl-pricing-tables' ) . ':</strong> ' . esc_attr( $plugin->tested ) . '</span>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
        
    }
    
    public function jkl_plugins_admin_scripts() {
        wp_enqueue_style( 'jkl_admin_menu_style', plugins_url( '/css/admin.css', __FILE__ ) );
    }
    
} // END JKL_Plugins_Admin
} // END if ( ! class_exists( 'JKL_Plugins_Admin' )