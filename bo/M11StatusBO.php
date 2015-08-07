<?php
namespace com\numeracy\BO; 
class M11StatusBO {
    private $m11statusid;
    private $code;
    private $label;
    private $createdon;
    private $createby;
    private $modifiedon;
    private $modifiedby;
public function getM11statusid() 
{ 
    return $this->m11statusid; 
} 
public function setM11statusid($m11statusid) 
{ 
    $this->m11statusid = $m11statusid; 
} 
public function getCode() 
{ 
    return $this->code; 
} 
public function setCode($code) 
{ 
    $this->code = $code; 
} 
public function getLabel() 
{ 
    return $this->label; 
} 
public function setLabel($label) 
{ 
    $this->label = $label; 
} 
public function getCreatedon() 
{ 
    return $this->createdon; 
} 
public function setCreatedon($createdon) 
{ 
    $this->createdon = $createdon; 
} 
public function getCreateby() 
{ 
    return $this->createby; 
} 
public function setCreateby($createby) 
{ 
    $this->createby = $createby; 
} 
public function getModifiedon() 
{ 
    return $this->modifiedon; 
} 
public function setModifiedon($modifiedon) 
{ 
    $this->modifiedon = $modifiedon; 
} 
public function getModifiedby() 
{ 
    return $this->modifiedby; 
} 
public function setModifiedby($modifiedby) 
{ 
    $this->modifiedby = $modifiedby; 
} 
public function iterateVisible() { 
    $json = "{"; 
    foreach($this as $key => $value) { 
   	    $json .= "\"".$key."\":\"".$value."\","; 
    } 
    $json = substr($json, 0, -1); ; 
    $json .= "}"; 
    return $json; 
} 
}
?>
