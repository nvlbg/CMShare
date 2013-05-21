<?php
class Article_admin extends Model
{

    public function getCategories()
    {
        $data = array();
        $this->db->query('SET names utf8');
        
        $stmt = $this->db->query('SELECT * FROM categories');
        
        while($row = $stmt->fetch_assoc())
        {
            $cat = array();
            
            $cat['id']   = $row['category_id'];
            $cat['name'] = $row['category_name'];
            
            $data[] = $cat;
        }
        
        return $data;
    }
    
    public function isValidCategory($cat_id)
    {
        $this->db->query('SET names utf8');
        
        $cat_id = (int) $cat_id;
        
        $stmt = $this->db->prepare('SELECT COUNT(*) FROM categories WHERE category_id = ?');
        $stmt->bind_param('i', $cat_id);
        $stmt->execute();
        
        $stmt->bind_result($cnt);
        $stmt->fetch();
        
        if($cnt > 0)
        {
            return TRUE;
        }
        return FALSE;
    }
    
    public function saveArticle()
    {
        $this->db->query('SET names utf8');
        
        $stmt = $this->db->prepare('INSERT INTO articles 
            (category_id, date_added, author_id, title, article) 
            VALUES (?, ?, ?, ?, ?)');
        
        $cat_id = (int) $_POST['category'];
        $date_added = time();
        $author_id = $_SESSION['user_info']['user_id'];
        $title = Validate::escape_html($_POST['title']);
        $article = Validate::purifyHTML($_POST['article']);
        
        $stmt->bind_param('iiiss', $cat_id, $date_added, $author_id, $title, $article);
        $stmt->execute();
        $stmt->close();
        
        $stmt = $this->db->prepare('SELECT MAX(article_id) FROM articles');
        $stmt->bind_result($id);
        $stmt->execute();
        $stmt->fetch();
        
        $article_id = $id;
        
        $stmt->close();
        
        $tags = explode(' ', trim($_POST['tags']));
        $article_tags = array();
        
        $stmt = $this->db->prepare('SELECT tag_id FROM tags WHERE tag = ?');
        $stmt->bind_result($id);
        
        foreach($tags as $tag)
        {
            $stmt->bind_param('s', $tag);
            $stmt->execute();
            $stmt->store_result();
            
            if($stmt->num_rows == 0)
            {
                $article_tags[] = $this->createTag($tag);
            }
            else
            {
                $stmt->fetch();
                $article_tags[] = $id;
            }
        }
        
        $stmt->close();
        
        $stmt = $this->db->prepare('INSERT INTO tag_map (article_id, tag_id) VALUES (?, ?)');
        
        foreach($article_tags as $tag_id)
        {
            $stmt->bind_param('ii', $article_id, $tag_id);
            $stmt->execute();
        }
        
    }
    
    public function getArticles()
    {
        $data = array();
        
        $this->db->query('SET names utf8');
        
        $stmt = $this->db->prepare('SELECT COUNT(*) as total FROM articles WHERE author_id = ?');
        $stmt->bind_param('i', $_SESSION['user_info']['user_id']);
        $stmt->bind_result($total);
        $stmt->execute();
        $num_rows = $total;
        $stmt->close();
        
        $path = PATH . 'admin/article/edit/?page=';
        $page = 1;
        
        if(isset($_GET['page']) && is_numeric($_GET['page']))
        {
            $page = (int) $_GET['page'];
        }
        
        $paginator = new Paginator($num_rows, $page, $path);
        $limits = $paginator->getLimits();
        
        $data['paginator'] = $paginator;
        
        $stmt = $this->db->prepare('SELECT article_id, title
            FROM articles
            WHERE author_id = ?
            ORDER BY date_added
            DESC
            LIMIT ?, ?');
        $stmt->bind_param('iii', $_SESSION['user_info']['user_id'], $limits[0], $limits[1]);
        $stmt->bind_result($id, $title);
        $stmt->execute();
        
        while($stmt->fetch())
        {
            $arr = array();
            
            $arr['id'] = $id;
            $arr['title'] = $title;
            
            $data['articles'][] = $arr;
        }
        
        return $data;
    }
    
    public function getArticle($id)
    {
        $data = array();
        $id = (int) $id;
        
        $data['article_id'] = $id;
        $data['categories'] = $this->getCategories();
        
        $this->db->query('SET names utf8');
        
        $stmt = $this->db->prepare('SELECT a.date_added, a.title, a.article, a.seen, a.category_id
            FROM articles a 
            WHERE a.article_id = ?');
        $stmt->bind_param('i', $id);
        $stmt->bind_result($date_added, $title, $article_body, $seen, $category_id);
        
        $stmt->execute();
        
        $stmt->fetch();
        
        $data['date_added'] = date('F j, Y \a\t G:i', $date_added);
        $data['title'] = $title;
        $data['article'] = $article_body;
        $data['seen'] = $seen;
        $data['category_id'] = $category_id;
        
        $stmt->close();
        
        $stmt = $this->db->prepare('SELECT t.tag FROM tags t LEFT JOIN tag_map tm ON (t.tag_id = tm.tag_id) WHERE tm.article_id = ?');
        $stmt->bind_param('i', $id);
        $stmt->bind_result($tag);
        
        $stmt->execute();
        
        $data['tags'] = '';
        while($stmt->fetch())
        {
            $data['tags'] .= $tag . ' ';
        }
        
        $stmt->close();
        
        return $data;
    }
    
    public function edit($id)
    {
        $id = (int) $id;
        $this->db->query('SET names utf8');
        
        $stmt = $this->db->prepare('SELECT 1 FROM articles WHERE article_id = ? AND author_id = ?');
        $stmt->bind_param('ii', $id, $_SESSION['user_info']['user_id']);
        $stmt->execute();
        $stmt->store_result();
        
        if($stmt->num_rows == 0)
        {
            throw new Exception('Access denied');
        }
        
        $stmt->close();
        
        $title = trim($_POST['title']);
        $article_body = trim($_POST['article']);
        $cat_id = (int) $_POST['category'];
        
        $stmt = $this->db->prepare('UPDATE articles SET title = ?, article = ?, category_id = ? WHERE article_id = ?');
        $stmt->bind_param('ssii', $title, $article_body, $cat_id, $id);
        $stmt->execute();
        $stmt->close();
        
        $stmt = $this->db->prepare('DELETE FROM tag_map WHERE article_id = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        
        $stmt->close();
        
        $tags = array_filter(explode(' ', trim($_POST['tags'])));
        $article_tags = array();
        
        $stmt = $this->db->prepare('SELECT tag_id FROM tags WHERE tag = ?');
        $stmt->bind_result($tag_id);
        
        foreach($tags as $tag)
        {
            $stmt->bind_param('s', $tag);
            $stmt->execute();
            $stmt->store_result();
            
            if($stmt->num_rows == 0)
            {
                $article_tags[] = $this->createTag($tag);
            }
            else
            {
                $stmt->fetch();
                $article_tags[] = $tag_id;
            }
        }
        
        $stmt->close();
        
        $stmt = $this->db->prepare('INSERT INTO tag_map (article_id, tag_id) VALUES(?, ?)');
        
        foreach($article_tags as $tag_id)
        {
            $stmt->bind_param('ii', $id, $tag_id);
            $stmt->execute();
        }
        
        $stmt->close();
        
        
        if(isset($_POST['reset']) && $_POST['reset'] == 1)
        {
            $stmt = $this->db->prepare('UPDATE articles SET seen = 0 WHERE article_id = ?');
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $stmt->close();
        }
        
    }
    
    public function deleteArticles($articles)
    {
        $this->db->query('SET names utf8');
        
        $stmt = $this->db->prepare('DELETE FROM articles WHERE article_id = ? AND author_id = ?');
        $stmt2 = $this->db->prepare('DELETE FROM tag_map WHERE article_id = ?');
        
        foreach($articles as $article_id)
        {
            $id = (int) $article_id;
            
            $stmt->bind_param('ii', $id, $_SESSION['user_info']['user_id']);
            $stmt->execute();
            
			if($stmt->affected_rows > 0)
			{
				$stmt2->bind_param('i', $id);
				$stmt2->execute();
			}
        }
    }
    
    public function articleExists($id)
    {
        $this->db->query('SET names utf8');
        
        $id = (int) $id;
        
        $stmt = $this->db->prepare('SELECT 1 FROM articles WHERE article_id = ? AND author_id = ?');
        $stmt->bind_param('ii', $id, $_SESSION['user_info']['user_id']);
        $stmt->execute();
        
        $stmt->store_result();
        
        return $stmt->num_rows == 1 ? TRUE : FALSE;
    }
    
    private function createTag($tag)
    {
        $this->db->query('SET names utf8');
        
        $stmt = $this->db->prepare('INSERT INTO tags (tag) VALUES (?)');
        $stmt->bind_param('s', $tag);
        $stmt->execute();
        $stmt->close();
        
        $stmt = $this->db->prepare('SELECT MAX(tag_id) FROM tags');
        $stmt->bind_result($tag_id);
        $stmt->execute();
        $stmt->fetch();
        
        return $tag_id;
    }

}