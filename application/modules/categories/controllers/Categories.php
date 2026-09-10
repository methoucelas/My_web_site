<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Categories Controller
 *
 * Gestion des catégories de projets (table categories)
 */
class Categories extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->not_logged_in();
        $this->load->model('Categories_model');
    }

    /**
     * Liste des catégories
     */
    public function index()
    {
        $data['categories'] = $this->Categories_model->get_all();
        $this->load->view('Categories_View', $data);
    }

    /**
     * Créer une catégorie
     */
    public function Create()
    {
        $name = trim($this->input->post('name'));

        if (empty($name)) {
            $this->_sms('Erreur', 'danger', 'Le nom de la catégorie est obligatoire.');
            redirect(base_url('Categories'));
            return;
        }

        if ($this->Categories_model->name_exists($name)) {
            $this->_sms('Erreur', 'danger', 'Cette catégorie existe déjà.');
            redirect(base_url('Categories'));
            return;
        }

        $slug = trim($this->input->post('slug'));
        if (empty($slug)) {
            $slug = url_title($name, 'dash', TRUE);
        }
        if (empty($slug)) {
            $slug = 'categorie';
        }

        if ($this->Categories_model->slug_exists($slug)) {
            $this->_sms('Erreur', 'danger', 'Ce slug est déjà utilisé.');
            redirect(base_url('Categories'));
            return;
        }

        $status = $this->input->post('status');
        if (!in_array($status, array('active', 'inactive'))) {
            $status = 'active';
        }

        $data = array(
            'name'        => $name,
            'slug'        => $slug,
            'description' => trim($this->input->post('description')),
            'status'      => $status
        );

        $id = $this->Categories_model->insert($data);

        if ($id) {
            $this->_sms('Succès', 'success', 'Catégorie créée avec succès.');
        } else {
            $this->_sms('Erreur', 'danger', 'Une erreur inconnue est survenue.');
        }

        redirect(base_url('Categories'));
    }

    /**
     * Modifier une catégorie
     */
    public function Update()
    {
        $id   = (int) $this->input->post('id');
        $name = trim($this->input->post('name'));

        if (empty($id) || empty($name)) {
            $this->_sms('Erreur', 'danger', 'Catégorie invalide.');
            redirect(base_url('Categories'));
            return;
        }

        $old = $this->Categories_model->get_by_id($id);

        if (empty($old)) {
            $this->_sms('Erreur', 'danger', 'Catégorie introuvable.');
            redirect(base_url('Categories'));
            return;
        }

        if ($this->Categories_model->name_exists($name, $id)) {
            $this->_sms('Erreur', 'danger', 'Cette catégorie existe déjà.');
            redirect(base_url('Categories'));
            return;
        }

        $slug = trim($this->input->post('slug'));
        if (empty($slug)) {
            $slug = url_title($name, 'dash', TRUE);
        }
        if (empty($slug)) {
            $slug = 'categorie';
        }

        if ($this->Categories_model->slug_exists($slug, $id)) {
            $this->_sms('Erreur', 'danger', 'Ce slug est déjà utilisé.');
            redirect(base_url('Categories'));
            return;
        }

        $status = $this->input->post('status');
        if (!in_array($status, array('active', 'inactive'))) {
            $status = 'active';
        }

        $data = array(
            'name'        => $name,
            'slug'        => $slug,
            'description' => trim($this->input->post('description')),
            'status'      => $status
        );

        $rsp = $this->Categories_model->update($id, $data);

        if ($rsp) {
            $this->_sms('Succès', 'success', 'Catégorie modifiée avec succès.');
        } else {
            $this->_sms('Erreur', 'danger', 'Une erreur inconnue est survenue.');
        }

        redirect(base_url('Categories'));
    }

    /**
     * Supprimer une catégorie
     */
    public function Delete()
    {
        $id = (int) $this->input->post('id');

        if (empty($id)) {
            $this->_sms('Erreur', 'danger', 'Catégorie invalide.');
            redirect(base_url('Categories'));
            return;
        }

        $rsp = $this->Categories_model->delete($id);

        if ($rsp) {
            $this->_sms('Succès', 'success', 'Catégorie supprimée avec succès.');
        } else {
            $this->_sms('Erreur', 'danger', 'Une erreur inconnue est survenue.');
        }

        redirect(base_url('Categories'));
    }

    /**
     * Message flash
     */
    private function _sms($title, $type, $message)
    {
        $this->session->set_flashdata('sms', '
            <div class="alert alert-' . $type . ' fade show mt-1 message" role="alert">
                <strong>' . $title . ' !</strong> ' . $message . '
            </div>
        ');
    }
}