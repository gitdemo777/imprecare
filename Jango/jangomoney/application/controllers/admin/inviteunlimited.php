<?php
class Inviteunlimited extends CI_Controller {
 
    /**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('inviteunlimited_model');
        
        if(!$this->session->userdata('is_logged_in')){
            redirect('admin/login');
        }
    }
 
    /**
    * Load the main view with all the current model model's data.
    * @return void
    */
    public function index()
    {

		//pagination settings
        $config['per_page'] = 5;
        $config['base_url'] = base_url().'admin/inviteunlimited/';
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 20;
        $config['full_tag_open'] = '<ul>';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';

		  //limit end
        $page = $this->uri->segment(3);

        //math to get the initial record to be select in the database
        $limit_end = ($page * $config['per_page']) - $config['per_page'];
        if ($limit_end < 0){
            $limit_end = 0;
        } 

         //if we have nothing inside session, so it's the default "Asc"
         $order_type = 'Asc';    
           
        //make the data type var avaible to our view
        $data['order_type_selected'] = $order_type;        

            //clean filter data inside section
            $data['order'] = 'id';

            //fetch sql data into arrays
            $data['count_inviteunlimited']= $this->inviteunlimited_model->count_inviteunlimited();
            $data['inviteunlimited'] = $this->inviteunlimited_model->get_inviteunlimited('', '', '', $order_type, $config['per_page'],$limit_end);        
            $config['total_rows'] = $data['count_inviteunlimited'];
            
        		//initializate the panination helper 
        		$this->pagination->initialize($config);   

        //load the view
        $data['main_content'] = 'admin/inviteunlimited/list';
        $this->load->view('includes/template', $data);  

    }//index

    public function add()
    {
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            $this->form_validation->set_rules('description', 'description', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $data_to_store = array(
                    'description' => $this->input->post('description')
                );
                //if the insert has returned true then we show the flash message
                if($this->inviteunlimited_model->store_inviteunlimited($data_to_store)){
                    $data['flash_message'] = TRUE; 
                }else{
                    $data['flash_message'] = FALSE; 
                }
            }
        }
        $data['main_content'] = 'admin/inviteunlimited/add';
        $this->load->view('includes/template', $data);  
    }       

    /**
    * Update item by his id
    * @return void
    */
    public function update()
    {
        //inviteunlimited id 
        $id = $this->uri->segment(4);
  
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            $this->form_validation->set_rules('description', 'description', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $data_to_store = array(
                    'description' => $this->input->post('description')
                );
                //if the insert has returned true then we show the flash message
                if($this->inviteunlimited_model->update_inviteunlimited($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/inviteunlimited/update/'.$id.'');

            }//validation run

        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        //inviteunlimited data 
        $data['inviteunlimited'] = $this->inviteunlimited_model->get_inviteunlimited_by_id($id);
        //load the view
        $data['main_content'] = 'admin/inviteunlimited/edit';
        $this->load->view('includes/template', $data);            

    }//update
    
    /**
    * Update item by his id
    * @return void
    */
    public function updatestatus()
    {
        $id = $this->uri->segment(4);
        $status = $this->uri->segment(5);
        $data_to_store = array(
                    'status' => $status
                );
        $this->inviteunlimited_model->update_inviteunlimited($id, $data_to_store);
        redirect('admin/inviteunlimited');

    }

    /**
    * Delete inviteunlimited by his id
    * @return void
    */
    public function delete()
    {
        //inviteunlimited id 
        $id = $this->uri->segment(4);
        $this->inviteunlimited_model->delete_inviteunlimited($id);
        redirect('admin/inviteunlimited');
    }//edit

}