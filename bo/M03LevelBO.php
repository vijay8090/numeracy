<?php
namespace com\numeracy\BO; 
class M03LevelBO {
    private $m03levelid;
    private $label;
    private $m11statusid;
    private $createdon;
    private $createdby;
    private $modifiedon;
    private $modifiedby;
public function getM03levelid() 
{ 
    return $this->m03levelid; 
} 
public function setM03levelid($m03levelid) 
{ 
    $this->m03levelid = $m03levelid; 
} 
public function getLabel() 
{ 
    return $this->label; 
} 
public function setLabel($label) 
{ 
    $this->label = $label; 
} 
public function getM11statusid() 
{ 
    return $this->m11statusid; 
} 
public function setM11statusid($m11statusid) 
{ 
    $this->m11statusid = $m11statusid; 
} 
public function getCreatedon() 
{ 
    return $this->createdon; 
} 
public function setCreatedon($createdon) 
{ 
    $this->createdon = $createdon; 
} 
public function getCreatedby() 
{ 
    return $this->createdby; 
} 
public function setCreatedby($createdby) 
{ 
    $this->createdby = $createdby; 
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
public function import( $data) 
    { 
    foreach (get_object_vars($data) as $key => $value) { 
    $this->$key = $value; 
    } 
    } 
}
?>