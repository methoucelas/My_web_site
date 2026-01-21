<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_us extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function Create()
    {
        

        $Image=$this->upload_document($_FILES['photo']['tmp_name'],$_FILES['photo']['name']);
        $data = [
            'Testifier' => $this->input->post('name', TRUE),
            'email'     => $this->input->post('email', TRUE),
            'rating'    => $this->input->post('rating', TRUE),
            'Image'     => $Image,
            'Poste'     => $this->input->post('role', TRUE),
            'Details'   => $this->input->post('message', TRUE),
            'status'    => 'pending'
        ];

        // Insérer en base
        if (!$this->Model->create('testimonies', $data)) {
            show_error($this->db->error()['message']); // Affiche une erreur si insertion échoue
        }

        $this->session->set_flashdata('success', 'Merci pour votre témoignage. Il sera publié après validation.');
        redirect(base_url('Pages/About_us/contact'));
    }



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