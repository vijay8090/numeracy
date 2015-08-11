<?php

namespace com\numeracy\Dao; 
include_once "../bo/M13AnswerBO.php"; 
use com\numeracy\BO\M13AnswerBO; 
use PDO;
class M13AnswerDao {
    private $db; 

function __construct($DB_con) 
    { 
    $this->db = $DB_con; 
    } 

private static $insertSQL = "INSERT INTO M13_ANSWER (DESCRIPTION, CREATEDON, CREATEDBY, MODIFIEDON, MODIFIEDBY, ACTIVE, TEXTANSWER) VALUES (?, ?, ?, ?, ?, ?, ?)";

private static $selectSQL = "SELECT M13ANSWERID, DESCRIPTION, CREATEDON, CREATEDBY, MODIFIEDON, MODIFIEDBY, ACTIVE, TEXTANSWER FROM M13_ANSWER ORDER BY M13ANSWERID DESC "; 

private static $updateSQL = "UPDATE M13_ANSWER SET DESCRIPTION = ? , CREATEDON = ? , CREATEDBY = ? , MODIFIEDON = ? , MODIFIEDBY = ? , ACTIVE = ? , TEXTANSWER = ? WHERE M13ANSWERID = ? ";

private static $deleteSQL = "DELETE FROM M13_ANSWER WHERE M13ANSWERID = ? ";

private static $selectByIdSQL = "SELECT * FROM M13_ANSWER WHERE M13ANSWERID = ? ";

public function create(M13AnswerBO $obj ) 
    { 
    $stmt = $this->db->prepare(self::$insertSQL); 
    $stmt->execute(array($obj->getDescription() , $obj->getCreatedon() , $obj->getCreatedby() , $obj->getModifiedon() , $obj->getModifiedby() , $obj->getActive() , $obj->getTextanswer() )); 
    return true;     
} 


public function getAll() 
    { 
    $objArray = array(); 
    $values = $this->db->query(self::$selectSQL) ; 
    if (is_array($values) || is_object($values)) 
    { 
foreach ($values as $row) { 
$obj = new M13AnswerBO(); 
$obj->setM13answerid($row['M13ANSWERID']) ; 
$obj->setDescription($row['DESCRIPTION']) ; 
$obj->setCreatedon($row['CREATEDON']) ; 
$obj->setCreatedby($row['CREATEDBY']) ; 
$obj->setModifiedon($row['MODIFIEDON']) ; 
$obj->setModifiedby($row['MODIFIEDBY']) ; 
$obj->setActive($row['ACTIVE']) ; 
$obj->setTextanswer($row['TEXTANSWER']) ; 

$objArray[] = $obj; 
    } 
    } 
    return $objArray; 
    } 


public function update(M13AnswerBO $obj ) 
    { 
    $stmt = $this->db->prepare(self::$updateSQL); 
    $stmt->execute(array($obj->getDescription() , $obj->getCreatedon() , $obj->getCreatedby() , $obj->getModifiedon() , $obj->getModifiedby() , $obj->getActive() , $obj->getTextanswer() , $obj->getM13answerid() )); 
    return true; 
    } 


public function delete(array $ids) 
    { 
    if (is_array($ids) || is_object($ids)) 
    { 
    foreach ($ids as $id){ 
    
    $stmt = $this->db->prepare(self::$deleteSQL); 
    $stmt->execute(array($id)); 
    } 
    } 
    
    return true; 
} 


public function getById(M13AnswerBO $obj )
    {
    
    $stmt = $this->db->prepare(self::$selectByIdSQL);
    $id = intval($obj->getM13answerid());
    $stmt->execute(array($id));
    $row = $stmt->fetch(PDO::FETCH_ASSOC); 
    
    if($row != null){ 
    $obj = new M13AnswerBO(); 
$obj->setM13answerid($row['M13ANSWERID']) ; 
$obj->setDescription($row['DESCRIPTION']) ; 
$obj->setCreatedon($row['CREATEDON']) ; 
$obj->setCreatedby($row['CREATEDBY']) ; 
$obj->setModifiedon($row['MODIFIEDON']) ; 
$obj->setModifiedby($row['MODIFIEDBY']) ; 
$obj->setActive($row['ACTIVE']) ; 
$obj->setTextanswer($row['TEXTANSWER']) ; 
    }
    return $obj;
    }

}
?>