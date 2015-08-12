<?php
    include_once '../util/CrossBrowserHead.php'; 
    include_once '../util/CommonUtil.php';
    include_once '../facade/M14LoginFacade.php';
    
    // use PDO;
    use com\numeracy\util\CommonUtil;
    use com\numeracy\facade\M14LoginFacade;
    
    $data = json_decode ( file_get_contents ( "php://input" ) );
    
    $facade = new M14LoginFacade();
    
    echo CommonUtil::excecuteCommand($facade,$data);
?>