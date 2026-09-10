<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Experiences Controller
 *
 * Gestion des expériences professionnelles (table experiences)
 */
class Experiences extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->not_logged_in();
        $this->load->model('Experiences_model');
    }

    /**
     * Liste des expériences
     */
    public function index()
    {
        $data['experiences'] = $this->Experiences_model->get_all();
        $this->load->view('Experiences_View', $data);
    }

    /**
     * Créer une expérience
     */
    public function Create()
    {
        $title = trim($this->input->post('title'));

        if (empty($title)) {
            $this->_sms('Erreur', 'danger', 'Le titre de l\'expérience est obligatoire.');
            redirect(base_url('Experiences'));
            return;
        }

        $type = $this->input->post('type');
        if (!in_array($type, array('Work', 'Internship', 'Freelance', 'Volunteer', 'Project', 'Other'))) {
            $type = 'Project';
        }

        $data = array(
            'title'        => $title,
            'organization' => trim($this->input->post('organization')),
            'location'     => trim($this->input->post('location')),
            'description'  => trim($this->input->post('description')),
            'start_date'   => !empty($this->input->post('start_date')) ? $this->input->post('start_date') : null,
            'end_date'     => !empty($this->input->post('end_date')) ? $this->input->post('end_date') : null,
            'current'      => ($this->input->post('current')) ? 1 : 0,
            'type'         => $type
        );

        $id = $this->Experiences_model->insert($data);

        if ($id) {
            $this->_sms('Succès', 'success', 'Expérience créée avec succès.');
        } else {
            $this->_sms('Erreur', 'danger', 'Une erreur inconnue est survenue.');
        }

        redirect(base_url('Experiences'));
    }

    /**
     * Modifier une expérience
     */
    public function Update()
    {
        $id    = (int) $this->input->post('id');
        $title = trim($this->input->post('title'));

        if (empty($id) || empty($title)) {
            $this->_sms('Erreur', 'danger', 'Expérience invalide.');
            redirect(base_url('Experiences'));
            return;
        }

        $old = $this->Experiences_model->get_by_id($id);

        if (empty($old)) {
            $this->_sms('Erreur', 'danger', 'Expérience introuvable.');
            redirect(base_url('Experiences'));
            return;
        }

        $type = $this->input->post('type');
        if (!in_array($type, array('Work', 'Internship', 'Freelance', 'Volunteer', 'Project', 'Other'))) {
            $type = 'Project';
        }

        $data = array(
            'title'        => $title,
            'organization' => trim($this->input->post('organization')),
            'location'     => trim($this->input->post('location')),
            'description'  => trim($this->input->post('description')),
            'start_date'   => !empty($this->input->post('start_date')) ? $this->input->post('start_date') : null,
            'end_date'     => !empty($this->input->post('end_date')) ? $this->input->post('end_date') : null,
            'current'      => ($this->input->post('current')) ? 1 : 0,
            'type'         => $type
        );

        $rsp = $this->Experiences_model->update($id, $data);

        if ($rsp) {
            $this->_sms('Succès', 'success', 'Expérience modifiée avec succès.');
        } else {
            $this->_sms('Erreur', 'danger', 'Une erreur inconnue est survenue.');
        }

        redirect(base_url('Experiences'));
    }

    /**
     * Supprimer une expérience
     */
    public function Delete()
    {
        $id = (int) $this->input->post('id');

        if (empty($id)) {
            $this->_sms('Erreur', 'danger', 'Expérience invalide.');
            redirect(base_url('Experiences'));
            return;
        }

        $rsp = $this->Experiences_model->delete($id);

        if ($rsp) {
            $this->_sms('Succès', 'success', 'Expérience supprimée avec succès.');
        } else {
            $this->_sms('Erreur', 'danger', 'Une erreur inconnue est survenue.');
        }

        redirect(base_url('Experiences'));
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