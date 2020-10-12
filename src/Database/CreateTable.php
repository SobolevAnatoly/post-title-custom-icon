<?php


namespace Posticon\Database;

defined('ABSPATH') || exit;

class CreateTable extends DatabaseSettings
{

    public static function createTable()
    {
        $instance = new self;

        $instance->tableStructure($instance->getTableName(), $instance->getCharsetCollate());

    }

    private function tableStructure($table_name, $charset_collate)
    {
        $sql = "CREATE TABLE IF NOT EXISTS `{$table_name}` (
			`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
			`post_id` int(11) unsigned NOT NULL,
			`icon` varchar(32) NOT NULL DEFAULT '',
			`position` varchar(5)  NOT NULL DEFAULT 'left',
			PRIMARY KEY (`id`),
			UNIQUE (`post_id`)
	  ) $charset_collate";
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        maybe_create_table($table_name, $sql);
    }


}