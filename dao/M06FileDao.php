<?php

namespace com\numeracy\Dao;

include_once "../bo/M06FileBO.php";
use com\numeracy\BO\M06FileBO;
use PDO;

class M06FileDao {
	private $db;
	function __construct($DB_con) {
		$this->db = $DB_con;
	}
	private static $insertSQL = "INSERT INTO M06_FILE (FILENAME, M10TYPEID, EXTENSION, SIZE, URL, PATH, TAGS, CREATEDON, CREATEDBY, MODIFIEDON, MODIFIEDBY) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
	private static $selectSQL = "SELECT M06FILEID, FILENAME, M10TYPEID, EXTENSION, SIZE, URL, PATH, TAGS, CREATEDON, CREATEDBY, MODIFIEDON, MODIFIEDBY FROM M06_FILE ORDER BY M06FILEID DESC ";
	private static $updateSQL = "UPDATE M06_FILE SET FILENAME = ? , M10TYPEID = ? , EXTENSION = ? , SIZE = ? , URL = ? , PATH = ? , TAGS = ? , CREATEDON = ? , CREATEDBY = ? , MODIFIEDON = ? , MODIFIEDBY = ? WHERE M06FILEID = ? ";
	private static $deleteSQL = "DELETE FROM M06_FILE WHERE M06FILEID = ? ";
	private static $selectByIdSQL = "SELECT * FROM M06_FILE WHERE M06FILEID = ? ";
	public function create(M06FileBO $obj) {
		$stmt = $this->db->prepare ( self::$insertSQL );
		$stmt->execute ( array (
				$obj->getFilename (),
				$obj->getM10typeid (),
				$obj->getExtension (),
				$obj->getSize (),
				$obj->getUrl (),
				$obj->getPath (),
				$obj->getTags (),
				$obj->getCreatedon (),
				$obj->getCreatedby (),
				$obj->getModifiedon (),
				$obj->getModifiedby () 
		) );
		return true;
	}
	public function getAll() {
		$objArray = array ();
		$values = $this->db->query ( self::$selectSQL );
		if (is_array ( $values ) || is_object ( $values )) {
			foreach ( $values as $row ) {
				$obj = new M06FileBO ();
				$obj->setM06fileid ( $row ['M06FILEID'] );
				$obj->setFilename ( $row ['FILENAME'] );
				$obj->setM10typeid ( $row ['M10TYPEID'] );
				$obj->setExtension ( $row ['EXTENSION'] );
				$obj->setSize ( $row ['SIZE'] );
				$obj->setUrl ( $row ['URL'] );
				$obj->setPath ( $row ['PATH'] );
				$obj->setTags ( $row ['TAGS'] );
				$obj->setCreatedon ( $row ['CREATEDON'] );
				$obj->setCreatedby ( $row ['CREATEDBY'] );
				$obj->setModifiedon ( $row ['MODIFIEDON'] );
				$obj->setModifiedby ( $row ['MODIFIEDBY'] );
				
				$objArray [] = $obj;
			}
		}
		return $objArray;
	}
	public function update(M06FileBO $obj) {
		$stmt = $this->db->prepare ( self::$updateSQL );
		$stmt->execute ( array (
				$obj->getFilename (),
				$obj->getM10typeid (),
				$obj->getExtension (),
				$obj->getSize (),
				$obj->getUrl (),
				$obj->getPath (),
				$obj->getTags (),
				$obj->getCreatedon (),
				$obj->getCreatedby (),
				$obj->getModifiedon (),
				$obj->getModifiedby (),
				$obj->getM06fileid () 
		) );
		return true;
	}
	public function delete(array $ids) {
		if (is_array ( $ids ) || is_object ( $ids )) {
			foreach ( $ids as $id ) {
				
				$stmt = $this->db->prepare ( self::$deleteSQL );
				$stmt->execute ( array (
						$id 
				) );
			}
		}
		
		return true;
	}
	public function getById(M06FileBO $obj) {
		$stmt = $this->db->prepare ( self::$selectByIdSQL );
		$id = intval ( $obj->getM06fileid () );
		$stmt->execute ( array (
				$id 
		) );
		$row = $stmt->fetch ( PDO::FETCH_ASSOC );
		
		if ($row != null) {
			$obj = new M06FileBO ();
			$obj->setM06fileid ( $row ['M06FILEID'] );
			$obj->setFilename ( $row ['FILENAME'] );
			$obj->setM10typeid ( $row ['M10TYPEID'] );
			$obj->setExtension ( $row ['EXTENSION'] );
			$obj->setSize ( $row ['SIZE'] );
			$obj->setUrl ( $row ['URL'] );
			$obj->setPath ( $row ['PATH'] );
			$obj->setTags ( $row ['TAGS'] );
			$obj->setCreatedon ( $row ['CREATEDON'] );
			$obj->setCreatedby ( $row ['CREATEDBY'] );
			$obj->setModifiedon ( $row ['MODIFIEDON'] );
			$obj->setModifiedby ( $row ['MODIFIEDBY'] );
		}
		return $obj;
	}
}
?>

