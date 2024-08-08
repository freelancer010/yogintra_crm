<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('auth_model', 'auth_model');
		$this->load->model('user_model', 'user_model');
		$this->CI =& get_instance();
	}

	public function index(){

		if($this->session->has_userdata('is_admin_login')){
			redirect('dashboard');
		}
		else{
			redirect('auth/login');
		}
	}

	//--------------------------------------------------------------
	public function login(){

		if($this->input->post('submit')){

			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('error', $data['errors']);
				redirect(PANELURL.'auth/login','refresh');
			}
			else {
				$data = array(
					'username' => $this->input->post('username'),
					'password' => $this->input->post('password')
				);
				
				$result = $this->auth_model->login($data);
				if($result){
					if($result['is_verify'] == 0){
						$this->session->set_flashdata('error', 'Please verify your email address!');
						redirect(PANELURL.'auth/login');
						exit();
					}
					if($result['is_active'] == 0){
						$this->session->set_flashdata('error', 'Account is disabled by Admin!');
						redirect(PANELURL.'auth/login');
						exit();
					}
					if($result['is_admin'] == 1){
						$admin_data = array(
							'admin_id' 		=> $result['admin_id'],
							'username' 		=> $result['username'],
							'admin_role_id' => $result['admin_role_id'],
							'admin_role' 	=> $result['admin_role_title'],
							'is_supper' 	=> $result['is_supper'],
							'profile_image' 	=> $result['profile_image'],
							'fullName' 	=> $result['firstname'].' '.$result['lastname'],
							'is_admin_login'=> TRUE
						);
						$this->session->set_userdata($admin_data);
						$this->rbac->set_access_in_session();

						redirect(PANELURL.'dashboard', 'refresh');

					}
				}
				else{
					$this->session->set_flashdata('errors', 'Invalid Username or Password!');
					redirect(PANELURL.'auth/login');
				}
			}
		}
		else{
			$this->load->view('auth/login');
		}
	}	

	public function user_login(){

		if($this->input->post('submit')){

			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('error', $data['errors']);
				redirect(base_url('auth/user_login'),'refresh');
			}
			else {
				$data = array(
					'username' => $this->input->post('username'),
					'password' => $this->input->post('password')
				);
				
				$result = $this->auth_model->user_login($data);
				if($result){
					if($result['is_verify'] == 0){
						$this->session->set_flashdata('error', 'Please verify your email address!');
						redirect(base_url('auth/user_login'));
						exit();
					}
					if($result['is_active'] == 0){
						$this->session->set_flashdata('error', 'Account is disabled by Admin!');
						redirect(base_url('auth/user_login'));
						exit();
					}
					if($result['admin_role_id'] == 3){
						$admin_data = array(
							'id' => $result['id'],
							'username' => $result['username'],
							'admin_role_id' => $result['admin_role_id'],
							'admin_role' => 'Frenchisor',
							'is_supper' => 0,
							'is_user_login' => TRUE
						);
						$this->session->set_userdata($admin_data);
						$this->rbac->set_access_in_session(); // set access in session

						redirect(base_url('users/dashboard'), 'refresh');

					}
				}
				else{
					$this->session->set_flashdata('errors', 'Invalid Username or Password!');
					redirect(base_url('auth/user_login'));
				}
			}
		}
		else{
			$data['title'] = 'Login';
			$data['navbar'] = false;
			$data['sidebar'] = false;
			$data['footer'] = false;
			$data['bg_cover'] = true;

			$this->load->view('includes/_header', $data);
			$this->load->view('auth/user_login');
			$this->load->view('includes/_footer', $data);
		}
	}	

	//-------------------------------------------------------------------------
	public function register(){

		if($this->input->post('submit')){

			// for google recaptcha
			if ($this->recaptcha_status == true) {
				if (!$this->recaptcha_verify_request()) {
					$this->session->set_flashdata('form_data', $this->input->post());
					$this->session->set_flashdata('error', 'reCaptcha Error');
					redirect(base_url('auth/register'));
					exit();
				}
			}

			$this->form_validation->set_rules('username', 'Username', 'trim|alpha_numeric|is_unique[ci_admin.username]|required');
			$this->form_validation->set_rules('firstname', 'Firstname', 'trim|required');
			$this->form_validation->set_rules('lastname', 'Lastname', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|is_unique[ci_admin.email]|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
			$this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|matches[password]');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('form_data', $this->input->post());
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('auth/register'),'refresh');
			}
			else{
				$data = array(
					'username' => $this->input->post('username'),
					'firstname' => $this->input->post('firstname'),
					'lastname' => $this->input->post('lastname'),
					'admin_role_id' => 3, // By default i putt role is 2 for registraiton
					'email' => $this->input->post('email'),
					'password' =>  password_hash($this->input->post('password'), PASSWORD_BCRYPT),
					'is_active' => 1,
					'is_verify' => 0,
					'token' => md5(rand(0,1000)),    
					'last_ip' => '',
					'created_at' => date('Y-m-d : h:m:s'),
					'updated_at' => date('Y-m-d : h:m:s'),
				);
				$data = $this->security->xss_clean($data);
				$result = $this->auth_model->register($data);
				if($result){
					//sending welcome email to user
					$this->load->helper('email_helper');

					$mail_data = array(
						'fullname' => $data['firstname'].' '.$data['lastname'],
						'verification_link' => base_url('auth/verify/').'/'.$data['token']
					);
					$to = $data['email'];
					$email = $this->mailer->mail_template($to,'email-verification',$mail_data);
					if($email){
						$this->session->set_flashdata('success', 'Your Account has been made, please verify it by clicking the activation link that has been send to your email.');	
						redirect(base_url('auth/login'));
					}	
					else{
						echo 'Email Error';
					}
				}
			}
		}
		else{
			$data['title'] = 'Create an Account';
			$data['navbar'] = false;
			$data['sidebar'] = false;
			$data['footer'] = false;
			$data['bg_cover'] = true;
			$this->load->view('includes/_header', $data);
			$this->load->view('auth/register');
			$this->load->view('includes/_footer', $data);
		}
	}

	//----------------------------------------------------------	
	public function verify(){

		$verification_id = $this->uri->segment(4);
		$result = $this->auth_model->email_verification($verification_id);
		if($result){
			$this->session->set_flashdata('success', 'Your email has been verified, you can now login.');
			redirect(base_url('auth/login'));
		}
		else{
			$this->session->set_flashdata('success', 'The url is either invalid or you already have activated your account.');	
			redirect(base_url('auth/login'));
		}	
	}

	public function user_verify(){

		$verification_id = $this->uri->segment(4);
		$result = $this->auth_model->user_verification($verification_id);
		if($result){
			$this->session->set_flashdata('success', 'Your email has been verified, you can now login.');
			redirect(base_url('auth/user_login'));
		}
		else{
			$this->session->set_flashdata('success', 'The url is either invalid or you already have activated your account.');	
			redirect(base_url('auth/user_login'));
		}	
	}

	public function register_frenchisor(){
		if($this->input->post('submit')){
			if ($this->recaptcha_status == true) {
				if (!$this->recaptcha_verify_request()) {
					$this->session->set_flashdata('form_data', $this->input->post());
					$this->session->set_flashdata('error', 'reCaptcha Error');
					redirect(base_url('auth/register'));
					exit();
				}
			}			

			$this->form_validation->set_rules('username', 'Username', 'trim|alpha_numeric|is_unique[ci_admin.username]|required');
			$this->form_validation->set_rules('firstname', 'Firstname', 'trim|required');
			$this->form_validation->set_rules('lastname', 'Lastname', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|is_unique[ci_users.email]|required');
			$this->form_validation->set_rules('mobile_no', 'Mobile No.', 'trim|required|min_length[10]');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('form_data', $this->input->post());
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('auth/register_frenchisor'),'refresh');
			}
			else{
				$img = array(
					'udid' => '',
					'pan' => ''
				);
				if($_FILES){
					$path = 'uploads/';
					$config = array(
						'upload_path' => "./uploads/",
						'allowed_types' => "gif|jpg|png|jpeg|pdf",
						'overwrite' => TRUE,
						'max_size' => "204800000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
					);
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if($_FILES['udid']){
						if($this->upload->do_upload('udid'))
						{
							$img['udid'] = $path.$this->upload->data('file_name');
						}
						else
						{
							$this->session->set_flashdata('errors',$this->upload->display_errors());
						}
					}
					if($_FILES['pan']){
						if($this->upload->do_upload('pan'))
						{
							$img['pan'] = $path.$this->upload->data('file_name');
						}
						else
						{
							$this->session->set_flashdata('errors',$this->upload->display_errors());
						}
					}
				}
				$pass = randomPassword();
				
				$data = array(
					'username' => $this->input->post('username'),
					'firstname' => $this->input->post('firstname'),
					'lastname' => $this->input->post('lastname'),
					'email' => $this->input->post('email'),
					'mobile_no' => $this->input->post('mobile_no'),
					'address' => $this->input->post('address'),
					'admin_role_id' => 3,
					'is_active' => 0,
					'is_verify' => 0,
					'last_ip' => '',
					'udid' => $img['udid'], 
					'pan' => $img['pan'], 
					'token' => md5(rand(0,1000)),
					'password' =>  password_hash($pass, PASSWORD_BCRYPT),
					'created_at' => date('Y-m-d : h:m:s'),
					'updated_at' => date('Y-m-d : h:m:s'),
				);
				$data = $this->security->xss_clean($data);
				$result = $this->user_model->add_user($data);
				if($result){
					$mail_array = array(
						'username' => $data['username'],
						'password' => $pass,
						'mobile_no' => $data['mobile_no'],
						'email' => $data['email'],
						'firstname' => $data['firstname'],
						'lastname' => $data['lastname'],
						'token' => $data['token'],
					);
					$email = send_mail($mail_array);
					// Activity Log 
					$this->activity_model->add_log(1);
					if($email){
						$this->session->set_flashdata('success', 'Your Account has been made, please verify it by clicking the activation link that has been send to your email.');	
						redirect(base_url('auth/user_login'));
					}	
					else{
						echo 'Email Error';
					}
				}
			}
		}
		else{
			$data['title'] = 'Create an Account';
			$data['navbar'] = false;
			$data['sidebar'] = false;
			$data['footer'] = false;
			$data['bg_cover'] = true;
			
			$this->load->view('includes/_header', $data);
			$this->load->view('auth/register_frenchisor');
			$this->load->view('includes/_footer', $data);
		}
		
	}

	//--------------------------------------------------		
	public function forgot_password(){

		if($this->input->post('submit')){
			//checking server side validation
			$this->form_validation->set_rules('email', 'Email', 'valid_email|trim|required');
			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);
				$this->session->set_flashdata('errors', $data['errors']);
				redirect(base_url('auth/forget_password'),'refresh');
			}

			$email = $this->input->post('email');
			$response = $this->auth_model->check_user_mail($email);

			if($response){

				$rand_no = rand(0,1000);
				$pwd_reset_code = md5($rand_no.$response['admin_id']);
				$this->auth_model->update_reset_code($pwd_reset_code, $response['admin_id']);
				
				// --- sending email
				$to = $response['email'];
				$mail_data= array(
					'fullname' => $response['firstname'].' '.$response['lastname'],
					'reset_link' => base_url('auth/reset_password/'.$pwd_reset_code)
				);
				$this->mailer->mail_template($to,'forget-password',$mail_data);

				if($email){
					$this->session->set_flashdata('success', 'We have sent instructions for resetting your password to your email');

					redirect(base_url('auth/forgot_password'));
				}
				else{
					$this->session->set_flashdata('error', 'There is the problem on your email');
					redirect(base_url('auth/forgot_password'));
				}
			}
			else{
				$this->session->set_flashdata('error', 'The Email that you provided are invalid');
				redirect(base_url('auth/forgot_password'));
			}
		}
		else{

			$data['title'] = 'Forget Password';
			$data['navbar'] = false;
			$data['sidebar'] = false;
			$data['footer'] = false;
			$data['bg_cover'] = true;

			$this->load->view('includes/_header', $data);
			$this->load->view('auth/forget_password');
			$this->load->view('includes/_footer', $data);
		}
	}

	//----------------------------------------------------------------		
	public function reset_password($id=0){

		// check the activation code in database
		if($this->input->post('submit')){
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');
			$this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|matches[password]');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors()
				);

				$this->session->set_flashdata('reset_code', $id);
				$this->session->set_flashdata('errors', $data['errors']);
				redirect($_SERVER['HTTP_REFERER'], 'refresh');
			}

			else{
				$new_password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
				$this->auth_model->reset_password($id, $new_password);
				$this->session->set_flashdata('success','New password has been Updated successfully.Please login below');
				redirect(base_url('auth/login'));
			}
		}
		else{
			$result = $this->auth_model->check_password_reset_code($id);

			if($result){

				$data['title'] = 'Reseat Password';
				$data['reset_code'] = $id;
				$data['navbar'] = false;
				$data['sidebar'] = false;
				$data['footer'] = false;
				$data['bg_cover'] = true;

				$this->load->view('includes/_header', $data);
				$this->load->view('auth/reset_password');
				$this->load->view('includes/_footer', $data);

			}
			else{
				$this->session->set_flashdata('error','Password Reset Code is either invalid or expired.');
				redirect(base_url('auth/forgot_password'));
			}
		}
	}

	//-----------------------------------------------------------------------
	public function logout(){
		$this->session->sess_destroy();
		redirect(PANELURL.'auth/login', 'refresh');
	}
	
	// Get Country. State and City
	//----------------------------------------
	public function get_country_states()
	{
		$states = $this->db->select('*')->where('country_id',$this->input->post('country'))->get('ci_states')->result_array();
			$options = array('' => 'Select Option') + array_column($states,'name','id');
			$html = form_dropdown('state',$options,'','class="form-control select2" required');
		$error =  array('msg' => $html);
		echo json_encode($error);
	}

	//----------------------------------------
	public function get_state_cities()
	{
		$cities = $this->db->select('*')->where('state_id',$this->input->post('state'))->get('ci_cities')->result_array();
			$options = array('' => 'Select Option') + array_column($cities,'name','id');
			$html = form_dropdown('city',$options,'','class="form-control select2" required');
		$error =  array('msg' => $html);
		echo json_encode($error);
	}

}  // end class


?>