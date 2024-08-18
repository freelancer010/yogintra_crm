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
		$this->load->view('renewal');
	}

	public function getRenewal()
	{
		error_reporting(0);
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
		$resp = $this->db->where($where)->order_by('created_date', 'desc')->get('leads')->result_array();

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
		$leadId = $_POST['leadId'];
		$data['package_end_date'] = $this->input->post('renewalDate');
		if ($data['package_end_date'] >= date('Y-m-d')) {
			$data['status'] = 3;
		}

		$resp = $this->db->where('id', $leadId)->update('leads', $data);
		if ($resp) {
			$renew_data = [
				'lead_id' => $leadId,
				'renew_date' => $data['package_end_date'],
				'created_by' => $_SESSION['username']
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
