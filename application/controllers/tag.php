<?php
class Tag extends Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->model = $this->load->model('Tag_model.php');
    }
    
    public function index()
    {   
        $data = array();
        $tag = $this->model->getTag();
        if($tag !== FALSE)
        {
            $data['header']['page_title'] = 'Tag - ' . $tag['tag_name'];
            $data['content'] = $tag;
            $data['content']['tags_m'] = Language::$articles['tags'];
            $data['content']['read'] = Language::$articles['read_more'];
            $data['content']['no_articles'] = Language::$tag_errors['no_articles'];
            $this->load->template('tag_view.php', $data);
        }
        else
        {
            $data['header']['page_title'] = Language::$tag_errors['tag_not_found_title'];
            $data['content']['message'] = Language::$tag_errors['tag_not_found_message'];
            $this->load->template('message.php', $data);
        }
    }
    
}