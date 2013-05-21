<?php
class Users_admin extends Model
{
    
    public function getUsers()
    {
        $data = array();
        $this->db->query('SET names utf8');
        
        $stmt = $this->db->query('SELECT COUNT(*) as total FROM users WHERE permissions != "a"');
        $row = $stmt->fetch_assoc();
        
        $num_rows = (int) $row['total'];
        
        $path = PATH . 'admin/users/edit/?page=';
        $page = 1;
        
        if(isset($_GET['page']) && is_numeric($_GET['page']))
        {
            $page = (int) $_GET['page'];
        }
        
        $paginator = new Paginator($num_rows, $page, $path);
        $limits = $paginator->getLimits();
        
        $data['paginator'] = $paginator;
        
        
        $stmt = $this->db->query('SELECT user_id, username FROM users WHERE permissions != "a" LIMIT ' . $limits[0] . ', ' . $limits[1]);
        
        while($row = $stmt->fetch_assoc())
        {
            $user = array();
            
            $user['id'] = $row['user_id'];
            $user['name'] = $row['username'];
            
            $data['users'][] = $user;
        }
        
        return $data;
    }
    
    public function getUserInfo($id)
    {
        $id = (int) $id;
        $this->db->query('SET names utf8');
        
        $stmt = $this->db->prepare('SELECT email, username, description, first_name, last_name, permissions, sex FROM users WHERE user_id = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        
        $stmt->bind_result($email, $username, $description, $fname, $lname, $permissions, $sex);
        $stmt->fetch();
        
        $data = array();
        
        $data['avatar'] = Validate::getAvatarPath($id, 100);
        $data['id'] = $id;
        $data['email'] = $email;
        $data['username'] = $username;
        $data['description'] = $description;
        $data['fname'] = $fname;
        $data['lname'] = $lname;
        $data['permissions'] = $permissions;
        $data['sex'] = $sex == 'm' ? Language::$gender['male'] : Language::$gender['female'];
        
        return $data;
    }
    
    public function editUser($id)
    {
        $id = (int) $id;
        $this->db->query('SET names utf8');
        
        $permissions = $_POST['permissions'] == 'm' ? 'm' : 'n';
        
        $stmt = $this->db->prepare('UPDATE users SET first_name = ?, last_name = ?, description = ?, permissions = ? WHERE user_id = ?');
        $stmt->bind_param('ssssi', Validate::escape_html(trim($_POST['fname'])),
                                   Validate::escape_html(trim($_POST['lname'])),
                                   Validate::escape_html(trim($_POST['description'])),
                                   $permissions,
                                   $id);
        return $stmt->execute();
    }
    
    public function deleteUsers($users)
    {
        $this->db->query('SET names utf8');
        
        $stmt = $this->db->prepare('DELETE FROM users WHERE user_id = ? AND permissions != "a"');
        
        foreach($users as $user_id)
        {
            $id = (int) $user_id;
            
            $stmt->bind_param('i', $id);
            $stmt->execute();
        }
    }
    
    public function userExists($id)
    {
        $id = (int) $id;
        
        $stmt = $this->db->prepare('SELECT 1 FROM users WHERE user_id = ? AND permissions != "a"');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->store_result();
        
        return $stmt->num_rows == 1 ? TRUE : FALSE;
    }
    
}