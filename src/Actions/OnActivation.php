<?php


namespace Posticon\Actions;

use Posticon\Database\CreateTable;

defined('ABSPATH') || exit;

class OnActivation extends CreateTable
{
    public static function register()
    {
        $instance = new self;
        register_activation_hook(PI_PLUGIN, [$instance, 'createDatabaseTable']);
    }

    public static function createDatabaseTable()
    {
        parent::createTable();
    }
}