<?php
namespace com\numeracy\BO; 
class M12QuestionBO {
    private $m12questionid;
    private $description;
    private $createdon;
    private $createdby;
    private $modifiedon;
    private $modifiedby;
    private $active;
    private $m11statusid;
public function getM12questionid() 
{ 
    return $this->m12questionid; 
} 
public function setM12questionid($m12questionid) 
{ 
    $this->m12questionid = $m12questionid; 
} 
public function getDescription() 
{ 
    return $this->description; 
} 
public function setDescription($description) 
{ 
    $this->description = $description; 
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
public function getActive() 
{ 
    return $this->active; 
} 
public function setActive($active) 
{ 
    $this->active = $active; 
} 
public function getM11statusid() 
{ 
    return $this->m11statusid; 
} 
public function setM11statusid($m11statusid) 
{ 
    $this->m11statusid = $m11statusid; 
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