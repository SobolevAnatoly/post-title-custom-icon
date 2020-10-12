<?php


namespace Posticon\Admin;

defined('ABSPATH') || exit;

class RegisterAdminPage
{
    public static function register()
    {
        $instance = new self;

        add_action('admin_menu', [$instance, 'regPluginOptionPage']);

    }

    public static function regPluginOptionPage()
    {
        self::pluginOptionPage();

    }

    public function pluginOptionPage()
    {
        add_options_page(
            'Post Title Icon',
            'Post Icon',
            'manage_options',
            'pi-settings-page',
            [$this, 'getSettingsPageTemplate']
        );
    }

    public function getSettingsPageTemplate()
    {
        $template = new SettingsPage();

        return $template::settingsPage();
    }


}