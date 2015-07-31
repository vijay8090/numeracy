<?php


use com\numeracy\util\CommonUtil;
include_once '../util/CrossBrowserHead.php';
include_once '../util/DbUtil.php';
include_once '../dao/CategoryDao.php';
include_once '../bo/CategoryBO.php';
include_once '../util/util.php';
include_once '../util/CommonUtil.php';

use com\numeracy\BO\CategoryBO;

$data = json_decode(file_get_contents("php://input"));

//echo $data->category;

$pdo = DbUtil::connect();

$categoryDao = new CategoryDao($pdo);

//echo '{"message":'. $data->category .'}';

if( $data->btn_action == 'save')
{
	try
	{
	$category = $data->category;
	$startAge = $data->startAge;
	$endAge = $data->endAge;
	$gender = $data->gender;
	
	//$contact = $_POST['contact_no'];
	$categoryBO = new CategoryBO();

	$categoryBO->setLabel($category);
	$categoryBO->setStartAge($startAge);
	$categoryBO->setEndAge($endAge);
	$categoryBO->setGender($gender);


	if ($categoryDao->create($categoryBO)) {
		echo json_encode('{"message":"success"}');
	} 	else{
	
		echo json_encode('{"message":"failure"}');
	}
	
	}catch(Exception $e)
	{
		$msg = 'failure'.$e->getMessage().$e->getFile().$e->getLine();	
		$msg = str_replace("\\", "\\\\", $msg);
		$msg = htmlspecialchars($msg);		
		echo json_encode('{"message":"'.$msg.'"}');
	}
} else if( $data->btn_action == 'update')
{
	try
	{
	// create new category object
	$categoryBO = new CategoryBO();
	
	// get id from request
	if(property_exists($data, 'id')) $categoryBO->setCategoryId($data->id);
	
	// get the persistance obj from db
	$categoryBO =  $categoryDao->getById($categoryBO);
	
	if($categoryBO != null){
	// set new values
	if(property_exists($data, 'label')) $categoryBO->setLabel($data->label);
	if(property_exists($data, 'startAge')) $categoryBO->setStartAge($data->startAge);
	if(property_exists($data, 'endAge')) $categoryBO->setEndAge($data->endAge);
	if(property_exists($data, 'gender')) $categoryBO->setGender( $data->gender);
	
	}

	// update new values into db
	if ($categoryDao->update($categoryBO)) {
		
		echo json_encode('{"message":"success"}');
		
	} 	else{
	
		echo json_encode('{"message":"failure"}');
	}
	
	} catch(Exception $e)
	{
		$msg = 'failure'.$e->getMessage().$e->getFile().$e->getLine();	
		$msg = str_replace("\\", "\\\\", $msg);
		$msg = htmlspecialchars($msg);		
		echo json_encode('{"message":"'.$msg.'"}');
	}
}  else if( $data->btn_action == 'delete')
{
	try
	{
	$idstr = $data->ids;
	
	$ids = explode(",", $idstr);
		

	if ($categoryDao->delete($ids)) {
		echo json_encode('{"message":"success"}');
	} 	else{
	
		echo json_encode('{"message":"failure"}');
	}
	
	}catch(Exception $e)
	{
		$msg = 'failure'.$e->getMessage().$e->getFile().$e->getLine();	
		$msg = str_replace("\\", "\\\\", $msg);
		$msg = htmlspecialchars($msg);		
		echo json_encode('{"message":"'.$msg.'"}');
	}
} else if( $data->btn_action == 'getAllCategory') {

	try
	{
		
	//$clientip =	util::get_client_ip();
	
	$categoryArray =  $categoryDao->getAllCategory();
	
	$size = sizeof($categoryArray);

	$jsonstr = '';

	$jsonstr .= '{"message":"success","data":[';


	foreach ($categoryArray as $category) {
		
		$jsonstr .= $category->iterateVisible().",";
		
	    //$jsonstr .= CommonUtil::getJsonStr($category);

	}

	$jsonstr = substr($jsonstr, 0, -1); ;

	$jsonstr .= ']}';

	echo json_encode($jsonstr);
	
	}catch(Exception $e) {
		
		// echo $e->getMessage();
		$msg = 'failure'.$e->getMessage().$e->getFile().$e->getLine();	
		$msg = str_replace("\\", "\\\\", $msg);
		$msg = htmlspecialchars($msg);		
		echo json_encode('{"message":"'.$msg.'"}');
	}

	//echo $jsonstr;

}else{
	echo '{"message":"action not found"}';
}

DbUtil::disconnect();

?>


