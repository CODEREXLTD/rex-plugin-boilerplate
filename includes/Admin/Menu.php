<?php

namespace RexTheme\PluginName\Admin;



use RexTheme\PluginName\Assets\LoadAssets;

class Menu {

    /**
     * Admin constructor.
     *
     * @since 1.0.0
     */
    public function __construct() {
        add_action( 'admin_menu', [ $this, 'init_menu' ] );
    }


    /**
     * Init menu
     *
     * @since 1.0.0
     */
    public function init_menu() {
        global $submenu;

        $slug          = PLUGIN_NAME_SLUG;
        $menu_position = 50;
        $capability    = 'manage_options';

        add_menu_page( esc_attr__( 'Plugin Name', 'plugin_name' ), esc_attr__( 'Plugin Name', 'plugin_name' ), $capability, $slug, [ $this, 'plugin_page' ], '', $menu_position );

        if ( current_user_can( $capability ) ) {
            $submenu[ $slug ][] = [ esc_attr__( 'Home', 'plugin_name' ), $capability, 'admin.php?page=' . $slug . '#/' ]; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
            $submenu[ $slug ][] = [ esc_attr__( 'Jobs', 'plugin_name' ), $capability, 'admin.php?page=' . $slug . '#/jobs' ]; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
        }
    }


    /**
     * Render the plugin page.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function plugin_page() {
        $assets   = new LoadAssets();
        $assets->admin();
        require_once PLUGIN_NAME_TEMPLATE_PATH . '/app.php';
    }
}