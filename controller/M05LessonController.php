<?php
    include_once '../util/CrossBrowserHead.php'; 
    include_once '../util/CommonUtil.php';
    include_once '../facade/M05LessonFacade.php';
    
    // use PDO;
    use com\numeracy\util\CommonUtil;
    use com\numeracy\facade\M05LessonFacade;
    
    $data = json_decode ( file_get_contents ( "php://input" ) );
    
    $facade = new M05LessonFacade();
    
    echo CommonUtil::excecuteCommand($facade,$data);
?>
