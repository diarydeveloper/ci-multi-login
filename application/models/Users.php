<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Model 
{
	/*
		Action : Get data users
		Params : id
		Access : Public
	*/
	public function get_users($id = null) 
	{
		if($id != null ) {
			$this->db->where('email', $id);
			$data = $this->db->get('tb_users');
			if($data->num_rows() > 0) {
				return $data->result_array()[0];
			} else {
				return false;
			}
		} else {
			$data = $this->db->get('tb_users');
			if($data->num_rows() > 0) {
				return $data->result_array();
			} else {
				return false;
			}
		}
	}

	/*
		Action : Check login
		Params : data['email'], data['pass']
		Access : Public
	*/
	public function cek_login($data) 
	{
		$this->db->where('email', $data['email']);
		$this->db->where('password', md5($data['pass']));
		$data = $this->db->get('tb_users');
		if ($data->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	/*
		Action : Check email exists
		Params : email
		Access : Public
	*/
	public function cek_email_exists($email) 
	{
		$this->db->where('email', $email);
		$data = $this->db->get('tb_users');
		if ($data->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
}