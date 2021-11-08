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

    public function __CONSTRUCT($id = null)
    {   
        parent::__CONSTRUCT($this->TableName, $this->TablePK);
        if ($id) {
            $this->SetDetails($id);
        }
    }

    public function SetDetails($id): bool
    {
        $query = "SELECT * FROM " . $this->TableName . " WHERE ". $this->TablePK ."=? ";
        $data = $this->_db->query($query, array($id));
        
        if (sizeof($data) == 1) {
            $this->pk_value = $data[0]['Vehicle_ID'];
            $this->BA_NO = $data[0]['BA_NO'];
            $this->Make_type = $data[0]['Make_Type'];
            $this->Year_of_Manufacturer = $data[0]['Year_of_Manufacturer'];
            $this->created = $data[0]['created'];
            $this->status = $data[0]['Status'];
            return True;
        } else {
            $this->Message = "No entry with provided email.";
            return false;
        }
    }



    public function save(){
        $query = "INSERT ".$this->TableName." (BA_NO, Make_type, Issued_On, Year_of_Manufacturer, Driver_ID) VALUES(?, ?, ?, ?, ?)";
        $data = array($this->BA_NO, $this->Make_type , $this->Issued_On , $this->Year_of_Manufacturer, $this->Driver_ID);
        if($this->_db->query($query, $data) == 1){
            $this->Vehicle_ID = $this->_db->lastInsertId();
            foreach ($this->maint_data as $maint_id => $data_arr){
               
                $query = "INSERT into maintenance_vehicle (maintenance_ID, vehicle_ID, duration_In_days, distance,next_due) VALUES(?, ?, ?, ?,DATE_ADD(now() , INTERVAL ".$data_arr['days']." DAY))";
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

    public function insert_part($title, $Vehicle_ID, $added_date){
        $query = "INSERT into parts (title, vehicle_ID, Added_date) VALUES(?, ?, ?)";
        $data = array($title, $Vehicle_ID, $added_date);
        return $this->_db->query($query, $data);
    }

    public function pending_today(){
        $query = "SELECT mv.maintenance_vehicle_ID as ID,Date(`next_due`) - CURRENT_DATE AS Remaing_days , name,BA_NO,title,`next_due` as pending_on FROM maintenance_vehicle as mv left join vehicle as v1 on v1.Vehicle_ID = mv.vehicle_ID left join maintenance as m on mv.maintenance_ID = m.maintenance_id left join driver as d on d.driver_id = v1.Driver_ID where Date(`next_due`) = CURRENT_DATE()
        ";
        return $this->_db->query($query);
    }

    public function pending_today_count(){
        $query = "SELECT Count(*) as pending_count FROM maintenance_vehicle as mv left join vehicle as v1 on v1.Vehicle_ID = mv.vehicle_ID left join maintenance as m on mv.maintenance_ID = m.maintenance_id left join driver as d on d.driver_id = v1.Driver_ID where Date(`next_due`) = CURRENT_DATE()
        ";
        $data = $this->_db->query($query);
        return $data[0]['pending_count'];
    }

    public function alerts_count(){
        $query = "SELECT Count(*) as alert_count FROM maintenance_vehicle as mv left join vehicle as v1 on v1.Vehicle_ID = mv.vehicle_ID left join maintenance as m on mv.maintenance_ID = m.maintenance_id left join driver as d on d.driver_id = v1.Driver_ID 
        ";
        $data = $this->_db->query($query);
        return $data[0]['alert_count'];
    }

    public function alerts(){
        $query = "SELECT mv.maintenance_vehicle_ID as ID,DATEDIFF(`next_due`,CURRENT_DATE) AS Remaing_days , name,BA_NO,title,`next_due` as pending_on FROM maintenance_vehicle as mv left join vehicle as v1 on v1.Vehicle_ID = mv.vehicle_ID left join maintenance as m on mv.maintenance_ID = m.maintenance_id left join driver as d on d.driver_id = v1.Driver_ID
        ";
        return $this->_db->query($query);
    }


    public function pending_today_by_id($id){
        $query = "SELECT mv.maintenance_vehicle_ID as ID, name,BA_NO,v1.Make_Type, title FROM maintenance_vehicle as mv left join vehicle as v1 on v1.Vehicle_ID = mv.vehicle_ID left join maintenance as m on mv.maintenance_ID = m.maintenance_id left join driver as d on d.driver_id = v1.Driver_ID where mv.maintenance_vehicle_ID = ?";
        $data = array($id);
        return $this->_db->query($query, $data);
    }

    public function get_vehicle_parts($id){
        $query = "Select * from parts where vehicle_ID= ?";
        $data = array($id);
        return $this->_db->query($query, $data);
    }

    public function vehicle_usage($id){
        $query = "Select * from fuel_record where vehicle_ID= ?";
        $data = array($id);
        return $this->_db->query($query, $data);
    }

    public function insert_usage($vehicle_id,$total_fuel_added,$total_running){
        $query = "INSERT into fuel_record (vehicle_id, total_fuel_added, total_running) VALUES(?, ?, ?)";
        $data = array($vehicle_id,$total_fuel_added,$total_running);
        return $this->_db->query($query, $data);
        }


    public function total_running(){
        $query = "SELECT SUM(`total_running`) as Total_Running ,BA_NO FROM `fuel_record` left join vehicle on fuel_record.vehicle_id = vehicle.Vehicle_ID GROUP by BA_NO";
        return $this->_db->query($query);
    }

    public function fuel_average(){
        $query = "SELECT SUM(`total_fuel_added`) AS total_fuel_added, SUM(total_running) AS total_running, total_fuel_added / total_running AS fuel_average, vehicle.BA_NO FROM vehicle, fuel_record WHERE vehicle.Vehicle_ID = fuel_record.vehicle_id GROUP BY vehicle.BA_NO";
        return $this->_db->query($query);
    }

    public function process_maintenance($veh_m_id, $odo){
        $query = "INSERT INTO process_maintenance (maintenance_vehicleid, odometer_reading) VALUES(?, ?)";
        $data = array($veh_m_id, $odo);
        if ($this->_db->query($query, $data)){
            // update next due date
            $days_to_add = $this->get_vehicle_maintenance_type_days($veh_m_id);
            ($days_to_add);
           
             $query = "UPDATE maintenance_vehicle SET next_due = DATE_ADD(next_due , INTERVAL '$days_to_add' DAY) WHERE maintenance_vehicle_ID = $veh_m_id ";
            //$data = array($days_to_add, $veh_m_id);
            return $this->_db->query($query);
        }
    }

    public function get_vehicle_maintenance_type_days($veh_m_id){
        $query = "SELECT duration_In_days from maintenance_vehicle WHERE maintenance_vehicle_ID= ?";
        $data = array($veh_m_id);
        $fetch = $this->_db->query($query, $data);
        return $fetch[0]['duration_In_days']; 
    }

    public function get_vehicle_maintenance_history($vehicle_id){
        $query = "SELECT DATE(pm.created) AS Process_Date, `odometer_reading`, title, NAME, BA_NO FROM process_maintenance AS pm LEFT JOIN maintenance_vehicle AS mv ON mv.maintenance_vehicle_ID = pm.maintenance_vehicleid LEFT JOIN maintenance AS mv1 ON mv1.maintenance_ID = mv.maintenance_id LEFT JOIN vehicle AS v ON mv.vehicle_ID = v.Vehicle_ID LEFT JOIN driver AS d ON d.driver_id = v.Driver_ID WHERE v.Vehicle_ID = ?
        ";
        $data = array($vehicle_id);
        return  $this->_db->query($query, $data);
    }

    public function dashboard_count(){
        $query ="Select SUM(total_running) as dashboard_count FROM fuel_record";       
        return  $this->_db->query($query);
    }

    public function total_average_count(){
        $query ="SELECT SUM(`total_fuel_added`) / SUM(`total_running`) as average from fuel_record";       
        return  $this->_db->query($query);
    }


}
