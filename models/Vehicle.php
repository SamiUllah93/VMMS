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
    public $msg = "";
    public $maint_data = [];
    public $company_id = "";
    public $qtrly_service_date = "";
    public $yrly_service_date = "";
    public $odo_reading = "";

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
            $this->Driver_ID = $data[0]['Driver_ID'];
            $this->company_id = $data[0]['company_id'];
            $this->qtrly_service_date = $data[0]['qtrly_service_date'];
            $this->yrly_service_date = $data[0]['yrly_service_date'];
            $this->odo_reading = $data[0]['odo_reading'];
            
            return True;
        } else {
            $this->Message = "No entry with provided email.";
            return false;
        }
    }



    public function save(){
        $query = "INSERT ".$this->TableName." (BA_NO, Make_type, Issued_On, Year_of_Manufacturer, Driver_ID, company_id, qtrly_service_date, yrly_service_date, odo_reading) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";
        if($this->Driver_ID == "NULL"){
            $this->Driver_ID = null;
        }
        if($this->company_id == "NULL"){
            $this->company_id = null;
        }
        $data = array($this->BA_NO, $this->Make_type , $this->Issued_On , $this->Year_of_Manufacturer, $this->Driver_ID, $this->company_id, $this->qtrly_service_date, $this->yrly_service_date, $this->odo_reading);
        if($this->_db->query($query, $data) == 1){
            $this->Vehicle_ID = $this->_db->lastInsertId();
            foreach ($this->maint_data as $maint_id => $data_arr){
                if($data_arr['kms']==null){
                    $data_arr['kms']= 0; 
                }
                if($data_arr['days']==null){
                    $data_arr['days']="NULL";
                }
                $query = "INSERT into maintenance_vehicle (maintenance_ID, vehicle_ID, duration_In_days, distance,next_due,next_distance) VALUES(?, ?, ?, ?,DATE_ADD(now() , INTERVAL ".$data_arr['days']." DAY),?)";
                $data = array($maint_id, $this->Vehicle_ID , $data_arr['days'] ,$data_arr['kms'],$data_arr['kms']+$this->odo_reading);
                $this->_db->query($query, $data);
               
            }

            // Update driver as assgined
            $driver = new Driver();
            if ($this->Driver_ID == null){
                return true;
            }else{
                $driver->driver_id = $this->Driver_ID;
                return $driver->set_driver_assigned();
            }
            
            
        }else{
            $this->msg = "Faield to add maintenances";
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

    public function overdue(){
        $query = "SELECT mv.maintenance_vehicle_ID as ID,datediff(Date(`next_due`),CURRENT_DATE) AS Remaing_days , name,BA_NO,title,`next_due` as pending_on FROM maintenance_vehicle as mv left join vehicle as v1 on v1.Vehicle_ID = mv.vehicle_ID left join maintenance as m on mv.maintenance_ID = m.maintenance_id left join driver as d on d.driver_id = v1.Driver_ID where Date(`next_due`) < CURRENT_DATE()
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
        $query = "SELECT mv.next_distance , v1.Vehicle_ID as veh_id,mv.maintenance_vehicle_ID as ID,v1.odo_reading as current_reading,mv.distance,DATEDIFF(`next_due`,CURRENT_DATE) AS Remaing_days , name,BA_NO,title,`next_due` as pending_on FROM maintenance_vehicle as mv left join vehicle as v1 on v1.Vehicle_ID = mv.vehicle_ID left join maintenance as m on mv.maintenance_ID = m.maintenance_id left join driver as d on d.driver_id = v1.Driver_ID";
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
        $query = "SELECT SUM(`total_running`)/SUM(`total_fuel_added`) AS fuel_average, vehicle.BA_NO , SUM(`total_fuel_added`) as total_fuel_added ,SUM(`total_running`) as total_running FROM vehicle, fuel_record WHERE vehicle.Vehicle_ID = fuel_record.vehicle_id GROUP BY vehicle.BA_NO";
        return $this->_db->query($query);
    }

    public function process_maintenance($veh_m_id, $odo){
        $query = "INSERT INTO process_maintenance (maintenance_vehicleid, odometer_reading) VALUES(?, ?)";
        $data = array($veh_m_id, $odo);
        if ($this->_db->query($query, $data)){
            // update next due date
            $days_to_add = $this->get_vehicle_maintenance_type_days($veh_m_id);
            ($days_to_add);
           
             $query = "UPDATE maintenance_vehicle SET next_due = DATE_ADD(now() , INTERVAL '$days_to_add' DAY) WHERE maintenance_vehicle_ID = $veh_m_id ";
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
        $query ="SELECT SUM(`total_running`)/SUM(`total_fuel_added`)  as average from fuel_record";       
        return  $this->_db->query($query);
    }

    public function attach_company_to_vehicle($comp_id, $veh_id){
        $query = "UPDATE ".$this->TableName." SET company_id = ? WHERE vehicle_ID = ? ";
        $data = array($comp_id, $veh_id);
        return $this->_db->query($query, $data );
    }

    public function release_vehicle_driver($veh_id){
        $veh = new Vehicle($veh_id);
        $driver =  new Driver($veh->Driver_ID);
        return $driver->set_driver_unassigned();
    }

    public function attach_driver_to_vehicle($driver_id, $veh_id){
        if($this->release_vehicle_driver($veh_id)){
            $query = "UPDATE ".$this->TableName." SET Driver_ID = ? WHERE vehicle_ID = ? ";
            $data = array($driver_id, $veh_id);
            if($this->_db->query($query, $data)){
                $dr = new Driver($driver_id);
                return  $dr->set_driver_assigned();
            }else{
                return false;
            }
        }
       
    }

    public function get_vehicle_details(){
        $query = "SELECT `BA_NO`, `Make_Type`, `Issued_On`, `Year_of_Manufacturer`, v.`Driver_ID`, d.name, c.title, v.Vehicle_ID, v.created FROM `vehicle` AS v LEFT JOIN company AS c ON v.`company_id` = c.company_id LEFT JOIN `driver` AS d ON v.Driver_ID = d.Driver_ID";
        return $this->_db->query($query); 
    } 


    public function dateonly_alerts($from,$to){
        $query = "SELECT mv.next_distance ,mv.maintenance_vehicle_ID as ID,v1.odo_reading as current_reading,mv.distance,DATEDIFF(`next_due`,CURRENT_DATE) AS Remaing_days , name,BA_NO,title,`next_due` as pending_on FROM maintenance_vehicle as mv left join vehicle as v1 on v1.Vehicle_ID = mv.vehicle_ID left join maintenance as m on mv.maintenance_ID = m.maintenance_id left join driver as d on d.driver_id = v1.Driver_ID where mv.next_due between ? and ?
        ";
        $data = array($from, $to);
        return $this->_db->query($query,$data);
    }
    public function dateandmain_alert($from,$to,$maint){
        $query = "SELECT mv.next_distance , mv.maintenance_vehicle_ID as ID,v1.odo_reading as current_reading,mv.distance,DATEDIFF(`next_due`,CURRENT_DATE) AS Remaing_days , name,BA_NO,title,`next_due` as pending_on FROM maintenance_vehicle as mv left join vehicle as v1 on v1.Vehicle_ID = mv.vehicle_ID left join maintenance as m on mv.maintenance_ID = m.maintenance_id left join driver as d on d.driver_id = v1.Driver_ID where mv.next_due between ? and ? and m.maintenance_id = ?
        ";
        $data = array($from, $to,$maint);
        return $this->_db->query($query,$data);
    }
    public function dateandcompany_alert($from,$to,$comp){
        $query = "SELECT mv.next_distance ,mv.maintenance_vehicle_ID as ID,v1.odo_reading as current_reading,mv.distance,DATEDIFF(`next_due`,CURRENT_DATE) AS Remaing_days , name,BA_NO,title,`next_due` as pending_on FROM maintenance_vehicle as mv left join vehicle as v1 on v1.Vehicle_ID = mv.vehicle_ID left join maintenance as m on mv.maintenance_ID = m.maintenance_id left join driver as d on d.driver_id = v1.Driver_ID where mv.next_due between ? and ? and  v1.company_id = ?
        ";
        $data = array($from, $to,$comp);
        return $this->_db->query($query,$data);
    }
    public function maintandcompany_alert($maint,$comp){
        $query = "SELECT mv.next_distance , mv.maintenance_vehicle_ID as ID,v1.odo_reading as current_reading,mv.distance,DATEDIFF(`next_due`,CURRENT_DATE) AS Remaing_days , name,BA_NO,title,`next_due` as pending_on FROM maintenance_vehicle as mv left join vehicle as v1 on v1.Vehicle_ID = mv.vehicle_ID left join maintenance as m on mv.maintenance_ID = m.maintenance_id left join driver as d on d.driver_id = v1.Driver_ID where  v1.company_id = ? and m.maintenance_id = ?
        ";
        $data = array($comp,$maint);
        return $this->_db->query($query,$data);
    } 

    public function company_alert($comp){
        $query = "SELECT mv.next_distance ,mv.maintenance_vehicle_ID as ID,v1.odo_reading as current_reading,mv.distance,DATEDIFF(`next_due`,CURRENT_DATE) AS Remaing_days , name,BA_NO,title,`next_due` as pending_on FROM maintenance_vehicle as mv left join vehicle as v1 on v1.Vehicle_ID = mv.vehicle_ID left join maintenance as m on mv.maintenance_ID = m.maintenance_id left join driver as d on d.driver_id = v1.Driver_ID where  v1.company_id = ?
        ";
        $data = array($comp);
        return $this->_db->query($query,$data);
    } 

    public function maint_alert($maint){
        $query = "SELECT mv.next_distance ,mv.maintenance_vehicle_ID as ID,v1.odo_reading as current_reading,mv.distance,DATEDIFF(`next_due`,CURRENT_DATE) AS Remaing_days , name,BA_NO,title,`next_due` as pending_on FROM maintenance_vehicle as mv left join vehicle as v1 on v1.Vehicle_ID = mv.vehicle_ID left join maintenance as m on mv.maintenance_ID = m.maintenance_id left join driver as d on d.driver_id = v1.Driver_ID where  m.maintenance_id = ?
        ";
        $data = array($maint);
        return $this->_db->query($query,$data);
    } 

    public function allfilter_alert($from,$to,$maint,$comp){
        $query = "SELECT mv.next_distance ,mv.maintenance_vehicle_ID as ID,v1.odo_reading as current_reading,mv.distance,DATEDIFF(`next_due`,CURRENT_DATE) AS Remaing_days , name,BA_NO,title,`next_due` as pending_on FROM maintenance_vehicle as mv left join vehicle as v1 on v1.Vehicle_ID = mv.vehicle_ID left join maintenance as m on mv.maintenance_ID = m.maintenance_id left join driver as d on d.driver_id = v1.Driver_ID where mv.next_due between ? and ? and v1.company_id = ? and m.maintenance_id = ?
        ";
        $data = array($from, $to,$comp,$maint);
        return $this->_db->query($query,$data);
    }

    
    public function get_vehicle_qrtrly_maint_data($veh){
        $query = "SELECT qmc.*,qc.maintenance_name FROM `quarterly_maintenance_vehicle` as qmc, quarterly_checklist as qc WHERE qmc.`quarterly_checklist_ID` = qc.`quarterly_checklist_ID` and vehicle_ID = ? ";
        $data = array($veh);
        return $this->_db->query($query,$data);
    }

    public function get_vehicle_yearly_maint_data($veh){
        $query = "SELECT ymc.*,yc.maintenance_name FROM `yearly_checklist_maintenance` as ymc,yearly_checklist as yc WHERE ymc.yearly_checklist_ID = yc.`yearly_checklist_ID` and `vehicle_ID` = ? ";
        $data = array($veh);
        return $this->_db->query($query,$data);
    }
    

    public function get_vehicle_detailalerts_qtly(){
        $query = "SELECT v1.Vehicle_ID as veh_id, DATEDIFF(`qtrly_service_date`, CURRENT_DATE) AS Remaing_days , qtrly_service_date as pending_on, name,BA_NO FROM vehicle as v1 left join driver as d on d.driver_id = v1.Driver_ID ";
        return $this->_db->query($query);
    }

    public function get_vehicle_detailalerts_yrly(){
        $query = "SELECT v1.Vehicle_ID as veh_id, DATEDIFF(`yrly_service_date`, CURRENT_DATE) AS Remaing_days , yrly_service_date as pending_on, name,BA_NO FROM vehicle as v1 left join driver as d on d.driver_id = v1.Driver_ID ";
        return $this->_db->query($query);
    }
}

