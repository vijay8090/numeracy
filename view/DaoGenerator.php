<?php include_once 'sidebarup.php';?>

<div class="clearfix"></div>
<br />

<div class="container">

		<?php
			
		//use com\vijay\util\DbUtil ;
		require_once('../util/DbUtil.php');
		use com\numeracy\util\DbUtil;
		
		$endChar ="<br/>";
		
		/**
		 * 
		 * @return multitype:unknown
		 */
		function getAllTables(){
			
			$pdo = DbUtil::connect();
			
			
			$sql = "select table_name from information_schema.tables where table_schema='numeracy'";
			
			//$sql ="DESCRIBE   numeracy.m01_user";
				
			$values= $pdo->query($sql) ;
			
			$count = 1;
			
			$result = "";
			
			$tableArray = array();
			
			if (is_array($values) || is_object($values))
			{
			
				foreach ($values as $row) {
					
					$tableName = $row['table_name'];
					
					print( "<p class='btn-info'>".$count++ ." >".dashesToCamelCase($tableName,true)."Dao.php</p><br/>");
					
					print("<div class='alert alert-danger clearfix'> &lt;?php");
					print('<br/>');
					print('<br/>
							namespace com\numeracy\Dao; <br/>
							include_once "../bo/'.dashesToCamelCase($tableName,true).'BO.php"; <br/>');
							print('use com\numeracy\BO\\'.dashesToCamelCase($tableName,true).'BO; <br/> ' );
							print('use PDO;');
							print('<br/>');
					print("class ".dashesToCamelCase($tableName,true)."Dao {<br/>");
					
					print('&nbsp;&nbsp;&nbsp;    private $db; <br/> <br/>');
					
					print('function __construct($DB_con) <br/>
						&nbsp;&nbsp;&nbsp;    { <br/>
						&nbsp;&nbsp;&nbsp;    	$this->db = $DB_con; <br/>
						&nbsp;&nbsp;&nbsp;    } <br/>');
					
					$tableArray[] = $row['table_name'];
					
										
					getAllColumns($tableName);
					
					print("}<br/>");
					print("?&gt;<br/></div>");
					print("<br/>");
				
				}
			}

			DbUtil::disconnect();
			
			return $tableArray;
			
		}
		
		/**
		 * 
		 * @param unknown $tableName
		 */
		function getAllColumns($tableName){
			
				
			$pdo = DbUtil::connect();
				
			$sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'numeracy' AND TABLE_NAME = '".$tableName."'";
				
			//$sql ="DESCRIBE   numeracy.m01_user";
		
			$values= $pdo->query($sql) ;
				
			$count = 1;
				
			$result = "";
				
			$colnameArray = array();
				
			if (is_array($values) || is_object($values))
			{
					
				foreach ($values as $row) {
						
					$colnameArray[] = $row['COLUMN_NAME'];
				}
				
			}
			
			$tableName = strtoupper($tableName);
			
			$idField  = findIdField($tableName, $colnameArray);
			print('<br/>');
			print('private static $insertSQL = "INSERT INTO '.$tableName.' ('.getInsert1($tableName, $colnameArray).')  VALUES ('.getInsert2($tableName,$colnameArray).')";</br>');
			print('<br/>');
			if($idField != ''){
			print('private static $selectSQL = "SELECT '.getSelect($colnameArray).' FROM '.$tableName.' ORDER BY '.$idField.' DESC "; </br>');
			} else {
				print('private static $selectSQL = "SELECT '.getSelect($colnameArray).' FROM '.$tableName.' "; </br>');
			}
			print('<br/>');
			if($idField != ''){
			print('private static $updateSQL = "UPDATE '.$tableName.' SET '.getUpdate($tableName, $colnameArray).' WHERE '.$idField.' = ? ";</br>');
			} else {
				//('private static $updateSQL = "UPDATE '.$tableName.' SET '.getUpdate($tableName, $colnameArray).' ";</br>');
				print('private static $updateSQL = "UPDATE '.$tableName.' SET '.getUpdate($tableName, $colnameArray).' WHERE CONDITIONFIELD = ? ";</br>');
			}
			print('<br/>');
			print('private static $deleteSQL = "DELETE FROM '.$tableName.' WHERE '.$idField.' = ? ";</br>');
			print('<br/>');
			print('private static $selectByIdSQL = "SELECT * FROM '.$tableName.' WHERE '.$idField.' = ? ";</br>');
			
			
			printCreateFunction($tableName, $colnameArray);
			
			printGetAllFunction($tableName, $colnameArray);
			
			printUpdateFunction($tableName, $colnameArray);
			
			printDeleteFunction($tableName, $colnameArray);
			
			printGetByIdFunction($tableName, $colnameArray, $idField);
		
			DbUtil::disconnect();
				
			//return $$colnameArray;
				
			
		}
		
		
	Function printGetByIdFunction($tableName, $colnameArray, $idField){
		print("<br/>");
			print('public function getById('.dashesToCamelCase($tableName,true).'BO $obj )</br>
					&nbsp;&nbsp;&nbsp;   {</br>
					&nbsp;&nbsp;&nbsp;   	 </br>
					&nbsp;&nbsp;&nbsp;   $stmt = $this->db->prepare(self::$selectByIdSQL);</br>
					&nbsp;&nbsp;&nbsp;   	$id =  intval($obj->get'.dashesToCamelCase($idField,true).'());</br>
					&nbsp;&nbsp;&nbsp;   	$stmt->execute(array($id));</br>
					&nbsp;&nbsp;&nbsp;   	$row = $stmt->fetch(PDO::FETCH_ASSOC); </br>
					&nbsp;&nbsp;&nbsp;   	</br>
					&nbsp;&nbsp;&nbsp;   	if($row != null){ </br>
					&nbsp;&nbsp;&nbsp;   	$obj = new '.dashesToCamelCase($tableName,true).'BO(); </br>
						'.getAll($colnameArray).' 
						
					&nbsp;&nbsp;&nbsp;   	}</br>
					&nbsp;&nbsp;&nbsp;   	return $obj;</br>
					&nbsp;&nbsp;&nbsp;   }</br>');
			
			print("<br/>");
		}
		
		
		/**
		 *
		 * @param unknown $tableName
		 * @param unknown $colnameArray
		 */
		function printGetAllFunction($tableName, $colnameArray){
			print("<br/>");
			print('public function getAll() </br>
					&nbsp;&nbsp;&nbsp;   { </br>
					&nbsp;&nbsp;&nbsp;      $objArray = array(); </br>
					&nbsp;&nbsp;&nbsp;   	$values =  $this->db->query(self::$selectSQL) ; </br>
					&nbsp;&nbsp;&nbsp;   	if (is_array($values) || is_object($values)) </br>
					&nbsp;&nbsp;&nbsp;   	{ </br>
							foreach ($values as $row) { </br>
							    $obj = new '.dashesToCamelCase($tableName,true).'BO(); </br>
							    '.getAll($colnameArray).' </br>
							    $objArray[] = $obj;  </br>
					&nbsp;&nbsp;&nbsp;         } </br>
					&nbsp;&nbsp;&nbsp;   	} </br>
					&nbsp;&nbsp;&nbsp;       return $objArray; </br>
					&nbsp;&nbsp;&nbsp;   } </br>');
			print("<br/>");
		}
		
		
		/**
		 *
		 * @param unknown $colnameArray
		 * @return string
		 */
		function getAll($colnameArray){
				
			$result='';
		
			foreach ($colnameArray as $colname) {
		
				$result .= '$obj->set'.dashesToCamelCase($colname,true).'($row[\''.$colname.'\']) ; <br/> ';
		
			}
		
			//$result = substr($result, 0, -2);
		
			return $result;
		}
		
		
		 function printDeleteFunction($tableName, $colnameArray){
		 	print("<br/>");
		 	print('public function delete(array $ids) </br>
					&nbsp;&nbsp;&nbsp;   { </br>
					&nbsp;&nbsp;&nbsp;   	if (is_array($ids) || is_object($ids)) </br>
					&nbsp;&nbsp;&nbsp;   	{ </br>
				    &nbsp;&nbsp;&nbsp;   		foreach ($ids as $id){ </br>
				    &nbsp;&nbsp;&nbsp;   			 </br>
				    &nbsp;&nbsp;&nbsp;   		  $stmt = $this->db->prepare(self::$deleteSQL); </br>
				    &nbsp;&nbsp;&nbsp;   		  $stmt->execute(array($id)); </br>
				    &nbsp;&nbsp;&nbsp;    		} </br>
					&nbsp;&nbsp;&nbsp;   	} </br>
					&nbsp;&nbsp;&nbsp;   		 </br>
					&nbsp;&nbsp;&nbsp;   	return true; </br>
					} </br>
		 			');
		 	
		 	print("<br/>");
		 }
		
		/**
		 * 
		 * @param unknown $tableName
		 * @param unknown $colnameArray
		 */
		function printUpdateFunction($tableName, $colnameArray){
			print("<br/>");
			print('public function update('.dashesToCamelCase($tableName,true).'BO $obj ) </br>
				&nbsp;&nbsp;&nbsp;   { </br>
					
					&nbsp;&nbsp;&nbsp;   $stmt = $this->db->prepare(self::$updateSQL); </br>
						
					&nbsp;&nbsp;&nbsp;   $stmt->execute(array('.getUpdateValues($tableName, $colnameArray).')); </br>
						
					&nbsp;&nbsp;&nbsp;   return true; </br>
				&nbsp;&nbsp;&nbsp;   } </br>');
			
			print("<br/>");
		}
		
		/**
		 * 
		 * @param unknown $tableName
		 * @param unknown $colnameArray
		 * @return string
		 */
		function getUpdateValues($tableName, $colnameArray){
		
			$result='';
		
			$pos = strpos($tableName,'_');
			$com = substr($tableName, 0, $pos);
			$idField = '';
		
			foreach ($colnameArray as $colname) {
		
				if($com != null){
		
					$tst = strpos($colname,$com);
		
					if(strlen($tst)>0){
						$idField .= '$obj->get'.dashesToCamelCase($colname,true).'() , ';
					}else{
						$result .= '$obj->get'.dashesToCamelCase($colname,true).'() , ';
					}
		
				} else{
					$result .= '$obj->get'.dashesToCamelCase($colname,true).'() , ';
				}
		
			}
			
			
			if($idField != ''){
				$result .= $idField;
			}
		
			$result = substr($result, 0, -2);
		
			return $result;
		}
		

		
		/**
		 * 
		 * @param unknown $tableName
		 * @param unknown $colnameArray
		 */
		function printCreateFunction($tableName, $colnameArray){
			
			print('<br/>');
			
			print('public function create('.dashesToCamelCase($tableName,true).'BO $obj ) <br/>
			&nbsp;&nbsp;&nbsp;    { <br/>
			
			&nbsp;&nbsp;&nbsp;    		$stmt = $this->db->prepare(self::$insertSQL); <br/>
		
			&nbsp;&nbsp;&nbsp;    		$stmt->execute(array('.getCreate($tableName, $colnameArray).')); <br/>
		
			&nbsp;&nbsp;&nbsp;    		return true;
			&nbsp;&nbsp;&nbsp;   <br/>
			} <br/>
			');
				
			print("<br/>");
				
		}
		
		
		/**
		 * 
		 * @param unknown $tableName
		 * @param unknown $colnameArray
		 * @return string
		 */
		function getCreate($tableName, $colnameArray){
		
			$result='';
		
			$pos = strpos($tableName,'_');
			$com = substr($tableName, 0, $pos);
		
		
			foreach ($colnameArray as $colname) {
		
				if($com != null){
		
					$tst = strpos($colname,$com);
		
					if(strlen($tst)>0){
		
					}else{
						$result .= '$obj->get'.dashesToCamelCase($colname,true).'() , ';
					}
		
				} else{
					$result .= '$obj->get'.dashesToCamelCase($colname,true).'() , ';
				}
		
			}
		
			$result = substr($result, 0, -2);
		
			return $result;
		}
		
		/**
		 * 
		 * @param unknown $tableName
		 * @param unknown $colnameArray
		 * @return string
		 */
		function getUpdate($tableName, $colnameArray){
				
			$result='';
				
			$pos = strpos($tableName,'_');
			$com = substr($tableName, 0, $pos);
				
				
			foreach ($colnameArray as $colname) {
		
				if($com != null){
		
					$tst = strpos($colname,$com);
		
					if(strlen($tst)>0){
		
					}else{
						$result .= $colname.' = ? , ';
					}
		
				} else{
					$result .= $colname.', ';
				}
		
			}
				
			$result = substr($result, 0, -2);
				
			return $result;
		}
		
		/**
		 * 
		 * @param unknown $tableName
		 * @param unknown $colnameArray
		 * @return Ambigous <string, unknown>
		 */
		function findIdField($tableName, $colnameArray){
			
			$result='';
			
			$pos = strpos($tableName,'_');			
			$com = substr($tableName, 0, $pos);
			
			
			foreach ($colnameArray as $colname) {
				
				if($com != null){
				
				$tst = strpos($colname,$com);
				
				if(strlen($tst)>0){
					$result = $colname;
					break;
				}else{
					
				} 
				
				} else{
					
				 }
				
			}
			
			return $result;
		}
		
		/**
		 * 
		 * @param unknown $colnameArray
		 * @return string
		 */
		function getSelect($colnameArray){
			
			$result='';
				
			foreach ($colnameArray as $colname) {
		
				$result .= $colname.', ';
		
			}
				
			$result = substr($result, 0, -2);
				
			return $result;
		}
		
		/**
		 * 
		 * @param unknown $tableName
		 * @param unknown $colnameArray
		 * @return string
		 */
		function getInsert1($tableName, $colnameArray){
			
			$result='';
			
			$pos = strpos($tableName,'_');			
			$com = substr($tableName, 0, $pos);
			
			
			foreach ($colnameArray as $colname) {
				
				if($com != null){
				
				$tst = strpos($colname,$com);
				
				if(strlen($tst)>0){
				 	
				}else{
					$result .= $colname.', ';
				} 
				
				} else{
				 $result .= $colname.', ';
				 }
				
			}
			
			$result = substr($result, 0, -2);
			
			return $result;
		}
		
		/**
		 * 
		 * @param unknown $tableName
		 * @param unknown $colnameArray
		 * @return string
		 */
		function getInsert2($tableName, $colnameArray){
			$result='';
			
			$pos = strpos($tableName,'_');			
			$com = substr($tableName, 0, $pos);
			
			
			foreach ($colnameArray as $colname) {
				
				if($com != null){
				
				$tst = strpos($colname,$com);
				
				if(strlen($tst)>0){
				 	
				} else{
					$result .= '?, ';
				} 
				
				} else{
				 	$result .= '?, ';
				}
				
			}
			
			$result = substr($result, 0, -2);
			
			return $result;
		}
		
		/**
		 * 
		 * @param unknown $string
		 * @param string $capitalizeFirstCharacter
		 * @return mixed
		 */
		function dashesToCamelCase($string, $capitalizeFirstCharacter = false)
		{
			$string = strtolower($string);
			$str = str_replace(' ', '', ucwords(str_replace('_', ' ', $string)));
		
			if (!$capitalizeFirstCharacter) {
				$str[0] = strtolower($str[0]);
			}
		
			return $str;
		}

		
			
		
		?>

		<?php 
		
		$tableArray =  getAllTables();
		
		
		
		?> <br/>

		<?php

		?>

</div>

<?php include_once 'sidebardown.php';?>
