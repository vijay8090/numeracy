<?php
/**
 * @author abi
 *
 */
class LevelBO
{

    private $levelId;
    private $label;
	private $createdOn;
	private $createdBy;
	private $modifiedOn;	
	private $modifiedBy;
	
	
	/**
     * @return the $levelId
     */
    public function getLevelId()
    {
        return $this->levelId;
    }

	/**
     * @return the $label
     */
    public function getLabel()
    {
        return $this->label;
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
     * @param field_type $levelId
     */
    public function setLevelId($levelId)
    {
        $this->levelId = $levelId;
    }

	/**
     * @param field_type $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
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

	
	
}

?>