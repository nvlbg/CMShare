<?php
class Feedback extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->model = $this->load->model('Feedback_admin.php');
    }
    
    public function index()
    {
        $data = array();
        
        $data['header']['title'] = Language::$admin['feedback']['title'];
        $data['content'] = $this->model->getMessages();
		
		if(!isset($data['content']['messages']))
		{
			$data['content']['messages'] = array();
		}
		
        $data['content']['labels'] = Language::$admin['feedback'];
        
        $this->load->admin_template('feedback.php', $data);
    }

}