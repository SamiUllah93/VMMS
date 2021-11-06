<?php


class Driver extends QueryManager
{

    protected $TableName = "driver";
    protected $TablePK = "driver_id";
    public $pk_value = 0;
    public $driver_id = 0;
    public $name = "";
    public $armyno = "";
    public $created = "";
    public $status = 1;

    public function __CONSTRUCT(){
        parent::__CONSTRUCT($this->TableName, $this->TablePK);
    }

    public function update(){
        $query = "UPDATE ".$this->TableName." SET  name=? , armyno=? WHERE ".$this->TablePK."=?";
        $data_vals = array($this->name, $this->armyno, $this->driver_id, );
        return ($this->_db->query($query, $data_vals)!=false ||  $this->_db->query($query, $data_vals)!=Null);
    }

    public function save(){
        $query = "INSERT ".$this->TableName." (name, armyno) VALUES(?, ?)";
        $data = array($this->name, $this->armyno);
        return $this->_db->query($query, $data);
    }

    public function set_driver_assigned(){
        $query = "UPDATE ".$this->TableName." SET status=1 WHERE driver_id=?";
        $data = array($this->driver_id);
        return $this->_db->query($query, $data);
    }

    public function get_drivers(){
        $query = "select driver.*, (select BA_NO from vehicle where vehicle.Driver_ID = driver.driver_id) as BA_NO from driver";
        return $this->_db->query($query);
    }

    
    


}