<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *@author:    Dushime Paul
 * Email:    dushimeyesupaulin@gmail.com
*/
class Parteners extends MY_Controller {

	function __construct()
    {
        parent::__construct();
    }

    
	public function index()
	{
		$data['parteners']=$this->Model->read('partener',null,'id_partner');
		$this->load->view('Partener_View',$data);
	}


	function Changestatus(){
	  $id_partner=$this->input->post('id_partner');
	  $status=$this->input->post('status');
	  if ($status==1) {
	  	$status=0;
	  }else{
	  	$status=1;
	  }
	  $rsp=$this->Model->update('partener',['id_partner'=>$id_partner],['status'=>$status]);

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
		redirect(base_url('Parteners'));	
	}

	function Create(){
		$description=$this->input->post('description');
		$logo=$this->upload_document($_FILES['logo']['tmp_name'],$_FILES['logo']['name']);
		$link=$this->input->post('link');
		

		$data=array('description'=>$description,
			         'logo'=>$logo,
	                 'link'=>$link,
	                
	               );
		$rsp=$this->Model->create('partener',$data);

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
		redirect(base_url('Parteners'));
	}

	function Update(){
		$id_partner=$this->input->post('id_partner');
		$description=$this->input->post('description');

		if (!empty($_FILES['logo']['name'])) {
		  $logo=$this->upload_document($_FILES['logo']['tmp_name'],$_FILES['logo']['name']);
		}else{
		  $logo=$this->input->post('Hiddenlogo');
		}
		
		$link=$this->input->post('link');
     
		
		$data=array('description'=>$description,
			         'logo'=>$logo,
	                 'link'=>$link,
	                
	               );
		$rsp=$this->Model->update('partener',['id_partner'=>$id_partner],$data);

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
		redirect(base_url('Parteners'));
	}


	function Delete(){
		$id_partner=$this->input->post('id_partner');
		$rsp=$this->Model->delete('partener',['id_partner'=>$id_partner]);

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
		redirect(base_url('Parteners'));
	}

	  //upload logos
	public function upload_document($nom_file,$nom_champ)
	{
	      $ref_folder =FCPATH.'attachments/Partener/';
	      $code=date("YmdHis").uniqid();
	      $fichier=basename($code);
	      $file_extension = pathinfo($nom_champ, PATHINFO_EXTENSION);
	      $file_extension = strtolower($file_extension);
	      $valid_ext = array('gif','jpg','png','jpeg','JPG','PNG','JPEG');

	      if(!is_dir($ref_folder)) //create the folder if it does not already exists   
	      {
	          mkdir($ref_folder,0777,TRUE);                                        
	      }  
	      move_uploaded_file($nom_file, $ref_folder.$fichier.".".$file_extension);
	      // $pathfile="attachments/shop_logos/".$fichier.".".$file_extension;
	      $logo_name=$fichier.".".$file_extension;
	      return $logo_name;
	}
}
