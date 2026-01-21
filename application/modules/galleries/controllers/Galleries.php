<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Galleries extends MY_Controller {

    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['galleries'] = $this->Model->read('gallery', null, 'IdGallery');
        $this->load->view('galleries_views', $data);
    }

    /* ================== CREATE ================== */
    public function create()
    {
        $type        = $this->input->post('TypeMedia', true);
        $description = $this->input->post('Description', true);
        $media       = '';

        if (!in_array($type, ['image','video','link'])) {
            redirect('galleries');
        }

        /* ===== IMAGE & VIDEO ===== */
        if ($type == 'image' || $type == 'video') {

            $config = [
                'upload_path'   => './attachments/gallery/',
                'allowed_types' => ($type == 'image') ? 'jpg|jpeg|png|gif' : 'mp4|avi|mov|mkv',
                'max_size'      => 20480,
                'encrypt_name'  => true
            ];

            if(!is_dir($ref_folder)) //create the folder if it does not already exists   
	      {
	          mkdir($ref_folder,0777,TRUE);                                        
	      }

            $this->upload->initialize($config);

            if (!$this->upload->do_upload('Media')) {
                $this->session->set_flashdata('sms',
                    '<div class="alert alert-danger">'.$this->upload->display_errors().'</div>'
                );
                redirect('galleries');
            }

            $media = $this->upload->data('file_name');
        }

        /* ===== LINK ===== */
        if ($type == 'link') {
            $media = $this->input->post('Link', true);
        }

        $this->Model->create('gallery', [
            'TypeMedia'   => $type,
            'Media'       => $media,
            'Description' => $description
        ]);

        $this->session->set_flashdata('sms',
            '<div class="alert alert-success">Média ajouté avec succès.</div>'
        );

        redirect('galleries');
    }

    /* ================== UPDATE ================== */
    public function update()
    {
        $id           = $this->input->post('IdGallery');
        $type         = $this->input->post('TypeMedia', true);
        $description  = $this->input->post('Description', true);
        $hiddenMedia  = $this->input->post('HiddenMedia');

        $media = $hiddenMedia;

        if ( ($type == 'image' || $type == 'video') && !empty($_FILES['Media']['name']) ) {

            $config = [
                'upload_path'   => './attachments/gallery/',
                'allowed_types' => ($type == 'image') ? 'jpg|jpeg|png|gif' : 'mp4|avi|mov|mkv',
                'encrypt_name'  => true
            ];

            $this->upload->initialize($config);

            if ($this->upload->do_upload('Media')) {

                /* supprimer ancien fichier */
                if (!empty($hiddenMedia) && file_exists('./attachments/gallery/'.$hiddenMedia)) {
                    unlink('./attachments/gallery/'.$hiddenMedia);
                }

                $media = $this->upload->data('file_name');
            }
        }

        if ($type == 'link') {
            $media = $this->input->post('Link', true);
        }

        $this->Model->update(
            'gallery',
            ['IdGallery' => $id],
            [
                'TypeMedia'   => $type,
                'Media'       => $media,
                'Description' => $description
            ]
        );

        $this->session->set_flashdata('sms',
            '<div class="alert alert-success">Média modifié avec succès.</div>'
        );

        redirect('galleries');
    }

    /* ================== DELETE ================== */
    public function delete()
    {
        $id = $this->input->post('IdGallery');

        $gallery = $this->Model->readOne('gallery', ['IdGallery'=>$id]);

        if ($gallery && $gallery->TypeMedia != 'link') {
            if (file_exists('./attachments/gallery/'.$gallery->Media)) {
                unlink('./attachments/gallery/'.$gallery->Media);
            }
        }

        $this->Model->delete('gallery', ['IdGallery'=>$id]);

        $this->session->set_flashdata('sms',
            '<div class="alert alert-success">Média supprimé avec succès.</div>'
        );

        redirect('galleries');
    }
}