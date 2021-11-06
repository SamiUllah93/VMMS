<?php


class Maintainance extends QueryManager
{

    protected $TableName = "maintenance";
    protected $TablePK = "maintenance_id";
    public $pk_value = 0;
    public $maintenance_id = 0;
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
            $this->pk_value = $data[0]['maintenance_id'];
            $this->title = $data[0]['title'];
            $this->created = $data[0]['created'];
            $this->status = $data[0]['status'];
            return True;
        } else {
            $this->Message = "No entry with provided email.";
            return false;
        }
    }

    public function update(){
        $query = "UPDATE ".$this->TableName." SET  title=?  WHERE ".$this->TablePK."=?";
        $data_vals = array($this->title,  $this->pk_value);
        return ($this->_db->query($query, $data_vals)!=false ||  $this->_db->query($query, $data_vals)!=Null);
    }

    public function save(){
        $query = "INSERT ".$this->TableName." (title) VALUES(?)";
        $data = array($this->title);
        return $this->_db->query($query, $data);
    }


}