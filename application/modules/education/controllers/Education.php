<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Education Controller
 *
 * Gestion de la formation (table education)
 */
class Education extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->not_logged_in();
        $this->load->model('Education_model');
    }

    /**
     * Liste des formations
     */
    public function index()
    {
        $data['education'] = $this->Education_model->get_all();
        $this->load->view('Education_View', $data);
    }

    /**
     * Créer une formation
     */
    public function Create()
    {
        $institution = trim($this->input->post('institution'));

        if (empty($institution)) {
            $this->_sms('Erreur', 'danger', 'L\'établissement est obligatoire.');
            redirect(base_url('Education'));
            return;
        }

        $data = array(
            'institution' => $institution,
            'degree'      => trim($this->input->post('degree')),
            'field'       => trim($this->input->post('field')),
            'description' => trim($this->input->post('description')),
            'start_date'  => !empty($this->input->post('start_date')) ? $this->input->post('start_date') : null,
            'end_date'    => !empty($this->input->post('end_date')) ? $this->input->post('end_date') : null,
            'current'     => ($this->input->post('current')) ? 1 : 0,
            'location'    => trim($this->input->post('location'))
        );

        $id = $this->Education_model->insert($data);

        if ($id) {
            $this->_sms('Succès', 'success', 'Formation créée avec succès.');
        } else {
            $this->_sms('Erreur', 'danger', 'Une erreur inconnue est survenue.');
        }

        redirect(base_url('Education'));
    }

    /**
     * Modifier une formation
     */
    public function Update()
    {
        $id          = (int) $this->input->post('id');
        $institution = trim($this->input->post('institution'));

        if (empty($id) || empty($institution)) {
            $this->_sms('Erreur', 'danger', 'Formation invalide.');
            redirect(base_url('Education'));
            return;
        }

        $old = $this->Education_model->get_by_id($id);

        if (empty($old)) {
            $this->_sms('Erreur', 'danger', 'Formation introuvable.');
            redirect(base_url('Education'));
            return;
        }

        $data = array(
            'institution' => $institution,
            'degree'      => trim($this->input->post('degree')),
            'field'       => trim($this->input->post('field')),
            'description' => trim($this->input->post('description')),
            'start_date'  => !empty($this->input->post('start_date')) ? $this->input->post('start_date') : null,
            'end_date'    => !empty($this->input->post('end_date')) ? $this->input->post('end_date') : null,
            'current'     => ($this->input->post('current')) ? 1 : 0,
            'location'    => trim($this->input->post('location'))
        );

        $rsp = $this->Education_model->update($id, $data);

        if ($rsp) {
            $this->_sms('Succès', 'success', 'Formation modifiée avec succès.');
        } else {
            $this->_sms('Erreur', 'danger', 'Une erreur inconnue est survenue.');
        }

        redirect(base_url('Education'));
    }

    /**
     * Supprimer une formation
     */
    public function Delete()
    {
        $id = (int) $this->input->post('id');

        if (empty($id)) {
            $this->_sms('Erreur', 'danger', 'Formation invalide.');
            redirect(base_url('Education'));
            return;
        }

        $rsp = $this->Education_model->delete($id);

        if ($rsp) {
            $this->_sms('Succès', 'success', 'Formation supprimée avec succès.');
        } else {
            $this->_sms('Erreur', 'danger', 'Une erreur inconnue est survenue.');
        }

        redirect(base_url('Education'));
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