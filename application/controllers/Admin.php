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
		$username=$this->input->post('Username');
    	$password=$this->input->post('password');

    	$checkUsername=$this->Model->check_email($username);
    
    if ($checkUsername==TRUE) {

        $login=$this->Model->login($username,$password);

      if ($login['isActive']!=0) {
        
        $result=$this->Model->readOne('users',['idUser'=>$login['idUser']]); 

        $session = array(
                    'idUser' => $result['idUser'],
                    'username' => $result['username'],
                    'firstName' => $result['firstName'],
                    'lastName' => $result['lastName'],
                    'user' => $result['firstName'].' '.$result['lastName'],
                    'idGroup'=>$result['idGroup'],
                    'logged_in'=>TRUE
                );
                    
                $this->session->set_userdata($session);

                redirect(base_url('Dashboard'));

      
      }else{
              // $this->attempt_time($username);
            $sms['sms']='<div id="message" class="alert alert-danger text-center">
                                <strong>Oups!</strong> incorrect password/ you are account is not activated.
                            </div>';
            $this->session->set_flashdata($sms);
            redirect(base_url('Admin'));
      }
    }else{
          $sms['sms']='<div id="message" class="alert alert-danger text-center">
                                <strong>Oups!</strong> incorrect username/ account has been desabled.
                            </div>';
        $this->session->set_flashdata($sms);
        redirect(base_url('Admin'));
    }
            
	}

	public function Logout(){

    $session = array(
            'idUser' => NULL,
            'username' => NULL,
            'firstName' => NULL,
            'lastName' => NULL,
            'logged_in'=> FALSE
        );

        $this->session->set_userdata($session);
        
        redirect(base_url('Admin'));

	}
}
