<?php

class User extends CI_Controller {

    /**
    * Check if the user is logged in, if he's not, 
    * send him to the login page
    * @return void
    */	
	function index()
	{
		if($this->session->userdata('is_logged_in')){
			redirect('admin/users');
        }else{
        	$this->load->view('admin/login');	
        }
	}
	
	 /**
    * encript the password 
    * @return mixed
    */	
    function __encrip_password($password) {
        return md5($password);
    }	

    /**
    * check the username and the password with the database
    * @return void
    */
	function validate_credentials()
	{	
		$this->load->model('admin_model');
		
		$user_name = $this->input->post('user_name');
		$password = $this->__encrip_password($this->input->post('password'));

		$is_valid = $this->admin_model->validate($user_name, $password);
		
		if($is_valid)
		{
			$data = array(
				'user_name' => $user_name,
				'is_logged_in' => true
			);
			$this->session->set_userdata($data);
			redirect('admin/users');
		}
		else // incorrect username or password
		{
			$data['message_error'] = TRUE;
			$this->load->view('admin/login', $data);	
		}
	}	

    /**
    * The method just loads the signup view
    * @return void
    */
	function signup()
	{
		$this->load->view('admin/signup_form');	
	}

    /**
    * Create new user and store it in the database
    * @return void
    */	
	function create_member()
	{
		$this->load->library('form_validation');
		
		// field name, error message, validation rules
		$this->form_validation->set_rules('first_name', 'Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required|matches[password]');
		$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
		
		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('admin/signup_form');
		}
		
		else
		{			
			$this->load->model('admin_model');
			
			if($query = $this->Admin_model->create_member())
			{
				$this->load->view('admin/signup_successful');			
			}
			else
			{
				$this->load->view('admin/signup_form');			
			}
		}
	}
	
	/**
    * Destroy the session, and logout the user.
    * @return void
    */		
	function changepassword()
	{
		 if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
        	$this->load->model('admin_model');
            //form validation
            $this->form_validation->set_rules('old_password', 'old password', 'required|callback_check_password');
            $this->form_validation->set_rules('new_password', 'new password', 'required');
            $this->form_validation->set_rules('confirm_password', 'confirm password', 'required|callback_match_password');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $data_to_store = array(
                    'pass_word' => md5($this->input->post('new_password'))
                );
                //if the insert has returned true then we show the flash message
                if($this->admin_model->update_password($this->session->userdata('user_name'),$data_to_store)){
                    $data['flash_message'] = TRUE; 
                }else{
                    $data['flash_message'] = FALSE; 
                }

            }

        }
		$data['main_content'] = 'admin/changepassword';
      $this->load->view('includes/template', $data);
	}
	
	function match_password() {
	   $new = $this->input->post('new_password');
	   $confirm = $this->input->post('confirm_password');
	
	   // do some database things you need to do e.g.
	   if ($new == $confirm) {
	       return true;
	   }
	   $this->form_validation->set_message('match_password','New password and confirm password does not match.');
	   return false;
	}
	
	function check_password() {
		$this->load->model('admin_model');
	   $password = $this->input->post('old_password');
	   $user_name = $this->session->userdata('user_name');
	
	   // do some database things you need to do e.g.
	   if ($this->admin_model->validate($user_name, md5($password))) {
       	return true;
  		}
	   $this->form_validation->set_message('check_password','Enter currect old password.');
	   return false;
	}
	
	/**
    * Destroy the session, and logout the user.
    * @return void
    */		
	function logout()
	{
		$this->session->sess_destroy();
		redirect('admin');
	}
}