<?php

namespace com\numeracy\Dao; 
include_once "../bo/M04ChapterBO.php"; 
use com\numeracy\BO\M04ChapterBO; 
use PDO;
class M04ChapterDao {
    private $db; 

function __construct($DB_con) 
    { 
    $this->db = $DB_con; 
    } 

private static $insertSQL = "INSERT INTO M04_CHAPTER (CHAPTERNAME, CHAPTERNUMBER, M11STATUSID, DESC, SHORTDESC, CREATEDON, CREATEDBY, MODIFIEDON, MODIFIEDBY) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

private static $selectSQL = "SELECT M04CHAPTERID, CHAPTERNAME, CHAPTERNUMBER, M11STATUSID, DESC, SHORTDESC, CREATEDON, CREATEDBY, MODIFIEDON, MODIFIEDBY FROM M04_CHAPTER ORDER BY M04CHAPTERID DESC "; 

private static $updateSQL = "UPDATE M04_CHAPTER SET CHAPTERNAME = ? , CHAPTERNUMBER = ? , M11STATUSID = ? , DESC = ? , SHORTDESC = ? , CREATEDON = ? , CREATEDBY = ? , MODIFIEDON = ? , MODIFIEDBY = ? WHERE M04CHAPTERID = ? ";

private static $deleteSQL = "DELETE FROM M04_CHAPTER WHERE M04CHAPTERID = ? ";

private static $selectByIdSQL = "SELECT * FROM M04_CHAPTER WHERE M04CHAPTERID = ? ";

public function create(M04ChapterBO $obj ) 
    { 
    $stmt = $this->db->prepare(self::$insertSQL); 
    $stmt->execute(array($obj->getChaptername() , $obj->getChapternumber() , $obj->getM11statusid() , $obj->getDesc() , $obj->getShortdesc() , $obj->getCreatedon() , $obj->getCreatedby() , $obj->getModifiedon() , $obj->getModifiedby() )); 
    return true;     
} 


public function getAll() 
    { 
    $objArray = array(); 
    $values = $this->db->query(self::$selectSQL) ; 
    if (is_array($values) || is_object($values)) 
    { 
foreach ($values as $row) { 
$obj = new M04ChapterBO(); 
$obj->setM04chapterid($row['M04CHAPTERID']) ; 
$obj->setChaptername($row['CHAPTERNAME']) ; 
$obj->setChapternumber($row['CHAPTERNUMBER']) ; 
$obj->setM11statusid($row['M11STATUSID']) ; 
$obj->setDesc($row['DESC']) ; 
$obj->setShortdesc($row['SHORTDESC']) ; 
$obj->setCreatedon($row['CREATEDON']) ; 
$obj->setCreatedby($row['CREATEDBY']) ; 
$obj->setModifiedon($row['MODIFIEDON']) ; 
$obj->setModifiedby($row['MODIFIEDBY']) ; 

$objArray[] = $obj; 
    } 
    } 
    return $objArray; 
    } 


public function update(M04ChapterBO $obj ) 
    { 
    $stmt = $this->db->prepare(self::$updateSQL); 
    $stmt->execute(array($obj->getChaptername() , $obj->getChapternumber() , $obj->getM11statusid() , $obj->getDesc() , $obj->getShortdesc() , $obj->getCreatedon() , $obj->getCreatedby() , $obj->getModifiedon() , $obj->getModifiedby() , $obj->getM04chapterid() ));
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


public function getById(M04ChapterBO $obj )
    {
    
    $stmt = $this->db->prepare(self::$selectByIdSQL);
    $id = intval($obj->getM04chapterid());
    $stmt->execute(array($id));
    $row = $stmt->fetch(PDO::FETCH_ASSOC); 
    
    if($row != null){ 
    $obj = new M04ChapterBO(); 
$obj->setM04chapterid($row['M04CHAPTERID']) ; 
$obj->setChaptername($row['CHAPTERNAME']) ; 
$obj->setChapternumber($row['CHAPTERNUMBER']) ; 
$obj->setM11statusid($row['M11STATUSID']) ; 
$obj->setDesc($row['DESC']) ; 
$obj->setShortdesc($row['SHORTDESC']) ; 
$obj->setCreatedon($row['CREATEDON']) ; 
$obj->setCreatedby($row['CREATEDBY']) ; 
$obj->setModifiedon($row['MODIFIEDON']) ; 
$obj->setModifiedby($row['MODIFIEDBY']) ; 
    }
    return $obj;
    }

}
?>