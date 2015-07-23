<?php

/**
 * 
 * @author avijaya8
 *
 */
class CategoryBO
{

    private $id;

    private $label;

    private $startAge;

    private $endAge;

    private $gender;

    /**
     * http://mikeangstadt.name/projects/getter-setter-gen/
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * @param int $id            
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function setLabel($label)
    {
        $this->label = $label;
    }

    public function getStartAge()
    {
        return $this->startAge;
    }

    public function setStartAge($startAge)
    {
        $this->startAge = $startAge;
    }

    public function getEndAge()
    {
        return $this->endAge;
    }

    public function setEndAge($endAge)
    {
        $this->endAge = $endAge;
    }

    public function toJSON()
    {
        return json_encode($this);
    }

    /**
     *
     * @return the $gender
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     *
     * @param field_type $gender            
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    public function __toString()
    {
        return '{"id":"' . $this->id . '","label":"' . $this->getLabel() . '","startAge":"' . $this->getStartAge() . '","endAge":"' . $this->getEndAge() . '","gender":"' . $this->getGender(). '"}';
    }
}

?>