<?php
namespace com\numeracy\BO; 
class M04ChapterBO {
    private $m04chapterid;
    private $chaptername;
    private $chapternumber;
    private $m11statusid;
    private $description;
    private $shortdesc;
    private $createdon;
    private $createdby;
    private $modifiedon;
    private $modifiedby;
public function getM04chapterid() 
{ 
    return $this->m04chapterid; 
} 
public function setM04chapterid($m04chapterid) 
{ 
    $this->m04chapterid = $m04chapterid; 
} 
public function getChaptername() 
{ 
    return $this->chaptername; 
} 
public function setChaptername($chaptername) 
{ 
    $this->chaptername = $chaptername; 
} 
public function getChapternumber() 
{ 
    return $this->chapternumber; 
} 
public function setChapternumber($chapternumber) 
{ 
    $this->chapternumber = $chapternumber; 
} 
public function getM11statusid() 
{ 
    return $this->m11statusid; 
} 
public function setM11statusid($m11statusid) 
{ 
    $this->m11statusid = $m11statusid; 
} 
public function getDescription() 
{ 
    return $this->description; 
} 
public function setDescription($description) 
{ 
    $this->description = $description; 
} 
public function getShortdesc() 
{ 
    return $this->shortdesc; 
} 
public function setShortdesc($shortdesc) 
{ 
    $this->shortdesc = $shortdesc; 
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