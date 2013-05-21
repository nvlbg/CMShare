<?php
class Search_model extends Model
{
    
    public function getArticles()
    {
        $data = array();
        $for = trim($_GET['for']);
        $this->db->query('SET names utf8');
        
        $stmt = $this->db->prepare('SELECT COUNT(*) as cnt FROM articles WHERE MATCH(title, article) AGAINST(? IN BOOLEAN MODE)');
        $stmt->bind_param('s', $for);
        $stmt->execute();
        $stmt->bind_result($num_rows);
        $stmt->fetch();
        if($num_rows != 0)
        {
            $page = 1;
            if(isset($_GET['page']) && is_numeric($_GET['page']))
            {
                $page = (int) $_GET['page'];
            }
            
            $path = PATH . 'search/?for=' . $for . '&page=';
            
            $paginator = new Paginator($num_rows, $page, $path, POSTS_PER_PAGES);
            $limits = $paginator->getLimits();
            $data['paginator'] = $paginator;
            
            $order_by = 'score';
            if(isset($_GET['order']))
            {
                switch($_GET['order'])
                {
                    case 1:
                        $order_by = 'title';
                        break;
                    case 2:
                        $order_by = 'date_added';
                        break;
                    case 3:
                        $order_by = 'seen';
                        break;
                    case 4:
                        $order_by = 'comments_cnt';
                        break;
                    
                    default:
                        $order_by = 'score';
                }
            }
            
            $check_desc = isset($_GET['desc']) ? $_GET['desc'] : '';
            
            if($check_desc == 1)
            {
                $desc = 'DESC';
                $data['desc'] = 0;
            }
            else
            {
                $desc = 'ASC';
                $data['desc'] = 1;
            }
            
            unset($check_desc);
            
            $data['for'] = $for;
            $stmt->close();

            $stmt = $this->db->prepare('SELECT a.*,c.category_name,u.username,(SELECT COUNT(*) FROM comments cm WHERE cm.article_id = a.article_id) as comments_cnt, MATCH(a.title, a.article) AGAINST(? IN BOOLEAN MODE) as score FROM articles a LEFT JOIN categories c ON a.category_id = c.category_id LEFT JOIN users u ON a.author_id = u.user_id WHERE MATCH(a.title, a.article) AGAINST(? IN BOOLEAN MODE) ORDER BY ' . $order_by . ' ' . $desc . ' LIMIT ?, ?');
            $stmt->bind_param('ssii', $for, $for, $limits[0], $limits[1]);
            $stmt->execute();
            $stmt->store_result();
            
            $data['num_rows'] = $stmt->num_rows;
            
            $stmt->bind_result($article_id, $category_id, $date_added, $author_id, $title, $seen, $article_body, $category_name, $username, $comments_cnt, $score);
            
            $tag_model = $this->load->model('Tag_model.php');
            $tags = $tag_model->getTags();
            
            $stmt2 = $this->db->prepare('SELECT tag_id FROM tag_map WHERE article_id = ?');
            $stmt2->bind_result($id);
            
            while($stmt->fetch())
            {
                $article = array();
                $article['article_id'] = $article_id;
                $article['category_id'] = $category_id;
                $article['date_added'] = date('j.n.Y', $date_added);
                $article['author_id'] = $author_id;
                $article['avatar'] = Validate::getAvatarPath($author_id, 44);
                $article['title'] = $title;
                $article['seen'] = $seen;
                $article['article'] = substr($article_body, 0, 600);
                $article['category_name'] = $category_name;
                $article['username'] = $username;
                $article['comments_count'] = $comments_cnt;
                $stmt2->bind_param('i', $article_id);
                $stmt2->execute();
                while($stmt2->fetch())
                {
                    $article['tags'][$id] = $tags[$id];
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

    public function getTitles()
    {
        $data = array();
        $this->db->query('SET names utf8');

        $stmt = $this->db->prepare('SELECT title FROM articles WHERE title REGEXP "' . mysqli_real_escape_string($_GET['for']) . '"');
        $stmt->execute();

        $stmt->bind_result($title);
        while($stmt->fetch())
        {
            $data[] = $title;
        }

        return $data;
    }

    private function countTitles()
    {

    }

}