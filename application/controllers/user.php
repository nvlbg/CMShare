<?php
class User extends Controller
{
    
    public function __construct() {
        parent::__construct();
        $this->model = $this->load->model('Users_model.php');
    }

    public function index()
    {
        $user = $this->model->getUserData();
        if($user === FALSE)
        {
            $data['header']['page_title'] = Language::$user_not_found['title'];
            $data['content']['message'] = Language::$user_not_found['message'];
            $this->load->template('message.php', $data);
        }
        else
        {
            $data['content'] = $user;
            $data['content']['other_user'] = (isset($_SESSION['is_logged']) && $_SESSION['is_logged'] === TRUE) && (!isset($_SESSION['user_info']['user_id']) || $_SESSION['user_info']['user_id'] != $data['content']['user_id']);
            $data['header']['page_title'] = Language::$users['title'] . $user['username'];
            $data['no_sections'] = TRUE;
            $data['content']['labels'] = Language::$users['labels'];
            $this->load->template('users_view.php', $data);
        }
    }
    
}