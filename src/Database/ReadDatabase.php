<?php


namespace Posticon\Database;

defined('ABSPATH') || exit;

class ReadDatabase extends DatabaseSettings
{

    public static function getAssignedPosts($post_id = null)
    {
        $instance = new self;
        $tablename = $instance->getTableName();
        if($post_id){
            $postsArray = $instance->getWpdb()->get_row("SELECT * FROM `$tablename` WHERE post_id = {$post_id}");
        } else{
            $postsArray = $instance->getWpdb()->get_results("SELECT * FROM `$tablename`");
        }

        return $postsArray;
    }

}