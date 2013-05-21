<?php
class Settings_model extends Model
{
    
    public function getLastLogins()
    {
        $data = array();
        $this->db->query('SET names utf8');
        $stmt = $this->db->prepare('SELECT ip, time FROM stats WHERE user_id = ? ORDER BY time DESC LIMIT 5');
        $stmt->bind_param('i', $_SESSION['user_info']['user_id']);
        $stmt->bind_result($ip, $time);
        $stmt->execute();
        $stmt->store_result();
        $data['rows'] = $stmt->num_rows;
        while($stmt->fetch())
        {
            $data['ip'][] = $ip;
            $data['time'][] = date('j.n.Y', $time);
        }
        return $data;
    }
    
    public function checkPasswords()
    {
        $this->db->query('SET names utf8');
        
        $pass = sha1($_SESSION['user_info']['username'].trim($_POST['old-password']));
        
        $stmt = $this->db->prepare('SELECT COUNT(*) as cnt FROM users WHERE password = ?');
        $stmt->bind_param('s', $pass);
        $stmt->bind_result($cnt);
        $stmt->execute();
        $stmt->fetch();
        
        if($cnt != 1)
        {
            return FALSE;
        }
        else
        {
            return TRUE;
        }
        
    }
    
    public function changePassword()
    {
        $this->db->query('SET names utf8');
        
        $pass = sha1($_SESSION['user_info']['username'].trim($_POST['new-password']));
        
        $stmt = $this->db->prepare('UPDATE users SET password = ? WHERE user_id = ?');
        $stmt->bind_param('si', $pass, $_SESSION['user_info']['user_id']);
        return $stmt->execute();
    }
    
    public function updateDescription()
    {
        $this->db->query('SET names utf8');
        
        $desc = Validate::escape_html(trim($_POST['p-desc']));
        
        $stmt = $this->db->prepare('UPDATE users SET description = ? WHERE user_id = ?');
        $stmt->bind_param('si', $desc, $_SESSION['user_info']['user_id']);
        if($stmt->execute())
        {
           $_SESSION['user_info']['desc'] = $desc;
           return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    public function updateFirst()
    {
        $this->db->query('SET names utf8');
        
        $fname = Validate::escape_html(trim($_POST['p-fname']));
        
        $stmt = $this->db->prepare('UPDATE users SET first_name = ? WHERE user_id = ?');
        $stmt->bind_param('si', $fname, $_SESSION['user_info']['user_id']);
        if($stmt->execute())
        {
            $_SESSION['user_info']['fname'] = $fname;
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    public function updateLast()
    {
        $this->db->query('SET names utf8');
        
        $lname = Validate::escape_html(trim($_POST['p-lname']));
        
        $stmt = $this->db->prepare('UPDATE users SET last_name = ? WHERE user_id = ?');
        $stmt->bind_param('si', $lname, $_SESSION['user_info']['user_id']);
        if($stmt->execute())
        {
            $_SESSION['user_info']['lname'] = $lname;
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
}