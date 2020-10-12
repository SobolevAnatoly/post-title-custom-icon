<?php


namespace Posticon\Database;

defined('ABSPATH') || exit;

class DatabaseSettings
{
    private $wpdb;
    private $table_name = 'posts_title_icons';
    private $charset_collate;

    /**
     * @return mixed $wpdb
     */
    public function getWpdb()
    {
        global $wpdb;

        $this->setWpdb($wpdb);

        return $this->wpdb;
    }

    /**
     * @param mixed $wpdb
     */
    public function setWpdb($wpdb)
    {
        $this->wpdb = $wpdb;
    }

    /**
     * @return mixed $table_name
     */
    public function getTableName()
    {
        return $this->getWpdb()->prefix . $this->table_name;
    }


    /**
     * @return mixed $charset_collate
     */
    public function getCharsetCollate()
    {
        $this->charset_collate = $this->getWpdb()->get_charset_collate();

        return $this->charset_collate;
    }


}