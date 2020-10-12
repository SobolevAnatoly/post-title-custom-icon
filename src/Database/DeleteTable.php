<?php


namespace Posticon\Database;

defined('ABSPATH') || exit;

class DeleteTable extends DatabaseSettings
{
    public static function deleteTable()
    {
        $instance = new self;

        $instance->deleteQuery($instance->getTableName());

    }

    private function deleteQuery($table_name)
    {
        $instance = new parent;
        $sql = "DROP TABLE IF EXISTS `{$table_name}`";

        $instance->getWpdb()->query($sql);

    }


}