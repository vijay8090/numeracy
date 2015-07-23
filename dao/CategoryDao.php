<?php

/**
 * CategoryDAO (Data Access Object )
 * @author avijaya8
 *
 */
class CategoryDao
{
	private $db;

	function __construct($DB_con)
	{
		$this->db = $DB_con;
	}


	public function create($categoryBO)
	{
		/* try
		{ */
			$stmt = $this->db->prepare("INSERT INTO M02_CATEGORY(LABEL,STARTAGE,ENDAGE,GENDER) VALUES(:label, :startAge, :endAge, :gender)");
			
			$label = $categoryBO->getLabel();
			$startAge = $categoryBO->getStartAge();
			$endAge = $categoryBO->getEndAge();
			$gender = $categoryBO->getGender();
			
			$stmt->bindparam(":label",$label);
			$stmt->bindparam(":startAge",$startAge);
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
	    /* try
	    { */
	    		$sql = "SELECT M02CATEGORYID as id, label,startage,endage,gender FROM M02_CATEGORY order by M02CATEGORYID desc";
			
		$values =  $this->db->query($sql) ;
			
		if (is_array($values) || is_object($values))
		{
		    
		   include_once '../bo/CategoryBO.php';

			foreach ($values as $row) {
			    
			   // $categoryArray[] = $row['id'];
			    
			    $category = new CategoryBO();
			    $category->setId($row['id']);
			    $category->setLabel($row['label']);
			    $category->setStartAge($row['startage']);
			    $category->setEndAge($row['endage']);
			    $category->setGender($row['gender']);
			    //echo $category;
			    $categoryArray[] = $category; 
		
	       }
		}
	    /* }
	    catch(PDOException $e)
	    {
	        echo $e->getMessage();
	        return null;
	    } */
	    
	    return $categoryArray;
	
	}


}

?>