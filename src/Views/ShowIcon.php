<?php


namespace Posticon\Views;

defined('ABSPATH') || exit;

use Posticon\Database\ReadDatabase;

class ShowIcon
{
    public static function register()
    {
        $instance = new self;
        $options = get_option('main_settings')['state'] ?? null;

        if ($options)
            add_filter('the_title', [$instance, 'iconAssignment']);

    }

    public function rewriteTitle($id = null, $title)
    {
        $new_title = $title;
        $row = $this->getAssignedPostsData($id);

        if ($row && $row->position === 'left') {
            $new_title = '<span class="dashicons ' . $row->icon . ' post-icon pi-' . $row->position . '"></span>' . $title;
        }
        if ($row && $row->position === 'right') {
            $new_title = $title . '<span class="dashicons ' . $row->icon . ' post-icon pi-' . $row->position . '"></span>';
        }
        return $new_title;


    }

    public function iconAssignment($title, $id = null)
    {


        if (in_the_loop()) {

            $cur_id = get_the_ID();

            $title = $this->rewriteTitle($cur_id, $title);
        }

        return $title;

    }

    public function getAssignedPostsData($id)
    {
        $instance = new ReadDatabase();

        return $instance->getAssignedPosts($id);
    }

}
