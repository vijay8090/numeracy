<?php


include_once '../util/CrossBrowserHead.php';
include_once '../util/DbUtil.php';
include_once '../dao/CategoryDao.php';
include_once '../bo/CategoryBO.php';
include_once '../util/util.php';

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
} else if( $data->btn_action == 'getAllCategory') {

	try
	{
		
	//$clientip =	util::get_client_ip();
	//$userDir = util::get_user_directory();
	
	$categoryArray =  $categoryDao->getAllCategory();
	
	$size = sizeof($categoryArray);

	$jsonstr = '';

	$jsonstr .= '{"message":"success","data":[';

	//for ($x = 0; $x < $size; $x++) {
	//	$category = $categoryArray[$x];

	foreach ($categoryArray as $category) {

		//var_dump($category);

		$jsonstr .= $category->__toString().",";

	}

	$jsonstr = substr($jsonstr, 0, -1); ;

	$jsonstr .= ']}';

	echo json_encode($jsonstr);
	
	}catch(Exception $e)
	{
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


