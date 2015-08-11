<?php include_once 'sidebarup.php';?>

<div class="clearfix"></div>
<br />

<div class="container">

		<?php
			
		//use com\vijay\util\DbUtil ;
		require_once('../util/DbUtil.php');
		use com\numeracy\util\DbUtil;
		
		$endChar ="<br/>";
		
		
		function getAllTables() {
			
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
					
					print( "<p class='btn-info'>".$count++ ." >".dashesToCamelCase($tableName,true)."Facade.php</p><br/>");
					
					print("<div class='alert alert-danger clearfix'> &lt;?php<br/>");
					
					print('namespace com\numeracy\facade; <br/>');
					
					print("&nbsp;&nbsp;&nbsp;    include_once '../util/DbUtil.php';<br/>
							&nbsp;&nbsp;&nbsp;    include_once '../util/CommonUtil.php';<br/>");
					
					print("&nbsp;&nbsp;&nbsp;    //bo includes<br/>
							&nbsp;&nbsp;&nbsp;    include_once '../bo/".dashesToCamelCase($tableName,true)."BO.php';<br/>
							<br/>
							&nbsp;&nbsp;&nbsp;    // dao includes<br/>
							&nbsp;&nbsp;&nbsp;    include_once '../dao/".dashesToCamelCase($tableName,true)."Dao.php';<br/>
							<br/>
							&nbsp;&nbsp;&nbsp;    // Util<br/>
							&nbsp;&nbsp;&nbsp;    use com\\numeracy\\util\\DbUtil;<br/>
							&nbsp;&nbsp;&nbsp;    use com\\numeracy\\util\\CommonUtil;<br/>
							<br/>
							&nbsp;&nbsp;&nbsp;    use com\\numeracy\BO\\".dashesToCamelCase($tableName,true)."BO;<br/>
							&nbsp;&nbsp;&nbsp;    use com\\numeracy\Dao\\".dashesToCamelCase($tableName,true)."Dao;<br/>");
					
					
					//print('	require __DIR__ . "\BaseBO.php"; <br/>use com\numeracy\BO\BaseBO; <br/> ' );
					
					//print("class ".dashesToCamelCase($tableName,true)."BO extends BaseBO {<br/>");
					
					print("class ".dashesToCamelCase($tableName,true)."Facade  {<br/>");
					
					$tableArray[] = $row['table_name'];
					
					print("<br/>");
					getCreateFunction($tableName);
					
					print("<br/>");
					getUpdateFunction($tableName);	
					

					print("<br/>");
					getDeleteFunction($tableName);
					
					

					print("<br/>");
					getAllFunction($tableName);
					
					print("}<br/>");
					print("?&gt;<br/></div>");
					print("<br/>");
				
				}
			}

			DbUtil::disconnect();
			
			return $tableArray;
			
		}
		
		
		function getCreateFunction($tableName){
			
			print('public function create($data) {<br/>
					&nbsp;&nbsp;&nbsp;   $result = false;<br/>
					&nbsp;&nbsp;&nbsp;   $obj = new '.dashesToCamelCase($tableName,true).'BO ();<br/>
					&nbsp;&nbsp;&nbsp;   $obj->import($data);<br/>
					&nbsp;&nbsp;&nbsp;   $pdo = DbUtil::connect ();<br/>
					&nbsp;&nbsp;&nbsp;   $dao = new '.dashesToCamelCase($tableName,true).'Dao ( $pdo );<br/>
					&nbsp;&nbsp;&nbsp;   $result = $dao->create ( $obj );<br/>
					&nbsp;&nbsp;&nbsp;   DbUtil::disconnect ();<br/>
					&nbsp;&nbsp;&nbsp;   <br/>
					&nbsp;&nbsp;&nbsp;   return $result;<br/>
					&nbsp;&nbsp;&nbsp;   }<br/>');
			
		}
		
		function getUpdateFunction($tableName){
				
			print('public function update($data) {<br/>
		&nbsp;&nbsp;&nbsp;   $result = false;<br/>
		&nbsp;&nbsp;&nbsp;   $pdo = DbUtil::connect ();<br/>
		&nbsp;&nbsp;&nbsp;   $dao = new '.dashesToCamelCase($tableName,true).'Dao ( $pdo );<br/>
		&nbsp;&nbsp;&nbsp;   // create new category object<br/>
		&nbsp;&nbsp;&nbsp;   $obj = new '.dashesToCamelCase($tableName,true).'BO ();<br/>
		&nbsp;&nbsp;&nbsp;   // get id from request<br/>
		&nbsp;&nbsp;&nbsp;   if (property_exists ( $data, \'id\' ))<br/>
		&nbsp;&nbsp;&nbsp;   	$obj->set'.dashesToCamelCase($tableName,true).'id ( $data->id );<br/>
		&nbsp;&nbsp;&nbsp;   	// get the persistance obj from db<br/>
		&nbsp;&nbsp;&nbsp;   $obj = $dao->getById ( $obj );<br/>
		&nbsp;&nbsp;&nbsp;   $obj->import($data);<br/>
		&nbsp;&nbsp;&nbsp;   $result = $dao->update ( $obj );<br/>
		&nbsp;&nbsp;&nbsp;   DbUtil::disconnect ();<br/>
		&nbsp;&nbsp;&nbsp;   return $result;<br/>}<br/>');
			
		}
		
		function getDeleteFunction($tableName){
		
			print('public function delete($data) {<br/>
				&nbsp;&nbsp;&nbsp;   $result = false;<br/>
				&nbsp;&nbsp;&nbsp;   $idstr = $data->ids;<br/>
				&nbsp;&nbsp;&nbsp;   $ids = explode ( ",", $idstr );<br/>
				&nbsp;&nbsp;&nbsp;   $pdo = DbUtil::connect ();<br/>
				&nbsp;&nbsp;&nbsp;   $dao = new '.dashesToCamelCase($tableName,true).'Dao ( $pdo );<br/>
				&nbsp;&nbsp;&nbsp;   $result = $dao->delete ( $ids );<br/>
				&nbsp;&nbsp;&nbsp;   DbUtil::disconnect ();<br/>
				&nbsp;&nbsp;&nbsp;   return $result;<br/>
				&nbsp;&nbsp;&nbsp;   }<br/>');
		}
		
		function getAllFunction($tableName){
		
			print('public function getAll() {<br/>
		
		&nbsp;&nbsp;&nbsp;   $pdo = DbUtil::connect ();<br/>
		
		&nbsp;&nbsp;&nbsp;   $dao = new '.dashesToCamelCase($tableName,true).'Dao ( $pdo );<br/>
		
		&nbsp;&nbsp;&nbsp;   $objArray = $dao->getAll();<br/>
		
		&nbsp;&nbsp;&nbsp;   DbUtil::disconnect ();<br/>
		
		&nbsp;&nbsp;&nbsp;   return  CommonUtil::objArrayToJson ( $objArray );<br/>
	&nbsp;&nbsp;&nbsp;   }<br/>');
				
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
