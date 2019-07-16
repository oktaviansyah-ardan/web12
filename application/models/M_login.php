<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class M_login Extends CI_Model {
    public function doLogin($username, $password) {
		$this->db->from('users');
		$this->db->where('username', $username);
		$this->db->where('password',$password);
		return $this->db->get()->row();
		}
	

}