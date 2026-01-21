<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Join_us extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    // LISTE
    public function index()
    {
        $data['joinus'] = $this->Model->read('join_us', null, 'id');
        $this->load->view('Join_us_View', $data);
    }

    // CREATE
    public function create()
    {
        $titre = $this->input->post('titre');
        $description = $this->input->post('description');

        $data = array(
            'titre'       => $titre,
            'description' => $description
        );

        $rsp = $this->Model->create('join_us', $data);

        $sms = [];
        if ($rsp) {
            $sms['sms'] = '<div class="alert alert-success fade show mt-1 message">Section Join Us créée avec succès.</div>';
        } else {
            $sms['sms'] = '<div class="alert alert-danger fade show mt-1 message">Erreur inconnue, contactez l\'administrateur.</div>';
        }

        $this->session->set_flashdata($sms);
        redirect(base_url('Join_us'));
    }

    // UPDATE
    public function update()
    {
        $id          = $this->input->post('id');
        $titre       = $this->input->post('titre');
        $description = $this->input->post('description');

        $data = array(
            'titre'       => $titre,
            'description' => $description
        );

        $rsp = $this->Model->update('join_us', ['id' => $id], $data);

        $sms = [];
        if ($rsp) {
            $sms['sms'] = '<div class="alert alert-success fade show mt-1 message">Section Join Us modifiée avec succès.</div>';
        } else {
            $sms['sms'] = '<div class="alert alert-danger fade show mt-1 message">Erreur inconnue, contactez l\'administrateur.</div>';
        }

        $this->session->set_flashdata($sms);
        redirect(base_url('Join_us'));
    }

    // DELETE
    public function delete()
    {
        $id = $this->input->post('id');
        $rsp = $this->Model->delete('join_us', ['id' => $id]);

        $sms = [];
        if ($rsp) {
            $sms['sms'] = '<div class="alert alert-success fade show mt-1 message">Section Join Us supprimée avec succès.</div>';
        } else {
            $sms['sms'] = '<div class="alert alert-danger fade show mt-1 message">Erreur inconnue, contactez l\'administrateur.</div>';
        }

        $this->session->set_flashdata($sms);
        redirect(base_url('Join_us'));
    }
}