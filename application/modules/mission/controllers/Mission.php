<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mission extends MY_Controller {

	function __construct()
    {
        parent::__construct();
        $this->not_logged_in();
		$this->load->model('Model');
    }

    
	public function index()
	{
		$data['mission']=$this->Model->read('mission',null,'id_mission');
		$this->load->view('missionView',$data);
	}


	function Creer_mission(){
		$Description=$this->input->post('Description');
		

		$data=array('content'=>$Description);
	               
		$rsp=$this->Model->create('mission',$data);

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
		redirect(base_url('mission'));
	}



	function Update_mission(){
		$id_mission=$this->input->post('id_mission');
        $Description=$this->input->post('Description');
		
		

		$data=array('content'=>$Description,
	               );
		$rsp=$this->Model->update('mission',['id_mission'=>$id_mission],$data);

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
		redirect(base_url('mission'));
	}


	

	function Supprimer_mision(){
		$id_mission=$this->input->post('id_mission');
		$rsp=$this->Model->delete('mission',['id_mission'=>$id_mission]);

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
		redirect(base_url('mission'));
	}
}
