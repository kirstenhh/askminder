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
 * Activity creation/editing form for the mod_[modname] plugin.
 *
 * @package   mod_askminder
 * @copyright 2022, kirsten.hauck@processcentric.ch
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once($CFG->dirroot.'/course/moodleform_mod.php');
require_once($CFG->dirroot.'/mod/askminder/lib.php');

class mod_askminder_mod_form extends moodleform_mod {
  public static $datefieldoptions = array('optional' => true);

    function definition() {
        global $CFG, $DB, $OUTPUT;
        $mform =& $this->_form;

        $mform->addElement('header', 'general', get_string('general', 'form'));

        $mform->addElement('text', 'name', get_string('name', 'askminder'), array('size'=>'64'));
        $mform->setType('name', PARAM_TEXT);
        $mform->addRule('name', null, 'required', null, 'client');
        $mform->addRule('name', get_string('maximumchars', '', 255), 'maxlength', 255, 'client');

        $mform->addElement('text', 'message', get_string('questiontext', 'askminder'), ['size'=>'64']);
        $mform->setType('message', PARAM_TEXT);
        $mform->addRule('message', null, 'required', null, 'client');
        $mform->addRule('message', null, 'required', null, 'client');
        $mform->addHelpButton('message', 'message', 'askminder');
        // two yesno questions: Send email before, send email after
        // one link/text, to the After form (regular Feedback)
        $this->standard_intro_elements(get_string('description', 'feedback'));
        $this->standard_coursemodule_elements();
        $this->add_action_buttons();

    }

 }
