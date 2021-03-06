<?php
namespace com\numeracy\BO; 
class M02CategoryBO {
    private $m02categoryid;
    private $label;
    private $m11statusid;
    private $startage;
    private $endage;
    private $gender;
    private $createdon;
    private $createdby;
    private $modifiedon;
    private $modifiedby;
public function getM02categoryid() 
{ 
    return $this->m02categoryid; 
} 
public function setM02categoryid($m02categoryid) 
{ 
    $this->m02categoryid = $m02categoryid; 
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
public function getStartage() 
{ 
    return $this->startage; 
} 
public function setStartage($startage) 
{ 
    $this->startage = $startage; 
} 
public function getEndage() 
{ 
    return $this->endage; 
} 
public function setEndage($endage) 
{ 
    $this->endage = $endage; 
} 
public function getGender() 
{ 
    return $this->gender; 
} 
public function setGender($gender) 
{ 
    $this->gender = $gender; 
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