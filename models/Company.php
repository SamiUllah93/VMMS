<?php

class Company extends QueryManager
{

    protected $TableName = "company";
    protected $TablePK = "company_id";
    public $pk_value = 0;
    public $company_id = 0;
    public $title = "";
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
            $this->pk_value = $data[0]['company_id'];
            $this->name = $data[0]['title'];
            $this->status = $data[0]['status'];
            return True;
        } else {
            $this->Message = "No entry with provided email.";
            return false;
        }
    }

    public function update(){
        $query = "UPDATE ".$this->TableName." SET  title=? WHERE ".$this->TablePK."=?";
        $data_vals = array($this->title, $this->pk_value, );
        return ($this->_db->query($query, $data_vals)!=false ||  $this->_db->query($query, $data_vals)!=Null);
    }

    public function save(){
        $query = "INSERT ".$this->TableName." (title) VALUES(?)";
        $data = array($this->title);
        return $this->_db->query($query, $data);
    }

    public function set_disabled(){
        $query = "UPDATE ".$this->TableName." SET status=0 WHERE ".$this->TablePK."=? ";
        $data = array($this->pk_value);
        return $this->_db->query($query, $data);
    }


}

?>
