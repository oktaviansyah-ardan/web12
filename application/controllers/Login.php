<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct() {
		parent::__construct();

		if($this->session->userdata('__administrator__')) {
            redirect(base_url('index.php/administrator'));
			exit();
        }
	}

	public function index() {
		$this->load->view('login/index');
	}

	public function doLogin() {
		$this->load->model('m_login');
		
        $username = $this->input->post('username');
		$password = $this->input->post('password');

        $config = [
            [
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required'
            ],
        ];

        $this->form_validation->set_rules($config);
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Sorry!</strong> ', '</div>');

        if($this->form_validation->run() === FALSE) {
			$this->session->set_flashdata('form_value', html_escape($username));
            $this->index();
        } else {
            $query = $this->m_login->doLogin($username, $password);
            
            if(is_null($query)) {
                $this->session->set_flashdata('form_value', html_escape($username));
                $this->session->set_flashdata('status', '<div class="alert alert-danger alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Sorry!</strong> username or password is incorrect.</div>');
                redirect(base_url('index.php/login'));
                exit();
            }

            $userdata = [
                'username'          => $username,
                "__administrator__" => $username,  
            ];
            $this->session->set_userdata($userdata);

            redirect(base_url('index.php/administrator'));
        }
    }
}
