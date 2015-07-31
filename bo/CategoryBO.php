<?php

namespace com\numeracy\BO;

use com\numeracy\BO\BaseBO;

require __DIR__ . '\BaseBO.php';

class CategoryBO extends BaseBO
{

    private $categoryId;
    private $label;
	private $statusId;
	private $startAge;
	private $endAge;
	private $gender;
	private $createdOn;
	private $createdBy;
	private $modifiedOn;
	private $modifiedBy;
	
	
	/**
     * @return the $categoryId
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

	/**
     * @return the $label
     */
    public function getLabel()
    {
        return $this->label;
    }

	/**
     * @return the $statusId
     */
    public function getStatusId()
    {
        return $this->statusId;
    }

	/**
     * @return the $startAge
     */
    public function getStartAge()
    {
        return $this->startAge;
    }

	/**
     * @return the $endAge
     */
    public function getEndAge()
    {
        return $this->endAge;
    }

	/**
     * @return the $gender
     */
    public function getGender()
    {
        return $this->gender;
    }

	/**
     * @return the $createdOn
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

	/**
     * @return the $createdBy
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

	/**
     * @return the $modifiedOn
     */
    public function getModifiedOn()
    {
        return $this->modifiedOn;
    }

	/**
     * @return the $modifiedBy
     */
    public function getModifiedBy()
    {
        return $this->modifiedBy;
    }

	/**
     * @param field_type $categoryId
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;
    }

	/**
     * @param field_type $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

	/**
     * @param field_type $statusId
     */
    public function setStatusId($statusId)
    {
        $this->statusId = $statusId;
    }

	/**
     * @param field_type $startAge
     */
    public function setStartAge($startAge)
    {
        $this->startAge = $startAge;
    }

	/**
     * @param field_type $endAge
     */
    public function setEndAge($endAge)
    {
        $this->endAge = $endAge;
    }

	/**
     * @param field_type $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

	/**
     * @param field_type $createdOn
     */
    public function setCreatedOn($createdOn)
    {
        $this->createdOn = $createdOn;
    }

	/**
     * @param field_type $createdBy
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;
    }

	/**
     * @param field_type $modifiedOn
     */
    public function setModifiedOn($modifiedOn)
    {
        $this->modifiedOn = $modifiedOn;
    }

	/**
     * @param field_type $modifiedBy
     */
    public function setModifiedBy($modifiedBy)
    {
        $this->modifiedBy = $modifiedBy;
    }

	
    /**
     * 
     * @return string
     */
    public function iterateVisible() {
        $json = "{";
         
        foreach($this as $key => $value) {
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