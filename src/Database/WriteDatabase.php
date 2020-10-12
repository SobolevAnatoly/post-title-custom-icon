<?php


namespace Posticon\Database;

defined('ABSPATH') || exit;

class WriteDatabase extends DatabaseSettings
{

    public static function writeToTable($post_id = null, $icon, $position)
    {
        $instance = new parent;
        $table_name = $instance->getTableName();

        if (self::checkTable($post_id, $table_name)) {

            self::updateTable($post_id, $icon, $position, $table_name);

        } else {
            $instance->getWpdb()->insert($table_name, array(
                'post_id' => $post_id,
                'icon' => $icon,
                'position' => $position),
                array('%s', '%s', '%s')
            );
        }

    }

    public static function updateTable($post_id, $icon, $position, $table_name)
    {
        $instance = new parent;

        $instance->getWpdb()->update($table_name, array(
            'icon' => $icon,
            'position' => $position),
            array('post_id' => $post_id)
        );

    }

    public static function checkTable($post_id, $table_name)
    {
        $instance = new parent;

        $result = $instance->getWpdb()->get_row("SELECT * FROM `$table_name` WHERE post_id = $post_id");

        return $result;
    }

}