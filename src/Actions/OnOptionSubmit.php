<?php


namespace Posticon\Actions;

defined('ABSPATH') || exit;

use Posticon\Database\WriteDatabase;

/**
 * Class OnOptionSubmit
 * @package Posticon\Actions
 *
 * Class to handle submit action on plugin option save
 */
class OnOptionSubmit
{

    /**
     * Method to register class in init.php
     * It's hook a submitData method to admin_init action
     */
    public static function register()
    {
        $instance = new self;
        add_action('admin_init', [$instance, 'submitData']);

    }

    /**
     * Listening a settings save action at plugin options page and
     * set it to writeToTable() method of WriteDatabase() class
     */
    public function submitData()
    {
        $instance = new WriteDatabase();

        if (isset($_POST['submit']) && !empty($_POST['icon-code']) && !empty($_POST['posts-id'])) {

            $post_id = filter_input(INPUT_POST, 'posts-id', FILTER_SANITIZE_NUMBER_INT);
            $icon = filter_input(INPUT_POST, 'icon-code', FILTER_SANITIZE_STRING);
            $position = filter_input(INPUT_POST, 'position', FILTER_SANITIZE_STRING);

            $instance::writeToTable($post_id, $icon, $position);
        }


    }

}