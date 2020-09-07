<?php

class assignedSubjectDTO{
   
public $analyticalProgram;
public $discipline;
public $evaluationType;
public $hours;
public $name;
public $period;
public $subjectType;
public $topicsProgram;
public $year;
  
}
class arrayIdData{

    public $arrayId;
    public $basicStudentData;
   
   }
   
   class basicStudentDTO{
       
       public $identification;
       public  $lastName;
       public $middleName;
       public   $name;
           
   
   }
   
  
   
   
   
   
   
   
    
           
   class pageFilterVO {

    public $offset;
    public $limit;
   }
   
   class generalPageFilterVO extends pageFilterVO {


    public $idCareer;
    public $idCourseType;
    public $idFaculty;
    public $idGroup;
    public$idTownUniversity;
    public $idYear;
    
    
    }
   
   class matriculatedStudentFilterVO extends generalPageFilterVO {
    public $idAcademicSituation;
    public $idCountry;
    public $idEntrySource;
    public $idMilitarType;
    public $idPoliticOrg;
    public $idProvince;
    public $idScholasticOrigin;
    public $idSex;
    public $idStudentType;
    public $idTown;
    
    
        
    }
   class studentPageFilterVO extends matriculatedStudentFilterVO{
        
    public $idStudentStatus;
       
       
    }    

class docentDataStudentDTO{

public $studentStatus;

}
class customStudyProgramDTO{
  public $career;
  public $courseInitial;
  public $course_type;
  public $description;
  public $name;
 public  $periodsAmount;



}

class codifiersDTO{
public $id;
public $name;

}




?>