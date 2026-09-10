<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Project_technologies Controller
 *
 * Gestion des associations projet / technologie (table project_technologies)
 *
 * URL: /ProjectTechnologies
 */
class Project_technologies extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->not_logged_in();
        $this->load->model('Project_technologies_model');
    }

    /**
     * Liste des associations
     */
    public function index()
    {
        $data['items']          = $this->Project_technologies_model->get_all();
        $data['projects']       = $this->Project_technologies_model->get_projects();
        $data['technologies']   = $this->Project_technologies_model->get_technologies();
        $this->load->view('Project_technologies_View', $data);
    }

    /**
     * Créer une association
     */
    public function Create()
    {
        $project_id     = (int) $this->input->post('project_id');
        $technology_id  = (int) $this->input->post('technology_id');

        if (empty($project_id) || empty($technology_id)) {
            $this->_sms('Erreur', 'danger', 'Le projet et la technologie sont obligatoires.');
            redirect(base_url('ProjectTechnologies'));
            return;
        }

        if ($this->Project_technologies_model->pair_exists($project_id, $technology_id)) {
            $this->_sms('Erreur', 'danger', 'Cette association existe déjà.');
            redirect(base_url('ProjectTechnologies'));
            return;
        }

        $data = array(
            'project_id'    => $project_id,
            'technology_id' => $technology_id
        );

        $id = $this->Project_technologies_model->insert($data);

        if ($id) {
            $this->_sms('Succès', 'success', 'Association créée avec succès.');
        } else {
            $this->_sms('Erreur', 'danger', 'Une erreur inconnue est survenue.');
        }

        redirect(base_url('ProjectTechnologies'));
    }

    /**
     * Modifier une association
     */
    public function Update()
    {
        $id             = (int) $this->input->post('id');
        $project_id     = (int) $this->input->post('project_id');
        $technology_id  = (int) $this->input->post('technology_id');

        if (empty($id) || empty($project_id) || empty($technology_id)) {
            $this->_sms('Erreur', 'danger', 'Association invalide.');
            redirect(base_url('ProjectTechnologies'));
            return;
        }

        $old = $this->Project_technologies_model->get_by_id($id);

        if (empty($old)) {
            $this->_sms('Erreur', 'danger', 'Association introuvable.');
            redirect(base_url('ProjectTechnologies'));
            return;
        }

        if ($this->Project_technologies_model->pair_exists($project_id, $technology_id, $id)) {
            $this->_sms('Erreur', 'danger', 'Cette association existe déjà.');
            redirect(base_url('ProjectTechnologies'));
            return;
        }

        $data = array(
            'project_id'    => $project_id,
            'technology_id' => $technology_id
        );

        $rsp = $this->Project_technologies_model->update($id, $data);

        if ($rsp) {
            $this->_sms('Succès', 'success', 'Association modifiée avec succès.');
        } else {
            $this->_sms('Erreur', 'danger', 'Une erreur inconnue est survenue.');
        }

        redirect(base_url('ProjectTechnologies'));
    }

    /**
     * Supprimer une association
     */
    public function Delete()
    {
        $id = (int) $this->input->post('id');

        if (empty($id)) {
            $this->_sms('Erreur', 'danger', 'Association invalide.');
            redirect(base_url('ProjectTechnologies'));
            return;
        }

        $rsp = $this->Project_technologies_model->delete($id);

        if ($rsp) {
            $this->_sms('Succès', 'success', 'Association supprimée avec succès.');
        } else {
            $this->_sms('Erreur', 'danger', 'Une erreur inconnue est survenue.');
        }

        redirect(base_url('ProjectTechnologies'));
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