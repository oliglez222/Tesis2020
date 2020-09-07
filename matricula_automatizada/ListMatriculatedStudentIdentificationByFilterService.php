<?php
function getListMatriculatedStudentIdentificationByLoadFilter($params){
   
  //borrar
  $a=array();
     $o=new stdClass();
  
     
$db=new SQLite3('Sigenu.db');
      
      
      $statement = $db->prepare('SELECT * FROM estudiante JOIN  matricula on estudiante.ci = matricula.ci WHERE "idcarrera"=?    LIMIT ? OFFSET ?');
      $statement->bindValue(1,$params['matriculatedStudentFilterVO']->idCareer);
      
      
       $statement->bindValue(2,$params['matriculatedStudentFilterVO']->limit);
      $statement->bindValue(3,$params['matriculatedStudentFilterVO']->offset);
      $result = $statement->execute();

 
 
 while($row = $result->fetchArray()) {
 $a[]=$row['ci'];
 
 }
 $o->ArrayMatriculatedStudentIdentificationByLoadFilter=$a;
 $result->finalize();
 //borrar hasta aqui
 //descomentar
// $client=new SoapClient('http://10.6.31.250:8080/sigenuws/ListMatriculatedStudentIdentificationByFilterService?wsdl',array('login'=>'ces','password' =>'gnu'));
//$o=$client->getListMatriculatedStudentIdentificationByLoadFilter($params);
 
 return $o;
  }

   function getCountListMatriculatedStudentIdentificationByLoadFilter($params){
  //borrar
   
  $count=0;
    $db=new SQLite3('Sigenu.db');
      $c=$params->idCareer;
      
      $statement = $db->prepare('SELECT COUNT(estudiante.ci) FROM estudiante JOIN  matricula on estudiante.ci = matricula.ci WHERE "idcarrera"=?   AND "courseType"=?');
      $statement->bindValue(1,$params['matriculatedStudentFilterVO']->idCareer);
      
      
      $statement->bindValue(2,$params['matriculatedStudentFilterVO']->idCourseType);
      
      $result = $statement->execute();
    
    
    while($row = $result->fetchArray()) {
      
      $count=$row[0];
      }
    $result->finalize();
//borrar hasta aqui
//descomentar
//$client=new SoapClient('http://10.6.31.250:8080/sigenuws/ListMatriculatedStudentIdentificationByFilterService?wsdl',array('login'=>'ces','password' =>'gnu'));
//$count=$client->getCountListMatriculatedStudentIdentificationByLoadFilter($params);
return $count;


   }



?>