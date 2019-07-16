<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrator extends CI_Controller {
	public function __construct() {
		parent::__construct();

		if(!$this->session->userdata('__administrator__')) {
            redirect(base_url('index.php/administrator'));
			exit();
        }
	}

	public function index() {
		$this->load->view('administrator/index');
    }

    public function input() {
		$this->load->view('administrator/input');
    }
    
    public function output() {
        $data['input'] = $this->db->get('input')->result();
		$this->load->view('administrator/output', $data);
    }

    public function postadmin() {
        $data['postadmin'] = $this->db->get('postadmin')->result();
		$this->load->view('administrator/postadmin', $data);
    }

    public function doInput() {
        $nama       = $this->input->post('nama');
        $alamat     = $this->input->post('alamat');
        $keterangan = $this->input->post('keterangan');

        $config = [
            [
                'field' => 'nama',
                'label' => 'Nama',
                'rules' => 'trim|required|max_length[100]'
            ],
            [
                'field' => 'alamat',
                'label' => 'Alamat',
                'rules' => 'trim|required|max_length[100]'
            ],
            [
                'field' => 'keterangan',
                'label' => 'Keterangan',
                'rules' => 'trim|required'
            ]
        ];

        $this->form_validation->set_rules($config);
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Sorry!</strong> ', '</div>');

        if($this->form_validation->run() === FALSE) {
            $this->input();
        } else {
            $data = [
                'nama'       => $nama,
                'alamat'     => $alamat,
                'keterangan' => $keterangan
            ];
            $this->db->insert('input', $data);

            $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Success!</strong></div>');
            redirect(base_url('index.php/administrator/input'));
        }
    }

    public function doGetInput() {
        $id = $this->input->post('id');
        
        $config = [
            [
                'field' => 'id',
                'label' => 'Input ID',
                'rules' => 'trim|required|numeric'
            ]
        ];

        $this->form_validation->set_rules($config);

        if($this->form_validation->run() === FALSE) {
            $this->output->set_status_header(400);
			$this->output->set_content_type('application/json', 'utf-8');
			$this->output->set_output(json_encode([
				'error'     => true, 
				'errorCode' => 400, 
                'errorMsg'  => 'Bad Request',
			], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
            $this->output->_display();
            exit();
        } else {
            $id = (int) $id;

            $query = $this->db->get_where('input', ['id' => $id])->row();
            if(is_null($query)) {
                $this->output->set_status_header(200);
                $this->output->set_content_type('application/json', 'utf-8');
                $this->output->set_output(json_encode([
                    'error'     => false, 
                    'errorCode' => 0, 
                    'errorMsg'  => null,
                    'data'      => [
                        'message' => 'Input ID is not exists in our database.'
                    ]
                ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
                $this->output->_display();
                exit();
            }

            $this->output->set_status_header(200);
			$this->output->set_content_type('application/json', 'utf-8');
			$this->output->set_output(json_encode([
				'error'     => false, 
				'errorCode' => 0, 
                'errorMsg'  => null,
                'data'      => [
                    'id'         => $query->id,
                    'nama'       => $query->nama,
                    'alamat'     => $query->alamat,
                    'keterangan' => $query->keterangan
                ]
			], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
            $this->output->_display();
            exit();
        }
    }

    public function doEditInput() {
        $id         = $this->input->post('id');
        $nama       = $this->input->post('nama');
        $alamat     = $this->input->post('alamat');
        $keterangan = $this->input->post('keterangan');

        $config = [
            [
                'field' => 'id',
                'label' => 'Input ID',
                'rules' => 'trim|required|numeric'
            ],
            [
                'field' => 'nama',
                'label' => 'Nama',
                'rules' => 'trim|required|max_length[100]'
            ],
            [
                'field' => 'alamat',
                'label' => 'Alamat',
                'rules' => 'trim|required|max_length[100]'
            ],
            [
                'field' => 'keterangan',
                'label' => 'Keterangan',
                'rules' => 'trim|required'
            ]
        ];

        $this->form_validation->set_rules($config);
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Sorry!</strong> ', '</div>');

        if($this->form_validation->run() === FALSE) {
            $this->output();
        } else {
            $id = (int) $id;

            $query = $this->db->get_where('input', ['id' => $id])->row();
            if(is_null($query)) {
                $this->session->set_flashdata('status', '<div class="alert alert-danger alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Sorry!</strong> Input ID is not exists in our database.</div>');
                redirect(base_url('index.php/administrator/output'));
                exit();
            }

            $data = [
                'nama'       => $nama,
                'alamat'     => $alamat,
                'keterangan' => $keterangan
            ];
            $this->db->update('input', $data, ['id' => $id]);

            $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Success!</strong></div>');
            redirect(base_url('index.php/administrator/output'));
        }
    }

    public function doDeleteInput() {
        $id = $this->input->post('id');
        
        $config = [
            [
                'field' => 'id',
                'label' => 'Input ID',
                'rules' => 'trim|required|numeric'
            ]
        ];

        $this->form_validation->set_rules($config);

        if($this->form_validation->run() === FALSE) {
            $this->output->set_status_header(400);
			$this->output->set_content_type('application/json', 'utf-8');
			$this->output->set_output(json_encode([
				'error'     => true, 
				'errorCode' => 400, 
                'errorMsg'  => 'Bad Request',
			], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
            $this->output->_display();
            exit();
        } else {
            $id = (int) $id;

            $query = $this->db->get_where('input', ['id' => $id])->row();
            if(is_null($query)) {
                $this->output->set_status_header(200);
                $this->output->set_content_type('application/json', 'utf-8');
                $this->output->set_output(json_encode([
                    'error'     => false, 
                    'errorCode' => 0, 
                    'errorMsg'  => null,
                    'data'      => [
                        'message' => 'Input ID is not exists in our database.'
                    ]
                ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
                $this->output->_display();
                exit();
            }

            $this->db->delete('input', ['id' => $id]);

            $this->output->set_status_header(200);
			$this->output->set_content_type('application/json', 'utf-8');
			$this->output->set_output(json_encode([
				'error'     => false, 
				'errorCode' => 0, 
                'errorMsg'  => null,
                'data'      => [
                    'message' => 'Input successfully deleted.'
                ]
			], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
            $this->output->_display();
            exit();
        }
    }

    public function doPostAdmin() {
        $postadmin = $this->input->post('postadmin');

        $config = [
            [
                'field' => 'postadmin',
                'label' => 'Status',
                'rules' => 'trim|required'
            ]
        ];

        $this->form_validation->set_rules($config);
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Sorry!</strong> ', '</div>');

        if($this->form_validation->run() === FALSE) {
            $this->postadmin();
        } else {
            $this->db->insert('postadmin', ['status' => $postadmin]);

            $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Success!</strong></div>');
            redirect(base_url('index.php/administrator/postadmin'));
        }
    }

    public function doGetPostAdmin() {
        $id = $this->input->post('id');
        
        $config = [
            [
                'field' => 'id',
                'label' => 'Post Admin ID',
                'rules' => 'trim|required|numeric'
            ]
        ];

        $this->form_validation->set_rules($config);

        if($this->form_validation->run() === FALSE) {
            $this->output->set_status_header(400);
			$this->output->set_content_type('application/json', 'utf-8');
			$this->output->set_output(json_encode([
				'error'     => true, 
				'errorCode' => 400, 
                'errorMsg'  => 'Bad Request',
			], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
            $this->output->_display();
            exit();
        } else {
            $id = (int) $id;

            $query = $this->db->get_where('postadmin', ['id' => $id])->row();
            if(is_null($query)) {
                $this->output->set_status_header(200);
                $this->output->set_content_type('application/json', 'utf-8');
                $this->output->set_output(json_encode([
                    'error'     => false, 
                    'errorCode' => 0, 
                    'errorMsg'  => null,
                    'data'      => [
                        'message' => 'Post Admin ID is not exists in our database.'
                    ]
                ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
                $this->output->_display();
                exit();
            }

            $this->output->set_status_header(200);
			$this->output->set_content_type('application/json', 'utf-8');
			$this->output->set_output(json_encode([
				'error'     => false, 
				'errorCode' => 0, 
                'errorMsg'  => null,
                'data'      => [
                    'id'        => $query->id,
                    'postadmin' => $query->status,
                ]
			], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
            $this->output->_display();
            exit();
        }
    }

    public function doEditPostAdmin() {
        $id        = $this->input->post('id');
        $postadmin = $this->input->post('postadmin');

        $config = [
            [
                'field' => 'id',
                'label' => 'Post Admin ID',
                'rules' => 'trim|required|numeric'
            ],
            [
                'field' => 'postadmin',
                'label' => 'Post Admin',
                'rules' => 'trim|required'
            ]
        ];

        $this->form_validation->set_rules($config);
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Sorry!</strong> ', '</div>');

        if($this->form_validation->run() === FALSE) {
            $this->postadmin();
        } else {
            $id = (int) $id;

            $query = $this->db->get_where('postadmin', ['id' => $id])->row();
            if(is_null($query)) {
                $this->session->set_flashdata('status', '<div class="alert alert-danger alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Sorry!</strong> Post Admin ID is not exists in our database.</div>');
                redirect(base_url('index.php/administrator/postadmin'));
                exit();
            }

            $this->db->update('postadmin', ['status' => $postadmin], ['id' => $id]);

            $this->session->set_flashdata('status', '<div class="alert alert-success alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Success!</strong></div>');
            redirect(base_url('index.php/administrator/postadmin'));
        }
    }

    public function doDeletePostAdmin() {
        $id = $this->input->post('id');
        
        $config = [
            [
                'field' => 'id',
                'label' => 'Post Admin ID',
                'rules' => 'trim|required|numeric'
            ]
        ];

        $this->form_validation->set_rules($config);

        if($this->form_validation->run() === FALSE) {
            $this->output->set_status_header(400);
			$this->output->set_content_type('application/json', 'utf-8');
			$this->output->set_output(json_encode([
				'error'     => true, 
				'errorCode' => 400, 
                'errorMsg'  => 'Bad Request',
			], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
            $this->output->_display();
            exit();
        } else {
            $id = (int) $id;

            $query = $this->db->get_where('postadmin', ['id' => $id])->row();
            if(is_null($query)) {
                $this->output->set_status_header(200);
                $this->output->set_content_type('application/json', 'utf-8');
                $this->output->set_output(json_encode([
                    'error'     => false, 
                    'errorCode' => 0, 
                    'errorMsg'  => null,
                    'data'      => [
                        'message' => 'Post Admin ID is not exists in our database.'
                    ]
                ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
                $this->output->_display();
                exit();
            }

            $this->db->delete('postadmin', ['id' => $id]);

            $this->output->set_status_header(200);
			$this->output->set_content_type('application/json', 'utf-8');
			$this->output->set_output(json_encode([
				'error'     => false, 
				'errorCode' => 0, 
                'errorMsg'  => null,
                'data'      => [
                    'message' => 'Post Admin successfully deleted.'
                ]
			], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
            $this->output->_display();
            exit();
        }
    }
    
    public function doLogout() {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('__administrator__');
        $this->session->sess_destroy();
        redirect(base_url());
	}
}
