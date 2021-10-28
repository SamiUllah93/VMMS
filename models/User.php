<?php


class User extends Person
{
    public $UserID = 0;
    public $FirstName = '';
    public $MiddleName = '';
    public $Surname = '';
    public $UTRNumber = '';
    public $NINumber = '';
    public $StreetAddress = '';
    public $AddressLine2 = '';
    public $City = '';
    public $Country = '';
    public $PostalCode = '';
    public $Phone = '';

    private $pasword = '';
    public $CreatedAt = '';
    public $UpdatedAt = '';
    public $Status = 0;

    protected $TableName = "users";
    protected $TablePK = "user_id";

    protected $SessionPK = "UserEmail";

    public function __CONSTRUCT($email = null)
    {
        parent::__CONSTRUCT('users', 'user_id', 'UserEmail');
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
            $this->FirstName = $user_data[0]['first_name'];
            $this->MiddleName = $user_data[0]['middle_name'];
            $this->Surname = $user_data[0]['surname'];
            $this->UTRNumber = $user_data[0]['utr_number'];
            $this->NINumber = $user_data[0]['ni_number'];
            $this->StreetAddress = $user_data[0]['street_address'];
            $this->AddressLine2 = $user_data[0]['address_line_2'];
            $this->City = $user_data[0]['city'];
            $this->Country = $user_data[0]['country'];
            $this->PostalCode = $user_data[0]['postal_code'];
            $this->Phone = $user_data[0]['phone'];
            $this->Email = $user_data[0]['email'];
            $this->CreatedAt = $user_data[0]['created_at'];
            $this->UpdatedAt = $user_data[0]['updated_at'];
            $this->Status = $user_data[0]['status'];
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
                    return $this->SendActivationEmail();
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

    private function Insert(): bool
    {
        $query = "INSERT INTO " . $this->TableName . " (first_name, surname, middle_name, utr_number, ni_number, 
        street_address, address_line_2, city, postal_code, phone, email, password) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
        $data_items = array($this->FirstName, $this->Surname, $this->MiddleName,  $this->UTRNumber, $this->NINumber,
            $this->StreetAddress, $this->AddressLine2,  $this->City, $this->PostalCode, $this->Phone, $this->Email, $this->Password);
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
            || empty($this->FirstName)
            || empty($this->MiddleName)
            || empty($this->Surname)
            || empty($this->Phone)
            || empty($this->Password)
            || empty($this->StreetAddress)
            || empty($this->PostalCode)
            || empty($this->City)
            || empty($this->UTRNumber)
            || empty($this->NINumber) ) {
            return False;
        } else {
            return true;
        }
    }


    private function SendActivationEmail(){
        $link = "https://acumenaccounting.co.uk/activate.php?in=".md5($this->Email);
        $body = "Dear ".$this->FirstName. " " .$this->MiddleName." ".$this->Surname;
        $body .= "<br /><br />";
        $body .= "Please click this link to <a href='".$link."'><u>Activate</u></a> your email. If it does not work copy and paste the link below into your browser.";
        $body .= "<br /><br />";
        $body .= "<a href='".$link."'>".$link."</a>";
        $body .= "<br /><br />";
        $body .= "Acumen Accounting UK Team.";
        $body .= "<br />https://acumenaccounting.co.uk";
        $mail = new Mail();
        if($mail->SendMail($this->Email, "Verify Email, Acument Accounting UK.", $body)){
            $this->Message = "Account created, check your email for the activation link.";
            return true;
        }else{
            $this->Message = "Failed to create email. Contact aministrator of the website.";
            return false;
        }
    }


}