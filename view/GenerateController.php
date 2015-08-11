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
					
					print( "<p class='btn-info'>".$count++ ." >".dashesToCamelCase($tableName,true)."Controller.php</p><br/>");
					
					print("<div class='alert alert-danger clearfix'> &lt;?php<br/>");
					
				//	print('<br/>namespace com\numeracy\BO; <br/>');
					//print('	require __DIR__ . "\BaseBO.php"; <br/>use com\numeracy\BO\BaseBO; <br/> ' );
					
					//print("class ".dashesToCamelCase($tableName,true)."BO extends BaseBO {<br/>");
					
					//print("class ".dashesToCamelCase($tableName,true)."Controller  {<br/>");
					
					$tableArray[] = $row['table_name'];
					
					getControllerContents($tableName);
										
					//getAllColumns($tableName);
					
					//print("}<br/>");
					print("?&gt;<br/></div>");
					print("<br/>");
				
				}
			}

			DbUtil::disconnect();
			
			return $tableArray;
			
		}
		
		function getControllerContents($tableName){
			
			
			print(' &nbsp;&nbsp;&nbsp;    include_once \'../util/CrossBrowserHead.php\'; <br/>
					&nbsp;&nbsp;&nbsp;    include_once \'../util/CommonUtil.php\';<br/>
					&nbsp;&nbsp;&nbsp;    include_once \'../facade/'.dashesToCamelCase($tableName,true).'Facade.php\';<br/>
					&nbsp;&nbsp;&nbsp;    <br/>
					&nbsp;&nbsp;&nbsp;    // use PDO;<br/>
					&nbsp;&nbsp;&nbsp;    use com\numeracy\util\CommonUtil;<br/>
					&nbsp;&nbsp;&nbsp;    use com\numeracy\facade\\'.dashesToCamelCase($tableName,true).'Facade;<br/>
					&nbsp;&nbsp;&nbsp;    <br/>
					&nbsp;&nbsp;&nbsp;    $data = json_decode ( file_get_contents ( "php://input" ) );<br/>
					&nbsp;&nbsp;&nbsp;    <br/>
					&nbsp;&nbsp;&nbsp;    $facade = new '.dashesToCamelCase($tableName,true).'Facade();<br/>
					&nbsp;&nbsp;&nbsp;    <br/>
					&nbsp;&nbsp;&nbsp;    echo CommonUtil::excecuteCommand($facade,$data);<br/>');
			
			
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
