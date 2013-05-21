<?php
class PM_model extends Model
{
    
    public function getMessages()
    {
        $this->db->query('SET names utf8');
        
        $stmt = $this->db->prepare('SELECT m.message_id, m.title, m.message, m.date_written, m.read, u.username, u.user_id FROM pm m LEFT JOIN users u ON m.sender_id = u.user_id WHERE m.reciever_id = ? AND m.del_reciever = "f" ORDER BY m.read DESC, m.date_written DESC');
        $stmt->bind_param('i', $_SESSION['user_info']['user_id']);
        $stmt->execute();
        $stmt->store_result();
        if($stmt->num_rows > 0)
        {
            $data['messages']['cnt'] = $stmt->num_rows;
            $stmt->bind_result($message_id, $title, $message, $date_written, $read, $username, $user_id);
            while($stmt->fetch())
            {
                $data['messages']['message_id'][] = $message_id;
                $data['messages']['title'][] = $title;
                $data['messages']['message'][] = strlen($message) > 128 ? substr($message, 0, 128) . ' ...' : $message;
                $data['messages']['date_written'][] = date('d.m.Y', $date_written);
                $data['messages']['read'][] = $read == 't' ? TRUE : FALSE;
                $data['messages']['username'][] = $username;
                $data['messages']['user_id'][] = $user_id;
                $data['messages']['avatar'][] = Validate::getAvatarPath($user_id, 44);
            }
            return $data;
        }
        else
        {
            return FALSE;
        }
    }
    
    public function getReadMessages()
    {
        $this->db->query('SET names utf8');
        
        $stmt = $this->db->prepare('SELECT m.message_id, m.title, m.message, m.date_written, m.read, u.username, u.user_id FROM pm m LEFT JOIN users u ON m.sender_id = u.user_id WHERE m.read = "t" AND m.del_reciever = "f" AND m.reciever_id = ?');
        $stmt->bind_param('i', $_SESSION['user_info']['user_id']);
        $stmt->execute();
        $stmt->store_result();
        if($stmt->num_rows > 0)
        {
            $data['messages']['cnt'] = $stmt->num_rows;
            $stmt->bind_result($message_id, $title, $message, $date_written, $read, $username, $user_id);
            while($stmt->fetch())
            {
                $data['messages']['message_id'][] = $message_id;
                $data['messages']['title'][] = $title;
                $data['messages']['message'][] = strlen($message) > 128 ? substr($message, 0, 128) . ' ...' : $message;
                $data['messages']['date_written'][] = date('d.m.Y', $date_written);
                $data['messages']['read'][] = $read == 'f' ? FALSE : TRUE;
                $data['messages']['username'][] = $username;
                $data['messages']['user_id'][] = $user_id;
                $data['messages']['avatar'][] = Validate::getAvatarPath($user_id, 44);
            }
            return $data;
        }
        else
        {
            return FALSE;
        }
    }
    
    public function getUnReadMessages()
    {
        $this->db->query('SET names utf8');
        
        $stmt = $this->db->prepare('SELECT m.message_id, m.title, m.message, m.date_written, m.read, u.username, u.user_id FROM pm m LEFT JOIN users u ON m.sender_id = u.user_id WHERE m.read = "f" AND m.del_reciever = "f" AND m.reciever_id = ?');
        $stmt->bind_param('i', $_SESSION['user_info']['user_id']);
        $stmt->execute();
        $stmt->store_result();
        if($stmt->num_rows > 0)
        {
            $data['messages']['cnt'] = $stmt->num_rows;
            $stmt->bind_result($message_id, $title, $message, $date_written, $read, $username, $user_id);
            while($stmt->fetch())
            {
                $data['messages']['message_id'][] = $message_id;
                $data['messages']['title'][] = $title;
                $data['messages']['message'][] = strlen($message) > 128 ? substr($message, 0, 128) . ' ...' : $message;
                $data['messages']['date_written'][] = date('d.m.Y', $date_written);
                $data['messages']['read'][] = $read == 'f' ? FALSE : TRUE;
                $data['messages']['username'][] = $username;
                $data['messages']['user_id'][] = $user_id;
                $data['messages']['avatar'][] = Validate::getAvatarPath($user_id, 44);
            }
            return $data;
        }
        else
        {
            return FALSE;
        }
    }
    
    public function getSent()
    {
        $this->db->query('SET names utf8');
        
        $stmt = $this->db->prepare('SELECT m.message_id, m.title, m.message, m.date_written, u.username, u.user_id FROM pm m LEFT JOIN users u ON m.reciever_id = u.user_id WHERE m.del_sender = "f" AND m.sender_id = ?');
        $stmt->bind_param('i', $_SESSION['user_info']['user_id']);
        $stmt->execute();
        $stmt->store_result();
        if($stmt->num_rows > 0)
        {
            $data['messages']['cnt'] = $stmt->num_rows;
            $stmt->bind_result($message_id, $title, $message, $date_written, $username, $user_id);
            while($stmt->fetch())
            {
                $data['messages']['message_id'][] = $message_id;
                $data['messages']['title'][] = $title;
                $data['messages']['message'][] = strlen($message) > 128 ? substr($message, 0, 128) . ' ...' : $message;
                $data['messages']['date_written'][] = date('d.m.Y', $date_written);
                $data['messages']['username'][] = $username;
                $data['messages']['user_id'][] = $user_id;
                $data['messages']['avatar'][] = Validate::getAvatarPath($user_id, 44);
                $data['messages']['read'][] = TRUE;
            }
            return $data;
        }
        else
        {
            return FALSE;
        }
    }
    
