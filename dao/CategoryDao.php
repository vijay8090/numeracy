<?php

namespace com\numeracy\Dao;

include_once '../bo/M02CategoryBO.php';

use com\numeracy\BO\M02CategoryBO;

/**
 * CategoryDAO (Data Access Object )
 * @author avijaya8
 *
 */
class CategoryDao 
{
	private $db;
	
	/* SQL */
	private static $insertSQL = "INSERT INTO M02_CATEGORY(LABEL,STARTAGE,ENDAGE,GENDER) VALUES(?,?,?,?)";
	private static $selectSQL = "SELECT M02CATEGORYID AS ID, LABEL,STARTAGE,ENDAGE,GENDER FROM M02_CATEGORY ORDER BY M02CATEGORYID DESC";
	private static $updateSQL = "UPDATE M02_CATEGORY set  LABEL = ?, STARTAGE = ?, ENDAGE = ?, GENDER = ? WHERE M02CATEGORYID = ? ";
	private static $deleteSQL = "DELETE FROM M02_CATEGORY WHERE M02CATEGORYID = ?";
	private static $selectByIdSQL = "SELECT * FROM M02_CATEGORY where M02CATEGORYID = ?";

	/**
	 * Constructor
	 * @param unknown $DB_con
	 */
	function __construct($DB_con)
	{
		$this->db = $DB_con;
	}

    /**
     * 
     * @param CategoryBO $categoryBO
     * @return boolean
     */
	public function create(M02CategoryBO $categoryBO ) 
	{
		
			$stmt = $this->db->prepare(self::$insertSQL);
			
			$stmt->execute(array($categoryBO->getLabel(),$categoryBO->getStartage(),$categoryBO->getEndage(),$categoryBO->getGender()));
			
			return true;
	}
	
    /**
     * 
     * @return multitype:\com\numeracy\BO\CategoryBO
     */
	public function getAll()
	{
	    
	    $categoryArray = array();
	    			
		$values =  $this->db->query(self::$selectSQL) ;
			
		if (is_array($values) || is_object($values))
		{

			foreach ($values as $row) {
			    $category = new M02CategoryBO();
			    $category->setM02categoryid($row['ID']);
			    $category->setLabel($row['LABEL']);
			    $category->setStartAge($row['STARTAGE']);
			    $category->setEndAge($row['ENDAGE']);
			    $category->setGender($row['GENDER']);
			    //echo $category;
			    $categoryArray[] = $category; 
	       }
		}
	   	    
	    return $categoryArray;
	
	}
	
	/**
	 * 
	 * @param CategoryBO $categoryBO
	 * @return \com\numeracy\BO\CategoryBO
	 */
	public function getById(M02CategoryBO $categoryBO)
	{
		 
	   // (com\numeracy\BO\CategoryBO())$categoryBO;
	    
	    $category = new M02CategoryBO();
		
		$stmt = $this->db->prepare(self::$selectByIdSQL);
		$id =  intval($categoryBO->getM02categoryid());
		$stmt->execute(array($id));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		if($row != null){
		$category = new M02CategoryBO();
		$category->setM02categoryid($row['M02CATEGORYID']);
		$category->setLabel($row['LABEL']);
		$category->setStartage($row['STARTAGE']);
		$category->setEndage($row['ENDAGE']);
		$category->setGender($row['GENDER']);
		$categoryArray[] = $category;
		
		}
		
		return $category;
	}
	
	/**
	 * 
	 * @param CategoryBO $categoryBO
	 * @return boolean
	 */
	public function update(M02CategoryBO $categoryBO)
	{
		
		$stmt = $this->db->prepare(self::$updateSQL);
			
		$stmt->execute(array($categoryBO->getLabel(),$categoryBO->getStartage(),$categoryBO->getEndage(), $categoryBO->getGender(),  $categoryBO->getM02categoryid()));
			
		return true;
	}
	
	/**
	 * 
	 * @param array $ids
	 * @return boolean
	 */
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

}

?>