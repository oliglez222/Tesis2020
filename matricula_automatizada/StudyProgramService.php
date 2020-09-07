<?php
include_once 'Types.php';



function getCustomStudyProgramBasicData($params){
  //borrar
    $res=new stdClass();
    $ans=new customStudyProgramDTO;

    $db=new SQLite3('Sigenu.db');
    $statement = $db->prepare('SELECT * FROM plan_de_estudio WHERE "idplan"=?');
    $statement->bindValue(1,$params['idCustomStudyProgram']);
    $result = $statement->execute();
    while($row = $result->fetchArray()) {
    $ans->name=$row['nombre'];
    $ans->periodsAmount=$row['yearsamount'];
    }
    $result->finalize();
   
   
   
   
   
   
$res->CustomStudyProgramBasicData=$ans;
//borrar hasta aqui
//descomentar  
//$client=new SoapClient('http://10.6.31.250:8080/sigenuws/StudyProgramService?wsdl',array('login'=>'ces','password' =>'gnu'));
//$res=$client->getCustomStudyProgramBasicData($params);
return $res;
}

function getListAssignedSubjectIdByCustomStudyProgram($params){
  //borrar
    $res=new stdClass();
    $x=array();
    $db=new SQLite3('Sigenu.db');
    $statement = $db->prepare('SELECT * FROM corresponde WHERE "idplan"=?');
    $statement->bindValue(1,$params['idCustomStudyProgram']);
    $result = $statement->execute();
    while($row = $result->fetchArray()) {
    $x[]=$row['idasignatura'];
    }
    $result->finalize();
    
    $res->ListAssignedSubjectIdByCustomStudyProgram=$x;
   //borrar aqui
   //descomentar
   //$client=new SoapClient('http://10.6.31.250:8080/sigenuws/StudyProgramService?wsdl',array('login'=>'ces','password' =>'gnu'));
//$res=$client->getListAssignedSubjectIdByCustomStudyProgram($params);
    return $res;
}




?>