<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
    * @author:   Jean de Dieu Ntirampeba
    * Email:     jeandedieuntirampeba@gmail.com
    * Gitgub:    https://github.com/porochen
 */
class Settings extends MY_Controller {

	function __construct()
    {
        parent::__construct();
        $this->not_logged_in();
    }

    

	public function index()
	{
		$data['settings']=$this->Model->read('settings');
		$this->load->view('Settings_View',$data);
	}

	function Create(){
		$TitlePage=$this->input->post('TitlePage');
		$KeyValue=$this->input->post('KeyValue');
		$Value=$this->input->post('Value');
		$isFile = $this->input->post('toggleInputCheckbox');

		$ISFILE=0;

		if (isset($isFile)) {
			$Value=$this->upload_document($_FILES['Value']['tmp_name'],$_FILES['Value']['name']);
			$ISFILE=1;
		}

		$data=array('KeyValue'=>$KeyValue,
			        'TitlePage'=>$TitlePage,
	                'Value'=>$Value,
	                'IsFile'=>$ISFILE
	               );
		$rsp=$this->Model->create('settings',$data);

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
		redirect(base_url('Settings'));
	}

	function Update(){
		$IdSetting=$this->input->post('IdSetting');
		$KeyValue=$this->input->post('KeyValue');
		$TitlePage=$this->input->post('TitlePage');
		$Value=$this->input->post('Value');
		$IsFile=$this->input->post('IsFile');

		if ($IsFile==1) {
		
			if (!empty($_FILES['Value']['name'])) {
			  $Value=$this->upload_document($_FILES['Value']['tmp_name'],$_FILES['Value']['name']);
			}else{
			  $Value=$this->input->post('HiddenImage');
			}

		}
		
		$data=array('KeyValue'=>$KeyValue,
	                'Value'=>$Value,
	                'TitlePage'=>$TitlePage,
	               );

		$rsp=$this->Model->update('settings',['IdSetting'=>$IdSetting],$data);

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
		redirect(base_url('Settings'));
	}


	function Delete(){
		$IdSetting=$this->input->post('IdSetting');
		$rsp=$this->Model->delete('settings',['IdSetting'=>$IdSetting]);

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
		redirect(base_url('Settings'));
	}


	public function upload_document($nom_file,$nom_champ)
	{
	      $ref_folder =FCPATH.'attachments/Other/';
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