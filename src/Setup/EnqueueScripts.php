<?php


namespace Posticon\Setup;

defined('ABSPATH') || exit;

class EnqueueScripts
{
    public static function register()
    {
        $instance = new self;
        add_action('admin_enqueue_scripts', [$instance, 'regBackendScripts']);
        add_action('wp_enqueue_scripts', [$instance, 'regFrontendScripts']);
    }

    public static function regFrontendScripts()
    {
        self::regFrontStyles();
    }

    public static function regBackendScripts()
    {
        $cur_page = filter_input(INPUT_GET, 'page') ? filter_input(INPUT_GET, 'page') : '';
        if ($cur_page == 'pi-settings-page') {
            self::regBackendJS();
        }
    }

    private static function regBackendJS()
    {
        // Loading Backend JS
        wp_enqueue_script(
            'tui-bootstrap-js',
            PI_PLUGIN_URL . 'assets/js/admin.js',
            ['jquery'],
            null,
            true
        );

    }

    private static function regFrontStyles()
    {
        // Loading Frontend styles
        wp_enqueue_style( 'dashicons' );

        wp_enqueue_style(
            'pi-main-css',
            PI_PLUGIN_URL . 'assets/css/pi-front.css',
            [],
            '1.0.0'
        );
    }


}
