<?php
function getAssignedSubjectData($idasig){
    $a=new stdClass();
    $s=new stdClass();
    $db=new SQLite3('Sigenu.db');
        $statement = $db->prepare('SELECT * FROM subjectinfo WHERE "subjectId"=?');
        $statement->bindValue(1,$idasig);
        $result = $statement->execute();
        while($row = $result->fetchArray()) {
        $s->name=$row['subjectName'];
        $s->year=$row['year'];
        
        }
        $result->finalize();
    
    
    $a->AssignedSubjectData=$s;
    //var_dump($a->AssignedSubjectData->name);
    return $a;
    }



?>