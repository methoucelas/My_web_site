<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Profile Controller
 *
 * Gestion du profil personnel (table profile)
 */
class Profile extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->not_logged_in();
        $this->load->model('Profile_model');
    }

    /**
     * Liste des profils
     */
    public function index()
    {
        $data['profiles'] = $this->Profile_model->get_all();
        $this->load->view('Profile_View', $data);
    }

    /**
     * Créer un profil
     */
    public function Create()
    {
        $full_name = trim($this->input->post('full_name'));

        if (empty($full_name)) {
            $this->_sms('Erreur', 'danger', 'Le nom complet est obligatoire.');
            redirect(base_url('Profile'));
            return;
        }

        $data = array(
            'full_name'          => $full_name,
            'professional_title' => trim($this->input->post('professional_title')),
            'short_bio'          => trim($this->input->post('short_bio')),
            'about'              => $this->input->post('about'),
            'email'              => trim($this->input->post('email')),
            'phone'              => trim($this->input->post('phone')),
            'location'           => trim($this->input->post('location')),
            'github_url'         => trim($this->input->post('github_url')),
            'linkedin_url'       => trim($this->input->post('linkedin_url')),
            'facebook_url'       => trim($this->input->post('facebook_url')),
            'youtube_url'        => trim($this->input->post('youtube_url'))
        );

        // Image de profil
        $image = $this->_do_upload('profile_image', 'Profile');
        if ($image === false) {
            redirect(base_url('Profile'));
            return;
        }
        if (!empty($image)) {
            $data['profile_image'] = $image;
        }

        // CV (fichier)
        $cv = $this->_do_upload('cv_file', 'CV', 'pdf|doc|docx');
        if ($cv === false) {
            redirect(base_url('Profile'));
            return;
        }
        if (!empty($cv)) {
            $data['cv_file'] = $cv;
        }

        $id = $this->Profile_model->insert($data);

        if ($id) {
            $this->_sms('Succès', 'success', 'Profil créé avec succès.');
        } else {
            $this->_sms('Erreur', 'danger', 'Une erreur inconnue est survenue.');
        }

        redirect(base_url('Profile'));
    }

    /**
     * Modifier un profil
     */
    public function Update()
    {
        $id        = (int) $this->input->post('id');
        $full_name = trim($this->input->post('full_name'));

        if (empty($id) || empty($full_name)) {
            $this->_sms('Erreur', 'danger', 'Profil invalide.');
            redirect(base_url('Profile'));
            return;
        }

        $old = $this->Profile_model->get_by_id($id);

        if (empty($old)) {
            $this->_sms('Erreur', 'danger', 'Profil introuvable.');
            redirect(base_url('Profile'));
            return;
        }

        $data = array(
            'full_name'          => $full_name,
            'professional_title' => trim($this->input->post('professional_title')),
            'short_bio'          => trim($this->input->post('short_bio')),
            'about'              => $this->input->post('about'),
            'email'              => trim($this->input->post('email')),
            'phone'              => trim($this->input->post('phone')),
            'location'           => trim($this->input->post('location')),
            'github_url'         => trim($this->input->post('github_url')),
            'linkedin_url'       => trim($this->input->post('linkedin_url')),
            'facebook_url'       => trim($this->input->post('facebook_url')),
            'youtube_url'        => trim($this->input->post('youtube_url'))
        );

        // Image de profil
        $image = $this->_do_upload('profile_image', 'Profile');
        if ($image === false) {
            redirect(base_url('Profile'));
            return;
        }
        if (!empty($image)) {
            $data['profile_image'] = $image;
            $this->_delete_file($old['profile_image']);
        }

        // CV (fichier)
        $cv = $this->_do_upload('cv_file', 'CV', 'pdf|doc|docx');
        if ($cv === false) {
            redirect(base_url('Profile'));
            return;
        }
        if (!empty($cv)) {
            $data['cv_file'] = $cv;
            $this->_delete_file($old['cv_file']);
        }

        $rsp = $this->Profile_model->update($id, $data);

        if ($rsp) {
            $this->_sms('Succès', 'success', 'Profil modifié avec succès.');
        } else {
            $this->_sms('Erreur', 'danger', 'Une erreur inconnue est survenue.');
        }

        redirect(base_url('Profile'));
    }

    /**
     * Supprimer un profil
     */
    public function Delete()
    {
        $id = (int) $this->input->post('id');

        if (empty($id)) {
            $this->_sms('Erreur', 'danger', 'Profil invalide.');
            redirect(base_url('Profile'));
            return;
        }

        $old = $this->Profile_model->get_by_id($id);

        if (empty($old)) {
            $this->_sms('Erreur', 'danger', 'Profil introuvable.');
            redirect(base_url('Profile'));
            return;
        }

        $rsp = $this->Profile_model->delete($id);

        if ($rsp) {
            $this->_delete_file($old['profile_image']);
            $this->_delete_file($old['cv_file']);
            $this->_sms('Succès', 'success', 'Profil supprimé avec succès.');
        } else {
            $this->_sms('Erreur', 'danger', 'Une erreur inconnue est survenue.');
        }

        redirect(base_url('Profile'));
    }

    /**
     * Upload un fichier et retourne son chemin relatif.
     *
     * @return string  chemin relatif ou '' si aucun fichier
     * @return false   en cas d'échec d'upload
     */
    private function _do_upload($field, $folder, $allowed = 'jpg|jpeg|png|gif|webp')
    {
        if (empty($_FILES[$field]['name'])) {
            return '';
        }

        $path = FCPATH . 'attachments/' . $folder . '/';
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        $config = array(
            'upload_path'   => $path,
            'allowed_types' => $allowed,
            'max_size'      => 8192,
            'encrypt_name'  => TRUE
        );

        $this->upload->initialize($config);

        if (!$this->upload->do_upload($field)) {
            $this->_sms('Erreur', 'danger', $this->upload->display_errors('', ''));
            return false;
        }

        return 'attachments/' . $folder . '/' . $this->upload->data('file_name');
    }

    /**
     * Supprimer un fichier uploadé
     */
    private function _delete_file($path)
    {
        if (!empty($path) && file_exists(FCPATH . $path)) {
            unlink(FCPATH . $path);
        }
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