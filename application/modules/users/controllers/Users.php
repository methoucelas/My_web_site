<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
    * @author:   Jean de Dieu Ntirampeba
    * Email:     jeandedieuntirampeba@gmail.com
    * Gitgub:    https://github.com/porochen
 */
class Users extends MY_Controller {

		function __construct()
    {
        parent::__construct();
        $this->not_logged_in();
    }

    

	public function index($idUser='')
	{
		$critere='';
		if (!empty($idUser)) {
			$critere=' AND idUser='.$idUser;
		}
		$data['users']=$this->Model->readQuery('SELECT u.*,g.group_name FROM users u JOIN groups g ON g.idGroup=u.idGroup WHERE 1 '.$critere);
		$data['groupes']=$this->Model->readQuery('SELECT * FROM groups WHERE 1');
		$this->load->view('Users_View',$data);
	}

	function Create(){

		$FistName=$this->input->post('FistName');
		$LastName=$this->input->post('LastName');
		$Username=$this->input->post('Username');
		$Phone=$this->input->post('Phone');
		$idGroup=$this->input->post('idGroup');
		$email=$this->input->post('email');

		$data=array('firstName'=>$FistName,
					'lastName'=>$LastName,
					'idGroup'=>$idGroup,
					'username'=>$Username,
					'telephone'=>$Phone,
					'email'=>$email,
	               );
		$idUser=$this->Model->createLastId('users',$data);

		$session=array('idUser'=>$idUser,
                       'idGroup'=>$idGroup,
                       'username'=>$Username,
                       'password'=>$this->password_hash('Admin@2025'),
                      );

        $rsp=$this->Model->create('user_group',$session);

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
		redirect(base_url('Users'));
	}

	function Update(){
		
		$FistName=$this->input->post('FistName');
		$LastName=$this->input->post('LastName');
		$Username=$this->input->post('Username');
		$Phone=$this->input->post('Phone');
		$idGroup=$this->input->post('idGroup');
		$email=$this->input->post('email');

		$idUser=$this->input->post('idUser');

		$data=array('firstName'=>$FistName,
								'lastName'=>$LastName,
								'idGroup'=>$idGroup,
								'username'=>$Username,
								'telephone'=>$Phone,
								'email'=>$email,
	               );

		$session=array('idGroup'=>$idGroup,
                   'username'=>$Username
                      );

		$this->Model->update('users',['idUser'=>$idUser],$data);

		$rsp=$this->Model->update('user_group',['idUser'=>$idUser],$session);

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
		redirect(base_url('Users'));
	}


	function Delete(){
		$idUser=$this->input->post('idUser');
		$rsp=$this->Model->delete('users',['idUser'=>$idUser]);

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
		redirect(base_url('Users'));
	}


	public function password_hash($pass = ''){
      if($pass) {
        $password = password_hash($pass, PASSWORD_DEFAULT);
        return $password;
      }
    }

	//upload images
	public function upload_document($nom_file,$nom_champ)
	{
	      $ref_folder =FCPATH.'attachments/Users/';
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

	  public function checkUser(){
      $username=$this->input->post('username');
      $user=$this->Model->readOne('users',['username'=>$username]);
      if (!empty($user)) {
        echo "denied";
      }else{
        echo "success";
      }
    }

    public function initialPWD(){

      $idUser=$this->input->post('idUser');
     
      $data=array('password'=>$this->password_hash('Admin@2025'),
                );

      $rsp=$this->Model->update('user_group',['idUser'=>$idUser],$data);
     
     if ($rsp) {
            $sms['sms']='<div class="alert alert-background fade show mt-1 message" role="alert">
                            Content updated successfully.
                         </div>';
        }else{
            $sms['sms']='<div class="alert alert-background fade show mt-1 message" role="alert">
                             An unknown error, contact admin!.
                         </div>';
        }

        $this->session->set_flashdata($sms);
        redirect(base_url('Users'));

    }

}