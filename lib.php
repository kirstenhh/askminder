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
 * Version information
 *
 * @package    askminder
 * @copyright 2022 processCentric
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

 defined('MOODLE_INTERNAL') || die();

function askminder_before_footer(){
  \core\notification::add('eebydeeby!', \core\output\notification::NOTIFY_INFO);
}


/**
 * this will create a new instance and return the id number
 * of the new instance.
 *
 * @global object
 * @param object $askminder the object given by mod_askminder_mod_form
 * @return int
 */
function askminder_add_instance($askminder) {
    global $DB;
    \core\notification::add('Adding!', \core\output\notification::NOTIFY_INFO);

    $askminder->timemodified = time();
    $askminder->id = '';


    //saving the askminder in db
    $askminderid = $DB->insert_record("askminder", $askminder);

    $askminder->id = $askminderid;
    \core\notification::add('beanie beep' . $askminderid, \core\output\notification::NOTIFY_INFO);

    //course
    if (!isset($askminder->coursemodule)) {
        $cm = get_coursemodule_from_id('askminder', $askminder->id);
        \core\notification::add('byenye' . $cm, \core\output\notification::NOTIFY_INFO);

        $askminder->coursemodule = $cm->id;
    }
    $context = context_module::instance($askminder->coursemodule);


    // $askminder->name = $askminderid;
    // $askminder->text = $askminderid;

    // $askminder->intro = $askminderid;
    // $askminder->introformat = $askminderid;


    $context = context_module::instance($askminder->course);
    $DB->update_record('askminder', $askminder);

    return $askminderid;
}

/**
 * this will update a given instance
 *
 * @global object
 * @param object $askminder the object given by mod_askminder_mod_form
 * @return boolean
 */
function askminder_update_instance($askminder) {
    global $DB;

    $askminder->timemodified = time();
    $askminder->id = $askminder->instance;


    //save the askminder into the db
    $DB->update_record("askminder", $askminder);

    return true;
}


/**
 * this will delete a given instance.
 * all referenced data also will be deleted
 *
 * @global object
 * @param int $id the instanceid of askminder
 * @return boolean
 */
function askminder_delete_instance($id) {
    global $DB;

    //get all referenced items
    $askminderitems = $DB->get_records('askminder', array('askminder'=>$id));


    //deleting old events
    $DB->delete_records('event', array('modulename'=>'askminder', 'instance'=>$id));
    return $DB->delete_records("askminder", array("id"=>$id));
}


/**
 * This gets an array with default options for the editor
 *
 * @return array the options
 */
function askminder_get_editor_options() {
    return array('maxfiles' => 12,
                'trusttext'=>true);
}
