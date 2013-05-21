<?php
class Admin_model extends Model
{

    public function checkAdminPass()
    {
        $this->db->query('SET names utf8');

        $user = trim($_POST['admin_name']);
        $pass = sha1($user.trim($_POST['admin_password']));

        $stmt = $this->db->prepare('SELECT 1 FROM users WHERE username = ? AND password = ?');
        $stmt->bind_param('ss', $user, $pass);

        $stmt->execute();
        $stmt->store_result();

        if($stmt->num_rows != 1)
        {
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }
    
    public function getLastFiveUsers()
    {
        $this->db->query('SET names utf8');
        
        $stmt = $this->db->query('SELECT user_id, username FROM users ORDER BY date_registred DESC LIMIT 5');
        
        $data = array();
        
        while($row = $stmt->fetch_assoc())
        {
            $user = array();
            
            $user['id'] = $row['user_id'];
            $user['name'] = $row['username'];
            
            $data[] = $user;
        }
        
        return $data;
    }
    
    public function getLastFiveComments()
    {
        $this->db->query('SET names utf8');
        
        $stmt = $this->db->query('SELECT c.comment, c.article_id, c.author_id, c.date_written, IF(author_id = 0, name, u.username) as username
                                  FROM comments c LEFT JOIN users u ON (c.author_id = u.user_id)
                                  ORDER BY c.date_written DESC LIMIT 5');
        
        $data = array();

        while($row = $stmt->fetch_assoc())
        {
            $row['date_written'] = date('d.m.y H:i', $row['date_written']);
            $data[] = $row;
        }

        return $data;
    }
    
}