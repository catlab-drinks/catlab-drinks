<?php
/**
 * CatLab Drinks - Simple bar automation system
 * Copyright (C) 2019 Thijs Van der Schaeghe
 * CatLab Interactive bvba, Gent, Belgium
 * http://www.catlab.eu/
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
 */

namespace App\Http\Api\V1\ResourceDefinitions;

use App\Models\Event;
use CatLab\Charon\Models\ResourceDefinition;

/**
 * Class EventResourceDefinition
 * @package App\Http\Api\V1\ResourceDefinitions
 */
class EventResourceDefinition extends ResourceDefinition
{
    /**
     * EventResourceDefinition constructor.
     */
    public function __construct()
    {
        parent::__construct(Event::class);

        $this
            ->identifier('id')
            ->int();

        $this->field('name')
            ->string()
            ->visible(true)
            ->writeable(true, true)
        ;
    }
}