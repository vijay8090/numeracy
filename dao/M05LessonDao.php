<?php

namespace com\numeracy\Dao; 
include_once "../bo/M05LessonBO.php"; 
use com\numeracy\BO\M05LessonBO; 
use PDO;
class M05LessonDao {
    private $db; 

function __construct($DB_con) 
    { 
    $this->db = $DB_con; 
    } 

private static $insertSQL = "INSERT INTO M05_LESSON (TITLE, LONGDESC, SHORTDESC, ADDITIONALINFO, CREATEDON, CREATEDBY, MODIFIEDON, MODIFIEDBY, M11STATUSID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

private static $selectSQL = "SELECT M05LESSONID, TITLE, LONGDESC, SHORTDESC, ADDITIONALINFO, CREATEDON, CREATEDBY, MODIFIEDON, MODIFIEDBY, M11STATUSID FROM M05_LESSON ORDER BY M05LESSONID DESC "; 

private static $updateSQL = "UPDATE M05_LESSON SET TITLE = ? , LONGDESC = ? , SHORTDESC = ? , ADDITIONALINFO = ? , CREATEDON = ? , CREATEDBY = ? , MODIFIEDON = ? , MODIFIEDBY = ? , M11STATUSID = ? WHERE M05LESSONID = ? ";

private static $deleteSQL = "DELETE FROM M05_LESSON WHERE M05LESSONID = ? ";

private static $selectByIdSQL = "SELECT * FROM M05_LESSON WHERE M05LESSONID = ? ";

public function create(M05LessonBO $obj ) 
    { 
    $stmt = $this->db->prepare(self::$insertSQL); 
    $stmt->execute(array($obj->getTitle() , $obj->getLongdesc() , $obj->getShortdesc() , $obj->getAdditionalinfo() , $obj->getCreatedon() , $obj->getCreatedby() , $obj->getModifiedon() , $obj->getModifiedby() , $obj->getM11statusid() )); 
    return true;     
} 


public function getAll() 
    { 
    $objArray = array(); 
    $values = $this->db->query(self::$selectSQL) ; 
    if (is_array($values) || is_object($values)) 
    { 
foreach ($values as $row) { 
$obj = new M05LessonBO(); 
$obj->setM05lessonid($row['M05LESSONID']) ; 
$obj->setTitle($row['TITLE']) ; 
$obj->setLongdesc($row['LONGDESC']) ; 
$obj->setShortdesc($row['SHORTDESC']) ; 
$obj->setAdditionalinfo($row['ADDITIONALINFO']) ; 
$obj->setCreatedon($row['CREATEDON']) ; 
$obj->setCreatedby($row['CREATEDBY']) ; 
$obj->setModifiedon($row['MODIFIEDON']) ; 
$obj->setModifiedby($row['MODIFIEDBY']) ; 
$obj->setM11statusid($row['M11STATUSID']) ; 

$objArray[] = $obj; 
    } 
    } 
    return $objArray; 
    } 


public function update(M05LessonBO $obj ) 
    { 
    $stmt = $this->db->prepare(self::$updateSQL); 
    $stmt->execute(array($obj->getTitle() , $obj->getLongdesc() , $obj->getShortdesc() , $obj->getAdditionalinfo() , $obj->getCreatedon() , $obj->getCreatedby() , $obj->getModifiedon() , $obj->getModifiedby() , $obj->getM11statusid() , $obj->getM05lessonid() )); 
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


public function getById(M05LessonBO $obj )
    {
    
    $stmt = $this->db->prepare(self::$selectByIdSQL);
    $id = intval($obj->getM05lessonid());
    $stmt->execute(array($id));
    $row = $stmt->fetch(PDO::FETCH_ASSOC); 
    
    if($row != null){ 
    $obj = new M05LessonBO(); 
$obj->setM05lessonid($row['M05LESSONID']) ; 
$obj->setTitle($row['TITLE']) ; 
$obj->setLongdesc($row['LONGDESC']) ; 
$obj->setShortdesc($row['SHORTDESC']) ; 
$obj->setAdditionalinfo($row['ADDITIONALINFO']) ; 
$obj->setCreatedon($row['CREATEDON']) ; 
$obj->setCreatedby($row['CREATEDBY']) ; 
$obj->setModifiedon($row['MODIFIEDON']) ; 
$obj->setModifiedby($row['MODIFIEDBY']) ; 
$obj->setM11statusid($row['M11STATUSID']) ; 
    }
    return $obj;
    }

}
?>