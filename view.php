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
 * Activity view page for the plugintype_pluginname plugin.
 *
 * @package   mod_askminder
 * @copyright Year, You Name <your@email.address>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require('../../config.php');
require('./classes/respond.php');

require_once($CFG->dirroot.'/course/moodleform_mod.php');
require_once($CFG->dirroot.'/mod/askminder/lib.php');

global $DB;

$url = new moodle_url('/mod/askminder/view.php');
$PAGE->set_url($url);
$PAGE->set_context(\context_system::instance());
$PAGE->set_title('Form response');


//Instantiate simplehtml_form
$mform = new respond_form();


//Form processing and displaying is done here
if ($mform->is_cancelled()) {
    //Handle form cancel operation, if cancel button is present on form
    //TO DO redirect to the enclosing course, not hardcoded
    redirect($CFG -> wwwroot . '/course/view.php?id=3');
} else if ($fromform = $mform->get_data()) {
  //Insert to database
   $studentname = $fromform->name;
    $examdate = $fromform->examdate;
    $recordtoinsert = new stdClass();
    $recordtoinsert->studentname = $studentname;
    $recordtoinsert->examdate = $examdate;
    $DB->insert_record('askminder_item', $recordtoinsert); 

  // { ["name"]=> string(12) "Name ms Name" ["examdate"]=> int(1669381200) ["submitbutton"]=> string(12) "Save changes" }
  redirect($CFG -> wwwroot . '/course/view.php?id=2');

  //In this case you process validated data. $mform->get_data() returns data posted in form.
}

echo $OUTPUT->header();
echo "h";

$mform->display();

echo $OUTPUT->footer();

// //Set default data (if any)
