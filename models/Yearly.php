<?php

class Yearly extends QueryManager
{

    protected $TableName = "yearly_checklist";
    protected $TablePK = "yearly_checklist_ID";
    public $pk_value = 0;
    public $yearly_checklist_ID = 0;
    public $maintenance_name = "";
    public $created = "";
    public $status = 1;

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
            $this->pk_value = $data[0]['yearly_checklist_ID'];
            $this->maintenance_name = $data[0]['maintenance_name'];
            $this->status = $data[0]['status'];
            return True;
        } else {
            $this->Message = "No entry with provided email.";
            return false;
        }
    }

    public function update(){
        $query = "UPDATE ".$this->TableName." SET  maintenance_name=? WHERE ".$this->TablePK."=?";
        $data_vals = array($this->maintenance_name, $this->pk_value, );
        return ($this->_db->query($query, $data_vals)!=false ||  $this->_db->query($query, $data_vals)!=Null);
    }

    public function save(){
        $query = "INSERT ".$this->TableName." (maintenance_name) VALUES(?)";
        $data = array($this->maintenance_name);
        return $this->_db->query($query, $data);
    }

    public function set_disabled(){
        $query = "UPDATE ".$this->TableName." SET status=0 WHERE ".$this->TablePK."=? ";
        $data = array($this->pk_value);
        return $this->_db->query($query, $data);
    }

    public function add_vehilce_yrly_data($veh_id, $data){
        print_r($data);
        foreach ($data as $maint_id => $reamrk){
            
            if($reamrk!=""){
                $query = "INSERT INTO yearly_checklist_maintenance (yearly_checklist_ID, vehicle_ID, Remarks) VALUES (?, ?, ?)";        
                $arr = array($maint_id, $veh_id, $reamrk);
               $this->_db->query($query, $arr);
            }
            
        }
        // Update qtly date
        $query = "UPDATE vehicle set yrly_service_date = DATE_ADD(yrly_service_date, INTERVAL 365 DAY) WHERE Vehicle_ID = ?";
        $arr = array($veh_id);
        $this->_db->query($query, $arr);
        return true;
    }

}

?>
