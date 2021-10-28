<?php


class Category extends QueryManager
{

    protected $TableName = "categories";
    protected $TablePK = "category_id";

    public $category_id = 0;
    public $title = "";
    public $description = "";
    public $created = "";
    public $status = 1;

    public function __CONSTRUCT(){
        parent::__CONSTRUCT($this->TableName, $this->TablePK);
    }

    public function update(){
        $query = "UPDATE ".$this->TableName." SET  title=? , description=? WHERE ".$this->TablePK."=?";
        $data_vals = array($this->title, $this->description, $this->title, $this->category_id, );
        return ($this->_db->query($query, $data_vals)!=false ||  $this->_db->query($query, $data_vals)!=Null);
    }

    public function save(){
        $query = "INSERT ".$this->TableName." (title, description) VALUES(?, ?)";
        $data = array($this->title, $this->description);
        return $this->_db->query($query, $data);
    }


}