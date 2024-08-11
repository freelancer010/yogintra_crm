<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Accounting extends CI_Controller
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
		if (@$_POST['class_type']) {

			$this->db->where_in('status', [2, 3]);

			if ($_POST['class_type'] != 'all') {
				$this->db->where('class_type', $_POST['class_type']);
			}
			if ($_POST['startDate'] != '') {
				$this->db->where(['date(leads.created_date)>=' => $_POST['startDate']]);
			}

			if ($_POST['endDate'] != '') {
				$this->db->where(['date(leads.created_date)<=' => $_POST['endDate']]);
			}

			$customers = $this->db->select('leads.*,trainer.name as trainerName,trainer.created_date as trainer_created_date,trainer.salary')
				->from('leads')
				->join('trainer', 'trainer.id = leads.trainer_id', 'LEFT')
				->order_by('leads.created_date', 'desc')
				->get()
				->result_array();

				// print_r($this->db->last_query()); die;

			if (count($customers) > 0) {
				$response = [
					'success' => 1,
					'data' => $customers
				];
			} else {
				$response = [
					'success' => 0,
					'message' => 'No data found!'
				];
			}
			echo json_encode($response);
		} else {
			$this->load->view('ledger');
		}
	}

	public function ledger()
	{
		$this->load->view('ledger');
	}

	public function summary()
	{
		if (@$_POST['class_type']) {

			$this->db->where_in('status', [2, 3]);

			if ($_POST['class_type'] != 'all') {
				$where['class_type'] = $_POST['class_type'];
			}
			$filterwhere = '';
			if ($_POST['startDate'] != '') {
				$filterwhere .= " and created_date >= '{$_POST['startDate']}'";
			}

			if ($_POST['endDate'] != '') {
				$filterwhere .= " and created_date <= '{$_POST['endDate']}'";
			}

			$query = "(SELECT class_type, sum(full_payment) full_payment, sum(payTotrainer) payTotrainer FROM leads WHERE status='1' and class_type != '' {$filterwhere} group by class_type) 
                    UNION ALL (SELECT 'Expense' class_type, '0' full_payment, sum(expenseAmount) payTotrainer FROM expense where 1=1 {$filterwhere} ) 
                    UNION ALL (SELECT class_type, sum(totalPayAmount) full_payment, '0' payTotrainer FROM events where 1=1 {$filterwhere}  group by class_type)
                    UNION ALL (SELECT class_type, sum(totalPayAmount) full_payment, '0' payTotrainer FROM yoga where 1=1 {$filterwhere}  group by class_type)";
			$customers = $this->db->query($query)->result_array();

			// Combine and rename class types
			$combinedData = [];
			foreach ($customers as $customer) {
				$classType = $customer['class_type'];
				$fullPayment = (int) $customer['full_payment'];
				$payToTrainer = (int) $customer['payTotrainer'];

				// Combine Home Visit Yoga and Home Visit Yoga Session
				if ($classType === 'Home Visit Yoga' || $classType === 'Home Visit Yoga Session') {
					$classType = 'Home Visit Yoga';
					if (isset($combinedData[$classType])) {
						$combinedData[$classType]['full_payment'] += $fullPayment;
						$combinedData[$classType]['payTotrainer'] += $payToTrainer;
					} else {
						$combinedData[$classType] = ['class_type' => $classType, 'full_payment' => $fullPayment, 'payTotrainer' => $payToTrainer];
					}
				}

				// Combine Private Online Session and Private Online Yoga
				elseif ($classType === 'Private Online Session' || $classType === 'Private Online Yoga') {
					$classType = 'Private Online Yoga';
					if (isset($combinedData[$classType])) {
						$combinedData[$classType]['full_payment'] += $fullPayment;
						$combinedData[$classType]['payTotrainer'] += $payToTrainer;
					} else {
						$combinedData[$classType] = ['class_type' => $classType, 'full_payment' => $fullPayment, 'payTotrainer' => $payToTrainer];
					}
				}

				// Combine Group Online Yoga and Group Online Session
				elseif ($classType === 'Group Online Session' || $classType === 'Group Online Yoga') {
					$classType = 'Group Online Yoga';
					if (isset($combinedData[$classType])) {
						$combinedData[$classType]['full_payment'] += $fullPayment;
						$combinedData[$classType]['payTotrainer'] += $payToTrainer;
					} else {
						$combinedData[$classType] = ['class_type' => $classType, 'full_payment' => $fullPayment, 'payTotrainer' => $payToTrainer];
					}
				}

				// Combine Corporate Yoga Booking
				elseif ($classType === 'Corporate Yoga Booking') {
					$classType = 'Corporate Yoga';
					if (isset($combinedData[$classType])) {
						$combinedData[$classType]['full_payment'] += $fullPayment;
						$combinedData[$classType]['payTotrainer'] += $payToTrainer;
					} else {
						$combinedData[$classType] = ['class_type' => $classType, 'full_payment' => $fullPayment, 'payTotrainer' => $payToTrainer];
					}
				}
				// Combine Teacher Training Courses
				elseif ($classType === 'Teacher Training Courses') {
					$classType = 'TTC';
					if (isset($combinedData[$classType])) {
						$combinedData[$classType]['full_payment'] += $fullPayment;
						$combinedData[$classType]['payTotrainer'] += $payToTrainer;
					} else {
						$combinedData[$classType] = ['class_type' => $classType, 'full_payment' => $fullPayment, 'payTotrainer' => $payToTrainer];
					}
				}
				// For other class types, keep them unchanged
				else {
					$combinedData[$classType] = ['class_type' => $classType, 'full_payment' => $fullPayment, 'payTotrainer' => $payToTrainer];
				}
			}

			// Convert the associative array back to indexed array
			$combinedData = array_values($combinedData);

			if (count($combinedData) > 0) {
				$response = [
					'success' => 1,
					'data' => $combinedData,
					'totalCredit' => array_sum(array_column($combinedData, 'full_payment')),
					'totalDebit' => array_sum(array_column($combinedData, 'payTotrainer')),
				];
			} else {
				$response = [
					'success' => 0,
					'message' => 'No data found!'
				];
			}

			// echo '<pre>';
			// print_r($response);

			echo json_encode($response);
		} else {
			$this->load->view('summary');
		}
	}

	public function officeExpences()
	{
		if (@$_POST['class_type']) {
			if ($_POST['startDate'] != '') {
				$this->db->where(['date(created_date)>=' => $_POST['startDate']]);
			}

			if ($_POST['endDate'] != '') {
				$this->db->where(['date(created_date)<=' => $_POST['endDate']]);
			}
			$customers = $this->db->order_by('created_date', 'desc')->get('expense')->result_array();
			if (count($customers) > 0) {
				$response = [
					'success' => 1,
					'data' => $customers
				];
			} else {
				$response = [
					'success' => 0,
					'message' => 'No data found!'
				];
			}
			echo json_encode($response);
		} else {
			$this->load->view('officeExpences');
		}
	}

	public function addExpenses()
	{
		if ($_POST) {
			$data['expenseType'] = $this->input->post('expenseType');
			$data['expenseAmount'] = $this->input->post('expenseAmount');
			$data['created_by'] = $_SESSION['fullName'];
			$data['created_date'] = $this->input->post('expenseDate');
			$data['note'] = $this->input->post('note');
			$data['payee'] = $this->input->post('payee');
			$resp = $this->db->insert('expense', $data);
			if ($resp == true) {
				$response = [
					'success' => 1,
					'message' => 'You Expense Added Successfully'
				];
			} else {
				$response = [
					'success' => 0,
					'message' => 'Some error occured!'
				];
			}

			echo json_encode($response);
		} else {
			$this->load->view('addExpenses');
		}
	}

	public function editExpenses($id)
	{
		if ($_POST) {
			$data['expenseType'] = $this->input->post('expenseType');
			$data['expenseAmount'] = $this->input->post('expenseAmount');
			$data['created_date'] = $this->input->post('expenseDate');
			$data['note'] = $this->input->post('note');
			$data['payee'] = $this->input->post('payee');
			$this->db->where('id', $id);
			$resp = $this->db->update('expense', $data);
			if ($resp == true) {
				$response = [
					'success' => 1,
					'message' => 'You Expense Added Updated'
				];
			} else {
				$response = [
					'success' => 0,
					'message' => 'Some error occured!'
				];
			}

			echo json_encode($response);
		} else {
			$this->db->where('id', $id);
			$data['expense'] = $this->db->get('expense')->row();
			$this->load->view('editExpenses', $data);
		}
	}

	public function deleteExpenses($id)
	{
		$this->db->where('id', $id);
		echo $this->db->delete('expense');
	}

}
