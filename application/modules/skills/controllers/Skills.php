<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Skills Controller
 *
 * Gestion des compétences (table competances)
 */
class Skills extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->not_logged_in();
        $this->load->model('Skills_model');
    }

    /**
     * Liste des compétences
     */
    public function index()
    {
        $data['skills'] = $this->Skills_model->get_all();
        $this->load->view('Skills_View', $data);
    }

    /**
     * Créer une compétence
     */
    public function Create()
    {
        $name = trim($this->input->post('name'));

        if (empty($name)) {
            $this->_sms('Erreur', 'danger', 'Le nom de la compétence est obligatoire.');
            redirect(base_url('Skills'));
            return;
        }

        $percentage = (int) $this->input->post('percentage');
        if ($percentage < 0 || $percentage > 100) {
            $percentage = 0;
        }

        $status = $this->input->post('status');
        if (!in_array($status, array('active', 'inactive'))) {
            $status = 'active';
        }

        $data = array(
            'name'        => $name,
            'category'    => trim($this->input->post('category')),
            'level'       => trim($this->input->post('level')),
            'percentage'  => $percentage,
            'icon'        => trim($this->input->post('icon')),
            'description' => trim($this->input->post('description')),
            'status'      => $status
        );

        $id = $this->Skills_model->insert($data);

        if ($id) {
            $this->_sms('Succès', 'success', 'Compétence créée avec succès.');
        } else {
            $this->_sms('Erreur', 'danger', 'Une erreur inconnue est survenue.');
        }

        redirect(base_url('Skills'));
    }

    /**
     * Modifier une compétence
     */
    public function Update()
    {
        $id   = (int) $this->input->post('id');
        $name = trim($this->input->post('name'));

        if (empty($id) || empty($name)) {
            $this->_sms('Erreur', 'danger', 'Compétence invalide.');
            redirect(base_url('Skills'));
            return;
        }

        $old = $this->Skills_model->get_by_id($id);

        if (empty($old)) {
            $this->_sms('Erreur', 'danger', 'Compétence introuvable.');
            redirect(base_url('Skills'));
            return;
        }

        $percentage = (int) $this->input->post('percentage');
        if ($percentage < 0 || $percentage > 100) {
            $percentage = 0;
        }

        $status = $this->input->post('status');
        if (!in_array($status, array('active', 'inactive'))) {
            $status = 'active';
        }

        $data = array(
            'name'        => $name,
            'category'    => trim($this->input->post('category')),
            'level'       => trim($this->input->post('level')),
            'percentage'  => $percentage,
            'icon'        => trim($this->input->post('icon')),
            'description' => trim($this->input->post('description')),
            'status'      => $status
        );

        $rsp = $this->Skills_model->update($id, $data);

        if ($rsp) {
            $this->_sms('Succès', 'success', 'Compétence modifiée avec succès.');
        } else {
            $this->_sms('Erreur', 'danger', 'Une erreur inconnue est survenue.');
        }

        redirect(base_url('Skills'));
    }

    /**
     * Supprimer une compétence
     */
    public function Delete()
    {
        $id = (int) $this->input->post('id');

        if (empty($id)) {
            $this->_sms('Erreur', 'danger', 'Compétence invalide.');
            redirect(base_url('Skills'));
            return;
        }

        $rsp = $this->Skills_model->delete($id);

        if ($rsp) {
            $this->_sms('Succès', 'success', 'Compétence supprimée avec succès.');
        } else {
            $this->_sms('Erreur', 'danger', 'Une erreur inconnue est survenue.');
        }

        redirect(base_url('Skills'));
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