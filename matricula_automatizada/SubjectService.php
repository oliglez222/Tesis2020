<?php
function getAssignedSubjectData($params){
   //borrar
    $a=new stdClass();
    $s=new stdClass();
    $db=new SQLite3('Sigenu.db');
        $statement = $db->prepare('SELECT * FROM asignatura WHERE "idasignatura"=?');
        $statement->bindValue(1,$params['idAssignedSubject']);
        $result = $statement->execute();
        while($row = $result->fetchArray()) {
        $s->name=$row['nombre'];
        $s->year=$row['año'];
        
        
        }
        $result->finalize();
    
    
   
   
     
  
  

   
        $a->AssignedSubjectData=$s;
    //borrar hasta aqui
    //descomentar
   // $client=new SoapClient('http://10.6.31.250:8080/sigenuws/SubjectService?wsdl',array('login'=>'ces','password' =>'gnu'));
//$a=$client->getAssignedSubjectData();
    return $a;
    }

//var_dump(getAssignedSubjectData('Ee'));

?>