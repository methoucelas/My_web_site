<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
    * @author:   Jean de Dieu Ntirampeba
    * Email:     jeandedieuntirampeba@gmail.com
    * Gitgub:    https://github.com/porochen
 */
class Admin extends MY_Controller {

	public function index()
	{
		$this->load->view('Login_View');
	}

	public function Login(){
		$this->load->view('Dashboard/Dashboard_View');
	}


	public function do_login($value='')
	{
		$email=$this->input->post('email');
    	$password=$this->input->post('password');

    	$checkemail=$this->Model->check_email($email);
    
    if ($checkemail==TRUE) {

        $login=$this->Model->login($email,$password);

      if ($login!=FALSE && $login['status']=='active') {
        
        $result=$this->Model->readOne('users',['id'=>$login['id']]); 

        $session = array(
                    'id' => $result['id'],
                    'email' => $result['email'],
                    'name' => $result['name'],
                    'role' => $result['role'],
                    'user' => $result['name'],
                    'logged_in'=>TRUE
                );
                    
                $this->session->set_userdata($session);

                redirect(base_url('Dashboard'));

      
      }else{
              // $this->attempt_time($email);
            $sms['sms']='<div id="message" class="alert alert-danger text-center">
                                <strong>Oups!</strong> mot de passe incorrect / votre compte est désactivé.
                            </div>';
            $this->session->set_flashdata($sms);
            redirect(base_url('Admin'));
      }
    }else{
          $sms['sms']='<div id="message" class="alert alert-danger text-center">
                                <strong>Oups!</strong> email incorrect / compte inexistant.
                            </div>';
        $this->session->set_flashdata($sms);
        redirect(base_url('Admin'));
    }
            	
	}

	public function Logout(){

    $session = array(
            'id' => NULL,
            'email' => NULL,
            'name' => NULL,
            'role' => NULL,
            'logged_in'=> FALSE
        );

        $this->session->set_userdata($session);
        $this->session->sess_destroy();
        
        redirect(base_url('Admin'));

	}
}
