<?php
class Tag_model extends Model
{
    
    private $tags = null;
    
    public function getTag()
    {
        $data = array();
        $seg = explode(':', $this->segment(2));
        $tag_id = Validate::num($seg[0]);
        
        $path = PATH . 'tag/' . $seg[0] . ':';
        $page = 1;
        if(isset($seg[1]) && is_numeric($seg[1]))
        {
            $page = (int) $seg[1];
        }
        
        $this->db->query('SET names utf8');
        
        $this->setTags();
        
        if(array_key_exists($tag_id, $this->tags) !== FALSE)
        {
            $data['tag_name'] = $this->tags[$tag_id];
            $data['tag_id'] = $tag_id;
            
            $stmt = $this->db->query('SELECT COUNT(*) as cnt FROM tag_map WHERE tag_id = ' .$tag_id);
            $row = $stmt->fetch_assoc();
            $num_rows = $row['cnt'];
            $stmt->close();
            
            $paginator = new Paginator($num_rows, $page, $path, POSTS_PER_PAGES);
            $limits = $paginator->getLimits();
            $data['paginator'] = $paginator;
            
            $stmt = $this->db->prepare(
                'SELECT a.*, u.username, c.category_name,
                (SELECT COUNT(*) FROM comments cm WHERE cm.article_id = a.article_id) as comments_cnt
                FROM tag_map tm, tags t, articles a
                LEFT JOIN users u ON a.author_id = u.user_id
                LEFT JOIN categories c ON a.category_id = c.category_id
                WHERE tm.tag_id = ?
                AND tm.article_id = a.article_id
                GROUP BY a.article_id
                LIMIT ?, ?'
            );
            $stmt->bind_param('iii', $tag_id, $limits[0], $limits[1]);
            $stmt->bind_result($article_id, $category_id, $date_added, $author_id, $title, $seen, $article_content, $username, $category_name, $comments_cnt);
            $stmt->execute();
            $stmt->store_result();
            
            $stmt2 = $this->db->prepare('SELECT tag_id FROM tag_map WHERE article_id = ?');
            $stmt2->bind_result($id);
            while($stmt->fetch())
            {
                $article = array();
                $article['article_id'] = $article_id;
                $article['category_id'] = $category_id;
                $article['date_added'] = date('j.n.Y', $date_added);
                $article['author_id'] = $author_id;
                $article['author_avatar'] = Validate::getAvatarPath($author_id, 44);
                $article['title'] = $title;
                $article['seen'] = $seen;
                $article['article'] = Validate::cutText($article_content, 100);
                $article['username'] = $username;
                $article['category_name'] = $category_name;
                $article['comments_count'] = $comments_cnt;
                $stmt2->bind_param('i', $article_id);
                $stmt2->execute();
                while($stmt2->fetch())
                {
                    $article['tags'][$id] = $this->tags[$id];
                }
                $data['articles'][] = $article;
            }
            return $data;
        }
        else
        {
            return FALSE;
        }
    }
    
    public function getTags()
    {
        if($this->tags == null)
        {
            $this->setTags();
        }
        return $this->tags;
    }
    
    private function setTags()
    {
        $stmt = $this->db->query('SELECT * FROM tags');
        while($row = $stmt->fetch_assoc())
        {
            $this->tags[$row['tag_id']] = $row['tag'];
        }
    }
}