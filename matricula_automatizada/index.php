<?php


require_once(__DIR__ . '/../../../config.php');
require_once($CFG->dirroot.'/course/lib.php');
require_once($CFG->dirroot.'/user/lib.php');
require_once($CFG->dirroot.'/lib/enrollib.php');
require_once($CFG->libdir .'/coursecatlib.php');
include_once 'FacultiesForm_form.php';

include_once 'functions.php';
 



$url = new moodle_url('/matricula.php');
$PAGE->set_context(context_system::instance());
$PAGE->set_url($url);
$title = get_string('fac', 'tool_matricula_automatizada');
$pagetitle = get_string('select', 'tool_matricula_automatizada');
//$PAGE->set_title($title);
$PAGE->set_heading($title);
echo $OUTPUT->header();
echo $OUTPUT->heading($pagetitle);
//echo $OUTPUT->footer();

$PAGE->set_pagelayout('admin');


$tosend=array();

$mform = new FacultiesForm_form();
$chosenCareers=array();
$chosenFaculties=array();
$c=0;




 if ($fromform = $mform->get_data()) {
  
  foreach($fromform as $k=>$value){
   if($value==='1'){
     
     
     
     $chosenCareers[]=$k;
    
    }
   
  }
  
  CreateStudyPlanYearsAndSubjects($chosenCareers);
  
  //Unenroll();
  Matriculate($chosenCareers);

  $courseurl = new moodle_url('/course');
  //redirect($courseurl);


} 


else{
  //echo $OUTPUT->header();

  $mform->display();
  //sleep(10);
  //echo $OUTPUT->footer();

}

//Unenroll();

//echo $OUTPUT->header();

echo $OUTPUT->footer();



?>






<?php

function CreateStudyPlanYearsAndSubjects($careers){
  global $DB;
  $years=array( 1 => 'Primer año',  2 => 'Segundo año',  3 => 'Tercer año', 4 => 'Cuarto año', 5 => 'Quinto año');
  $catFac='';
  $catCareer='';
  $cats=$DB->get_records('course_categories');
  $createdCareer=false;
  $createdFaculty=false;
  
   
  foreach($careers as $c){
    $fac=getFacultybyCareer($c);//por cada carrera elegida ,obtener la fac a la q pertenece
    
    foreach($cats as $ct){//buscar en las categorias si ya esta creada esa facultad y/o esa carrera
      
      if($ct->name===$fac){
        $createdFaculty=true;
        $catFac=$ct->id;
        
       
      }
      if($ct->name===$c){
        $createdCareer=true;
        $catCareer=$ct->id;
        
      }
    }
    if($createdFaculty===false){
      $data=new stdClass();
      $data->name= $fac;
     
        $data->description='';
      $data->idnumber=''; 
      $catFac=coursecat::create($data);

    }
  
    if($createdCareer===false)
  {  $data=new stdClass();
  $data->name= $c;
 
    $data->description='';
  $data->idnumber=''; 
  $data->parent=$catFac->id;
  $catCareer=coursecat::create($data);}
  
  
  $studyPlans=StudyPlans($c);//obtener los plnes de estudio activos para esa carrera
  
  foreach($studyPlans as $sp){
    
    $cats=$DB->get_records('course_categories');
  $catsp='';
  $catnumber='';
  $createdSpCategory=false;
  $sub=GetSubjectsId($sp);
  
  foreach($cats as $c){
    if($c->name==='Plan de estudio'.' '.$sp){//verificar si ya existe ese plan de estudio creado
      $catnumber=$c->id;
      $createdSpCategory=true;
  }

    } 
  if($createdSpCategory===false)
  {
    $data=new stdClass();
    $data->name= 'Plan de estudio'.' '.$sp;
 
    $data->description='';
    $data->idnumber=''; 
    $data->parent=$catCareer->id;
    $catnumber=coursecat::create($data);
    
  

  }
$year=StudyPlanPeriodsAmount($sp)/2;//obtener los años activos para ese plan de estudio
$i=0;


foreach($years as $n=>$l)
{
  if($i<$year)
{
  $createdYears=false;

foreach($cats as $c)
  {
    if($c->name===$l&&$c->parent===$catnumber){//verificar si estan creados los años del plan d estudio
      //actual
   
      $createdYears=true;
    break;
    }
  
  }
if($createdYears===false)
{ $data1=new stdClass();
  $data1->name= $l;
  $data1->description='';
  $data1->idnumber=''; 
  $data1->parent=$catnumber->id;
  
 
  coursecat::create($data1);
  
  
}
  $i=$i+1;
}
}
foreach($sub as $subId){
  $subjectInfo=SubjectData($subId);
  $courses=$DB->get_record('course',array('shortname'=>strtolower($subId)));//verifica si esta craeada
  
  $cats=$DB->get_records('course_categories');
  if($courses===false)
  {
    
    $data=new stdClass();
    $data->shortname=strtolower($subId);
    $data->fullname=$subjectInfo->name;
    $yearsub=$subjectInfo->year;
    foreach($cats as $c){
      if($c->name===$years[$yearsub]){
        
        $data->category=$c->id;
        
    }

  }
     $data->visible=1;
     $idcourse=create_course($data);
     
}

}

}

}
}


