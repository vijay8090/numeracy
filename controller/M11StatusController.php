<?php
    include_once '../util/CrossBrowserHead.php'; 
    include_once '../util/CommonUtil.php';
    include_once '../facade/M11StatusFacade.php';
    
    // use PDO;
    use com\numeracy\util\CommonUtil;
    use com\numeracy\facade\M11StatusFacade;
    
    $data = json_decode ( file_get_contents ( "php://input" ) );
    
    $facade = new M11StatusFacade();
    
    echo CommonUtil::excecuteCommand($facade,$data);
?>