<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Technologies Controller
 *
 * Gestion des technologies (table technologies)
 */
class Technologies extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->not_logged_in();
        $this->load->model('Technologies_model');
    }

    /**
     * Liste des technologies
     */
    public function index()
    {
        $data['technologies'] = $this->Technologies_model->get_all();
        $this->load->view('Technologies_View', $data);
    }

    /**
     * Créer une technologie
     */
    public function Create()
    {
        $name = trim($this->input->post('name'));

        if (empty($name)) {
            $this->_sms('Erreur', 'danger', 'Le nom de la technologie est obligatoire.');
            redirect(base_url('Technologies'));
            return;
        }

        if ($this->Technologies_model->name_exists($name)) {
            $this->_sms('Erreur', 'danger', 'Cette technologie existe déjà.');
            redirect(base_url('Technologies'));
            return;
        }

        $data = array(
            'name'        => $name,
            'icon'        => trim($this->input->post('icon')),
            'description' => trim($this->input->post('description'))
        );

        $id = $this->Technologies_model->insert($data);

        if ($id) {
            $this->_sms('Succès', 'success', 'Technologie créée avec succès.');
        } else {
            $this->_sms('Erreur', 'danger', 'Une erreur inconnue est survenue.');
        }

        redirect(base_url('Technologies'));
    }

    /**
     * Modifier une technologie
     */
    public function Update()
    {
        $id   = (int) $this->input->post('id');
        $name = trim($this->input->post('name'));

        if (empty($id) || empty($name)) {
            $this->_sms('Erreur', 'danger', 'Technologie invalide.');
            redirect(base_url('Technologies'));
            return;
        }

        $old = $this->Technologies_model->get_by_id($id);

        if (empty($old)) {
            $this->_sms('Erreur', 'danger', 'Technologie introuvable.');
            redirect(base_url('Technologies'));
            return;
        }

        if ($this->Technologies_model->name_exists($name, $id)) {
            $this->_sms('Erreur', 'danger', 'Cette technologie existe déjà.');
            redirect(base_url('Technologies'));
            return;
        }

        $data = array(
            'name'        => $name,
            'icon'        => trim($this->input->post('icon')),
            'description' => trim($this->input->post('description'))
        );

        $rsp = $this->Technologies_model->update($id, $data);

        if ($rsp) {
            $this->_sms('Succès', 'success', 'Technologie modifiée avec succès.');
        } else {
            $this->_sms('Erreur', 'danger', 'Une erreur inconnue est survenue.');
        }

        redirect(base_url('Technologies'));
    }

    /**
     * Supprimer une technologie
     */
    public function Delete()
    {
        $id = (int) $this->input->post('id');

        if (empty($id)) {
            $this->_sms('Erreur', 'danger', 'Technologie invalide.');
            redirect(base_url('Technologies'));
            return;
        }

        $rsp = $this->Technologies_model->delete($id);

        if ($rsp) {
            $this->_sms('Succès', 'success', 'Technologie supprimée avec succès.');
        } else {
            $this->_sms('Erreur', 'danger', 'Une erreur inconnue est survenue.');
        }

        redirect(base_url('Technologies'));
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