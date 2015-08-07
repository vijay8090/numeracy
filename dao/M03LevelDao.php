<?php

namespace com\numeracy\Dao; 
include_once "../bo/M03LevelBO.php"; 
use com\numeracy\BO\M03LevelBO; 
use PDO;
class M03LevelDao {
    private $db; 

function __construct($DB_con) 
    { 
    $this->db = $DB_con; 
    } 

private static $insertSQL = "INSERT INTO M03_LEVEL (LABEL, M11STATUSID, CREATEDON, CREATEDBY, MODIFIEDON, MODIFIEDBY) VALUES (?, ?, ?, ?, ?, ?)";

private static $selectSQL = "SELECT M03LEVELID, LABEL, M11STATUSID, CREATEDON, CREATEDBY, MODIFIEDON, MODIFIEDBY FROM M03_LEVEL ORDER BY M03LEVELID DESC "; 

private static $updateSQL = "UPDATE M03_LEVEL SET LABEL = ? , M11STATUSID = ? , CREATEDON = ? , CREATEDBY = ? , MODIFIEDON = ? , MODIFIEDBY = ? WHERE M03LEVELID = ? ";

private static $deleteSQL = "DELETE FROM M03_LEVEL WHERE M03LEVELID = ? ";

private static $selectByIdSQL = "SELECT * FROM M03_LEVEL WHERE M03LEVELID = ? ";

public function create(M03LevelBO $obj ) 
    { 
    $stmt = $this->db->prepare(self::$insertSQL); 
    $stmt->execute(array($obj->getLabel() , $obj->getM11statusid() , $obj->getCreatedon() , $obj->getCreatedby() , $obj->getModifiedon() , $obj->getModifiedby() )); 
    return true;     
} 


public function getAll() 
    { 
    $objArray = array(); 
    $values = $this->db->query(self::$selectSQL) ; 
    if (is_array($values) || is_object($values)) 
    { 
foreach ($values as $row) { 
$obj = new M03LevelBO(); 
$obj->setM03levelid($row['M03LEVELID']) ; 
$obj->setLabel($row['LABEL']) ; 
$obj->setM11statusid($row['M11STATUSID']) ; 
$obj->setCreatedon($row['CREATEDON']) ; 
$obj->setCreatedby($row['CREATEDBY']) ; 
$obj->setModifiedon($row['MODIFIEDON']) ; 
$obj->setModifiedby($row['MODIFIEDBY']) ; 

$objArray[] = $obj; 
    } 
    } 
    return $objArray; 
    } 


public function update(M03LevelBO $obj ) 
    { 
    $stmt = $this->db->prepare(self::$updateSQL); 
    $stmt->execute(array($obj->getLabel() , $obj->getM11statusid() , $obj->getCreatedon() , $obj->getCreatedby() , $obj->getModifiedon() , $obj->getModifiedby() , $obj->getM03levelid() )); 
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


public function getById(M03LevelBO $obj )
    {
    
    $stmt = $this->db->prepare(self::$selectByIdSQL);
    $id = intval($obj->getM03levelid());
    $stmt->execute(array($id));
    $row = $stmt->fetch(PDO::FETCH_ASSOC); 
    
    if($row != null){ 
    $obj = new M03LevelBO(); 
$obj->setM03levelid($row['M03LEVELID']) ; 
$obj->setLabel($row['LABEL']) ; 
$obj->setM11statusid($row['M11STATUSID']) ; 
$obj->setCreatedon($row['CREATEDON']) ; 
$obj->setCreatedby($row['CREATEDBY']) ; 
$obj->setModifiedon($row['MODIFIEDON']) ; 
$obj->setModifiedby($row['MODIFIEDBY']) ; 
    }
    return $obj;
    }

}
?>