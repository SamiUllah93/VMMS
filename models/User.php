<?php


class User extends QueryManager
{   
    public $pk_value = 0;
    public $UserID = 0;
    public $Name = '';
    public $Email = '';
    public $Password = '';
    public $isAdmin = false;
    public $CreatedAt = '';
    public $UpdatedAt = '';
    public $Status = 0;

    protected $TableName = "user";
    protected $TablePK = "user_id";

    protected $SessionPK = "UserEmail";

    public function __CONSTRUCT($email = null)
    {   
        parent::__CONSTRUCT($this->TableName, $this->TablePK);
        if ($email) {
            $this->SetDetails($email);
        }
    }

    public function SetDetails($email): bool
    {
        $query = "SELECT * FROM " . $this->TableName . " WHERE email=? ";
        $user_data = $this->_db->query($query, array($email));
        
        if (sizeof($user_data) == 1) {
            $this->UserID = $user_data[0]['user_id'];
            $this->Name = $user_data[0]['name'];
            $this->Email = $user_data[0]['email'];
            $this->Status = $user_data[0]['status'];
            $this->isAdmin = $user_data[0]['isadmin'];
            $this->CreatedAt = $user_data[0]['created'];
            $this->UpdatedAt = $user_data[0]['updated'];
            return True;
        } else {
            $this->Message = "No user exists with provided email.";
            return false;
        }
    }

    public function Save(): bool
    {
        
        if ($this->Validate()) {
            
            if (!$this->Exists()) {
                $this->Message = "Profile created.";
                
                if($this->Insert()){
                    return true;
                }else{
                    return False;
                }

            } else {
                $this->Message = "Email already in use.";
                return false;
            }
        } else {
           $this->Message = "Fields with * are required.";
            return false;
        }
    }

    protected function Exists(): bool
    {
        $query = "SELECT COUNT(*) AS numb FROM " . $this->TableName . " WHERE email=?";
        $email_counts = $this->_db->query($query, array($this->Email));
        return $email_counts[0]['numb'] > 0;
    }

    public function Activate($encodedid){
        $query = "UPDATE " . $this->TableName . " SET Status=1 WHERE md5(email)=? ";
        if($this->_db->query($query, array($encodedid))!=NULL){
            $this->Message = "Acount activated.";
            return True;
        }else{
            $this->Message = "Failed to activate account.";
            return False;
        }
    }

    private function Insert(): bool
    {
        $query = "INSERT INTO " . $this->TableName . " (name, email, password) VALUES (?,?,?)";
        $data_items = array($this->Name,$this->Email, $this->Password);
        $insert_status = $this->_db->query($query, $data_items);
        if ($insert_status) {
            return true;
        } else {
            return false;
        }
    }



    private function Validate(): bool
    {
        // change to single if with ors.
        if (!filter_var($this->Email, FILTER_VALIDATE_EMAIL)
            || empty($this->Name)
            || empty($this->Email)
            || empty($this->Password)
            
            ) {
                
                return False;
        } else {
          
            return true;
        }
    }


    public function SetPassword(string $password): void
    {
        $this->Password = $password;
    }


    public function Authenticate(): bool{
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


    public function UpdatePassword($a, $b){
        $this->SetPassword($a);
        if($this->Authenticate()){
            $this->SetPassword($b);
            $query = "UPDATE " . $this->TableName . " SET password=?";
            $data = $this->_db->query($query, array($this->Password));
            if($data>0 && $data!=NULL){
                $this->Message = "Password updated.";
                return true;
            }else{
                return false;
            }
        }else{
            $this->Message = "Invalid current password.";
            return False;
        }
     }

  

}