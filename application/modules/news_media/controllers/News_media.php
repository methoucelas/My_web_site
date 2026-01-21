

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News_media extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model'); // Assure-toi que ton Model est chargé
    }

    // Affichage de tous les news_media
    public function index()
    {
        $data['news_media'] = $this->Model->read('news_media', null, 'id_news_media');
        $this->load->view('news_mediaView', $data);
    }

    // Création
    public function Create()
    {
        $title = $this->input->post('title');
        $details = $this->input->post('details');

        // Upload image si présent
        if (!empty($_FILES['image']['name'])) {
            $image = $this->upload_document($_FILES['image']['tmp_name'], $_FILES['image']['name']);
        } else {
            $image = null;
        }

        $data = array(
            'title' => $title,
            'image' => $image,
            'details' => $details
        );

        $rsp = $this->Model->create('news_media', $data);

        if ($rsp) {
            $this->session->set_flashdata('sms', '<div class="alert alert-success mt-1">Content created successfully.</div>');
        } else {
            $this->session->set_flashdata('sms', '<div class="alert alert-danger mt-1">An unknown error, contact admin!</div>');
        }

        redirect(base_url('news_media'));
    }

    // Mise à jour
    public function Update()
    {
        $id_news_media = $this->input->post('id_news_media');
        $title = $this->input->post('title');
        $details = $this->input->post('details');

        $data = array(
            'title' => $title,
            'details' => $details
        );

        // Upload image si modifiée
        if (!empty($_FILES['image']['name'])) {
            $data['image'] = $this->upload_document($_FILES['image']['tmp_name'], $_FILES['image']['name']);
        }

        $rsp = $this->Model->update('news_media', ['id_news_media' => $id_news_media], $data);

        if ($rsp) {
            $this->session->set_flashdata('sms', '<div class="alert alert-success mt-1">Content updated successfully.</div>');
        } else {
            $this->session->set_flashdata('sms', '<div class="alert alert-danger mt-1">An unknown error, contact admin!</div>');
        }

        redirect(base_url('news_media'));
    }

    // Suppression
    public function Delete()
    {
        $id_news_media = $this->input->post('id_news_media');
        $rsp = $this->Model->delete('news_media', ['id_news_media' => $id_news_media]);

        if ($rsp) {
            $this->session->set_flashdata('sms', '<div class="alert alert-success mt-1">Content deleted successfully.</div>');
        } else {
            $this->session->set_flashdata('sms', '<div class="alert alert-danger mt-1">An unknown error, contact admin!</div>');
        }

        redirect(base_url('news_media'));
    }

    // Upload image
    private function upload_document($tmp_name, $file_name)
    {
        $ref_folder = FCPATH.'attachments/news_media/';
        if(!is_dir($ref_folder)) {
            mkdir($ref_folder,0777,TRUE);                                        
        }

        $code = date("YmdHis").uniqid();
        $ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $ext = strtolower($ext);
        $valid_ext = array('gif','jpg','png','jpeg');

        if(!in_array($ext, $valid_ext)) return null;

        $image_name = $code.'.'.$ext;
        move_uploaded_file($tmp_name, $ref_folder.$image_name);

        return $image_name;
    }
}


