<?php
require_once __DIR__ ."\..\config\connection.php";
require_once __DIR__ ."\..\config\crud.php";
class Task extends connection implements crud
{
    private $id;
    private $name;
    private $description;
    private $empolyee_task;
    private $start_date;
    private $end_date;
    private $employee_id;
    private $project_id;
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
     * Get the value of empolyee_task
     */ 
    public function getEmpolyee_task()
    {
        return $this->empolyee_task;
    }

    /**
     * Set the value of empolyee_task
     *
     * @return  self
     */ 
    public function setEmpolyee_task($empolyee_task)
    {
        $this->empolyee_task = $empolyee_task;

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
     * Get the value of project_id
     */
    public function getProject_id()
    {
        return $this->project_id;
    }

    /**
     * Set the value of project_id
     *
     * @return  self
     */
    public function setProject_id($project_id)
    {
        $this->project_id = $project_id;

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
        // $this->employee_id?$query = "SELECT * FROM `task` where employee_id=" . $this->id : $query = "SELECT * FROM `task`";
        $this->id ? $query = "SELECT * FROM `task` where id=" . $this->id :($this->employee_id ? $query = "SELECT * FROM `task` where employee_id=" . $this->employee_id : $query = "SELECT * FROM `task`");
        // echo $query;die;
        return $this->runDQL($query);
    }
    public function update()
    {
        $query = 'UPDATE `task` SET `name`="' . $this->name . '",`description`="' . $this->description . '",`start_date`="' . $this->start_date . '",`end_date`="' . $this->end_date . '",`project_id`='.$this->project_id.',`employee_id`='.$this->employee_id.',`status`=' . $this->status . ' WHERE id=' . $this->id;
        return $this->runDML($query);
    }
    public function Submit_task()
    {
        $query = 'UPDATE `task` SET `empolyee_task`="' . $this->empolyee_task . '",`status`=' . $this->status . ' WHERE id=' . $this->id;
        return $this->runDML($query);
    }
    public function delete()
    {
        $query = "Delete FROM `task` Where id=" . $this->id;
        return $this->runDML($query);
    }
    public function create()
    {
        $query = "insert into `task` (`name`, `description`, `start_date`, `end_date`, `employee_id`,`project_id`,`status`) values('" . $this->name . "','" . $this->description . "','" . $this->start_date . "','" . $this->end_date . "'," . $this->employee_id . "," . $this->project_id. "," . $this->status . ")";
        return $this->runDML($query);
    }
}
