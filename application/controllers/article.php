<?php
class Article extends Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->model = $this->load->model('Article_model.php');
    }

    public function index()
    {
        $this->run($this->model->getArticle(2));
    }
    
    public function comment()
    {
        if(isset($_POST['check']))
        {
            $data = array();
            if(!isset($_SESSION['is_logged']) || $_SESSION['is_logged'] === FALSE) // not logged
            {
                if(trim($_POST['cm-comment']) === '')
                {
                    $error = Language::$comments['no-comment'];
                }
                elseif(!Validate::strlen($_POST['cm-comment'], 400))
                {
                    $error = Language::$comments['too-long'];
                }
                elseif(!Validate::name($_POST['cm-name']))
                {
                    $error = Language::$comments['invalid-name'];
                }
                elseif(!Validate::email($_POST['cm-email']))
                {
                    $error = Language::$comments['invalid-email'];
                }
                else
                {
                    $data['content'] = $this->model->comment($_POST['cm-comment'], $_POST['cm-name'], $_POST['cm-email']);
                }
                $comment_data = TRUE;
            }
            else // logged
            {
                if(trim($_POST['cm-comment']) === '')
                {
                    $error = Language::$comments['no-comment'];
                }
                elseif(!Validate::strlen($_POST['cm-comment'], 400))
                {
                    $error = Language::$comments['too-long'];
                }
                else
                {
                    $data['content'] = $this->model->comment($_POST['cm-comment']);
                }
                $comment_data = FALSE;
            }

            if(isset($_POST['ajax']) && $_POST['ajax'] == true)
            {
                if(isset($error))
                {
                    echo $error;
                }
                else
                {
                    echo -1;
                }
                
                die();
            }

            if(isset($error))
            {
                $data['content'] = $this->model->getArticle(3);
                $data['content']['comment_error'] = $error;

                foreach ($_POST as $key => $value)
                {
                    $data['content']['post'][$key] = $value;
                }
            }

            $data['header']['page_title'] = $data['content']['title'];
            $data['content']['comment_data'] = $comment_data;
            $data['content']['comms'] = isset($data['content']['comments']) ? $data['content']['comments_count'] . Language::$articles['comments'] : Language::$articles['no_comments'];
            $data['content']['tags_m'] = $data['content']['tags'];
            
            $this->load->template('article_view.php', $data);
        }
        else
        {
            $article = $this->model->getArticle(3);
            $this->run($article);
        }
    }
    
    private function run($article)
    {
        if($article !== FALSE)
        {
            $data['header']['page_title'] = $article['title'];
            $data['content'] = $article;
            $data['content']['comms'] = isset($article['comments']) ? $article['comments_count'] . Language::$articles['comments'] : Language::$articles['no_comments'];
            $data['content']['tags_m'] = Language::$articles['tags'];
            if(isset($_SESSION['is_logged']) && $_SESSION['is_logged'] === TRUE)
            {
                $data['content']['comment_data'] = FALSE;
            }
            else
            {
                $data['content']['comment_data'] = TRUE;
            }
            $this->load->template('article_view.php', $data);
        }
        else
        {
            $data['header']['page_title'] = Language::$article_errors['title'];
            $data['content']['message'] = Language::$article_errors['message'];
            $this->load->template('message.php', $data);
        }
    }
    
}