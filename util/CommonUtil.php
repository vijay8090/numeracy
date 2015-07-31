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
    
}


?>