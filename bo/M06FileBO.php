<?php

namespace com\numeracy\BO;

class M06FileBO {
	private $m06fileid;
	private $filename;
	private $m10typeid;
	private $extension;
	private $size;
	private $url;
	private $path;
	private $tags;
	private $createdon;
	private $createdby;
	private $modifiedon;
	private $modifiedby;
	public function getM06fileid() {
		return $this->m06fileid;
	}
	public function setM06fileid($m06fileid) {
		$this->m06fileid = $m06fileid;
	}
	public function getFilename() {
		return $this->filename;
	}
	public function setFilename($filename) {
		$this->filename = $filename;
	}
	public function getM10typeid() {
		return $this->m10typeid;
	}
	public function setM10typeid($m10typeid) {
		$this->m10typeid = $m10typeid;
	}
	public function getExtension() {
		return $this->extension;
	}
	public function setExtension($extension) {
		$this->extension = $extension;
	}
	public function getSize() {
		return $this->size;
	}
	public function setSize($size) {
		$this->size = $size;
	}
	public function getUrl() {
		return $this->url;
	}
	public function setUrl($url) {
		$this->url = $url;
	}
	public function getPath() {
		return $this->path;
	}
	public function setPath($path) {
		$this->path = $path;
	}
	public function getTags() {
		return $this->tags;
	}
	public function setTags($tags) {
		$this->tags = $tags;
	}
	public function getCreatedon() {
		return $this->createdon;
	}
	public function setCreatedon($createdon) {
		$this->createdon = $createdon;
	}
	public function getCreatedby() {
		return $this->createdby;
	}
	public function setCreatedby($createdby) {
		$this->createdby = $createdby;
	}
	public function getModifiedon() {
		return $this->modifiedon;
	}
	public function setModifiedon($modifiedon) {
		$this->modifiedon = $modifiedon;
	}
	public function getModifiedby() {
		return $this->modifiedby;
	}
	public function setModifiedby($modifiedby) {
		$this->modifiedby = $modifiedby;
	}
	public function iterateVisible() {
		$json = "{";
		foreach ( $this as $key => $value ) {
			$json .= "\"" . $key . "\":\"" . $value . "\",";
		}
		$json = substr ( $json, 0, - 1 );
		;
		$json .= "}";
		return $json;
	}
}
?>