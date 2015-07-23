<?php

class Book {
public $title = "";
public $author = "";
public $yearofpublication = "";


public function getTitle(){
	return $this->title;
}

public function setTitle($title){
	$this->title = $title;
}

public function getAuthor(){
	return $this->author;
}

public function setAuthor($author){
	$this->author = $author;
}

public function getYearofpublication(){
	return $this->yearofpublication;
}

public function setYearofpublication($yearofpublication){
	$this->yearofpublication = $yearofpublication;
}

public function toJSON(){
		return json_encode($this);
	}


}

$book = new Book();
$book->setTitle("JSF Cookbook");
$book->author = "Anghel Leonard";
$book->yearofpublication="2012";

$result = $book->toJSON();
echo 'The JSON representation is:'.$result.'<br>';


include_once '../util/DbUtil.php';
include_once '../dao/CategoryDao.php';
include_once '../bo/CategoryBO.php';

$pdo = DbUtil::connect();

$categoryDao = new CategoryDao($pdo);

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
	
	echo $jsonstr;

DbUtil::disconnect();

/* echo '************************'.'<br>';
echo 'Decoding the JSON data format into an PHP object:'.'<br>';
$decoded = json_decode($result);

var_dump($decoded);

echo $decoded->title.'<br>';
echo $decoded->author.'<br>';
echo $decoded->yearofpublication.'<br>';

echo '************************'.'<br>';
echo 'Decoding the JSON data format into an PHP array:'.'<br>';
$json = json_decode($result,true);

//listing the array
foreach($json as $prop => $value)
echo '<br/>'. $prop .' : '. $value; */
?> 
