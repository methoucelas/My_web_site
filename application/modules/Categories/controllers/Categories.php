<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author    Dushime Paul
 * Email:     dushimeyesupaulin@gmail.com
 */

class Categories extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    // Afficher la liste des catégories
    public function index()
    {
        $data['categories'] = $this->Model->read('categories', null, 'id_categorie');
        $this->load->view('Categories_View', $data);
    }

    // Créer une nouvelle catégorie
    public function create()
    {
        $nom_categories = $this->input->post('nom_categories');
        $image = null;

        if (!empty($_FILES['Image']['name'])) {
            $image = $this->upload_document($_FILES['Image']['tmp_name'], $_FILES['Image']['name']);
        }

        $data = array(
            'nom_categories' => $nom_categories,
            'Image'          => $image
        );

        $rsp = $this->Model->create('categories', $data);

        $sms = [];
        if ($rsp) {
            $sms['sms'] = '<div class="alert alert-success fade show mt-1 message" role="alert">
                             Catégorie créée avec succès.
                         </div>';
        } else {
            $sms['sms'] = '<div class="alert alert-danger fade show mt-1 message" role="alert">
                             <strong>Oups!</strong> Une erreur inconnue, contactez l\'administrateur.
                         </div>';
        }

        $this->session->set_flashdata($sms);
        redirect(base_url('Categories'));
    }

    // Mettre à jour une catégorie
    public function update()
    {
        $id_categorie   = $this->input->post('id_categorie');
        $nom_categories = $this->input->post('nom_categories');

        if (!empty($_FILES['Image']['name'])) {
            $image = $this->upload_document($_FILES['Image']['tmp_name'], $_FILES['Image']['name']);
        } else {
            $image = $this->input->post('HiddenImage');
        }

        $data = array(
            'nom_categories' => $nom_categories,
            'Image'          => $image
        );

        $rsp = $this->Model->update('categories', ['id_categorie' => $id_categorie], $data);

        $sms = [];
        if ($rsp) {
            $sms['sms'] = '<div class="alert alert-success fade show mt-1 message" role="alert">
                             Catégorie modifiée avec succès.
                         </div>';
        } else {
            $sms['sms'] = '<div class="alert alert-danger fade show mt-1 message" role="alert">
                             <strong>Oups!</strong> Une erreur inconnue, contactez l\'administrateur.
                         </div>';
        }

        $this->session->set_flashdata($sms);
        redirect(base_url('Categories'));
    }

    // Supprimer une catégorie
    public function delete()
    {
        $id_categorie = $this->input->post('id_categorie');
        $rsp = $this->Model->delete('categories', ['id_categorie' => $id_categorie]);

        $sms = [];
        if ($rsp) {
            $sms['sms'] = '<div class="alert alert-success fade show mt-1 message" role="alert">
                             Catégorie supprimée avec succès.
                         </div>';
        } else {
            $sms['sms'] = '<div class="alert alert-danger fade show mt-1 message" role="alert">
                             <strong>Oups!</strong> Une erreur inconnue, contactez l\'administrateur.
                         </div>';
        }

        $this->session->set_flashdata($sms);
        redirect(base_url('Categories'));
    }

    // Upload des images
    public function upload_document($nom_file, $nom_champ)
    {
        $ref_folder = FCPATH . 'attachments/Categorie/';
        $code = date("YmdHis") . uniqid();
        $file_extension = strtolower(pathinfo($nom_champ, PATHINFO_EXTENSION));
        $valid_ext = ['gif','jpg','png','jpeg'];

        if (!in_array($file_extension, $valid_ext)) {
            return null; // Optionnel : gérer le cas d'extension invalide
        }

        if (!is_dir($ref_folder)) {
            mkdir($ref_folder, 0777, TRUE);
        }

        $fichier = $code . "." . $file_extension;
        move_uploaded_file($nom_file, $ref_folder . $fichier);

        return $fichier;
    }
}