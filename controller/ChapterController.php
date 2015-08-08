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
	
	if ($data->btn_action == 'save') {
		
		echo CommonUtil::getSuccessFailureJson($facade->createNewChapter ( $data ));
		
	} else if ($data->btn_action == 'update') {
		
		echo CommonUtil::getSuccessFailureJson($facade->updateChapter ( $data ));
		
	} else if ($data->btn_action == 'delete') {
		
		echo CommonUtil::getSuccessFailureJson($facade->deleteChapter ( $data ));
		
	} else if ($data->btn_action == 'getAllChapter') {
		
		echo $facade->getAllChapter ();
		
	} else {
		echo '{"message":"action not found"}';
	}
} catch ( Exception $e ) {
	echo CommonUtil::getExceptionMessage ( $e );
}

?>