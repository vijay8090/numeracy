<?php

namespace com\numeracy\Dao; 
include_once "../bo/M02CategoryBO.php"; 
use com\numeracy\BO\M02CategoryBO; 
use PDO;
class M02CategoryDao {
    private $db; 

function __construct($DB_con) 
    { 
    $this->db = $DB_con; 
    } 

private static $insertSQL = "INSERT INTO M02_CATEGORY (LABEL, M11STATUSID, STARTAGE, ENDAGE, GENDER, CREATEDON, CREATEDBY, MODIFIEDON, MODIFIEDBY) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

private static $selectSQL = "SELECT M02CATEGORYID, LABEL, M11STATUSID, STARTAGE, ENDAGE, GENDER, CREATEDON, CREATEDBY, MODIFIEDON, MODIFIEDBY FROM M02_CATEGORY ORDER BY M02CATEGORYID DESC "; 

private static $updateSQL = "UPDATE M02_CATEGORY SET LABEL = ? , M11STATUSID = ? , STARTAGE = ? , ENDAGE = ? , GENDER = ? , CREATEDON = ? , CREATEDBY = ? , MODIFIEDON = ? , MODIFIEDBY = ? WHERE M02CATEGORYID = ? ";

private static $deleteSQL = "DELETE FROM M02_CATEGORY WHERE M02CATEGORYID = ? ";

private static $selectByIdSQL = "SELECT * FROM M02_CATEGORY WHERE M02CATEGORYID = ? ";

public function create(M02CategoryBO $obj ) 
    { 
    $stmt = $this->db->prepare(self::$insertSQL); 
    $stmt->execute(array($obj->getLabel() , $obj->getM11statusid() , $obj->getStartage() , $obj->getEndage() , $obj->getGender() , $obj->getCreatedon() , $obj->getCreatedby() , $obj->getModifiedon() , $obj->getModifiedby() )); 
    return true;     
} 


public function getAll() 
    { 
    $objArray = array(); 
    $values = $this->db->query(self::$selectSQL) ; 
    if (is_array($values) || is_object($values)) 
    { 
foreach ($values as $row) { 
$obj = new M02CategoryBO(); 
$obj->setM02categoryid($row['M02CATEGORYID']) ; 
$obj->setLabel($row['LABEL']) ; 
$obj->setM11statusid($row['M11STATUSID']) ; 
$obj->setStartage($row['STARTAGE']) ; 
$obj->setEndage($row['ENDAGE']) ; 
$obj->setGender($row['GENDER']) ; 
$obj->setCreatedon($row['CREATEDON']) ; 
$obj->setCreatedby($row['CREATEDBY']) ; 
$obj->setModifiedon($row['MODIFIEDON']) ; 
$obj->setModifiedby($row['MODIFIEDBY']) ; 

$objArray[] = $obj; 
    } 
    } 
    return $objArray; 
    } 


public function update(M02CategoryBO $obj ) 
    { 
    $stmt = $this->db->prepare(self::$updateSQL); 
    $stmt->execute(array($obj->getLabel() , $obj->getM11statusid() , $obj->getStartage() , $obj->getEndage() , $obj->getGender() , $obj->getCreatedon() , $obj->getCreatedby() , $obj->getModifiedon() , $obj->getModifiedby() , $obj->getM02categoryid() )); 
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


public function getById(M02CategoryBO $obj )
    {
    
    $stmt = $this->db->prepare(self::$selectByIdSQL);
    $id = intval($obj->getM02categoryid());
    $stmt->execute(array($id));
    $row = $stmt->fetch(PDO::FETCH_ASSOC); 
    
    if($row != null){ 
    $obj = new M02CategoryBO(); 
$obj->setM02categoryid($row['M02CATEGORYID']) ; 
$obj->setLabel($row['LABEL']) ; 
$obj->setM11statusid($row['M11STATUSID']) ; 
$obj->setStartage($row['STARTAGE']) ; 
$obj->setEndage($row['ENDAGE']) ; 
$obj->setGender($row['GENDER']) ; 
$obj->setCreatedon($row['CREATEDON']) ; 
$obj->setCreatedby($row['CREATEDBY']) ; 
$obj->setModifiedon($row['MODIFIEDON']) ; 
$obj->setModifiedby($row['MODIFIEDBY']) ; 
    }
    return $obj;
    }

}
?>