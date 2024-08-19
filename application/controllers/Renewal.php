<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Renewal extends CI_Controller
{

	public function __construct()
	{

		parent::__construct();

		auth_check();

		$this->rbac->check_module_access();

		if ($this->uri->segment(2) != '')
			$this->rbac->check_operation_access();
	}

	public function index()
	{
		$table = (!empty($_GET['type']) && $_GET['type'] == 'yoga') ? 'yoga-renewal' : 'renewal';

		$this->load->view($table);
	}

	public function getRenewal()
	{
		if ($_POST['startDate'] != '') {
			$this->db->where(['date(created_date)>=' => $_POST['startDate']]);
		}

		if ($_POST['endDate'] != '') {
			$this->db->where(['date(created_date)<=' => $_POST['endDate']]);
		}
		if ($_SESSION['admin_role_id'] == 3) {
			$where = [
				'status' => 5,
				'created_by' => $_SESSION['username']
			];
		} else {
			$where = [
				'status' => 5,
			];
		}

		$table = (!empty($_POST['type']) && $_POST['type'] == 'yoga') ? 'yoga' : 'leads';
		
		$resp = $this->db->where($where)->order_by('created_date', 'desc')->get($table)->result_array();

		if (count($resp) > 0) {
			foreach ($resp as &$item) {
				if (isset($item['class_type'])) {
					$item['class_type'] = str_replace(' Session', '', $item['class_type']);
				}
			}

			$response = [
				'success' => 1,
				'data' => $resp
			];
		} else {
			$response = [
				'success' => 0,
				'message' => 'No data found!'
			];
		}

		echo json_encode($response);
	}

	public function deleteData()
	{
		$id = $_POST['id'];
		$resp = $this->db->where('id', $id)->update('leads', ['status' => 0]);
		if ($resp) {
			$response = [
				'success' => 1,
				'message' => 'Lead deleted Successfully'
			];
		} else {
			$response = [
				'success' => 0,
				'message' => 'No records found!'
			];
		}
		echo json_encode($response);
	}

	public function editRenewal()
	{
		$table = (!empty($_GET['type']) && $_GET['type'] == 'yoga') ? 'yoga' : 'leads';
		$status = (!empty($_GET['type']) && $_GET['type'] == 'yoga') ? 1 : 3;
		$pay = (!empty($_GET['type']) && $_GET['type'] == 'yoga') ? 'totalPayAmount' : 'full_payment';

		
		$leadId = $_POST['leadId'];
		$data['package_end_date'] 	= $this->input->post('renewalDate');
		$data[$pay] 				= $this->input->post('renewalAmount');
		$data['totalPayDate'] 		= date('Y-m-d');
		$data['status'] 			= $status;

		$resp = $this->db->where('id', $leadId)->update($table, $data);
		if ($resp) {
			$renew_data = [
				'lead_id' 		=> $leadId,
				'renew_date' 	=> $data['package_end_date'],
				'renew_amount' 	=> $data[$pay],
				'type' 			=> $table,
				'created_by' 	=> $_SESSION['username'],
				'created_date' 	=> date('Y-m-d H:i:s')
			];

			$this->db->replace('package_renew_detail', $renew_data);

			$response = [
				'success' => 1,
				'message' => 'Renewal Updated Successfully'
			];
		} else {
			$response = [
				'success' => 0,
				'message' => 'No records found!'
			];
		}
		echo json_encode($response);
	}
}