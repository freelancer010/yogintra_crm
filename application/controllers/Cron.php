<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->CI =& get_instance();
	}

    public function updateRenewData()
	{
		$resp = $this->db->where('package_end_date <', date('Y-m-d'))->update('leads', ['status' => 5]);
		if ($resp) {
			$response = [
				'success' => 1,
				'message' => 'Lead status updated successfully'
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