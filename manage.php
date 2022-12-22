<?php
/**
 * Version information
 *
 * @package    askminder
 * @copyright 2022 processCentric
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

//See all existing askminders

require_once('../../config.php');
$url = new moodle_url('/mod/askminder/manage.php');
$PAGE->set_url($url);
$PAGE->set_context(\context_system::instance());
$PAGE->set_title('A page for managing askminders');


$minders = $DB->get_records('askminder', null, 'id');

echo $OUTPUT->header();
$templatecontext = (object)[
    'askminders' => array_values($minders),
];

echo $OUTPUT->render_from_template('mod_askminder/manage', $templatecontext);


echo $OUTPUT->footer();
