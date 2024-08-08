<?php
class RBAC 
{	
	private $module_access;
	function __construct()
	{
		$this->obj =& get_instance();
		$this->obj->module_access = $this->obj->session->userdata('module_access');
		$this->obj->is_supper = $this->obj->session->userdata('is_supper');
	}

	//----------------------------------------------------------------
	function set_access_in_session()
	{
		$this->obj->db->from('module_access');
		$this->obj->db->where('admin_role_id', $this->obj->session->userdata('admin_role_id'));
		$query=$this->obj->db->get();

		$data = array();
		foreach($query->result_array() as $v)
		{
			$data[$v['module']][$v['operation']] = '';
		}

		$this->obj->session->set_userdata('module_access',$data);

	}

	
	//--------------------------------------------------------------	
	function check_module_access()
	{
		if($this->obj->is_supper)
		{
			return 1;
		}
		elseif(!$this->check_module_permission($this->obj->uri->segment(1))) //sending controller name
		{
			$back_to = $_SERVER['REQUEST_URI'];
			$back_to = urlencode(base64_encode($back_to));
			redirect('access_denied/index/'.$back_to);
		}
		
	}

	//--------------------------------------------------------------	
	function check_module_permission($module) // $module is controller name
	{
		$access = false;

		if($module == 'recruit')
		{
			$module = 'recruiter';
		}
		else
		{
			$module = $module;
		}

		if($this->obj->is_supper)
			return true;
		elseif(isset($this->obj->module_access[$module])){
			foreach($this->obj->module_access[$module] as $key => $value)
			{

			  if($key == 'access') {
			  	$access = true;
			  }
			}
		
			if($access)
				return 1;
			else 
			 	return 0;
		}
	}

	//--------------------------------------------------------------	
	function check_operation_access()
	{
		if($this->obj->is_supper)
		{
			return 1;
		}
		elseif(!$this->check_operation_permission($this->obj->uri->segment(2)))
		{
			$back_to =$_SERVER['REQUEST_URI'];
			$back_to = urlencode(base64_encode($back_to));
			redirect('access_denied/index/'.$back_to);
		}
		

	}

	//--------------------------------------------------------------	
	function check_operation_permission($operation)
	{

		if($this->obj->uri->segment(1) == 'recruit')
		{
			$segment = 'recruiter';
		}
		else
		{
			$segment = $this->obj->uri->segment(1);
		}
		if(isset($this->obj->module_access[$segment][$operation])) 

			return 1;
		else 
		 	return 0;
	}


}
?>