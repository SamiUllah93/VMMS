<?php
    class QueryManager{
        protected $_db = NUll;
        protected $TableName = '';
        protected $TablePK = '';

        private $DBHost = '127.0.0.1';
        private $DBPort =  3306;
        private $DBName = 'vmss';
        private $DBUser = 'root';
        private $DBPassword = '';

        public $Message = "";

        public function __CONSTRUCT($table_name, $table_pk){
            $this->_db = new Db($this->DBHost, $this->DBPort, $this->DBName, $this->DBUser, $this->DBPassword);
            $this->TableName = $table_name;
            $this->TablePK = $table_pk;
        }

        /*
         * params:
         * 1. limit(int) : number of rows to return
         * 2. order_by(string) : order by colulmn name
         * 3. order_as(string) : AESC or DSC
        */
        public function get_all($limit = 0, $order_by = '', $order_as = 'ASC'){
            $query = "SELECT * FROM ".$this->TableName." ";
            if ($order_by!=''){
                $query.= " ORDER BY " .  $order_by . " ". $order_as;
            }
            if ($limit>0){
                $query.= " LIMIT " . $limit;
            }
            return $this->_db->query($query);
        }

        public function get_all_keyval($key, $val){
            $query = "SELECT * FROM ".$this->TableName." WHERE ".$key." = ? ORDER BY created_at DESC";
            return $this->_db->query($query, array($val));
        }

        public function get_count(){
            $query = "SELECT count(*) as 'numb' FROM ".$this->TableName;
            $count_data =  $this->_db->query($query);
            return $count_data[0]['numb']; // might not be array
        }

        public function get_count_keyval($key, $val){
            $query = "SELECT count(*) as 'numb' FROM ".$this->TableName." WHERE ".$key." = ?";
            $count_data =  $this->_db->query($query, array($val));
            return $count_data[0]['numb']; // might not be array
        }



    }
?>