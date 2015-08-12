<?php

namespace com\numeracy\Dao; 
include_once "../bo/M14LoginBO.php"; 
use com\numeracy\BO\M14LoginBO; 
use PDO;
class M14LoginDao {
    private $db; 

function __construct($DB_con) 
    { 
    $this->db = $DB_con; 
    } 

private static $insertSQL = "INSERT INTO M14_LOGIN (USERNAME, PASSWORD, CREATEDON, CREATEDBY, MODIFIEDON, MODIFIEDBY) VALUES (?, ?, ?, ?, ?, ?)";

private static $selectSQL = "SELECT M14LOGINID, USERNAME, PASSWORD, CREATEDON, CREATEDBY, MODIFIEDON, MODIFIEDBY FROM M14_LOGIN ORDER BY M14LOGINID DESC "; 

private static $updateSQL = "UPDATE M14_LOGIN SET USERNAME = ? , PASSWORD = ? , CREATEDON = ? , CREATEDBY = ? , MODIFIEDON = ? , MODIFIEDBY = ? WHERE M14LOGINID = ? ";

private static $deleteSQL = "DELETE FROM M14_LOGIN WHERE M14LOGINID = ? ";

private static $selectByIdSQL = "SELECT * FROM M14_LOGIN WHERE M14LOGINID = ? ";

public function create(M14LoginBO $obj ) 
    { 
    $stmt = $this->db->prepare(self::$insertSQL); 
    $stmt->execute(array($obj->getUsername() , $obj->getPassword() , $obj->getCreatedon() , $obj->getCreatedby() , $obj->getModifiedon() , $obj->getModifiedby() )); 
    return true;     
} 


public function getAll() 
    { 
    $objArray = array(); 
    $values = $this->db->query(self::$selectSQL) ; 
    if (is_array($values) || is_object($values)) 
    { 
foreach ($values as $row) { 
$obj = new M14LoginBO(); 
$obj->setM14loginid($row['M14LOGINID']) ; 
$obj->setUsername($row['USERNAME']) ; 
$obj->setPassword($row['PASSWORD']) ; 
$obj->setCreatedon($row['CREATEDON']) ; 
$obj->setCreatedby($row['CREATEDBY']) ; 
$obj->setModifiedon($row['MODIFIEDON']) ; 
$obj->setModifiedby($row['MODIFIEDBY']) ; 

$objArray[] = $obj; 
    } 
    } 
    return $objArray; 
    } 


public function update(M14LoginBO $obj ) 
    { 
    $stmt = $this->db->prepare(self::$updateSQL); 
    $stmt->execute(array($obj->getUsername() , $obj->getPassword() , $obj->getCreatedon() , $obj->getCreatedby() , $obj->getModifiedon() , $obj->getModifiedby() , $obj->getM14loginid() )); 
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


public function getById(M14LoginBO $obj )
    {
    
    $stmt = $this->db->prepare(self::$selectByIdSQL);
    $id = intval($obj->getM14loginid());
    $stmt->execute(array($id));
    $row = $stmt->fetch(PDO::FETCH_ASSOC); 
    
    if($row != null){ 
    $obj = new M14LoginBO(); 
$obj->setM14loginid($row['M14LOGINID']) ; 
$obj->setUsername($row['USERNAME']) ; 
$obj->setPassword($row['PASSWORD']) ; 
$obj->setCreatedon($row['CREATEDON']) ; 
$obj->setCreatedby($row['CREATEDBY']) ; 
$obj->setModifiedon($row['MODIFIEDON']) ; 
$obj->setModifiedby($row['MODIFIEDBY']) ; 
    }
    return $obj;
    }

}
?>
