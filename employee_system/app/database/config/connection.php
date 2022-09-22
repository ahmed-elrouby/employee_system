<?php 
class connection {
    private $hostname = 'localhost';
    private $username = 'root';
    private $password = '20160020';
    private $database = 'employee_system';
    private $connection;
    function __construct()
    {
        $this->connection = new mysqli($this->hostname,$this->username,$this->password,$this->database);
    }

    public function runDQL($query)
    {
        $result = $this->connection->query($query);
        if($result->num_rows > 0){
            return $result;
        }else{
            return [];
        }
    }

    public function runDML($query)
    {
        $result = $this->connection->query($query);
        if($result){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}