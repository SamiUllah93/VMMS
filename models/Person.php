<?php

class Person extends  QueryManager
{
    public $Email = '';
    protected $Password = '';

    protected $TableName = "";
    protected $TablePK = "";
    protected $SessionPK = "";

    public function __CONSTRUCT($table_name, $table_pk, $session_key){
        parent::__CONSTRUCT($this->TableName, $this->TablePK);
        $this->TableName = $table_name;
        $this->TablePK = $table_pk;
        $this->SessionPK = $session_key;
    }

    public function SetPassword(string $password): void
    {
        $this->Password = md5($password);
    }


    public function Authenticate(): bool
    {
        if (empty($this->Email) || empty($this->Password)) {
            $this->Message = 'Empty email/password!';
            return false;
        } else {
            $query = "SELECT * FROM " . $this->TableName . " WHERE email = ? and password = ? ";
            $auth_data = $this->_db->query($query, array($this->Email, $this->Password));
            if (sizeof($auth_data) == 1) {
                Debug::Show("Auth: Creating Sessions");
                $Sm = SessionManager::GetSessionManager();
                return $Sm->StartSession($this->SessionPK, $this->Email);
            } else {
                Debug::Show("Auth: Failed");
                $this->Message = "Invalid email/password!";
                return false;
            }
        }
    }

    function Logout(): bool
    {
        $Sm = SessionManager::GetSessionManager();
        return $Sm->EndSession($this->SessionPK);
    }

    function IsLoggedIn(): bool
    {
        $sm = SessionManager::GetSessionManager();
        if ($sm->SessionExists($this->SessionPK)) {
            return $this->SetDetails($_SESSION[$this->SessionPK]);
        } else {
            return false;
        }
    }

    
	
	// Need to add roles and roles methods here,

}