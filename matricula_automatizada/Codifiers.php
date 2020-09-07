<?php
include_once 'Types.php';

function getCodifierFaculty(){
   //borrar
    $faculties=array();
    $db=new SQLite3('Sigenu.db');
    $statement = $db->prepare('SELECT * FROM facultad ');
    
    $result = $statement->execute();
   

    while($row = $result->fetchArray()) {
    $f=new stdClass();
    $f->id=$row['idfacultad'];
    $f->name=$row['nombre'];
    $faculties[]=$f;    
}
    $result->finalize();   

$ans=new stdClass();
$ans->ArrayCodifierFaculty=$faculties;
//borrar hasta aqui
//descomentar 
//$client=new SoapClient('http://10.6.31.250:8080/sigenuws/CodifiersService?wsdl',array('login'=>'ces','password' =>'gnu'));
//$ans=$client->getCodifierFaculty();

return $ans;

}

function getCodifierCareer(){
  //borrar
    $db=new SQLite3('Sigenu.db');
    $statement = $db->prepare('SELECT * FROM carrera ');
    
    $result = $statement->execute();
   
    $careers=array();
    while($row = $result->fetchArray()) {
    $f=new stdClass();
    $f->id=$row['idcarrera'];
    $f->name=$row['nombre'];
    $careers[]=$f;
}
   $result->finalize();   

  
    
    
    $ans=new stdClass();
    $ans->ArrayCodifierCareer=$careers;
    //borrar hasta aqui
    
    //descomentar
//$client=new SoapClient('http://10.6.31.250:8080/sigenuws/CodifiersService?wsdl',array('login'=>'ces','password' =>'gnu'));
//$ans=$client->getCodifierCareer();
    return $ans;
    
    }



   function getCodifierCareerByFacultyandCourseType($params){
   //borrar
    $ar=array(); 
    $res=new stdClass();
    $x=new  codifiersDTO;
    $db=new SQLite3('Sigenu.db');
    $statement = $db->prepare('SELECT * FROM carrera JOIN pertenencia on carrera.idcarrera = pertenencia.idcarrera WHERE "idfacultad" ==?');
    $statement->bindValue(1,$params['idFaculty']);
    $result = $statement->execute();
    
    while($row = $result->fetchArray()) {
    $x=new  codifiersDTO;
    $x->name=$row['nombre'];
    $x->id=$row['idcarrera'];
    $ar[]=$x;   
}
    $result->finalize();
   
    $res->ArrayCodifierCareerByFacultyandCourseType=$ar;
   //borrar hasta aqui
   //descomentar
// $client=new SoapClient('http://10.6.31.250:8080/sigenuws/CodifiersService?wsdl',array('login'=>'ces','password' =>'gnu'));
//$res=$client->getCodifierCareerByFacultyandCourseType($params);
    
    
        
        
        return $res;

    }





function getCodifierCourseType(){


}





?>