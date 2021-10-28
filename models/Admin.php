<?php


class Admin extends Person
{
    public $AdminID = '';
    public $Name = "";
    public $Phone = "";
    public $CreatedAT = "";
    public $UpdatedAt = "";
    public $isSuper = 0;
    public $Status = 1;

    public function __CONSTRUCT($email = null)
    {
        parent::__CONSTRUCT('admin', 'admin_id', 'AdminEmail');
        if ($email) {
            $this->SetAdminDetails($email);
        }
    }

    public function SetDetails($email): bool
    {
        $query = "SELECT * FROM " . $this->TableName . " WHERE email=? ";
        $admin_data = $this->_db->query($query, array($email));

        if (sizeof($admin_data) == 1) {
            $this->AdminID = $admin_data[0]['admin_id'];
            $this->Name = $admin_data[0]['name'];
            $this->Email = $admin_data[0]['email'];
            $this->Phone = $admin_data[0]['phone'];
            $this->CreatedAT = $admin_data[0]['created_at'];
            $this->UpdatedAt = $admin_data[0]['updated_at'];
            $this->isSuper = $admin_data[0]['is_super'];
            return True;
        } else {
            $this->Message = "No admin exists with provided email.";
            return false;
        }
    }


    public function Save(): bool
    {
        if ($this->Validate()) {
            if (!$this->Exists()) {
                $this->Message = "New admin registered.";
                return $this->Insert();
            } else {
                $this->Message = "Email already in use.";
                return false;
            }
        } else {
            return false;
        }
    }


    private function Insert(): bool
    {
        $query = "INSERT INTO " . $this->TableName . " (name, email, password, phone, status, is_super) VALUES (?, ?, ?, ?, ?,?)";
        $data_items = array($this->Name, $this->Email, $this->Password, $this->Phone, $this->Status, $this->isSuper);
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
        if (!filter_var($this->Email, FILTER_VALIDATE_EMAIL)) {
            $this->Message = 'Invalid Email address.';
            return False;
        } elseif (empty($this->Name)) {
            $this->Message = 'Name cannot be empty.';
            return False;
        } elseif (empty($this->Password)) {
            $this->Message = 'Password cannot be empty.';
            return false;
        } else {
            return true;
        }
    }



    public function UpdatePassword($a, $b){
       $this->SetPassword($a);
       if($this->Authenticate()){
           $this->SetPassword($b);
           $query = "UPDATE admin SET password=?";
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

