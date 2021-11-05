<?php


class Maintainance extends QueryManager
{

    protected $TableName = "maintenance";
    protected $TablePK = "maintenance_id";

    public $maintenance_id = 0;
    public $title = "";
    public $created = "";
    public $status = 1;

    public function __CONSTRUCT(){
        parent::__CONSTRUCT($this->TableName, $this->TablePK);
    }

    public function update(){
        $query = "UPDATE ".$this->TableName." SET  title=?  WHERE ".$this->TablePK."=?";
        $data_vals = array($this->title,  $this->driver_id, );
        return ($this->_db->query($query, $data_vals)!=false ||  $this->_db->query($query, $data_vals)!=Null);
    }

    public function save(){
        $query = "INSERT ".$this->TableName." (title) VALUES(?)";
        $data = array($this->title);
        return $this->_db->query($query, $data);
    }


}