<?php
/**
 * Version information
 *
 * @package    askminder
 * @copyright 2022 processCentric
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../../config.php');
//Not using

//Answer the askminder
$url = new moodle_url('/mod/askminder/answer.php');
$PAGE->set_url($url);
$PAGE->set_context(\context_system::instance());
$PAGE->set_title('Respond');


$askminder = $DB->get_record("askminder", array("id" => $cm->instance), '*', MUST_EXIST);
echo $askminder->name;
echo 'hi';
$mform =& $this->_form;

$mform->addElement('text', 'name', get_string('name_question', 'askminder'), ['size'=>'64']);
$mform->setType('name', PARAM_TEXT);
$mform->addRule('name', null, 'required', null, 'client');
$mform->addHelpButton('name', 'name', 'askminder');

$ynoptions = [
    0 => get_string('no'),
    1 => get_string('yes'),
];
$mform->addElement('select', 'yesno', get_string('yesno_question', 'askminder'), $ynoptions);
$mform->setDefault('yesno', 0);

$mform->addElement('date_time_selector', 'examdate', get_string('exam_question', 'askminder'),
        self::$datefieldoptions);
$this->standard_coursemodule_elements();
echo 'hi';
$this->add_action_buttons();
