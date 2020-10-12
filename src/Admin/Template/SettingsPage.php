<?php

/*
 * Copyright (C) 2020 Anatolii S.
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */

namespace Posticon\Admin;

defined('ABSPATH') || exit;

use Posticon\Database\ReadDatabase, WP_Query;

class SettingsPage
{

    public static function settingsPage()
    {
        $instance = new self;

        ?>
        <div class="wrap">
            <h1>Plugin settings page</h1>

            <form method="post" action="options.php">
                <?php
                settings_fields('main-settings-group');
                do_settings_sections('pi-settings-page');
                ?>
                <p>You can find full list of icons code
                    <a href="https://developer.wordpress.org/resource/dashicons/#admin-site"
                       target="_blank"
                    >
                        <b>HERE</b>
                    </a>
                </p>
                <p>For example - dashicons-admin-site &nbsp; it' code for <span
                            class="dashicons dashicons-admin-site"></span></p>

                <fieldset style="padding-top: 1rem">
                    <span>Select Page: </span>
                    <?php $instance->dropdownPages(); ?>
                    <span>OR Post</span>
                    <?php $instance->dropdownPosts(); ?>
                    <?php $instance->dropdownProducts(); ?>
                    <?php $instance->iconCode(); ?>
                    <?php $instance->iconPosition(); ?>
                </fieldset>


                <?php submit_button(); ?>

            </form>

            <table class="wp-list-table widefat">
                <thead>
                <tr>
                    <th class="manage-column" scope="col" style="width:50%;">
                        <label>Post Title</label>
                    </th>
                    <th class="manage-column" scope="col" style="width:20%;">
                        <label>Icon</label>
                    </th>
                    <th class="manage-column" scope="col" style="width:20%;">
                        <label>Position</label>
                    </th>
                    <th class="manage-column" scope="col" style="width:10%;">

                    </th>
                </tr>
                </thead>
                <tbody id="the-list">
                <?php $instance->listAssignedPosts(); ?>
                </tbody>
                <tfoot>
                <tr>
                    <th class="manage-column" scope="col" style="width:50%;">
                        <label>Post Title</label>
                    </th>
                    <th class="manage-column" scope="col" style="width:20%;">
                        <label>Icon</label>
                    </th>
                    <th class="manage-column" scope="col" style="width:20%;">
                        <label>Position</label>
                    </th>
                    <th class="manage-column" scope="col" style="width:10%;">

                    </th>
                </tr>
                </tfoot>
            </table>
        </div>
        <?php
    }

    public function iconCode()
    {
        print '<label for="icon-code">Enter icon code:</label>
               <input type="text" id="icon-code" name="icon-code" value="" />';
    }

    public function iconPosition()
    {
        print '<input type="radio" id="left-pos"
                        name="position" value="left" checked="checked" style="margin-left: .7rem" />
               <label for="left-pos">Left</label>
               <input type="radio" id="right-pos"
                       name="position" value="right" style="margin-left: .3rem" />
               <label for="right-pos">Right</label>';
    }


    public function listAssignedPosts()
    {
        $readDatabase = new ReadDatabase();
        $rows = $readDatabase::getAssignedPosts();

        foreach ($rows as $row) {
            print '
                <tr>
                    <th style="width:50%;">' . get_the_title($row->post_id) . '</th>
                    <th style="width:20%;"><span class="dashicons ' . $row->icon . '"></span></th>
                    <th style="width:20%;">' . $row->position . '</th>
                    <th style="width:10%;"><button type="button" name="remove"  value="' . $row->post_id . '" title="(In Development)Remove assignment">X</button></th>
                </tr>
            ';
        }

    }

    public function dropdownPages()
    {
        $pages_query = new WP_Query;

        $args = [
            'sort_order' => 'ASC',
            'sort_column' => 'post_title',
            'post_type' => 'page',
            'post_status' => 'publish',
            'posts_per_page' => -1,
        ];

        $pages = $pages_query->query($args); ?>

        <select name="posts-id" id="pages-list">
            <option disabled="disabled">Select Page</option>
            <?php foreach ($pages as $post) : ?>
                <option value="<?= $post->ID; ?>">
                    <?= esc_html($post->post_title); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <?php
    }

    public function dropdownPosts()
    {
        $posts_query = new WP_Query;

        $args = [
            'sort_order' => 'ASC',
            'sort_column' => 'post_title',
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => -1,
        ];

        $posts = $posts_query->query($args);
        ?>
        <select name="posts-id" id="posts-list">
            <option disabled="disabled">Select Post</option>
            <?php foreach ($posts as $post) : ?>
                <option value="<?= $post->ID; ?>">
                    <?= esc_html($post->post_title); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <?php
    }

    public function dropdownProducts()
    {
        if (!class_exists('WooCommerce'))
            return;

        $args = ['status' => 'publish', 'limit' => -1];
        $products = wc_get_products($args); ?>
        <span>OR Product: </span>
        <select name="posts-id" id="product-list">
            <option disabled="disabled">Select Product</option>
            <?php foreach ($products as $product): ?>
                <option value="<?= $product->get_id(); ?>">
                    <?= $product->get_title(); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <?php
    }

}
