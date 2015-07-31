<?php
namespace com\numeracy\BO; 
require __DIR__ . "\BaseBO.php"; 
use com\numeracy\BO\BaseBO; 
class M02CategoryBO extends BaseBO {
    private $m02categoryid;
    private $label;
    private $startage;
    private $endage;
    private $gender;
    private $createdby;
    private $createdon;
    private $modifiedby;
    private $modifiedon;
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
public function getCreatedby() 
{ 
    return $this->createdby; 
} 
public function setCreatedby($createdby) 
{ 
    $this->createdby = $createdby; 
} 
public function getCreatedon() 
{ 
    return $this->createdon; 
} 
public function setCreatedon($createdon) 
{ 
    $this->createdon = $createdon; 
} 
public function getModifiedby() 
{ 
    return $this->modifiedby; 
} 
public function setModifiedby($modifiedby) 
{ 
    $this->modifiedby = $modifiedby; 
} 
public function getModifiedon() 
{ 
    return $this->modifiedon; 
} 
public function setModifiedon($modifiedon) 
{ 
    $this->modifiedon = $modifiedon; 
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