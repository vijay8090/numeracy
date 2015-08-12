<?php
namespace com\numeracy\BO; 
class M14LoginBO {
    private $m14loginid;
    private $username;
    private $password;
    private $createdon;
    private $createdby;
    private $modifiedon;
    private $modifiedby;
public function getM14loginid() 
{ 
    return $this->m14loginid; 
} 
public function setM14loginid($m14loginid) 
{ 
    $this->m14loginid = $m14loginid; 
} 
public function getUsername() 
{ 
    return $this->username; 
} 
public function setUsername($username) 
{ 
    $this->username = $username; 
} 
public function getPassword() 
{ 
    return $this->password; 
} 
public function setPassword($password) 
{ 
    $this->password = $password; 
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