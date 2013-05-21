<?php
class Category_model extends Model
{
    
    public function getCategory()
    {
        $data = array();
        $seg = explode(':', $this->segment(2));
        $cat_id = Validate::num($seg[0]);
        
        $path = PATH . 'category/' . $cat_id . ':';
        $page = 1;
        
        if(isset($seg[1]) && is_numeric($seg[1]))
        {
            $page = (int) $seg[1];
        }
        
        $this->db->query('SET names utf8');
        
        $stmt = $this->db->query('SELECT COUNT(*) as cnt FROM articles a WHERE a.category_id = ' . $cat_id);
        $rows = $stmt->fetch_assoc();
        $num_rows = $rows['cnt'];
        $stmt->close();
        
        if(!$num_rows > 0)
        {
            return FALSE;
        }
        else
        {
            $paginator = new Paginator($num_rows, $page, $path, POSTS_PER_PAGES);
            $limits = $paginator->getLimits();
            $data['paginator'] = $paginator;

            $tag_model = $this->load->model('Tag_model.php');
            $this->tags = $tag_model->getTags();

            $stmt = $this->db->prepare(
                'SELECT a.*, u.username, c.category_name,
                (SELECT COUNT(*) FROM comments cm WHERE cm.article_id = a.article_id) as comments_cnt
                FROM articles a
                LEFT JOIN users u ON a.author_id = u.user_id
                LEFT JOIN categories c ON a.category_id = c.category_id
                WHERE c.category_id = ?
                LIMIT ?, ?'
            );
            $stmt->bind_param('iii', $cat_id, $limits[0], $limits[1]);
            $stmt->bind_result($article_id, $category_id, $date_added, $author_id, $title, $seen, $article_content, $username, $category_name, $comments_cnt);
            $stmt->execute();
            $stmt->store_result();
            
            $stmt2 = $this->db->prepare('SELECT tag_id FROM tag_map WHERE article_id = ?');
            $stmt2->bind_result($id);
            while($stmt->fetch())
            {
                $data['category_name'] = $category_name;
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
    }
    
}