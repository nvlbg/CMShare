<?php
class Register_model extends Model
{

    private $errors = null;
    
    public function __construct()
    {
        parent::__construct();
        $this->errors = Language::$reg_error;
    }
    
    private function isValidUsername($user)
    {
        $trimmed_user = trim($user);
        $strlen = mb_strlen($trimmed_user);
        if($strlen < 4)
        {
            return $this->errors[0];
        }
        elseif($strlen > 32)
        {
            return $this->errors[1];
        }
        elseif(!preg_match('/(?=.*[a-zа-я])/i', $trimmed_user))
        {
            return $this->errors[2];
        }
        elseif(!preg_match('/^[а-яa-z0-9_]{4,32}$/i', $trimmed_user))
        {
            return $this->errors[3];
        }
        else
        {
            $stmt = $this->db->prepare('SELECT username FROM users WHERE username = ?');
            $stmt->bind_param('s', $trimmed_user);
            $stmt->execute();
            $stmt->store_result();
            if($stmt->num_rows != 0)
            {
                return $this->errors[4];
            }
            $stmt->close();
        }
        
        return TRUE;
    }

    private function isValidPassword($pass, $re, $user)
    {
        $trimmed_pass = trim($pass);
        $trimmed_re = trim($re);
        $trimmed_user = trim($user);
        if($trimmed_pass == $trimmed_user)
        {
            return $this->errors[5];
        }
        elseif(strlen($trimmed_pass) < 6)
        {
            return $this->errors[6];
        }
        elseif(!preg_match('/(?=.*[a-zа-я])(?=.*[0-9])/i', $trimmed_pass))
        {
            return $this->errors[7];
        }
        elseif($trimmed_pass != $trimmed_re)
        {
            return $this->errors[8];
        }

        return TRUE;
    }

    private function isValidEmail($email, $re)
    {
        $trimmed_email = trim($email);
        $trimmed_re = trim($re);
        if(mb_strlen($trimmed_email) > 50)
        {
            return $this->errors[9];
        }
        elseif(!preg_match('/^([.0-9a-z_-]+)@(([0-9a-z-]+\.)+[0-9a-z]{2,4})$/i', $trimmed_email))
        {
            return $this->errors[10];
        }
        elseif($trimmed_email != $trimmed_re)
        {
            return $this->errors[11];
        }
        else
        {
            $stmt = $this->db->prepare('SELECT email FROM users WHERE email = ?');
            $stmt->bind_param('s', $trimmed_email);
            $stmt->execute();
            $stmt->store_result();
            if($stmt->num_rows != 0)
            {
                return $this->errors[12];
            }
            $stmt->close();
        }

        return TRUE;
    }

    private function isValidName($name)
    {
        $trimmed_name = trim($name);
        $strlen = mb_strlen($trimmed_name);
        if($strlen == 0)
        {
            return TRUE;
        }
        elseif($strlen > 20)
        {
            return $this->errors[13];
        }
        elseif(!preg_match('/^[a-zа-я]{3,20}$/i', $trimmed_name))
        {
            return $this->errors[14];
        }

        return TRUE;
    }

    private function isValidSex($sex)
    {
        if($sex != 'm' && $sex != 'f')
        {
            return $this->errors[15];
        }
        return TRUE;
    }

    private function isValidDescription($description)
    {
        if(mb_strlen(trim($description)) > 400)
        {
            return $this->errors[16];
        }

        return TRUE;
    }

    public function register($username, $password, $email, $fname, $lname, $sex, $description, $permissions = 'n')
    {
        $stmt = $this->db->prepare('INSERT INTO `users` (`username`,`password`,`email`,`first_name`,`last_name`,`sex`,`description`,`date_registred`, `permissions`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $username = trim(Validate::escape_html($username));
        $password = trim(Validate::escape_html($password));
        $email = trim(Validate::escape_html($email));
        $fname = trim(Validate::escape_html($fname));
        $lname = trim(Validate::escape_html($lname));
        $sex = trim(Validate::escape_html($sex));
        $description = trim(Validate::escape_html($description));
        $now = time();
        $stmt->bind_param('sssssssis', $username, sha1($username.$password), $email, $fname, $lname, $sex, $description, $now, $permissions);
        if($stmt->execute())
        {
            return TRUE;
        }
        else
        {
            return $this->errors[17];
        }
    }
    
    public function validate()
    {
        $errors = array();
        
        $username_check = $this->isValidUsername($_POST['r-username']);
        $password_check = $this->isValidPassword($_POST['r-password'], $_POST['re-password'], $_POST['r-username']);
        $email_check = $this->isValidEmail($_POST['email'], $_POST['re-email']);
        $sex_check = $this->isValidSex($_POST['sex']);
        
        $username_check !== TRUE ? $errors[] = $username_check : '';
        $password_check !== TRUE ? $errors[] = $password_check : '';
        $email_check !== TRUE ? $errors[] = $email_check : '';
        $sex_check !== TRUE ? $errors[] = $sex_check : '';
        
        if(isset($_POST['first-name']))
        {
            $fname_check = $this->isValidName($_POST['first-name']);
            $fname_check !== TRUE ? $errors[] = $fname_check : '';
        }
        
        if(isset($_POST['last-name']))
        {
            $lname_check = $this->isValidName($_POST['last-name']);
            $lname_check !== TRUE ? $errors[] = $lname_check : '';
        }
        
        if(isset($_POST['description']))
        {
            $desc_check = $this->isValidDescription($_POST['description']);
            $desc_check !== TRUE ? $errors[] = $desc_check : '';
        }
        
        return $errors;
    }
    
}