<?php

include_once '../util/CrossBrowserHead.php';
include_once '../util/CommonUtil.php';
include_once '../facade/DaoFacade.php';

// use PDO;
use com\numeracy\util\CommonUtil;
use com\numeracy\facade\DaoFacade;


$ds  = DIRECTORY_SEPARATOR;  //1
 
$storeFolder = '../uploads';   //2


 
if (!empty($_FILES)) {
     
    $tempFile = $_FILES['file']['tmp_name'];          //3             
      
    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;  //4
     
    $targetFile =  $targetPath. $_FILES['file']['name'];  //5
 
    move_uploaded_file($tempFile,$targetFile); //6
     
}
?>     
