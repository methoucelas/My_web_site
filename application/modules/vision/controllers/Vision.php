<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *@author:    Dushime Paul
 * Email:    dushimeyesupaulin@gmail.com
*/

class Vision extends MY_Controller {

	function __construct()
    {
        parent::__construct();
    }

    
	public function index()
	{
		$data['vision']=$this->Model->read('vision',null,'id_vision');
		$this->load->view('Vision_View',$data);
	}


	function CreateVision(){
		$Description=$this->input->post('Description');
		

		$data=array('content'=>$Description,
	               );
		$rsp=$this->Model->create('vision',$data);

		if ($rsp) {
			$sms['sms']='<div class="alert alert-background fade show mt-1 message" role="alert">
						     Content created successfully.
						 </div>';
		}else{
            $sms['sms']='<div class="alert alert-background fade show mt-1 message" role="alert">
						     <strong class="text-danger">Oups!</strong> An unknown error, contact admin!.
						 </div>';
		}
		$this->session->set_flashdata($sms);
		redirect(base_url('Vision'));
	}



	function UpdateVision(){
		$id_vision=$this->input->post('id_vision');
        $Description=$this->input->post('Description');
		
		

		$data=array('content'=>$Description,
	               );
		$rsp=$this->Model->update('vision',['id_vision'=>$id_vision],$data);

		if ($rsp) {
			$sms['sms']='<div class="alert alert-background fade show mt-1 message" role="alert">
						     Content updated successfully.
						 </div>';
		}else{
            $sms['sms']='<div class="alert alert-background fade show mt-1 message" role="alert">
						     <strong class="text-danger">Oups!</strong> An unknown error, contact admin!.
						 </div>';
		}
		$this->session->set_flashdata($sms);
		redirect(base_url('vision'));
	}


	

	function DeleteVision(){
		$id_vision=$this->input->post('id_vision');
		$rsp=$this->Model->delete('vision',['id_vision'=>$id_vision]);

		if ($rsp) {
			$sms['sms']='<div class="alert alert-background fade show mt-1 message" role="alert">
						     Content deleted successfully.
						 </div>';
		}else{
            $sms['sms']='<div class="alert alert-background fade show mt-1 message" role="alert">
						     <strong class="text-danger">Oups!</strong> An unknown error, contact admin!.
						 </div>';
		}
		$this->session->set_flashdata($sms);
		redirect(base_url('vision'));
	}
}

