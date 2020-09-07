<?php
include_once 'Codifiers.php';
include_once 'Types.php';
include_once 'ListStudyProgramIdByFilterService.php';
include_once 'StudyProgramStudentService.php';
include_once 'ListMatriculatedStudentIdentificationByFilterService.php';
include_once 'FileStudentService.php';
include_once 'StudyProgramService.php';
include_once 'SubjectService.php';



function StudyPlans($career){
    $answer=array();
    $cod=getCodifierCareer();
    $codCareer='';
    //busca en los codificadores la carrera correspondiente.Ver si hace falta tambien la facultad.
    foreach($cod->ArrayCodifierCareer as $c){
        
        if($c->name===$career){//aqui iria leer lo q me pongan en el moodle
        $codCareer=$c->id;
        }
    }
    
    $gpf=new generalPageFilterVO;
    $gpf->idCareer=$codCareer;
    $gpf->idCourseType='2';

    $p=array('generalPageFilterVO'=>$gpf);
    var_dump($p);
     $CodStudyPlan=getListCustomStudyProgramIdByFilter($p);
    
     foreach($CodStudyPlan->ArrayListCustomStudyProgramIdByFilter as $sp){
         $answer[]=$sp;

     }
    
      return $answer;

}


function GetSubjectsId($idStudyPlan){
    $ans=array();
  $p=array('idCustomStudyProgram'=>$idStudyPlan);
    $idSub= getListAssignedSubjectIdByCustomStudyProgram($p);
    foreach($idSub->ListAssignedSubjectIdByCustomStudyProgram as $is){
     $ans[]=$is;

    }
return $ans;
}



function SubjectData($idSubject){
   $params=array('idAssignedSubject'=>$idSubject);
    $subjectInfo=getAssignedSubjectData($params);
    $data=new stdClass();
    $data=$subjectInfo->AssignedSubjectData;
     return $data;

}

function CountStudents($car){
    $p=new matriculatedStudentFilterVO;
    $p->idCareer=$car;
    $p->idCourseType='2';
    
   $params=array('matriculatedStudentFilterVO'=>$p);
    $studentscount=getCountListMatriculatedStudentIdentificationByLoadFilter($params); 
    return $studentscount;

}

function GetStudents($car,$limit,$offset){
   
    $p=new matriculatedStudentFilterVO;
    $p->idCareer=$car;;
     
     $p->offset=$offset;
     $p->limit=$limit;
    $params=array('matriculatedStudentFilterVO'=>$p);
     $res=new stdClass(); 
   
    
     $students=array();
    
    
        $ci=getListMatriculatedStudentIdentificationByLoadFilter($params);
        foreach($ci->ArrayMatriculatedStudentIdentificationByLoadFilter as $c){
        
           $students[]=$c;
         
          
  
        }
  
     
     //var_dump($students);
     return $students;
   }
function GetMatriculatedSubject($ci){
$ans=new stdClass();
$d=new stdClass();
$p=array('identification'=>$ci);
$ms=getListMatriculatedSubjectIdByStudent($p);
$ans->idS=$ms->ListMatriculatedSubjectIdByStudent->arrayId;
$d->name=$ms->ListMatriculatedSubjectIdByStudent->basicStudentData->name;
$d->lastName=$ms->ListMatriculatedSubjectIdByStudent->basicStudentData->lastName;
$d->middleName=$ms->ListMatriculatedSubjectIdByStudent->basicStudentData->middleName;

$ans->StudentData=$d;



return $ans;

}

function StudyPlanByCi($ci){
     $ans='';
    $p=array('identification'=>$ci);
     $sp=getActualCustomStudyProgramIdByStudent($p);
    $ans=$sp->ActualCustomStudyProgramIdByStudent;
    return $ans;

}









function GetStatusbyCi($ci){

    $st=getStudentFileDocentData(array('identification'=>$ci));
return $st->ArrayStudentFileDocentData->studentStatus;

}


function StudyPlanPeriodsAmount($idSp){
$p=array('idCustomStudyProgram'=>$idSp);
    $a=getCustomStudyProgramBasicData($p);
    return $a->CustomStudyProgramBasicData->periodsAmount;
}

function GetCareers($idFaculty){
$res=array();

$cod=getCodifierCareerByFacultyandCourseType( array('idFaculty'=>$idFaculty,'idCourseType'=>'2'));


foreach($cod->ArrayCodifierCareerByFacultyandCourseType as $careers){
$res[]=$careers;

}
return $res;
}

function GetFaculties(){

  $fac=getCodifierFaculty();
  $ans=$fac->ArrayCodifierFaculty;
  return $ans;  
}
 function getFacultybyCareer($career){
$faculty='';
$fac=GetFaculties();
foreach($fac as $f){
$car=GetCareers($f->id);
foreach($car as $c){
    if($c->name===$career){
$faculty=$f->name;

    }
}


 }
 return $faculty;
}
function GetIdByCareerName($careername){
    $cod=getCodifierCareer();
    $codCareer='';
    
    foreach($cod->ArrayCodifierCareer as $c){
        
        if($c->name===$careername){//aqui iria leer lo q me pongan en el moodle
        $codCareer=$c->id;
        }
    }
return $codCareer;
}

var_dump( GetMatriculatedSubject('00040187651'));

?>