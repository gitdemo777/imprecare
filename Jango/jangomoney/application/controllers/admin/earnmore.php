<?php
class Earnmore extends CI_Controller {
 
    /**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('earnmore_model');
        $this->load->model('country_model');
        
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
        $config['base_url'] = base_url().'admin/earnmore/';
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
            $data['count_earnmore']= $this->earnmore_model->count_earnmore();
            $data['earnmore'] = $this->earnmore_model->get_earnmore('', '', '', $order_type, $config['per_page'],$limit_end);        
            $config['total_rows'] = $data['count_earnmore'];
            
        		//initializate the panination helper 
        		$this->pagination->initialize($config);   
			$data['country'] = $this->country_model->get_country('', '', '', "","","");
        //load the view
        $data['main_content'] = 'admin/earnmore/list';
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
            $this->form_validation->set_rules('point', 'point', 'required|numeric');
            $this->form_validation->set_rules('url', 'url', 'required');
            $this->form_validation->set_rules('pkg_name', 'package name', 'required');
            $this->form_validation->set_rules('country', 'country', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
            		$image = $_FILES['image']['name'];
					$target = './images/earnmore/'.$image;
					move_uploaded_file( $_FILES['image']['tmp_name'], $target);
					
                $data_to_store = array(
                    'title' => $this->input->post('title'),
                    'description' => $this->input->post('description'),
                    'point' => $this->input->post('point'),
                    'url' => $this->input->post('url'),
                    'pkg_name' => $this->input->post('pkg_name'),
                    'country_id' => $this->input->post('country'),
                    'image' => $image
                );
                //if the insert has returned true then we show the flash message
                if($this->earnmore_model->store_earnmore($data_to_store)){
                    $data['flash_message'] = TRUE; 
                }else{
                    $data['flash_message'] = FALSE; 
                }

            }

        }
        //fetch earnmore data to populate the select field
        $data['country'] = $this->country_model->get_country('', '', '', "","","");
        //load the view
        $data['main_content'] = 'admin/earnmore/add';
        $this->load->view('includes/template', $data);  
    }       

    /**
    * Update item by his id
    * @return void
    */
    public function update()
    {
        //earnmore id 
        $id = $this->uri->segment(4);
  
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            $this->form_validation->set_rules('title', 'title', 'required');
            $this->form_validation->set_rules('description', 'description', 'required');
				$this->form_validation->set_rules('point', 'point', 'required|numeric');            
            $this->form_validation->set_rules('url', 'url', 'required');
            $this->form_validation->set_rules('pkg_name', 'package name', 'required');
            $this->form_validation->set_rules('country', 'country', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
            		$image =  $this->input->post('old_image');
            		if ($_FILES['image']['name'] != '')
					{
					   $image = $_FILES['image']['name'];
						$target = './images/earnmore/'.$image;
					    move_uploaded_file( $_FILES['image']['tmp_name'], $target);
					}
                $data_to_store = array(
                    'title' => $this->input->post('title'),
                    'description' => $this->input->post('description'),
						 'point' => $this->input->post('point'),                    
                    'url' => $this->input->post('url'),
                    'pkg_name' => $this->input->post('pkg_name'),
                    'country_id' => $this->input->post('country'),
                    'image' => $image
                );
                //if the insert has returned true then we show the flash message
                if($this->earnmore_model->update_earnmore($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/earnmore/update/'.$id.'');

            }//validation run

        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        //earnmore data 
        $data['earnmore'] = $this->earnmore_model->get_earnmore_by_id($id);
        $data['country'] = $this->country_model->get_country('', '', '', "","","");
        //load the view
        $data['main_content'] = 'admin/earnmore/edit';
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
        $this->earnmore_model->update_earnmore($id, $data_to_store);
        redirect('admin/earnmore');

    }

    /**
    * Delete earnmore by his id
    * @return void
    */
    public function delete()
    {
        //earnmore id 
        $id = $this->uri->segment(4);
        $this->earnmore_model->delete_earnmore($id);
        redirect('admin/earnmore');
    }//edit

}