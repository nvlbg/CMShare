<?php
class Contact_model extends Model
{
    
    public function save($name, $title, $message, $email)
    {
        $name = trim(Validate::escape_html($name));
        $title = trim(Validate::escape_html($title));
        $message = trim(Validate::escape_html($message));
        $email = trim(Validate::escape_html($email));
        $stmt = $this->db->prepare('INSERT INTO feedback (name, title, message, email) VALUES (?, ?, ?, ?)');
        $stmt->bind_param('ssss', $name, $title, $message, $email);
        return $stmt->execute();
    }
    
}