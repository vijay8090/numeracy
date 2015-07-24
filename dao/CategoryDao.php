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
	
	private static $insertSQL = "INSERT INTO M02_CATEGORY(LABEL,STARTAGE,ENDAGE,GENDER) VALUES(:label, :startAge, :endAge, :gender)";
	private static $selectSQL = "SELECT M02CATEGORYID AS ID, LABEL,STARTAGE,ENDAGE,GENDER FROM M02_CATEGORY ORDER BY M02CATEGORYID DESC";
	private static $updateSQL = "UPDATE M02_CATEGORY set  LABEL = :label, STARTAGE = :startAge, ENDAGE = :endAge, GENDER = :gender WHERE M02CATEGORYID = :id ";
	private static $deleteSQL = "DELETE FROM M02_CATEGORY WHERE M02CATEGORYID = :id";

	function __construct($DB_con)
	{
		$this->db = $DB_con;
	}


	public function create($categoryBO) 
	{
		/* try
		{ */
			$stmt = $this->db->prepare(self::$insertSQL);
			
			$label = $categoryBO->getLabel();
			$startAge = $categoryBO->getStartAge();
			$endAge = $categoryBO->getEndAge();
			$gender = $categoryBO->getGender();
			
			$stmt->bindparam(":label",$label);
			$stmt->bindparam(":startAge",$startAge );
			$stmt->bindparam(":endAge",$endAge);
			$stmt->bindparam(":gender",$gender);
			
			$stmt->execute();
			
			return true;
		//}
		/* catch(PDOException $e)
		{
		   // $error = new 
			//echo $e->__toString();
		   // return false;
			return array(false, $e->getMessage());
		} */

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
	
	
	public function update($categoryBO)
	{
		
		$stmt = $this->db->prepare(self::$updateSQL);
					
		$stmt->bindparam(":id",$categoryBO->getId());	
			
		$stmt->execute();
			
		return true;
	}
	
	
	public function delete($categoryBO)
	{
	
		$stmt = $this->db->prepare(self::$deleteSQL);
			
		$stmt->bindparam(":id",$categoryBO->getId());	
			
		$stmt->execute();
			
		return true;
	}


}

?>