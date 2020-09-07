<?php
require_once 'Types.php';

function getStudentFileDocentData($ci){
   //borrar
    $res=new docentDataStudentDTO;
    $x='';
    $db=new SQLite3('Sigenu.db');
    $statement = $db->prepare('SELECT * FROM estudiante WHERE "ci"=?');
    $statement->bindValue(1,$ci['identification']);
    $result = $statement->execute();
    while($row = $result->fetchArray()) {
    $x=$row['status'];
    var_dump($row);
    }
    $result->finalize();
    $res->ArrayStudentFileDocentData=$x;
    //borrar hasta aqui
    //descomentar
   // $client=new SoapClient('http://10.6.31.250:8080/sigenuws/FileStudentService?wsdl',array('login'=>'ces','password' =>'gnu'));
   // $fac=$client->getStudentFileDocentData($ci);
    return $res;


}




//$a=getStudentFileDocentData('00040187651');
//var_dump($a);
//Quickie();

?>