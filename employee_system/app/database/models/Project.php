<?php
require_once __DIR__ ."\..\config\connection.php";
require_once __DIR__ ."\..\config\crud.php";
class Project extends connection implements crud
{
    private $id;
    private $name;
    private $description;
    private $start_date;
    private $end_date;
    private $employee_id;
    private $created_at;
    private $updated_at;
    private $status;


    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of start_date
     */
    public function getStart_date()
    {
        return $this->start_date;
    }

    /**
     * Set the value of start_date
     *
     * @return  self
     */
    public function setStart_date($start_date)
    {
        $this->start_date = $start_date;

        return $this;
    }

    /**
     * Get the value of end_date
     */
    public function getEnd_date()
    {
        return $this->end_date;
    }

    /**
     * Set the value of end_date
     *
     * @return  self
     */
    public function setEnd_date($end_date)
    {
        $this->end_date = $end_date;

        return $this;
    }

    /**
     * Get the value of employee_id
     */
    public function getEmployee_id()
    {
        return $this->employee_id;
    }

    /**
     * Set the value of employee_id
     *
     * @return  self
     */
    public function setEmployee_id($employee_id)
    {
        $this->employee_id = $employee_id;

        return $this;
    }

    /**
     * Get the value of created_at
     */
    public function getCreated_at()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of updated_at
     */
    public function getUpdated_at()
    {
        return $this->updated_at;
    }

    /**
     * Set the value of updated_at
     *
     * @return  self
     */
    public function setUpdated_at($updated_at)
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * Get the value of status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }
    public function read()
    {
        $this->id?$query="SELECT * FROM `project` where id=".$this->id:$query="SELECT * FROM `project`";
        return $this->runDQL($query);
    }
    public function update()
    {
        $query='UPDATE `project` SET `name`="'.$this->name.'",`description`="'.$this->description.'",`start_date`="'.$this->start_date.'",`end_date`="'.$this->end_date.'",`status`='.$this->status.' WHERE id='.$this->id;
        return $this->runDML($query);
    }
    public function delete()
    {
        $query="Delete FROM `project` Where id=".$this->id;
        return $this->runDML($query);
    }
    public function create()
    {
        $query="insert into `project` (`name`, `description`, `start_date`, `end_date`, `employee_id`,`status`) values('".$this->name."','".$this->description."','".$this->start_date."','".$this->end_date."',".$this->employee_id.",".$this->status.")";
        return $this->runDML($query);
    }

}
