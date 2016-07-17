<?php
class Challenge extends CI_Controller {
 
    /**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('challenges_model');
        
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
        $config['base_url'] = base_url().'admin/challenge/';
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
            $data['count_challenges']= $this->challenges_model->count_challenges();
            $data['challenges'] = $this->challenges_model->get_challenges('', '', '', $order_type, $config['per_page'],$limit_end);        
            $config['total_rows'] = $data['count_challenges'];
            
        		//initializate the panination helper 
        		$this->pagination->initialize($config);   

        //load the view
        $data['main_content'] = 'admin/challenges/list';
        $this->load->view('includes/template', $data);  

    }//index

    public function add()
    {
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
				//form validation
            $this->form_validation->set_rules('title', 'title', 'required');
            $this->form_validation->set_rules('description', 'description', 'required');
            if (empty($_FILES['image']['name']))
				{
				    $this->form_validation->set_rules('image', 'image', 'required');
				}
            $this->form_validation->set_rules('ref_url', 'ref_url', 'required');
            $this->form_validation->set_rules('pkg_name', 'pkg_name', 'required');
            $this->form_validation->set_rules('ref_id', 'ref_id', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
				
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
            		$image = $_FILES['image']['name'];
					$target = './images/app/'.$image;
					move_uploaded_file( $_FILES['image']['tmp_name'], $target);
					
                $data_to_store = array(
                    'title' => $this->input->post('title'),
                    'description' => $this->input->post('description'),
                    'ref_url' => $this->input->post('ref_url'),
                    'pkg_name' => $this->input->post('pkg_name'),          
                    'ref_id' => $this->input->post('ref_id'),
                    'image' => $image
                );
                //if the insert has returned true then we show the flash message
                if($this->challenges_model->store_challenge($data_to_store)){
                    $data['flash_message'] = TRUE; 
                }else{
                    $data['flash_message'] = FALSE; 
                }
            }
        }
        
        $data['main_content'] = 'admin/challenges/add';
        $this->load->view('includes/template', $data);  
    }       

    /**
    * Update item by his id
    * @return void
    */
    public function update()
    {
        //challenge id 
        $id = $this->uri->segment(4);
  
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            $this->form_validation->set_rules('title', 'title', 'required');
            $this->form_validation->set_rules('description', 'description', 'required');
            $this->form_validation->set_rules('ref_url', 'ref_url', 'required');
            $this->form_validation->set_rules('pkg_name', 'pkg_name', 'required');
            $this->form_validation->set_rules('ref_id', 'ref_id', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
            		$image =  $this->input->post('old_image');
            		if ($_FILES['image']['name'] != '')
					{
					   $image = $_FILES['image']['name'];
						$target = './images/app/'.$image;
					    move_uploaded_file( $_FILES['image']['tmp_name'], $target);
					}
					
                $data_to_store = array(
                    'title' => $this->input->post('title'),
                    'description' => $this->input->post('description'),
                    'ref_url' => $this->input->post('ref_url'),
                    'pkg_name' => $this->input->post('pkg_name'),          
                    'ref_id' => $this->input->post('ref_id'),
                    'image' => $image
                );
                //if the insert has returned true then we show the flash message
                if($this->challenges_model->update_challenge($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/challenge/update/'.$id.'');

            }//validation run

        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        //challenge data 
        $data['challenges'] = $this->challenges_model->get_challenge_by_id($id);
        //load the view
        $data['main_content'] = 'admin/challenges/edit';
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
        $this->challenges_model->update_challenge($id, $data_to_store);
        redirect('admin/challenge');

    }

    /**
    * Delete challenge by his id
    * @return void
    */
    public function delete()
    {
        //challenge id 
        $id = $this->uri->segment(4);
        $this->challenges_model->delete_challenge($id);
        redirect('admin/challenge');
    }//edit

}