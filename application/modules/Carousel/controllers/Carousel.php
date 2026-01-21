<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carousel extends MY_Controller {

	function __construct()
    {
        parent::__construct();
        $this->not_logged_in();
    }

    
	public function index()
	{
		$data['carousel']=$this->Model->read('carousels',null,'IdCarousel');
		$this->load->view('Carousel_View',$data);
	}


	function ChangeStatus(){
	  $IdCarousel=$this->input->post('IdCarousel');
	  $IsActive=$this->input->post('IsActive');
	  if ($IsActive==1) {
	  	$status=0;
	  }else{
	  	$status=1;
	  }
	  $rsp=$this->Model->update('carousels',['IdCarousel'=>$IdCarousel],['IsActive'=>$status]);

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
		redirect(base_url('Carousel'));	
	}

	function CarouselDetail($CarouselDetail){
	  $IdCarousel=explode('_', $CarouselDetail);
	  $data['detail']=$this->Model->readOne('carousels',['IdCarousel'=>$IdCarousel[0]]);
	  $this->load->view('CarouselDetail_View',$data);
	}

	function SaveDetail(){
	  $IdCarousel=$this->input->post('IdCarousel');
	  $Detail=$this->input->post('Detail');
	  $rsp=$this->Model->update('carousels',['IdCarousel'=>$IdCarousel],['Detail'=>$Detail]);
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
		redirect(base_url('Carousel'));
	}

	function Create(){
		$Title=$this->input->post('Title');
		$Description=$this->input->post('Description');
		$Image=$this->upload_document($_FILES['Image']['tmp_name'],$_FILES['Image']['name']);

		$data=array('Title'=>$Title,
	                'Description'=>$Description,
	                'Image'=>$Image,
	               );
		$rsp=$this->Model->create('carousels',$data);

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
		redirect(base_url('Carousel'));
	}

	function Update(){
		$IdCarousel=$this->input->post('IdCarousel');
		$Title=$this->input->post('Title');
		$Description=$this->input->post('Description');
		// $HiddenImage=$this->input->post('HiddenImage');
       
		if (!empty($_FILES['Image']['name'])) {
		  $Image=$this->upload_document($_FILES['Image']['tmp_name'],$_FILES['Image']['name']);
		}else{
		  $Image=$this->input->post('HiddenImage');
		}
		

		$data=array('Title'=>$Title,
	                'Description'=>$Description,
	                'Image'=>$Image,
	               );
		$rsp=$this->Model->update('carousels',['IdCarousel'=>$IdCarousel],$data);

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
		redirect(base_url('Carousel'));
	}


	function Delete(){
		$IdCarousel=$this->input->post('IdCarousel');
		$rsp=$this->Model->delete('carousels',['IdCarousel'=>$IdCarousel]);

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
		redirect(base_url('Carousel'));
	}







	  //upload images
	public function upload_document($nom_file,$nom_champ)
	{
	      $ref_folder =FCPATH.'attachments/Carousel/';
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
