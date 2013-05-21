<?php
class Home_model extends Model
{
    
   private $tags = null;
   
   public function getArticles()
   {
       $this->db->query('SET names utf8');
       
       $stmt = $this->db->query('SELECT COUNT(*) as cnt FROM articles');
       $row = $stmt->fetch_assoc();
       $num_rows = $row['cnt'];
       $stmt->close();
       
       $path = PATH . 'home/';
       $page = 1;
       
       if(is_numeric($this->segment(2)))
       {
           $page = (int) $this->segment(2);
       }
       
       
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
                ORDER BY date_added
                DESC
                LIMIT ?, ?'
            );
       $stmt->bind_param('ii', $limits[0], $limits[1]);
       $stmt->execute();
       $stmt->bind_result($article_id, $category_id, $date_added, $author_id, $title, $seen, $article_content, $username, $category_name, $comments_count);
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
           $article['category_name'] = $category_name;
           $article['username'] = $username;
           $article['comments_count'] = $comments_count;
           $article['tags'] = array();
           
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

   public function getCategories()
   {
       $stmt = $this->db->prepare('SELECT * FROM categories');
       $stmt->execute();

       $stmt->bind_result($id, $cat_name);
       $data = array();
       while($stmt->fetch())
       {
           $data['id'][] = $id;
           $data['cat_name'] = $cat_name;
       }
       return $data;
   }

}