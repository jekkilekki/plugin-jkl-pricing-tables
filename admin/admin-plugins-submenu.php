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
        
        add_action( 'admin_init', array( $this, 'jkl_settings_init' ) );
        
        // echo "Hello eburybody!~";
        // Submenu Page content (view)
        // $this->add_menu_items();
        // add_action( 'load-' . $this->settings, array( $this, 'jklpt_add_tabs' ) );
    }
    
    public function jkl_settings_init() {
        
        // Register settings for this plugin
        register_setting( 'jklpt_options', 'jklpt_settings' );
        
        // Add Settings Section
        add_settings_section(
                'jklpt_options_section',
                __( 'Plugin Settings', 'jkl-pricing-tables' ),
                array( $this, 'jkl_settings_section' ),
                'jklpt_options'
        );
        
        // Text field for "Recommended" label
        add_settings_field(
                'jklpt_recommended_label',                                      // $id
                __( 'Label for recommended product', 'jkl-pricing-tables' ),    // $title
                array( $this, 'jklpt_recommended_render' ),                     // $callback
                'jklpt_options',                                                // $page
                'jklpt_options_section'                                         // $section (also $args next)
        );
        
        // Text field for HTML or named color input
        add_settings_field(
                'jklpt_html_color',                                             // $id
                __( 'Base color (HTML) for highlights', 'jkl-pricing-tables' ), // $title
                array( $this, 'jklpt_html_color_render' ),                      // $callback
                'jklpt_options',                                                // $page
                'jklpt_options_section'                                         // $section (also $args next)
        );
    }
    
    public function jkl_settings_section() {
        echo esc_html__( 'JKL Pricing Tables Settings', 'jkl-pricing-tables' );
    }
    
    public function jklpt_recommended_render() {
        $options = get_option( 'jklpt_options' );
        ?>
        <input type='text' name='jkl_options[jkl_recommended_label]' value='<?php echo $options['jkl_recommended_label']; ?>'>
        <?php
    }
    
    public function jklpt_html_color_render() {
        $options = get_option( 'jklpt_options' );
        ?>
        <input type='text' name='jkl_options[jkl_html_color]' value='<?php echo $options['jkl_html_color']; ?>'>
        <?php
    }
        
    public function jkl_plugin_settings() {
        include_once plugin_dir_path( __FILE__ ) . '../views/view-jkl-pricing-table-options.php';
    }
    
} // END class JKL_Plugins_Admin_Submenu

} // END if ( ! class_exists() )
