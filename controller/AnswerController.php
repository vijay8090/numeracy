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
		
		echo CommonUtil::getSuccessFailureJson($facade->createNewAnswer ( $data ));
		
	} else if ($data->btn_action == 'update') {
		
		echo CommonUtil::getSuccessFailureJson($facade->updateAnswer ( $data ));
		
	} else if ($data->btn_action == 'delete') {
		
		echo CommonUtil::getSuccessFailureJson($facade->deleteAnswer ( $data ));
		
	} else if ($data->btn_action == 'getAll') {
		
		echo $facade->getAllAnswer();
		
	} else {
		echo '{"message":"action not found"}';
	}
} catch ( Exception $e ) {
	echo CommonUtil::getExceptionMessage ( $e );
}

?>


