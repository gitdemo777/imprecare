<?php
class Users extends CI_Controller {
 
    /**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('users_model');
        
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

        //all the posts sent by the view
        
        //pagination settings
        $config['per_page'] = 5;
        $config['base_url'] = base_url().'admin/users/';
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
            $data['count_users']= $this->users_model->count_users();
            $data['users'] = $this->users_model->get_users('', '', '', $order_type, $config['per_page'],$limit_end);        
            $config['total_rows'] = $data['count_users'];

        //initializate the panination helper 
        $this->pagination->initialize($config);   

        //load the view
        $data['main_content'] = 'admin/users/list';
        $this->load->view('includes/template', $data);  

    }//index

    /**
    * Delete user by his id
    * @return void
    */
    public function delete()
    {
        //user id 
        $id = $this->uri->segment(4);
        $this->users_model->delete_user($id);
        redirect('admin/users');
    }//edit

}