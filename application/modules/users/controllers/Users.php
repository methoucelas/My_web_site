<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Users Controller
 *
 * Gestion des utilisateurs de l'administration
 *
 * @author: Jean de Dieu Ntirampeba
 * @modified: Portfolio Personal
 */
class Users extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Vérifier que l'utilisateur est connecté
        $this->not_logged_in();
    }


    /**
     * Liste des utilisateurs
     * 
     * URL:
     * /Users
     * /Users/index/1
     */
    public function index($id = '')
    {
        $critere = '';

        if (!empty($id)) {
            $id = (int) $id;
            $critere = ' AND id=' . $id;
        }

        $data['users'] = $this->Model->readQuery(
            'SELECT *
             FROM users
             WHERE 1 ' . $critere . '
             ORDER BY id DESC'
        );

        $this->load->view('Users_View', $data);
    }


    /**
     * Créer un utilisateur
     */
    public function Create()
    {
        $name     = trim($this->input->post('name'));
        $email    = trim($this->input->post('email'));
        $password = $this->input->post('password');
        $role     = $this->input->post('role');
        $status   = $this->input->post('status');


        // Valeurs par défaut
        if (empty($role)) {
            $role = 'admin';
        }

        if (empty($status)) {
            $status = 'active';
        }


        // Valeurs autorisées par la table users
        if (!in_array($role, ['admin', 'editor'])) {
            $role = 'admin';
        }

        if (!in_array($status, ['active', 'inactive'])) {
            $status = 'active';
        }


        // Vérification des champs obligatoires
        if (empty($name) || empty($email)) {

            $sms['sms'] = '
                <div class="alert alert-danger fade show mt-1 message" role="alert">
                    <strong>Erreur !</strong>
                    Le nom et l\'email sont obligatoires.
                </div>
            ';

            $this->session->set_flashdata($sms);
            redirect(base_url('Users'));
            return;
        }


        // Vérifier si l'email existe déjà
        $existingUser = $this->Model->readOne(
            'users',
            ['email' => $email]
        );

        if (!empty($existingUser)) {

            $sms['sms'] = '
                <div class="alert alert-danger fade show mt-1 message" role="alert">
                    <strong>Erreur !</strong>
                    Cette adresse email existe déjà.
                </div>
            ';

            $this->session->set_flashdata($sms);
            redirect(base_url('Users'));
            return;
        }


        // Mot de passe par défaut
        if (empty($password)) {
            $password = 'Admin@2025';
        }


        // Préparer les données
        $data = array(
            'name'       => $name,
            'email'      => $email,
            'password'   => $this->password_hash($password),
            'role'       => $role,
            'status'     => $status
        );


        // Créer l'utilisateur
        $id = $this->Model->createLastId('users', $data);


        if ($id) {

            $sms['sms'] = '
                <div class="alert alert-success fade show mt-1 message" role="alert">
                    <strong>Succès !</strong>
                    Utilisateur créé avec succès.
                </div>
            ';

        } else {

            $sms['sms'] = '
                <div class="alert alert-danger fade show mt-1 message" role="alert">
                    <strong>Erreur !</strong>
                    Une erreur inconnue est survenue.
                </div>
            ';
        }


        $this->session->set_flashdata($sms);

        redirect(base_url('Users'));
    }


    /**
     * Modifier un utilisateur
     */
    public function Update()
    {
        $id       = (int) $this->input->post('id');
        $name     = trim($this->input->post('name'));
        $email    = trim($this->input->post('email'));
        $role     = $this->input->post('role');
        $status   = $this->input->post('status');
        $password = $this->input->post('password');


        // Vérifier l'ID
        if (empty($id)) {

            $sms['sms'] = '
                <div class="alert alert-danger fade show mt-1 message" role="alert">
                    <strong>Erreur !</strong>
                    Utilisateur invalide.
                </div>
            ';

            $this->session->set_flashdata($sms);
            redirect(base_url('Users'));
            return;
        }


        // Vérifier les champs obligatoires
        if (empty($name) || empty($email)) {

            $sms['sms'] = '
                <div class="alert alert-danger fade show mt-1 message" role="alert">
                    <strong>Erreur !</strong>
                    Le nom et l\'email sont obligatoires.
                </div>
            ';

            $this->session->set_flashdata($sms);
            redirect(base_url('Users'));
            return;
        }


        // Valeurs autorisées par la table users
        if (!in_array($role, ['admin', 'editor'])) {
            $role = 'admin';
        }

        if (!in_array($status, ['active', 'inactive'])) {
            $status = 'active';
        }


        // Vérifier que l'email n'appartient pas à un autre utilisateur
        $existingUser = $this->Model->readQuery(
            "SELECT *
             FROM users
             WHERE email = " . $this->db->escape($email) . "
             AND id != " . $id
        );


        if (!empty($existingUser)) {

            $sms['sms'] = '
                <div class="alert alert-danger fade show mt-1 message" role="alert">
                    <strong>Erreur !</strong>
                    Cette adresse email est déjà utilisée.
                </div>
            ';

            $this->session->set_flashdata($sms);
            redirect(base_url('Users'));
            return;
        }


        // Données à modifier
        $data = array(
            'name'   => $name,
            'email'  => $email,
            'role'   => $role,
            'status' => $status
        );


        // Si un nouveau mot de passe est fourni
        if (!empty($password)) {
            $data['password'] = $this->password_hash($password);
        }


        // Mise à jour
        $rsp = $this->Model->update(
            'users',
            ['id' => $id],
            $data
        );


        if ($rsp) {

            $sms['sms'] = '
                <div class="alert alert-success fade show mt-1 message" role="alert">
                    <strong>Succès !</strong>
                    Utilisateur modifié avec succès.
                </div>
            ';

        } else {

            $sms['sms'] = '
                <div class="alert alert-danger fade show mt-1 message" role="alert">
                    <strong>Erreur !</strong>
                    Une erreur inconnue est survenue.
                </div>
            ';
        }


        $this->session->set_flashdata($sms);

        redirect(base_url('Users'));
    }


    /**
     * Supprimer un utilisateur
     */
    public function Delete()
    {
        $id = (int) $this->input->post('id');


        if (empty($id)) {

            $sms['sms'] = '
                <div class="alert alert-danger fade show mt-1 message" role="alert">
                    <strong>Erreur !</strong>
                    Utilisateur invalide.
                </div>
            ';

            $this->session->set_flashdata($sms);
            redirect(base_url('Users'));
            return;
        }


        $rsp = $this->Model->delete(
            'users',
            ['id' => $id]
        );


        if ($rsp) {

            $sms['sms'] = '
                <div class="alert alert-success fade show mt-1 message" role="alert">
                    <strong>Succès !</strong>
                    Utilisateur supprimé avec succès.
                </div>
            ';

        } else {

            $sms['sms'] = '
                <div class="alert alert-danger fade show mt-1 message" role="alert">
                    <strong>Erreur !</strong>
                    Une erreur inconnue est survenue.
                </div>
            ';
        }


        $this->session->set_flashdata($sms);

        redirect(base_url('Users'));
    }


    /**
     * Hasher un mot de passe
     */
    public function password_hash($pass = '')
    {
        if (!empty($pass)) {
            return password_hash($pass, PASSWORD_DEFAULT);
        }

        return false;
    }


    /**
     * Vérifier si un email existe déjà
     *
     * Utilisable en AJAX
     */
    public function checkEmail()
    {
        $email = trim($this->input->post('email'));
        $id    = (int) $this->input->post('id');


        if (empty($email)) {
            echo "invalid";
            return;
        }


        if ($id > 0) {

            $user = $this->Model->readQuery(
                "SELECT id
                 FROM users
                 WHERE email = " . $this->db->escape($email) . "
                 AND id != " . $id
            );

        } else {

            $user = $this->Model->readOne(
                'users',
                ['email' => $email]
            );
        }


        if (!empty($user)) {
            echo "denied";
        } else {
            echo "success";
        }
    }


    /**
     * Activer / désactiver un utilisateur
     */
    public function ChangeStatus()
    {
        $id     = (int) $this->input->post('id');
        $status = $this->input->post('status');


        if (empty($id)) {
            echo "error";
            return;
        }


        if (!in_array($status, ['active', 'inactive'])) {
            echo "error";
            return;
        }


        $data = array(
            'status' => $status
        );


        $rsp = $this->Model->update(
            'users',
            ['id' => $id],
            $data
        );


        if ($rsp) {
            echo "success";
        } else {
            echo "error";
        }
    }


    /**
     * Réinitialiser le mot de passe
     */
    public function initialPWD()
    {
        $id = (int) $this->input->post('id');


        if (empty($id)) {

            $sms['sms'] = '
                <div class="alert alert-danger fade show mt-1 message" role="alert">
                    <strong>Erreur !</strong>
                    Utilisateur invalide.
                </div>
            ';

            $this->session->set_flashdata($sms);
            redirect(base_url('Users'));
            return;
        }


        $data = array(
            'password' => $this->password_hash('Admin@2025')
        );


        $rsp = $this->Model->update(
            'users',
            ['id' => $id],
            $data
        );


        if ($rsp) {

            $sms['sms'] = '
                <div class="alert alert-success fade show mt-1 message" role="alert">
                    Le mot de passe a été réinitialisé avec succès.
                    <br>
                    <small>Mot de passe temporaire : Admin@2025</small>
                </div>
            ';

        } else {

            $sms['sms'] = '
                <div class="alert alert-danger fade show mt-1 message" role="alert">
                    <strong>Erreur !</strong>
                    Une erreur inconnue est survenue.
                </div>
            ';
        }


        $this->session->set_flashdata($sms);

        redirect(base_url('Users'));
    }
}