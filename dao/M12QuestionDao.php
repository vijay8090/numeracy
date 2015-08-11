<?php

namespace com\numeracy\Dao; 
include_once "../bo/M12QuestionBO.php"; 
use com\numeracy\BO\M12QuestionBO; 
use PDO;
class M12QuestionDao {
    private $db; 

function __construct($DB_con) 
    { 
    $this->db = $DB_con; 
    } 

private static $insertSQL = "INSERT INTO M12_QUESTION (DESCRIPTION, CREATEDON, CREATEDBY, MODIFIEDON, MODIFIEDBY, ACTIVE) VALUES (?, ?, ?, ?, ?, ?)";

private static $selectSQL = "SELECT M12QUESTIONID, DESCRIPTION, CREATEDON, CREATEDBY, MODIFIEDON, MODIFIEDBY, ACTIVE FROM M12_QUESTION ORDER BY M12QUESTIONID DESC "; 

private static $updateSQL = "UPDATE M12_QUESTION SET DESCRIPTION = ? , CREATEDON = ? , CREATEDBY = ? , MODIFIEDON = ? , MODIFIEDBY = ? , ACTIVE = ? WHERE M12QUESTIONID = ? ";

private static $deleteSQL = "DELETE FROM M12_QUESTION WHERE M12QUESTIONID = ? ";

private static $selectByIdSQL = "SELECT * FROM M12_QUESTION WHERE M12QUESTIONID = ? ";

public function create(M12QuestionBO $obj ) 
    { 
    $stmt = $this->db->prepare(self::$insertSQL); 
    $stmt->execute(array($obj->getDescription() , $obj->getCreatedon() , $obj->getCreatedby() , $obj->getModifiedon() , $obj->getModifiedby() , $obj->getActive() )); 
    return true;     
} 


public function getAll() 
    { 
    $objArray = array(); 
    $values = $this->db->query(self::$selectSQL) ; 
    if (is_array($values) || is_object($values)) 
    { 
foreach ($values as $row) { 
$obj = new M12QuestionBO(); 
$obj->setM12questionid($row['M12QUESTIONID']) ; 
$obj->setDescription($row['DESCRIPTION']) ; 
$obj->setCreatedon($row['CREATEDON']) ; 
$obj->setCreatedby($row['CREATEDBY']) ; 
$obj->setModifiedon($row['MODIFIEDON']) ; 
$obj->setModifiedby($row['MODIFIEDBY']) ; 
$obj->setActive($row['ACTIVE']) ; 

$objArray[] = $obj; 
    } 
    } 
    return $objArray; 
    } 


public function update(M12QuestionBO $obj ) 
    { 
    $stmt = $this->db->prepare(self::$updateSQL); 
    $stmt->execute(array($obj->getDescription() , $obj->getCreatedon() , $obj->getCreatedby() , $obj->getModifiedon() , $obj->getModifiedby() , $obj->getActive() , $obj->getM12questionid() )); 
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


public function getById(M12QuestionBO $obj )
    {
    
    $stmt = $this->db->prepare(self::$selectByIdSQL);
    $id = intval($obj->getM12questionid());
    $stmt->execute(array($id));
    $row = $stmt->fetch(PDO::FETCH_ASSOC); 
    
    if($row != null){ 
    $obj = new M12QuestionBO(); 
$obj->setM12questionid($row['M12QUESTIONID']) ; 
$obj->setDescription($row['DESCRIPTION']) ; 
$obj->setCreatedon($row['CREATEDON']) ; 
$obj->setCreatedby($row['CREATEDBY']) ; 
$obj->setModifiedon($row['MODIFIEDON']) ; 
$obj->setModifiedby($row['MODIFIEDBY']) ; 
$obj->setActive($row['ACTIVE']) ; 
    }
    return $obj;
    }

}
?>