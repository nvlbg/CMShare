<?php
class Comments_admin extends Model
{
    
    public function articleExists($id)
    {
        $id = (int) $id;
        
        $stmt = $this->db->prepare('SELECT 1 FROM articles WHERE article_id = ?');
        $stmt->bind_param('i', $id);
        
        $stmt->execute();
        $stmt->store_result();
        
        return $stmt->num_rows == 1 ? TRUE : FALSE;
    }

    public function userExists($id)
    {
        $id = (int) $id;

        $stmt = $this->db->prepare('SELECT 1 FROM users WHERE user_id = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->store_result();

        return $stmt->num_rows == 1 ? TRUE : FALSE;
    }

    public function commentExists($id)
    {
        $id = (int) $id;

        $stmt = $this->db->prepare('SELECT 1 FROM comments WHERE id = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->store_result();

        return $stmt->num_rows == 1 ? TRUE : FALSE;
    }
    
    public function getArticleComments($id)
    {
        $result = array();

        $id = (int) $id;
        
        $this->db->query('SET names utf8');
        
        $stmt = $this->db->prepare('SELECT c.comment, c.date_written, IF(c.author_id = 0, c.name, u.username) AS username, IF(c.author_id = 0, c.email, u.email) AS email, c.author_id, c.id FROM comments c LEFT JOIN users u ON (c.author_id = u.user_id) WHERE article_id = ?');
        $stmt->bind_param('i', $id);
        $stmt->bind_result($comment, $date_written, $username, $email, $author_id, $comment_id);

        $stmt->execute();

        while($stmt->fetch())
        {
            $comment_arr = array();

            $comment_arr['comment'] = $comment;
            $comment_arr['date_written'] = date('F j, Y \a\t G:i', $date_written);
            $comment_arr['username'] = $username;
            $comment_arr['email'] = $email;
            $comment_arr['author_id'] = $author_id;
            $comment_arr['comment_id'] = $comment_id;
            $comment_arr['article_id'] = $id;

            $result[] = $comment_arr;
        }

        return $result;
    }

    public function getUserComments($id)
    {
        $result = array();

        $id = (int) $id;
        $this->db->query('SET names utf8');

        $stmt = $this->db->prepare('SELECT c.comment, c.date_written, IF(c.author_id = 0, c.name, u.username) AS username, IF(c.author_id = 0, c.email, u.email) AS email, c.article_id, c.id FROM comments c LEFT JOIN users u ON (c.author_id = u.user_id) WHERE author_id = ?');
        $stmt->bind_param('i', $id);
        $stmt->bind_result($comment, $date_written, $username, $email, $article_id, $comment_id);

        $stmt->execute();

        while($stmt->fetch())
        {
            $comment_arr = array();

            $comment_arr['comment'] = $comment;
            $comment_arr['date_written'] = date('F j, Y \a\t G:i', $date_written);
            $comment_arr['username'] = $username;
            $comment_arr['email'] = $email;
            $comment_arr['comment_id'] = $comment_id;
            $comment_arr['article_id'] = $article_id;
            $comment_arr['author_id'] = $id;

            $result[] = $comment_arr;
        }

        return $result;
    }

    public function getComment($id)
    {
        $id = (int) $id;

        $this->db->query('SET names utf8');

        $stmt = $this->db->prepare('SELECT comment FROM comments WHERE id = ?');
        $stmt->bind_param('i', $id);
        $stmt->bind_result($comment);
        $stmt->execute();
        $stmt->fetch();
        return $comment;
    }

    public function updateComment($comment, $id)
    {
        $comment = trim(Validate::purifyHTML(Validate::BBCode($comment)));
        $id = (int) $id;

        $stmt = $this->db->prepare('UPDATE comments SET comment = ? WHERE id = ?');
        $stmt->bind_param('si', $comment, $id);
        $stmt->execute();
    }
    
}