<?php
include_once 'Types.php';


//paso 1 obtener los identificadores del plan de estudio segun los filtros
function getListCustomStudyProgramIdByFilter($generalPageFilter){
$res=new stdClass();


$x=array('D','E');

$res->ArrayListCustomStudyProgramIdByFilter=$x;
return $res;


}

 

//----------------paso 2 ,obtener los identificadores de las asignaturas asignadas




//-------------paso 3 ,obtener los datos q me interesen de las asignaturas
function getAssignedSubjectData($idasig){
$a=new stdClass();
$s=new stdClass();
$db=new SQLite3('Sigenu.db');
    $statement = $db->prepare('SELECT * FROM subjectinfo WHERE "subjectId"=?');
    $statement->bindValue(1,$idasig);
    $result = $statement->execute();
    while($row = $result->fetchArray()) {
    $s->name=$row['subjectName'];
    $s->year=$row['year'];
    
    }
    $result->finalize();


$a->AssignedSubjectData=$s;
//var_dump($a->AssignedSubjectData->name);
return $a;
}

 //$a=getAssignedSubjectData('E');
 
//var_dump($a->AssignedSubjectData);



?>