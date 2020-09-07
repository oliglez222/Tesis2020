<?php
include_once 'Types.php';



function getListCustomStudyProgramIdByFilter($params){
//borrar aqui
$res=new stdClass();
$x=array();
$db=new SQLite3('Sigenu.db');
     $statement = $db->prepare('SELECT * FROM plan_de_estudio  WHERE "idcareer"=? ' );
     $statement->bindValue(1,$params['generalPageFilterVO']->idCareer);
     $result = $statement->execute();
     while($row = $result->fetchArray()) {
         
         $x[]=$row['idplan'];

    
     }
     $result->finalize();


 $res->ArrayListCustomStudyProgramIdByFilter=$x;
// //borrar hasta aqui
// //descomentar
//$client=new SoapClient('http://10.6.31.250:8080/sigenuws/ListStudyProgramIdByFilterService?wsdl',array('login'=>'ces','password' =>'gnu'));
//$fac=$client->getListCustomStudyProgramIdByFilter($params);

return $res;


}

 








?>