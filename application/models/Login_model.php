<?php
class Login_model extends Model
{
    
    public function login_check($user, $pass)
    {
        $username = trim($user);
        $password = sha1($username.trim($pass));
        $stmt = $this->db->prepare('SELECT user_id, permissions, email, first_name, last_name, description FROM `users` WHERE `username` = ? AND `password` = ?');
        $stmt->bind_param('ss', $username, $password);
        $stmt->bind_result($user_id, $permissions, $email, $fname, $lname, $desc);
        $stmt->execute();
        $stmt->store_result();
        if($stmt->num_rows != 1)
        {
            return FALSE;
        }
        else
        {
            while($stmt->fetch())
            {
                $_SESSION['is_logged']                = TRUE;
                $_SESSION['user_info']['username']    = $user;
                $_SESSION['user_info']['user_id']     = $user_id;
                $_SESSION['user_info']['permissions'] = $permissions;
                $_SESSION['user_info']['email']       = $email;
                $_SESSION['user_info']['fname']       = $fname;
                $_SESSION['user_info']['lname']       = $lname;
                $_SESSION['user_info']['desc']        = $desc;
            }
            
            $this->stat();
            $this->update();
            
            return TRUE;
        }
    }
    
    public function logout()
    {
        $stmt = $this->db->prepare('DELETE FROM online_users WHERE user_id = ?');
        $stmt->bind_param('i', $_SESSION['user_info']['user_id']);
        $stmt->execute();
    }
    
    private function stat()
    {
        $now = time();
        $stmt = $this->db->prepare('INSERT INTO stats (user_id, ip, user_agent, time) VALUES (?, ?, ?, ?)');
        $stmt->bind_param('issi', $_SESSION['user_info']['user_id'], $_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT'], $now);
        $stmt->execute();
    }
    
    private function update()
    {
        $now = time();
        $stmt = $this->db->prepare('INSERT INTO online_users (user_id, last_seen) VALUES (?, ?)');
        $stmt->bind_param('ii', $_SESSION['user_info']['user_id'], $now);
        $stmt->execute();
    }
    
}