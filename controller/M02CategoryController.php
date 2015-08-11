<?php
    include_once '../util/CrossBrowserHead.php'; 
    include_once '../util/CommonUtil.php';
    include_once '../facade/M02CategoryFacade.php';
    
    // use PDO;
    use com\numeracy\util\CommonUtil;
    use com\numeracy\facade\M02CategoryFacade;
    
    $data = json_decode ( file_get_contents ( "php://input" ) );
    
    $facade = new M02CategoryFacade();
    
    echo CommonUtil::excecuteCommand($facade,$data);
?>