<?php
include_once 'Types.php';



function getCustomStudyProgramBasicData($studyPlanId){
   $res=new stdClass();
    $ans=new customStudyProgramDTO;

    if($studyPlanId==='D'){
$ans->name='Plan de estudio D';
$ans->periodsAmount=10;

}
if($studyPlanId==='E'){
    $ans->name='Plan de estudio E';
    $ans->periodsAmount=8;
    
    }
$res->CustomStudyProgramBasicData=$ans;
    return $res;
}

function getListAssignedSubjectIdByCustomStudyProgram($idstudyPlan){
    $res=new stdClass();
    $x=array();
    $db=new SQLite3('Sigenu.db');
    $statement = $db->prepare('SELECT * FROM subjectinfo WHERE "studyPlan"=?');
    $statement->bindValue(1,$idstudyPlan);
    $result = $statement->execute();
    while($row = $result->fetchArray()) {
    $x[]=$row['subjectId'];
    }
    $result->finalize();
    //var_dump($x);
    $res->ListAssignedSubjectIdByCustomStudyProgram=$x;
    return $res;
}




?>