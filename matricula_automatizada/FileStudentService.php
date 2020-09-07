<?php
require_once 'Types.php';

function getStudentFileDocentData($ci){
  //borrar
    $ans=new stdClass();
    $res=new docentDataStudentDTO;
    $x='';
    $db=new SQLite3('Sigenu.db');
    $statement = $db->prepare('SELECT * FROM estudiante WHERE "ci"=?');
    $statement->bindValue(1,$ci);
    $result = $statement->execute();
    while($row = $result->fetchArray()) {
    $res->studentStatus=$row['status'];
    
    }
    $result->finalize();
    $ans->ArrayStudentFileDocentData=$res;
   //descomentar
   // $client=new SoapClient('http://10.6.31.250:8080/sigenuws/FileStudentService?wsdl',array('login'=>'ces','password' =>'gnu'));
   // $ans=$client->getStudentFileDocentData($ci);
    return $ans;


}




//$a=getStudentFileDocentData('00040187651');
//var_dump($a);


?>