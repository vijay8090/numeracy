<?php

include_once '../bo/CategoryBO.php';

/**
 * CategoryDAO (Data Access Object )
 * @author avijaya8
 *
 */
class CategoryDao
{
	private $db;
	
	private static $insertSQL = "INSERT INTO M02_CATEGORY(LABEL,STARTAGE,ENDAGE,GENDER) VALUES(?,?,?,?)";
	private static $selectSQL = "SELECT M02CATEGORYID AS ID, LABEL,STARTAGE,ENDAGE,GENDER FROM M02_CATEGORY ORDER BY M02CATEGORYID DESC";
	private static $updateSQL = "UPDATE M02_CATEGORY set  LABEL = :label, STARTAGE = :startAge, ENDAGE = :endAge, GENDER = :gender WHERE M02CATEGORYID = :id ";
	private static $deleteSQL = "DELETE FROM M02_CATEGORY WHERE M02CATEGORYID = ?";
	private static $selectByIdSQL = "SELECT * FROM M02_CATEGORY where M02CATEGORYID = ?";

	function __construct($DB_con)
	{
		$this->db = $DB_con;
	}


	public function create($categoryBO) 
	{
		
			$stmt = $this->db->prepare(self::$insertSQL);
			
			$stmt->execute(array($categoryBO->getLabel(),$categoryBO->getStartAge(),$categoryBO->getEndAge(),$categoryBO->getGender()));
			
			return true;
	}
	

	public function getAllCategory()
	{
	    
	    $categoryArray = array();
	    			
		$values =  $this->db->query(self::$selectSQL) ;
			
		if (is_array($values) || is_object($values))
		{

			foreach ($values as $row) {
			    $category = new CategoryBO();
			    $category->setId($row['ID']);
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
	
	public function getById($categoryBO)
	{
		 
		$category = null;
		
		$stmt = $this->db->prepare(self::$selectByIdSQL);
		$id =  intval($categoryBO->getId());
		$stmt->execute(array($id));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		if($row != null){
		$category = new CategoryBO();
		$category->setId($row['M02CATEGORYID']);
		$category->setLabel($row['LABEL']);
		$category->setStartAge($row['STARTAGE']);
		$category->setEndAge($row['ENDAGE']);
		$category->setGender($row['GENDER']);
		$categoryArray[] = $category;
		
		}
		
		return $category;
	
	}
	
	
	public function update($categoryBO)
	{
		
		$stmt = $this->db->prepare(self::$updateSQL);
		
		$id =  $categoryBO->getId();
		$label = $categoryBO->getLabel();
		$startAge = $categoryBO->getStartAge();
		$endAge = $categoryBO->getEndAge();
		$gender = $categoryBO->getGender();
					
		$stmt->bindparam(":id",$id);
		$stmt->bindparam(":label",$label);
		$stmt->bindparam(":startAge",$startAge );
		$stmt->bindparam(":endAge",$endAge);
		$stmt->bindparam(":gender",$gender);
			
		$stmt->execute();
			
		return true;
	}
	
	
	public function delete($ids)
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