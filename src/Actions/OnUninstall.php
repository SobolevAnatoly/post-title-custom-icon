<?php


namespace Posticon\Actions;

use Posticon\Database\DeleteTable;

defined('ABSPATH') || exit;

class OnUninstall extends DeleteTable
{
    public static function register()
    {
        register_uninstall_hook(PI_PLUGIN, [__CLASS__, 'uninstallPlugin']);
    }

    public static function uninstallPlugin()
    {
        if (!current_user_can('activate_plugins'))
            return;

        if ( PI_PLUGIN_BASENAME !== WP_UNINSTALL_PLUGIN )
            return;

        parent::deleteTable();

        delete_option("main_settings");
    }
}