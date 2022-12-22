<?php

require_once("$CFG->libdir/formslib.php");



class respond_form extends moodleform {
    //Add elements to form
    public function definition() {
        global $CFG;

        $mform = $this->_form; // Don't forget the underscore!

        $mform->addElement('text', 'name', get_string('name_question', 'askminder')); // Add elements to your form.
        $mform->setType('name', PARAM_NOTAGS);                   // Set type of element.

        $mform->addElement('date_time_selector', 'examdate', get_string('exam_question', 'askminder'));
        //mform->setDefault('examdate', current time rounded to the hour)
        $this->add_action_buttons();

    }
    //Custom validation should be added here
    function validation($data, $files) {
        return array();
    }
}
