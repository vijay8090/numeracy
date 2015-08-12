<?php
    include_once '../util/CrossBrowserHead.php'; 
    include_once '../util/CommonUtil.php';
    include_once '../facade/M06FileFacade.php';
    
    // use PDO;
    use com\numeracy\util\CommonUtil;
    use com\numeracy\facade\M06FileFacade;
    
    $data = json_decode ( file_get_contents ( "php://input" ) );
    
    $facade = new M06FileFacade();
    
    echo CommonUtil::excecuteCommand($facade,$data);
?>
