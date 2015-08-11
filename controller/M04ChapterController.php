<?php
    include_once '../util/CrossBrowserHead.php'; 
    include_once '../util/CommonUtil.php';
    include_once '../facade/M04ChapterFacade.php';
    
    // use PDO;
    use com\numeracy\util\CommonUtil;
    use com\numeracy\facade\M04ChapterFacade;
    
    $data = json_decode ( file_get_contents ( "php://input" ) );
    
    $facade = new M04ChapterFacade();
    
    echo CommonUtil::excecuteCommand($facade,$data);
?>