    public function send($message, $title, $reciever)
    {
        $this->db->query('SET names utf8');
        
        $now = time();
        
        $stmt = $this->db->prepare('INSERT INTO pm (message, title, sender_id, reciever_id, date_written) VALUES (?, ?, ?, ?, ?)');
        $stmt->bind_param('ssiii', $message, $title, $_SESSION['user_info']['user_id'], $reciever, $now);
        $stmt->execute();
    }
    
    public function getMessage()
    {
        $id = $this->segment(3);
        if($id == '' || $id == 0)
        {
            return FALSE;
        }
        
        $id = Validate::num($id);

        $this->db->query('SET names utf8');

        if($id == $_SESSION['user_info']['user_id'])
        {
            $user_id = 'p.sender_id';
            $other_id = 'reciever_id';
            $del_ = 'p.del_reciever';
        }
        else
        {
            $user_id = 'p.reciever_id';
            $other_id = 'sender_id';
            $del_ = 'p.del_sender';
        }
        
        $stmt = $this->db->prepare('SELECT p.message, p.title, p.date_written, p.read, u.username, u.user_id FROM pm p LEFT JOIN users u ON p.sender_id = u.user_id WHERE p.message_id = ? AND ((p.reciever_id = ? AND p.del_reciever = "f") OR (p.sender_id = ? AND p.del_sender = "f"))');
        $stmt->bind_param('iii', $id, $_SESSION['user_info']['user_id'], $_SESSION['user_info']['user_id']);

        $stmt->execute();
        $stmt->store_result();
        if($stmt->num_rows == 1)
        {
            $data = array();
            $stmt->bind_result($message, $title, $date_written, $read, $sender, $sender_id);
            $stmt->fetch();
            $stmt->close();

            $data['is_your'] = $sender_id != $_SESSION['user_info']['user_id'];
            $data['message'] = $message;
            $data['title'] = $title;
            $data['date_written'] = date('j.n.Y', $date_written);
            $data['sender'] = $sender;
            $data['sender_id'] = $sender_id;
            $data['avatar'] = Validate::getAvatarPath($sender_id, 44);
            $data['id'] = $id;
            
            if($read == 'f')
            {
                $stmt = $this->db->prepare('UPDATE pm SET `read` = "t" WHERE message_id = ?');
                $stmt->bind_param('i', $id);
                $stmt->execute();
            }
            
            return $data;
        }
        else
        {
            return FALSE;
        }
    }
    
    public function delete($id)
    {
        $id = Validate::num($id);
        $this->db->query('SET names utf8');
        
        $stmt = $this->db->prepare('SELECT IF(reciever_id = ?, "del_reciever", IF(sender_id = ?, "del_sender", NULL)) AS deler FROM pm WHERE message_id = ?');
        $stmt->bind_param('iii', $_SESSION['user_info']['user_id'], $_SESSION['user_info']['user_id'], $id);
        $stmt->bind_result($deler);
        $stmt->execute();
        $stmt->fetch();
        $stmt->close();
        
        if($deler === NULL)
        {
            return FALSE;
        }
        else
        {
            $query = '';
            if($deler == 'del_reciever')
            {
                $query = 'UPDATE pm SET del_reciever = "t" WHERE message_id = ?';
            }
            elseif($deler == 'del_sender')
            {
                $query = 'UPDATE pm SET del_sender = "t" WHERE message_id = ?';
            }
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('i', $id);
            $stmt->execute();
            return TRUE;
        }
    }

    public function isUser($username)
    {
        $this->db->query('SET names utf8');

        $username = trim($username);
        $stmt = $this->db->prepare('SELECT user_id FROM users WHERE username = ?');
        $stmt->bind_param('s', $username);
        $stmt->bind_result($user_id);

        $stmt->execute();
        $stmt->store_result();

        if($stmt->num_rows != 1)
        {
            return FALSE;
        }

        $stmt->fetch();
        return $user_id;

    }
	
    public function getUsername($id)
    {
            $id = Validate::num($id);

            $this->db->query('SET names utf8');

            $stmt = $this->db->prepare('SELECT username FROM `users` WHERE user_id = ? AND user_id != ?');
            $stmt->bind_param('ii', $id, $_SESSION['user_info']['user_id']);
            $stmt->execute();
            $stmt->store_result();

            if($stmt->num_rows == 0)
            {
                    return '';
            }

            $stmt->bind_result($username);
            $stmt->fetch();
            return $username;
    }

}