<?php
include_once 'matricula_automatizada/Types.php';

function getCodifierFaculty(){
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

return $ans;
//me devuelve lo que quiero
}

function getCodifierCareer(){
    $comp=new stdClass();
    $comp->id='2';
    $comp->name="Computación";
    
    $mat=new stdClass();
    $mat->id='1';
    $mat->name='Matemática';
    
    $ans=new stdClass();
    $careers=array();
    $careers[]=$comp;
    $careers[]=$mat;
    return $careers;
    //me devuelve lo que quiero
    }



   function getCodifierCareerByFacultyandCourseType($idFaculty,$idCourseType){
    //aqui usar base d datos ,hay q crear tabla
    $res=new stdClass();
    $ar=array(); 
    $a=new codifiersDTO;
     
        if($idFaculty==='222')
       { $comp=new codifiersDTO;

        $comp->name='Computación';
        $comp->id='2';

        $mat=new CodifiersDTO;
        $mat->name='Matematica';
        $mat->id='3';
        
        $ar[]=$comp;
        $ar[]=$mat;
        
        $res->ArrayCodifierCareerByFacultyandCourseType=$ar;}
     
        else{
            $c=new codifiersDTO;

            $c->name='Contabilidad';
            $c->id='4';
    
            $m=new CodifiersDTO;
            $m->name='Economia';
            $m->id='5';
            
            $ar[]=$c;
            $ar[]=$m;
            
            $res->ArrayCodifierCareerByFacultyandCourseType=$ar;

        }
        
        
        
        return $res;

    }




$c=getCodifierFaculty();
var_dump($c);

function getCodifierCourseType(){


}





?>