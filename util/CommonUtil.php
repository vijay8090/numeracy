<?php 
namespace com\numeracy\util;

class CommonUtil {
    
    
 public static function getJsonStr($obj) {
        $json = "{";
         
        foreach($obj as $key => $value) {
            $json .= "\"".$key."\":\"".$value."\",";
            //print "$key => $value\n";
        }
         
        $json = substr($json, 0, -1); ;
         
        $json .= "}";
         
        return $json;
        //print $json;
    }
    


public static function getExceptionMessage( $e) {
	
	$msg = 'failure'.$e->getMessage().$e->getFile().$e->getLine();
	$msg = str_replace("\\", "\\\\", $msg);
	$msg = htmlspecialchars($msg);
	return json_encode('{"message":"'.$msg.'"}');
}

public static function getSuccessFailureJson($result){
	
	
	if ($result) {
		return json_encode ( '{"message":"success"}' );
	} else {
			
		return json_encode ( '{"message":"failure"}' );
	}
	
}


public static  function objArrayToJson($objArray) {
	$jsonstr = '';

	$jsonstr .= '{"message":"success","data":[';

	foreach ( $objArray as $obj ) {
			
		$jsonstr .= $obj->iterateVisible () . ",";
	}

	$jsonstr = substr ( $jsonstr, 0, - 1 );

	$jsonstr .= ']}';

	return json_encode ( $jsonstr );
}

}


?>