7 >M07AddressDao.php


<?php


namespace com\numeracy\Dao;

include_once "../bo/M07AddressBO.php";
use com\numeracy\BO\M07AddressBO;
use PDO;

class M07AddressDao {
	private $db;
	function __construct($DB_con) {
		$this->db = $DB_con;
	}
	private static $insertSQL = "INSERT INTO M07_ADDRESS (TYPE, CODE, CREATEDBY, MODIFIEDBY, CREATEDON, MODIFIEDON) VALUES (?, ?, ?, ?, ?, ?)";
	private static $selectSQL = "SELECT M07ADDRESSID, TYPE, CODE, CREATEDBY, MODIFIEDBY, CREATEDON, MODIFIEDON FROM M07_ADDRESS ORDER BY M07ADDRESSID DESC ";
	private static $updateSQL = "UPDATE M07_ADDRESS SET TYPE = ? , CODE = ? , CREATEDBY = ? , MODIFIEDBY = ? , CREATEDON = ? , MODIFIEDON = ? WHERE M07ADDRESSID = ? ";
	private static $deleteSQL = "DELETE FROM M07_ADDRESS WHERE M07ADDRESSID = ? ";
	private static $selectByIdSQL = "SELECT * FROM M07_ADDRESS WHERE M07ADDRESSID = ? ";
	public function create(M07AddressBO $obj) {
		$stmt = $this->db->prepare ( self::$insertSQL );
		$stmt->execute ( array (
				$obj->getType (),
				$obj->getCode (),
				$obj->getCreatedby (),
				$obj->getModifiedby (),
				$obj->getCreatedon (),
				$obj->getModifiedon () 
		) );
		return true;
	}
	public function getAll() {
		$objArray = array ();
		$values = $this->db->query ( self::$selectSQL );
		if (is_array ( $values ) || is_object ( $values )) {
			foreach ( $values as $row ) {
				$obj = new M07AddressBO ();
				$obj->setM07addressid ( $row ['M07ADDRESSID'] );
				$obj->setType ( $row ['TYPE'] );
				$obj->setCode ( $row ['CODE'] );
				$obj->setCreatedby ( $row ['CREATEDBY'] );
				$obj->setModifiedby ( $row ['MODIFIEDBY'] );
				$obj->setCreatedon ( $row ['CREATEDON'] );
				$obj->setModifiedon ( $row ['MODIFIEDON'] );
				
				$objArray [] = $obj;
			}
		}
		return $objArray;
	}
	public function update(M07AddressBO $obj) {
		$stmt = $this->db->prepare ( self::$updateSQL );
		$stmt->execute ( array (
				$obj->getType (),
				$obj->getCode (),
				$obj->getCreatedby (),
				$obj->getModifiedby (),
				$obj->getCreatedon (),
				$obj->getModifiedon (),
				$obj->getM07addressid () 
		) );
		return true;
	}
	public function delete(array $ids) {
		if (is_array ( $ids ) || is_object ( $ids )) {
			foreach ( $ids as $id ) {
				
				$stmt = $this->db->prepare ( self::$deleteSQL );
				$stmt->execute ( array (
						$id 
				) );
			}
		}
		
		return true;
	}
	public function getById(M07AddressBO $obj) {
		$stmt = $this->db->prepare ( self::$selectByIdSQL );
		$id = intval ( $obj->getM07addressid () );
		$stmt->execute ( array (
				$id 
		) );
		$row = $stmt->fetch ( PDO::FETCH_ASSOC );
		
		if ($row != null) {
			$obj = new M07AddressBO ();
			$obj->setM07addressid ( $row ['M07ADDRESSID'] );
			$obj->setType ( $row ['TYPE'] );
			$obj->setCode ( $row ['CODE'] );
			$obj->setCreatedby ( $row ['CREATEDBY'] );
			$obj->setModifiedby ( $row ['MODIFIEDBY'] );
			$obj->setCreatedon ( $row ['CREATEDON'] );
			$obj->setModifiedon ( $row ['MODIFIEDON'] );
		}
		return $obj;
	}
}
?>
