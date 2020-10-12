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

namespace Posticon;

defined( 'ABSPATH' ) || exit;

/**
 * Initialize the classes
 *
 * @author Anatolii S. <sobolev.anatoly@gmail.com>
 */
final class Init
{

    /**
     * Loop through the classes, initialize them, and call the register() method if it exists
     * @return
     */
    public function __construct()
    {
        foreach (self::getServices() as $class) {
            $service = self::instantiate($class);
            if (method_exists($service, 'register')) {
                $service->register();
            }
        }
    }

    /**
     * Store all the classes inside an array
     * @return array Full list of classes
     */
    public static function getServices()
    {
        return [
            Actions\OnActivation::class,
            Actions\OnUninstall::class,
            Admin\RegisterAdminPage::class,
            Admin\RegisterSettings::class,
            Actions\OnOptionSubmit::class,
            Setup\EnqueueScripts::class,
            Views\ShowIcon::class
        ];
    }

    /**
     * Initialize the class
     * @param  class $class         class from the services array
     * @return class instance       new instance of the class
     */
    public static function instantiate($class)
    {
        return new $class();
    }
}