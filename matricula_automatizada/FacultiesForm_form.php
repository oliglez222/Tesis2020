<?php
require_once("$CFG->libdir/formslib.php");
include_once 'functions.php';



class FacultiesForm_form extends moodleform {
    //Add elements to form
    public function definition() {
        //global $CFG;
        
        $mform = $this->_form; 
        
      
        
       $fac=GetFaculties();
       
       foreach($fac as $f){
        $mform->addElement('static', 'description','','Facultad de '.$f->name);
        $mform->setType('Facultad de '.$f->name,PARAM_RAW);
       
       $careers=GetCareers($f->id);
       foreach($careers as $c){
        //var_dump($c);
        $mform->addElement('advcheckbox', $c->name, $c->name,null); 
       }
        
    }
      
       $this->add_action_buttons(false,'Siguiente');
    }
    
    function validation($data, $files) {
        return array();
    }
}




?>