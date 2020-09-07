<?php

include_once 'Types.php';

function getActualCustomStudyProgramIdByStudent($ci){
    //Obtener el identificador del plan de estudio actual de un estudiante
    //retorna Arreglo de identificador de plan de estudio ArrayId[]
    $identificator='';   
    $db=new SQLite3('Sigenu.db');
        $statement = $db->prepare('SELECT * FROM studentsinfo WHERE "ci"=?');
        $res=new stdClass();
        $statement->bindValue(1,$ci);
        $result = $statement->execute();
        while($row = $result->fetchArray()) {
        $identificator=$row['studyPlan'];
         
         
        }
        $res->ActualCustomStudyProgramIdByStudent=$identificator;
        $result->finalize();
        return $res;//este en verdad es como el objeto q devuelve el metodo d abajo.Hacerlo
    
     }

     function getListMatriculatedSubjectIdByStudent($ci){
        //Obtener el listado de identificadores de las asignaturas matriculadas de un estudiante
        //retorna Arreglo de identificadores de las asignaturas matriculadas de un estudiante ArrayId[]
        $ans=array();
        $res=new stdClass();
        $x=new arrayIdData;
        $identificators=array();
        //ar
        $db=new SQLite3('Sigenu.db');
            $statement = $db->prepare('SELECT * FROM studentSubject WHERE "ci"=?');
            
            $statement->bindValue(1,$ci);
            $result = $statement->execute();
            while($row = $result->fetchArray()) {
            $identificators[]=$row['subjectid'];
             
             
            }
            
            $result->finalize();
        $x->arrayId=$identificators;//esto tiene q ser un array
        $st=new basicStudentDTO;
        $statement = $db->prepare('SELECT * FROM studentsinfo WHERE "ci"=?');
            
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
        
        //var_dump($ans);
        
        
        $res->ListMatriculatedSubjectIdByStudent=$ans;
        //var_dump($res->ListMatriculatedSubjectIdByStudent->arrayId);
        return $res;
        }


?>