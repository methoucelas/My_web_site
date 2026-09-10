<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Projects Controller
 *
 * Gestion des projets (table projects)
 */
class Projects extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->not_logged_in();
        $this->load->model('Projects_model');
    }

    /**
     * Liste des projets
     */
    public function index()
    {
        $data['projects']    = $this->Projects_model->get_all();
        $data['categories']  = $this->Projects_model->get_categories();
        $this->load->view('Projects_View', $data);
    }

    /**
     * Créer un projet
     */
    public function Create()
    {
        $title = trim($this->input->post('title'));

        if (empty($title)) {
            $this->_sms('Erreur', 'danger', 'Le titre est obligatoire.');
            redirect(base_url('Projects'));
            return;
        }

        $slug = trim($this->input->post('slug'));
        if (empty($slug)) {
            $slug = $this->_make_slug($title);
        } elseif ($this->Projects_model->slug_exists($slug)) {
            $this->_sms('Erreur', 'danger', 'Ce slug est déjà utilisé.');
            redirect(base_url('Projects'));
            return;
        }

        $category_id = (int) $this->input->post('category_id');
        if (empty($category_id)) {
            $category_id = null;
        }

        $project_type = $this->input->post('project_type');
        if (!in_array($project_type, array('IT', 'MUSIC', 'OTHER'))) {
            $project_type = 'IT';
        }

        $status = $this->input->post('status');
        if (!in_array($status, array('draft', 'published', 'archived'))) {
            $status = 'draft';
        }

        $data = array(
            'title'             => $title,
            'slug'              => $slug,
            'category_id'       => $category_id,
            'project_type'      => $project_type,
            'short_description' => trim($this->input->post('short_description')),
            'description'       => $this->input->post('description'),
            'github_url'        => trim($this->input->post('github_url')),
            'demo_url'          => trim($this->input->post('demo_url')),
            'audio_url'         => trim($this->input->post('audio_url')),
            'video_url'         => trim($this->input->post('video_url')),
            'start_date'        => !empty($this->input->post('start_date')) ? $this->input->post('start_date') : null,
            'end_date'          => !empty($this->input->post('end_date')) ? $this->input->post('end_date') : null,
            'status'            => $status,
            'featured'          => ($this->input->post('featured')) ? 1 : 0
        );

        // Image du projet
        $image = $this->_do_upload('image', 'Project');
        if ($image === false) {
            redirect(base_url('Projects'));
            return;
        }
        if (!empty($image)) {
            $data['image'] = $image;
        }

        $id = $this->Projects_model->insert($data);

        if ($id) {
            $this->_sms('Succès', 'success', 'Projet créé avec succès.');
        } else {
            $this->_sms('Erreur', 'danger', 'Une erreur inconnue est survenue.');
        }

        redirect(base_url('Projects'));
    }

    /**
     * Modifier un projet
     */
    public function Update()
    {
        $id    = (int) $this->input->post('id');
        $title = trim($this->input->post('title'));

        if (empty($id) || empty($title)) {
            $this->_sms('Erreur', 'danger', 'Projet invalide.');
            redirect(base_url('Projects'));
            return;
        }

        $old = $this->Projects_model->get_by_id($id);

        if (empty($old)) {
            $this->_sms('Erreur', 'danger', 'Projet introuvable.');
            redirect(base_url('Projects'));
            return;
        }

        $slug = trim($this->input->post('slug'));
        if (empty($slug)) {
            $slug = $this->_make_slug($title, $id);
        } elseif ($this->Projects_model->slug_exists($slug, $id)) {
            $this->_sms('Erreur', 'danger', 'Ce slug est déjà utilisé.');
            redirect(base_url('Projects'));
            return;
        }

        $category_id = (int) $this->input->post('category_id');
        if (empty($category_id)) {
            $category_id = null;
        }

        $project_type = $this->input->post('project_type');
        if (!in_array($project_type, array('IT', 'MUSIC', 'OTHER'))) {
            $project_type = 'IT';
        }

        $status = $this->input->post('status');
        if (!in_array($status, array('draft', 'published', 'archived'))) {
            $status = 'draft';
        }

        $data = array(
            'title'             => $title,
            'slug'              => $slug,
            'category_id'       => $category_id,
            'project_type'      => $project_type,
            'short_description' => trim($this->input->post('short_description')),
            'description'       => $this->input->post('description'),
            'github_url'        => trim($this->input->post('github_url')),
            'demo_url'          => trim($this->input->post('demo_url')),
            'audio_url'         => trim($this->input->post('audio_url')),
            'video_url'         => trim($this->input->post('video_url')),
            'start_date'        => !empty($this->input->post('start_date')) ? $this->input->post('start_date') : null,
            'end_date'          => !empty($this->input->post('end_date')) ? $this->input->post('end_date') : null,
            'status'            => $status,
            'featured'          => ($this->input->post('featured')) ? 1 : 0
        );

        // Image du projet
        $image = $this->_do_upload('image', 'Project');
        if ($image === false) {
            redirect(base_url('Projects'));
            return;
        }
        if (!empty($image)) {
            $data['image'] = $image;
            $this->_delete_file($old['image']);
        }

        $rsp = $this->Projects_model->update($id, $data);

        if ($rsp) {
            $this->_sms('Succès', 'success', 'Projet modifié avec succès.');
        } else {
            $this->_sms('Erreur', 'danger', 'Une erreur inconnue est survenue.');
        }

        redirect(base_url('Projects'));
    }

    /**
     * Supprimer un projet
     */
    public function Delete()
    {
        $id = (int) $this->input->post('id');

        if (empty($id)) {
            $this->_sms('Erreur', 'danger', 'Projet invalide.');
            redirect(base_url('Projects'));
            return;
        }

        $old = $this->Projects_model->get_by_id($id);

        if (empty($old)) {
            $this->_sms('Erreur', 'danger', 'Projet introuvable.');
            redirect(base_url('Projects'));
            return;
        }

        $rsp = $this->Projects_model->delete($id);

        if ($rsp) {
            $this->_delete_file($old['image']);
            $this->_sms('Succès', 'success', 'Projet supprimé avec succès.');
        } else {
            $this->_sms('Erreur', 'danger', 'Une erreur inconnue est survenue.');
        }

        redirect(base_url('Projects'));
    }

    /**
     * Génère un slug unique à partir du titre
     */
    private function _make_slug($title, $id = 0)
    {
        $slug = url_title($title, 'dash', TRUE);
        $base = $slug;
        $i    = 1;

        while ($this->Projects_model->slug_exists($slug, $id)) {
            $slug = $base . '-' . ($i++);
        }

        return $slug;
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