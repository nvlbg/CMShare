<?php
class Feedback_admin extends Model
{

    public function getMessages()
    {
        $data = array();
        $this->db->query('SET names utf8');
        
        $stmt = $this->db->query('SELECT COUNT(*) as total FROM feedback');
        $row = $stmt->fetch_assoc();
        
        $num_rows = (int) $row['total'];
        
        $path = PATH . 'admin/feedback/';
        $page = 1;
        
        if(is_numeric($this->segment(3)))
            $page = (int) $this->segment (3);
        
        $paginator = new Paginator($num_rows, $page, $path);
        $limits = $paginator->getLimits();
        
        $data['paginator'] = $paginator;
        
        $stmt = $this->db->prepare('SELECT name, title, message, email FROM feedback ORDER BY id DESC LIMIT ?, ?');
        $stmt->bind_param('ii', $limits[0], $limits[1]);
        
        $stmt->execute();
        
        $stmt->bind_result($name, $title, $message, $email);
        
        while($stmt->fetch())
        {
            $msg = array();
            
            $msg['name'] = $name;
            $msg['title'] = $title;
            $msg['message'] = $message;
            $msg['email'] = $email;
            
            $data['messages'][] = $msg;
        }
        
        return $data;
    }

}