<?php

require_once("$CFG->libdir/formslib.php");



class respond_form extends moodleform {
    //Add elements to form
    public function definition() {
        global $CFG;

        $mform = $this->_form; // Don't forget the underscore!

        //Hidden data elements
        $mform->addElement('hidden', 'id', $this->_customdata['id']);
        $mform->addElement('hidden', 'askminderid',$this->_customdata['askminderid']); // Add elements to your form.
        $mform->addElement('hidden', 'course',$this->_customdata['courseid']); // Add elements to your form.
        


     
        $mform->addElement('header', 'minder_name', $this->_customdata['name']); // Add elements to your form.
        
        $mform->addElement('text', 'studentname', get_string('name_question', 'askminder')); // Add elements to your form.
        $mform->setType('studentname', PARAM_NOTAGS);                   // Set type of element.

        $mform->addElement('date_time_selector', 'exam_date', get_string('exam_question', 'askminder'));
       
        $submitlabel = get_string('submit');
        $mform->addElement('submit', 'submitmessage', $submitlabel);

        //mform->setDefault('examdate', current time rounded to the hour)
        //$this->add_action_buttons();
    }
    //Custom validation should be added here
    function validation($data, $files) {
        return [];
    }


}
