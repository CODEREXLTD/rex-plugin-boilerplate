<?php

/**
 * Plugin Name:     {{The Plugin Name}}
 * Plugin URI:      {{plugin_url}}
 * Description:     {{plugin_description}}
 * Version:         {{version}}
 * Author:          {{author_name}}
 * Author URI:      {{author_url}}
 * Text Domain:     the-plugin-name-text-domain
 * Domain Path:     /languages
 * Requires PHP:    7.1
 * Requires WP:     5.5.0
 * Namespace:       ThePluginName
 */

defined( 'ABSPATH' ) || exit;


final class PluginName {
    /**
     * Plugin version.
     *
     * @var string
     */
    const VERSION = '1.0.0';

    /**
     * Plugin slug.
     *
     * @var string
     *
     * @since 1.0.0
     */
    const SLUG = 'plugin_name';

    /**
     * Holds various class instances.
     *
     * @var array
     *
     * @since 1.0.0
     */
    private $container = [];

    /**
     * Constructor for the PluginName class.
     *
     * Sets up all the appropriate hooks and actions within our plugin.
     *
     * @since 1.0.0
     */
    private function __construct() {
        require_once __DIR__ . '/vendor/autoload.php';

        $this->define_constants();

        register_activation_hook( __FILE__, [ $this, 'activate' ] );
        register_deactivation_hook( __FILE__, [ $this, 'deactivate' ] );

        add_action( 'wp_loaded', [ $this, 'flush_rewrite_rules' ] );
        $this->init_plugin();
    }

    /**
     * Initializes the PluginBoilerplate() class.
     *
     * Checks for an existing PluginBoilerplate() instance
     * and if it doesn't find one, creates it.
     *
     * @since 1.0.0
     *
     * @return PluginName|bool
     */
    public static function init() {
        static $instance = false;

        if ( ! $instance ) {
            $instance = new PluginName();
        }

        return $instance;
    }

    /**
     * Magic getter to bypass referencing plugin.
     *
     * @since 1.0.0
     *
     * @param $prop
     *
     * @return mixed
     */
    public function __get( $prop ) {
        if ( array_key_exists( $prop, $this->container ) ) {
            return $this->container[ $prop ];
        }

        return $this->{$prop};
    }

    /**
     * Magic isset to bypass referencing plugin.
     *
     * @since 1.0.0
     *
     * @param $prop
     *
     * @return mixed
     */
    public function __isset( $prop ) {
        return isset( $this->{$prop} ) || isset( $this->container[ $prop ] );
    }

    /**
     * Define the constants.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function define_constants() {
        define( 'PLUGIN_NAME_VERSION', self::VERSION );
        define( 'PLUGIN_NAME_SLUG', self::SLUG );
        define( 'PLUGIN_NAME_FILE', __FILE__ );
        define( 'PLUGIN_NAME_DIR', __DIR__ );
        define( 'PLUGIN_NAME_PATH', dirname( PLUGIN_NAME_FILE ) );
        define( 'PLUGIN_NAME_INCLUDES', PLUGIN_NAME_PATH . '/includes' );
        define( 'PLUGIN_NAME_TEMPLATE_PATH', PLUGIN_NAME_PATH . '/views' );
        define( 'PLUGIN_NAME_URL', plugins_url( '', PLUGIN_NAME_FILE ) );
        define( 'PLUGIN_NAME_BUILD', PLUGIN_NAME_URL . '/build' );
        define( 'PLUGIN_NAME_ASSETS', PLUGIN_NAME_URL . '/assets' );
        define( 'PLUGIN_NAME_PRODUCTION', 'yes' );
    }

    /**
     * Load the plugin after all plugins are loaded.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function init_plugin() {
        $this->includes();
        $this->init_hooks();

        /**
         * Fires after the plugin is loaded.
         *
         * @since 1.0.0
         */
        do_action( 'plugin_name_loaded' );
    }

    /**
     * Activating the plugin.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function activate() {
        // Run the installer to create necessary migrations and seeders.
//        $this->install();
    }

    /**
     * Placeholder for deactivation function.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function deactivate() {
        //
    }

    /**
     * Flush rewrite rules after plugin is activated.
     *
     * Nothing being added here yet.
     *
     * @since 1.0.0
     */
    public function flush_rewrite_rules() {
        // fix rewrite rules
    }

    /**
     * Run the installer to create necessary migrations and seeders.
     *
     * @since 1.0.0
     *
     * @return void
     */
    private function install() {
        $installer = new RexTheme\PluginName\Setup\Installer();
        $installer->run();
    }

    /**
     * Include the required files.
     *
     * @since 0.2.0
     *
     * @return void
     */
    public function includes() {
        if ( $this->is_request( 'admin' ) ) {
            $this->container['admin_menu'] = new RexTheme\PluginName\Admin\Menu();
        }

        $this->container['rest_api'] = new RexTheme\PluginName\REST\Api();
    }

    /**
     * Initialize the hooks.
     *
     * @since 0.2.0
     *
     * @return void
     */
    public function init_hooks() {
        // Init classes
        add_action( 'init', [ $this, 'init_classes' ] );

        // Localize our plugin
        add_action( 'init', [ $this, 'localization_setup' ] );

        // Add the plugin page links
        add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), [ $this, 'plugin_action_links' ] );
    }


    /**
     * Instantiate the required classes.
     *
     * @since 0.2.0
     *
     * @return void
     */
    public function init_classes() {
        // Init necessary hooks
    }

    /**
     * Initialize plugin for localization.
     *
     * @uses load_plugin_textdomain()
     *
     * @since 0.2.0
     *
     * @return void
     */
    public function localization_setup() {
        load_plugin_textdomain( 'plugin_name', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

        // Load the React-pages translations.
        if ( is_admin() ) {
            // Load wp-script translation for plugin-name-app
            wp_set_script_translations( 'plugin-name-app', 'plugin_name', plugin_dir_path( __FILE__ ) . 'languages/' );
        }
    }

    /**
     * What type of request is this.
     *
     * @since 0.2.0
     *
     * @param string $type admin, ajax, cron or frontend
     *
     * @return bool
     */
    private function is_request( $type ) {
        switch ( $type ) {
            case 'admin':
                return is_admin();

            case 'ajax':
                return defined( 'DOING_AJAX' );

            case 'rest':
                return defined( 'REST_REQUEST' );

            case 'cron':
                return defined( 'DOING_CRON' );

            case 'frontend':
                return ( ! is_admin() || defined( 'DOING_AJAX' ) ) && ! defined( 'DOING_CRON' );
        }
    }

    /**
     * Plugin action links
     *
     * @param array $links
     *
     * @since 0.2.0
     *
     * @return array
     */
    public function plugin_action_links( $links ) {
        $links[] = '<a href="' . admin_url( 'admin.php?page=plugin_name#/settings' ) . '">' . __( 'Settings', 'plugin_name' ) . '</a>';
        $links[] = '<a href="https://github.com/ManiruzzamanAkash/wp-react-kit#quick-start" target="_blank">' . __( 'Documentation', 'plugin_name' ) . '</a>';

        return $links;
    }
}



/**
 * Initialize the main plugin.
 *
 * @since 1.0.0
 *
 * @return \PluginName|bool
 */
function plugin_name() {
    return PluginName::init();
}

/*
 * Kick-off the plugin.
 *
 * @since 1.0.0
 */
plugin_name();