<?php
    include_once '../util/CrossBrowserHead.php'; 
    include_once '../util/CommonUtil.php';
    include_once '../facade/M13AnswerFacade.php';
    
    // use PDO;
    use com\numeracy\util\CommonUtil;
    use com\numeracy\facade\M13AnswerFacade;
    
    $data = json_decode ( file_get_contents ( "php://input" ) );
    
    $facade = new M13AnswerFacade();
    
    echo CommonUtil::excecuteCommand($facade,$data);
?>