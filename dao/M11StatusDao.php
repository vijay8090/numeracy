<?php

namespace com\numeracy\Dao; 
include_once "../bo/M11StatusBO.php"; 
use com\numeracy\BO\M11StatusBO; 
use PDO;
class M11StatusDao {
    private $db; 

function __construct($DB_con) 
    { 
    $this->db = $DB_con; 
    } 

private static $insertSQL = "INSERT INTO M11_STATUS (CODE, LABEL, CREATEDON, CREATEBY, MODIFIEDON, MODIFIEDBY) VALUES (?, ?, ?, ?, ?, ?)";

private static $selectSQL = "SELECT M11STATUSID, CODE, LABEL, CREATEDON, CREATEBY, MODIFIEDON, MODIFIEDBY FROM M11_STATUS ORDER BY M11STATUSID DESC "; 

private static $updateSQL = "UPDATE M11_STATUS SET CODE = ? , LABEL = ? , CREATEDON = ? , CREATEBY = ? , MODIFIEDON = ? , MODIFIEDBY = ? WHERE M11STATUSID = ? ";

private static $deleteSQL = "DELETE FROM M11_STATUS WHERE M11STATUSID = ? ";

private static $selectByIdSQL = "SELECT * FROM M11_STATUS WHERE M11STATUSID = ? ";

public function create(M11StatusBO $obj ) 
    { 
    $stmt = $this->db->prepare(self::$insertSQL); 
    $stmt->execute(array($obj->getCode() , $obj->getLabel() , $obj->getCreatedon() , $obj->getCreateby() , $obj->getModifiedon() , $obj->getModifiedby() )); 
    return true;     
} 


public function getAll() 
    { 
    $objArray = array(); 
    $values = $this->db->query(self::$selectSQL) ; 
    if (is_array($values) || is_object($values)) 
    { 
foreach ($values as $row) { 
$obj = new M11StatusBO(); 
$obj->setM11statusid($row['M11STATUSID']) ; 
$obj->setCode($row['CODE']) ; 
$obj->setLabel($row['LABEL']) ; 
$obj->setCreatedon($row['CREATEDON']) ; 
$obj->setCreateby($row['CREATEBY']) ; 
$obj->setModifiedon($row['MODIFIEDON']) ; 
$obj->setModifiedby($row['MODIFIEDBY']) ; 

$objArray[] = $obj; 
    } 
    } 
    return $objArray; 
    } 


public function update(M11StatusBO $obj ) 
    { 
    $stmt = $this->db->prepare(self::$updateSQL); 
    $stmt->execute(array($obj->getCode() , $obj->getLabel() , $obj->getCreatedon() , $obj->getCreateby() , $obj->getModifiedon() , $obj->getModifiedby() , $obj->getM11statusid() )); 
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


public function getById(M11StatusBO $obj )
    {
    
    $stmt = $this->db->prepare(self::$selectByIdSQL);
    $id = intval($obj->getM11statusid());
    $stmt->execute(array($id));
    $row = $stmt->fetch(PDO::FETCH_ASSOC); 
    
    if($row != null){ 
    $obj = new M11StatusBO(); 
$obj->setM11statusid($row['M11STATUSID']) ; 
$obj->setCode($row['CODE']) ; 
$obj->setLabel($row['LABEL']) ; 
$obj->setCreatedon($row['CREATEDON']) ; 
$obj->setCreateby($row['CREATEBY']) ; 
$obj->setModifiedon($row['MODIFIEDON']) ; 
$obj->setModifiedby($row['MODIFIEDBY']) ; 
    }
    return $obj;
    }

}
?>