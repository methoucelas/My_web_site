<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
    * @author:   Jean de Dieu Ntirampeba
    * Email:     jeandedieuntirampeba@gmail.com
    * Gitgub:    https://github.com/porochen
 */
class Testimony extends MY_Controller {

	function __construct()
    {
        parent::__construct();
        $this->not_logged_in();
    }

    

	public function index()
	{
		$data['testimonies']=$this->Model->readQuery('SELECT * FROM testimonies t  WHERE 1');
		$this->load->view('Testimony_View',$data);
	}

	function Create(){

		$Testifier=$this->input->post('FullName');
		$Poste=$this->input->post('Poste');
		$Details=$this->input->post('Details');

		$Image='';
		if (!empty($_FILES['Image']['name'])) {
		  $Image=$this->upload_document($_FILES['Image']['tmp_name'],$_FILES['Image']['name']);
		}

		$data=array('Testifier'=>$Testifier,
					'Poste'=>$Poste,
					'Image'=>$Image,
					'Details'=>$Details,
	               );
		$rsp=$this->Model->create('testimonies',$data);

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
		redirect(base_url('Testimony'));
	}

	function Update(){

		$Testifier=$this->input->post('FullName');
		$Poste=$this->input->post('Poste');
		$Details=$this->input->post('Details');
		$IdTestimony=$this->input->post('IdTestimony');

		$Image='';
		if (!empty($_FILES['Image']['name'])) {
		  $Image=$this->upload_document($_FILES['Image']['tmp_name'],$_FILES['Image']['name']);
		}else{
		  $Image=$this->input->post('HiddenImage');
		}

		$data=array('Testifier'=>$Testifier,
					'Poste'=>$Poste,
					'Image'=>$Image,
					'Details'=>$Details,
	               );


		$rsp=$this->Model->update('testimonies',['IdTestimony'=>$IdTestimony],$data);

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
		redirect(base_url('Testimony'));
	}


	function Delete(){
		$IdTestimony=$this->input->post('IdTestimony');
		$rsp=$this->Model->delete('testimonies',['IdTestimony'=>$IdTestimony]);

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
		redirect(base_url('Testimony'));
	}

	//upload images
	public function upload_document($nom_file,$nom_champ)
	{
	      $ref_folder =FCPATH.'attachments/Testimony/';
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
	      // $pathfile="attachments/shop_images/".$fichier.".".$file_extension;
	      $image_name=$fichier.".".$file_extension;
	      return $image_name;
	}

}