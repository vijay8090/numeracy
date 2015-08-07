<?php
include_once '../util/CrossBrowserHead.php';
include_once '../util/CommonUtil.php';
include_once '../facade/DaoFacade.php';

// use PDO;
use com\numeracy\util\CommonUtil;
use com\numeracy\facade\DaoFacade;

$data = json_decode ( file_get_contents ( "php://input" ) );

$facade = new DaoFacade ();

try {
	
	 if ($data->btn_action == 'getAllStatus') {
		
		echo $facade->getAllStatus();
		
	} 
} catch ( Exception $e ) {
	echo CommonUtil::getExceptionMessage ( $e );
}

?>


