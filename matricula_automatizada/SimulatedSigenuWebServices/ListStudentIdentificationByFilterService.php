<?php
function getListStudentIdentificationByLoadFilter($params){
    $a=array();
     $o=new stdClass();
  
     $l=$params->offset.','.$params->limit;
  //var_dump($l);
     $db=new SQLite3('Sigenu.db');
      $c=$params->idCareer;
      //echo $c;
      $statement = $db->prepare('SELECT * FROM studentsinfo WHERE "careerid"=? AND "facultyid"=? AND "status"=? LIMIT ? OFFSET ?');
      $statement->bindValue(1,$params->idCareer);
      $statement->bindValue(2,$params->idFaculty);
      $statement->bindValue(3,$params->idStudentStatus);
       $statement->bindValue(4,$params->limit);
      $statement->bindValue(5,$params->offset);
      $result = $statement->execute();

 
 
 while($row = $result->fetchArray()) {
 $a[]=$row['ci'];
 //var_dump($row['ci']);
 }
 $o->ListStudentIdentificationByLoadFilter=$a;
 $result->finalize();
 //var_dump($o->ListStudentIdentificationByLoadFilter);
 return $o;
  }

   function getCountListMatriculatedStudentIdentificationByLoadFilter(){
    $count=0;
    $db=new SQLite3('Sigenu.db');
    $statement = $db->prepare('SELECT COUNT("ci") FROM studentsinfo');
    $result = $statement->execute();
     
    
    
    while($row = $result->fetchArray()) {
      
      $count=$row[0];
      }
    $result->finalize();

return $count;


   }

//var_dump(getCountListMatriculatedStudentIdentificationByLoadFilter());

// $p->idCareer='2';
// $p->idFaculty='222';
// $p->offset=2;
// $p->limit=6;
// $p->idStudentStatus='01';

//  getListStudentIdentificationByLoadFilter($p);


?>