<?php
class Feedback extends CI_Controller {
 
    /**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('feedback_model');
        
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
        $config['base_url'] = base_url().'admin/feedback/';
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
         $order_type = 'Desc';    
           
        //make the data type var avaible to our view
        $data['order_type_selected'] = $order_type;        

            //clean filter data inside section
            $data['order'] = 'id';

            //fetch sql data into arrays
            $data['count_feedback']= $this->feedback_model->count_feedback();
            $data['feedback'] = $this->feedback_model->get_feedback('', '', '', $order_type, $config['per_page'],$limit_end);        
            $config['total_rows'] = $data['count_feedback'];
            
        		//initializate the panination helper 
        		$this->pagination->initialize($config);   

        //load the view
        $data['main_content'] = 'admin/feedback/list';
        $this->load->view('includes/template', $data);  

    }//index

}