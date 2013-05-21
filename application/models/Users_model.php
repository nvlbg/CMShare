<?php
class Users_model extends Model
{
    
    public function getUserData()
    {
        $data = array();
        $this->db->query('SET names utf8');
        $id = Validate::num($this->segment(2));
        
        $stmt = $this->db->prepare('SELECT u.username, u.description, u.date_registred, u.first_name, u.last_name, u.permissions, u.sex, ou.last_seen, (SELECT COUNT(*) FROM comments c WHERE u.user_id = c.author_id) as comments FROM users u LEFT JOIN online_users ou ON u.user_id = ou.user_id WHERE u.user_id = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->store_result();
        if($stmt->num_rows === 0)
        {
            return FALSE;
        }
        else
        {
            $stmt->bind_result($username, $description, $date_registred, $first_name, $last_name, $rights, $sex, $online, $comments);
            $stmt->fetch();
            $data['username'] = $username;
            $data['description'] = $description;
            $data['date_registred'] = date('j.m.y \a\t H:i a', $date_registred);
            if($first_name !== '')
            {
                $data['first_name'] = $first_name;
            }
            else
            {
                $data['first_name'] = '-';
            }
            
            if($last_name !== '')
            {
                $data['last_name'] = $last_name;
            }
            else
            {
                $data['last_name'] = '-';
            }
            
            $data['permissions'] = Language::$permissions[$rights];
            $data['sex'] = $sex == 'm' ? Language::$gender['male'] : Language::$gender['female'];
            if($sex == 'm')
            {
                $data['sex_color'] = '#00C';
            }
            else
            {
                $data['sex_color'] = '#FF2BFF';
            }
            $data['user_id'] = $id;
            $data['user_avatar'] = Validate::getAvatarPath($id, 100);
            
            $data['online'] = $online === NULL ? FALSE : TRUE;
            
            $data['comments'] = $comments;
            return $data;
        }
    }

}