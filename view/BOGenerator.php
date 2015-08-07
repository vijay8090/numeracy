<?php include_once 'sidebarup.php';?>

<div class="clearfix"></div>
<br />

<div class="container">

		<?php
			
		//use com\vijay\util\DbUtil ;
		require_once('../util/DbUtil.php');
		use com\numeracy\util\DbUtil;
		
		$endChar ="<br/>";
		
		
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
					
					print( "<p class='btn-info'>".$count++ ." >".dashesToCamelCase($tableName,true)."BO.php</p><br/>");
					
					print("<div class='alert alert-danger clearfix'> &lt;?php");
					
					print('<br/>namespace com\numeracy\BO; <br/>');
					//print('	require __DIR__ . "\BaseBO.php"; <br/>use com\numeracy\BO\BaseBO; <br/> ' );
					
					//print("class ".dashesToCamelCase($tableName,true)."BO extends BaseBO {<br/>");
					
					print("class ".dashesToCamelCase($tableName,true)."BO  {<br/>");
					
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
					print("&nbsp;&nbsp;&nbsp;    private $".dashesToCamelCase($row['COLUMN_NAME'],false).";<br/>");
					//print("&nbsp;&nbsp;&nbsp; COl".$count++ ." > ".dashesToCamelCase($row['COLUMN_NAME'],false)."<br/>");
				}
				
				
				foreach ($colnameArray as $colname) {
				
				$getFn = 'public function get'.dashesToCamelCase($colname,true).'() <br/>
				{  <br/>
					&nbsp;&nbsp;&nbsp;    return $this->'.dashesToCamelCase($colname,false).';  <br/>
				} <br/> ';
				
				print($getFn);
				
				//print('<br/>');
				
				
				
				$setFn = 'public function set'.dashesToCamelCase($colname,true).'($'.dashesToCamelCase($colname,false).') <br/>
				{  <br/>
					&nbsp;&nbsp;&nbsp;    $this->'.dashesToCamelCase($colname,false).' = $'.dashesToCamelCase($colname,false).';  <br/>
				} <br/> ';
				
				print($setFn);
				
				}
				
			
				
				$iterateVisible = 
		' public function iterateVisible() {  <br/>
			&nbsp;&nbsp;&nbsp;   $json = "{";  <br/>
			 
			&nbsp;&nbsp;&nbsp;   foreach($this as $key => $value) {  <br/>
			&nbsp;&nbsp;&nbsp;	 &nbsp;&nbsp;&nbsp;    $json .= "\"".$key."\":\"".$value."\",";  <br/>				
			&nbsp;&nbsp;&nbsp;   }  <br/>
			 
			&nbsp;&nbsp;&nbsp;   $json = substr($json, 0, -1); ;  <br/>
			  
			&nbsp;&nbsp;&nbsp;   $json .= "}";  <br/>
			 
			&nbsp;&nbsp;&nbsp;   return $json;  <br/>			
		}  <br/>';
      		
				print($iterateVisible);
				
				print(printImportMethod());
      		
			}
		
			DbUtil::disconnect();
				
			//return $$colnameArray;
				
		}
		
		
		function printImportMethod(){
			
			$content='public function import( $data)  <br/>
	&nbsp;&nbsp;&nbsp;   {  <br/>
		&nbsp;&nbsp;&nbsp;   foreach (get_object_vars($data) as $key => $value) { <br/>
		&nbsp;&nbsp;&nbsp;   	$this->$key = $value; <br/>
		&nbsp;&nbsp;&nbsp;   } <br/>
	&nbsp;&nbsp;&nbsp;   } <br/>';
			
			return $content;
			
		}
		
		
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
