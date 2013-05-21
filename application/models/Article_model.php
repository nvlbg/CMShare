<?php
class Article_model extends Model
{
    public function getArticle($id = 2)
    {
        $article_id = $this->segment($id);
        
        $this->db->query('SET names utf8');
        
        $stmt = $this->db->prepare('SELECT a.*, u.username, c.category_name, (SELECT COUNT(*) FROM comments cm WHERE cm.article_id = a.article_id) as comments_cnt FROM articles a LEFT JOIN users u ON a.author_id = u.user_id LEFT JOIN categories c ON a.category_id = c.category_id WHERE a.article_id = ?');
        $stmt->bind_param('i', $article_id);
        $stmt->execute();
        $stmt->store_result();
        if($stmt->num_rows != 1)
        {
            return FALSE;
        }
        else
        {
            $data = array();
            $stmt->bind_result($articleid, $category_id, $date_added, $author_id, $title, $seen, $article, $username, $category_name, $comments_count);
            $stmt->fetch();
            $data['article_id'] = $articleid;
            $data['category_id'] = $category_id;
            $data['date_added'] = date('j.n.Y', $date_added);
            $data['author_id'] = $author_id;
            $data['title'] = $title;
            $data['seen'] = $seen;
            $data['article'] = $article;
            $data['category_name'] = $category_name;
            $data['username'] = $username;
            $data['comments_count'] = $comments_count;
            $data['author_avatar'] = Validate::getAvatarPath($author_id, 44);
            $stmt->close();
            $stmt = $this->db->prepare('SELECT t.tag_id, t.tag FROM tag_map tm, tags t WHERE tm.tag_id = t.tag_id AND tm.article_id = ?');
            $stmt->bind_param('i', $article_id);
            $stmt->bind_result($tag_id, $tag);
            $stmt->execute();
            while($stmt->fetch())
            {
                $data['tags'][$tag_id] = $tag;
            }
            $stmt->close();
            $stmt = $this->db->prepare('SELECT c.comment, c.author_id, c.date_written, c.name, u.username FROM comments c LEFT JOIN users u ON c.author_id = u.user_id WHERE c.article_id = ?');
            $stmt->bind_param('i', $article_id);
            $stmt->execute();
            $stmt->store_result();
            if($stmt->num_rows != 0)
            {
                $stmt->bind_result($comment, $c_author_id, $c_written, $c_name, $c_author);
                while($stmt->fetch())
                {
                    $data['comments']['comment'][] = $comment;
                    $data['comments']['author_id'][] = $c_author_id;
                    $data['comments']['written'][] = date('F j, Y \a\t G:i', $c_written);
                    $data['comments']['author'][] = $c_author;
                    $data['comments']['name'][] = $c_name;
                    $data['comments']['author_avatar'][] = Validate::getAvatarPath($c_author_id, 44);
                }
            }
            $stmt->close();
            $stmt = $this->db->prepare('UPDATE articles SET seen = ? WHERE article_id = ?');
            $seen = ++$data['seen'];
            $stmt->bind_param('ii', $seen, $data['article_id']);
            $stmt->execute();
            return $data;
        }
    }
    
    public function comment($comment, $name = NULL, $email = NULL)
    {
        $comment = trim(Validate::purifyHTML(Validate::BBCode($comment)));
        $article_id = Validate::num($this->segment(3));
        if($name === NULL && $email === NULL)
        {
            $stmt = $this->db->prepare('INSERT INTO comments (comment, author_id, article_id, date_written) VALUES (?, ?, ?, ?)');
            $stmt->bind_param('siii', $comment, $_SESSION['user_info']['user_id'], $article_id, time());
            $stmt->execute();
        }
        else
        {
            $stmt = $this->db->prepare('INSERT INTO comments (comment, name, email, article_id, date_written) VALUES (?, ?, ?, ?, ?)');
            $stmt->bind_param('sssii', $comment, trim($name), trim($email), $article_id, time());
            $stmt->execute();
        }
        return $this->getArticle(3);
    }
    
}