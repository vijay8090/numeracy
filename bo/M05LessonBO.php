<?php
namespace com\numeracy\BO; 
class M05LessonBO {
    private $m05lessonid;
    private $title;
    private $longdesc;
    private $shortdesc;
    private $additionalinfo;
    private $createdon;
    private $createdby;
    private $modifiedon;
    private $modifiedby;
    private $m11statusid;
public function getM05lessonid() 
{ 
    return $this->m05lessonid; 
} 
public function setM05lessonid($m05lessonid) 
{ 
    $this->m05lessonid = $m05lessonid; 
} 
public function getTitle() 
{ 
    return $this->title; 
} 
public function setTitle($title) 
{ 
    $this->title = $title; 
} 
public function getLongdesc() 
{ 
    return $this->longdesc; 
} 
public function setLongdesc($longdesc) 
{ 
    $this->longdesc = $longdesc; 
} 
public function getShortdesc() 
{ 
    return $this->shortdesc; 
} 
public function setShortdesc($shortdesc) 
{ 
    $this->shortdesc = $shortdesc; 
} 
public function getAdditionalinfo() 
{ 
    return $this->additionalinfo; 
} 
public function setAdditionalinfo($additionalinfo) 
{ 
    $this->additionalinfo = $additionalinfo; 
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