function Matriculate($career){
  global $DB;
  $offst=0;
  $limit=3;//para tener en memoria solo una cantidad limitada de datos.
 //var_dump($career);
  foreach($career as $c)
 { 
 
 
  $stCount=CountStudents($car);
  //var_dump($stCount);

  
  while($limit+$offst<$stCount)
  {  
    $car=GetIdByCareerName($c);
   
    
    $ci=GetStudents($car,$limit,$offst);//aqui poner d q carrera
   
    foreach($ci as $st){
      $sub= GetMatriculatedSubject($st);//obtiene los id de asignaturas matriculadas.
      $usn=$st;
      $u=$DB->get_record('user',array('username'=>$usn));
      $iduser='';
     echo $st;
    // echo '          ';
     //echo '**************************';
     //echo 'asignaturas:   ';
     //var_dump($sub);
      if($u===false)
      {
        $user=new stdClass();
        $user->username=$usn;//el username es el ci
        $user->password='T07@a'.$st;
        $user->confirmed='1';
        $user->firstname=$sub->StudentData->name;
        $user->lastname=$sub->StudentData->lastName;
       try
       { $iduser=user_create_user($user) ;}
      
       catch(Exception $e)
       {var_dump($user);}
 } 
 
 
 else{
     // $u=$DB->get_record('user',array('username'=>$usn));
      $iduser=$u->id;
      
     }
         
   foreach($sub->idS as $s)
   { $dataSubject=SubjectData($s);
     $subjectname=$dataSubject->name;
     $sp=StudyPlanByCi($st);//obtener  a que plan d estudio pertenece el estudiante
        
     $course=$DB->get_record('course',array('shortname'=>strtolower($s)));
     enroll_to_course($course->shortname,$iduser);  //matricular 
     }
     
     }
     if($limit>$stCount-($offst+$limit)){//esto es para la cantidad d datos en memoria
      $limit=$stCount-($offst+$limit);
   }
   $offst=$offst+$limit;
   
   }
  }
}

  function Unenroll(){
  global $DB;
  $s=$DB->get_records('user_enrolments');
$courses=$DB->get_records('course');

foreach($s as $user)
{
  $u=$DB->get_record('user',array('id'=>$user->userid));
  $status=GetStatusbyCi($u->username);
  var_dump( $status);
  if($status!=='02')
{ 
   user_delete_user($u); //catch ( Exception $e ) {   } 
  
}
$a=enrol_get_users_courses($u->id);
foreach($a as $enrolledcourses){
unenroll_to_course($enrolledcourses->shortname,$user->userid);

}
}

}



//para matricular en curso
function enroll_to_course($shortname,$userid,$roleid=5,$enrolmethod='manual'){
global $DB;
global $OUTPUT;
 
$course=$DB->get_record('course',array('shortname'=>$shortname));
$enrol=enrol_get_plugin($enrolmethod);
 if($enrol===null){
     
 }
else{

  
}

$instances=enrol_get_instances($course->id,true);
$manualinstance=null;
foreach($instances as $instance){
if($instance->name==$enrolmethod)
{$manualinstance=$instance;
break;
}

}
if($manualinstance!== null)
{
$instanceid=$enrol->add_default_instance($course);
if($instanceid===null){
    $instanceid=$enrol->add_instance($course);
}
$instance=$DB->get_record('enrol',array('id'=>$instanceid));
}
$enrol->enrol_user($instance,$userid,$roleid);
}


?>
<?php
//para desmatricular en curso
function unenroll_to_course($shortname,$userid,$roleid=5,$enrolmethod='manual'){
global $DB;
global $OUTPUT;
 
$course=$DB->get_record('course',array('shortname'=>$shortname));
$enrol=enrol_get_plugin($enrolmethod);
 

$instances=enrol_get_instances($course->id,true);
$manualinstance=null;
foreach($instances as $instance){
if($instance->name==$enrolmethod)
{$manualinstance=$instance;
break;
}

}
if($manualinstance!== null)
{
$instanceid=$enrol->add_default_instance($course);
if($instanceid===null){
    $instanceid=$enrol->add_instance($course);
}
$instance=$DB->get_record('enrol',array('id'=>$instanceid));
}
$enrol->unenrol_user($instance,$userid);
}


?>