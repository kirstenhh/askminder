<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Event observer definitions for the plugintype_pluginname plugin.
 *
 * @package   plugintype_pluginname
 * @copyright Year, You Name <your@email.address>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


 //EVENTS: Listeners for stuff that happens elsewhere

$observers = [
    [
        'eventname' => '\core\event\course_module_created',
        'callback'  => '\plugintype_pluginname\event\observer\course_module_created::store',
        'priority'  => 1000,
    ],
    [
        'eventname' => '\core\event\course_content_deleted',
        'callback'  => '\plugintype_pluginname\event\observer\course_content_deleted::store',
        'priority'  => 1000,
    ],
];
