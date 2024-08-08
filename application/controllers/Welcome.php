<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	
	public function __construct(){

		parent::__construct();

		auth_check();

		$this->rbac->check_module_access();

		if($this->uri->segment(3) != '')
		$this->rbac->check_operation_access();
	}
	
	public function index()
	{
		$this->load->view('index');
	}

	public function counts()
	{
		$lead = $this->db->where([
			'is_tellecalling' => 0,
			'is_customer' => 0,
			'status' => 1
		])->order_by('id', 'desc')->get('leads')->result_array();

		$unreadLeads = $this->db->where([
			'is_tellecalling' => 0,
			'is_customer' => 0,
			'status' => 1,
			'read_status' => 0
		])->order_by('id', 'desc')->get('leads')->result_array();

		$trainer = $this->db->where([
			'is_trainer' => 1
		])->order_by('id', 'desc')->get('trainer')->result_array();

		$customer = $this->db->where([
			'is_tellecalling' => 1,
			'is_customer' => 1,
			'status' => 1
		])->order_by('id', 'desc')->get('leads')->result_array();

		$telecaller = $this->db->where([
			'is_tellecalling' => 1,
			'is_customer' => 0,
			'status' => 1
		])->order_by('id', 'desc')->get('leads')->result_array();

		$result = array(
			'lead' => count($lead),
			'customer' => count($customer),
			'trainer' => count($trainer),
			'telecaller' => count($telecaller),
			'unreadLeads' => count($unreadLeads)
		);

		echo json_encode($result);
	}
}
