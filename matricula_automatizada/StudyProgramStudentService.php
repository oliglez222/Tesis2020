<?php

include_once 'Types.php';

function getActualCustomStudyProgramIdByStudent($params){
    //borrar
    $identificator='';   
    $db=new SQLite3('Sigenu.db');
        $statement = $db->prepare('SELECT * FROM plan_estudiante WHERE "ci"=?');
        $res=new stdClass();
        $statement->bindValue(1,$params['identification']);
        $result = $statement->execute();
        while($row = $result->fetchArray()) {
        $identificator=$row['idplan'];
         
         
        }
        $res->ActualCustomStudyProgramIdByStudent=$identificator;
        $result->finalize();
       //borrar hasta aqui
       //descomentar
       //$client=new SoapClient('http://10.6.31.250:8080/sigenuws/StudyProgramStudentService?wsdl',array('login'=>'ces','password' =>'gnu'));
        //$res=$client->getActualCustomStudyProgramIdByStudent($params);
        return $res;
    
     }

     function getListMatriculatedSubjectIdByStudent($params){
       //borrar
        $ans=array();
        $res=new stdClass();
        $x=new arrayIdData;
        $identificators=array();
        //ar
        $db=new SQLite3('Sigenu.db');
            $statement = $db->prepare('SELECT * FROM cursa WHERE "ci"=?');
            
            $statement->bindValue(1,$params['identification']);
            $result = $statement->execute();
            while($row = $result->fetchArray()) {
            $identificators[]=$row['idasignatura'];
             
             
            }
            
            $result->finalize();
        $x->arrayId=$identificators;
        $st=new basicStudentDTO;
        $statement = $db->prepare('SELECT * FROM estudiante WHERE "ci"=?');
            
            $statement->bindValue(1,$ci);
            $result = $statement->execute();
            while($row = $result->fetchArray()) {
                $st->name= $row['name'];
                $st->lastName=$row['lastName'];
                $st->middleName=$row['middleName'];
             
            }
            
            $result->finalize();
        
        
        
        $x->basicStudentData=$st;
        $ans=$x;
        
        
        
        
        $res->ListMatriculatedSubjectIdByStudent=$ans;
        //borrar hasta aqui
        //descomentar
        //$client=new SoapClient('http://10.6.31.250:8080/sigenuws/StudyProgramStudentService?wsdl',array('login'=>'ces','password' =>'gnu'));
        //$res=$client->getListMatriculatedSubjectIdByStudent($params);
        return $res;
        }


?>