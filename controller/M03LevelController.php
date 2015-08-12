<?php
    include_once '../util/CrossBrowserHead.php'; 
    include_once '../util/CommonUtil.php';
    include_once '../facade/M03LevelFacade.php';
    
    // use PDO;
    use com\numeracy\util\CommonUtil;
    use com\numeracy\facade\M03LevelFacade;
    
    $data = json_decode ( file_get_contents ( "php://input" ) );
    
    $facade = new M03LevelFacade();
    
    echo CommonUtil::excecuteCommand($facade,$data);
?>