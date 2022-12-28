<?php

/**
 * the first page to view the feedback
 *
 * @author Andreas Grabs
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package mod_feedback
 */
require('../../config.php');
require('./classes/respond_form.php');

require_once($CFG->dirroot.'/mod/askminder/lib.php');

global $DB;
global $USER;

$id = required_param('id', PARAM_INT);
$courseid = optional_param('courseid', false, PARAM_INT);

list($course, $cm) = get_course_and_cm_from_cmid($id, 'askminder');

require_course_login($course, true, $cm);
$askminder = $DB->get_record("askminder", array("id" => $cm->instance), '*', MUST_EXIST);
$PAGE->set_activity_record($askminder);
$context = context_module::instance($cm->id);


//Nav stuff
$url = new moodle_url('/mod/askminder/view.php', array('id' => $cm->id));
$PAGE->set_url($url);
$PAGE->set_context(\context_system::instance());
$PAGE->set_title($askminder->name);

$mform = new respond_form(null, array('id'=>$id, 'askminderid'=>$askminder->id, 'courseid'=>$course->id, 'name'=>$askminder->name, 'message'=>$askminder->message ));


//Form processing and displaying is done here
if ($mform->is_cancelled()) {
  //Handle form cancel operation, if cancel button is present on form
  //TO DO redirect to the enclosing course, not hardcoded
  redirect($CFG -> wwwroot . '/course/view.php?id=' . $courseid);
} else if ($fromform = $mform->get_data()) {
//Insert to database

  $recordtoinsert = new stdClass();
  $recordtoinsert->course = $fromform->course;
  $recordtoinsert->askminderid = $fromform->id;
  $recordtoinsert->userid = $USER->id;

  $recordtoinsert->student_name = $fromform->studentname;
  $recordtoinsert->exam_date = $fromform->exam_date; 
  $recordtoinsert->timemodified = time();
  echo '______';
  $DB->insert_record('askminder_item', $recordtoinsert); 
  
  // var_dump($fromform);
  // var_dump($recordtoinsert);

  redirect($CFG -> wwwroot . '/course/view.php?id=' . $fromform->course);

} 

//else display


echo $OUTPUT->header();
echo $askminder->message;

$mform->display();

echo $OUTPUT->footer();
