<?php

class Home extends CI_Controller {

    /**
    * Check if the user is logged in, if he's not, 
    * send him to the login page
    * @return void
    */	
	function index()
	{
	    	$this->load->view('home');	
   }
	
	 
}