<?php
class Shared_model extends Model
{
    
    public function getMsgCount()
    {
        $this->db->query('SET names utf8');
        
        $stmt = $this->db->prepare('SELECT COUNT(*) FROM pm WHERE reciever_id = ? AND `read` = "f"');
        $stmt->bind_param('i', $_SESSION['user_info']['user_id']);
        $stmt->bind_result($msg_count);
        $stmt->execute();
        $stmt->fetch();
        
        return $msg_count;
    }
    
    public function getSectionsData()
    {
        $data = array();

        $this->db->query('SET names utf8');

        include SPATH . 'system/classes/Category.php';
        $categories = $this->getCategories();
        $title = Language::$sections['categories']['title'];
        $data['section'][] = new CategoryObj($categories, $title);

        include SPATH . 'system/classes/Tag.php';
        $tags = $this->getTags();
        $title = Language::$sections['tags']['title'];
        $data['section'][] = new TagObj($tags, $title);

        return $data;
    }

    private function getCategories()
    {
        $data = array();

        $stmt = $this->db->query('SELECT * FROM categories');
        while($row = $stmt->fetch_assoc())
        {
            $data[$row['category_id']] = $row['category_name'];
        }

        return $data;
    }

    private function getTags()
    {
        $data = array();

        $stmt = $this->db->query('SELECT tags.tag, tags.tag_id,  COUNT(*) as count FROM tag_map, tags WHERE tag_map.tag_id = tags.tag_id GROUP by tag_map.tag_id');
        while($row = $stmt->fetch_assoc())
        {
            $data[$row['tag']] = array('count' => $row['count'], 'id' => $row['tag_id']);
        }

        return $data;
    }

}