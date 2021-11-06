<?php


class Vehicle extends QueryManager
{

    protected $TableName = "vehicle";
    protected $TablePK = "Vehicle_ID";
    public $pk_value = 0;
    public $Vehicle_ID = 0;
    public $BA_NO = "";
    public $Make_type = "";
    public $Issued_On = "";
    public $Year_of_Manufacturer = "";
    public $Driver_ID = "";
    public $created = "";
    public $status = 1;

    public $maint_data = [];

    public function __CONSTRUCT(){
        parent::__CONSTRUCT($this->TableName, $this->TablePK);
    }


    public function save(){
        $query = "INSERT ".$this->TableName." (BA_NO, Make_type, Issued_On, Year_of_Manufacturer, Driver_ID) VALUES(?, ?, ?, ?, ?)";
        $data = array($this->BA_NO, $this->Make_type , $this->Issued_On , $this->Year_of_Manufacturer, $this->Driver_ID);
        if($this->_db->query($query, $data) == 1){
            $this->Vehicle_ID = $this->_db->lastInsertId();
            foreach ($this->maint_data as $maint_id => $data_arr){
               
                $query = "INSERT maintenance_vehicle (maintenance_ID, vehicle_ID, duration_In_days, distance) VALUES(?, ?, ?, ?)";
                $data = array($maint_id, $this->Vehicle_ID , $data_arr['days'] ,$data_arr['kms']);
                $this->_db->query($query, $data);
            }

            // Update driver as assgined
            $driver = new Driver();
            $driver->driver_id = $this->Driver_ID;
            return $driver->set_driver_assigned();
        }else{
            return false;
        }
    }


}
