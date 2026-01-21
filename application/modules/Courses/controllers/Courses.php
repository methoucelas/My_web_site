<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *@author:    Votre Nom
 * Email:    votre.email@gmail.com
*/

class Courses extends MY_Controller {

    function __construct()
    {
        parent::__construct();
    }

    
    public function index()
    {
        // Récupérer les cours avec les informations des tables liées
        $data['courses'] = $this->Model->getCoursesWithDetails();
        $data['categories'] = $this->Model->read('categories', null, 'id_categorie');
        $data['teachers'] = $this->Model->read('teachers', null, 'id_teacher');
        $this->load->view('Courses_View', $data);
    }


    function CreateCourse(){
        $nom_course = $this->input->post('nom_course');
        $id_categorie = $this->input->post('id_categorie');
        $id_teacher = $this->input->post('id_teacher');
        $description = $this->input->post('description');

        $data = array(
            'nom_course' => $nom_course,
            'id_categorie' => $id_categorie,
            'id_teacher' => $id_teacher,
            'description' => $description,
            'date_insertion' => date('Y-m-d H:i:s')
        );
        
        $rsp = $this->Model->create('courses', $data);

        if ($rsp) {
            $sms['sms'] = '<div class="alert alert-background fade show mt-1 message" role="alert">
                             Cours créé avec succès.
                         </div>';
        } else {
            $sms['sms'] = '<div class="alert alert-background fade show mt-1 message" role="alert">
                             <strong class="text-danger">Oups!</strong> Une erreur inconnue, contactez l\'administrateur!.
                         </div>';
        }
        $this->session->set_flashdata($sms);
        redirect(base_url('Courses'));
    }



    function UpdateCourse(){
        $id_course = $this->input->post('id_course');
        $nom_course = $this->input->post('nom_course');
        $id_categorie = $this->input->post('id_categorie');
        $id_teacher = $this->input->post('id_teacher');
        $description = $this->input->post('description');

        $data = array(
            'nom_course' => $nom_course,
            'id_categorie' => $id_categorie,
            'id_teacher' => $id_teacher,
            'description' => $description
        );
        
        $rsp = $this->Model->update('courses', ['id_course' => $id_course], $data);

        if ($rsp) {
            $sms['sms'] = '<div class="alert alert-background fade show mt-1 message" role="alert">
                             Cours modifié avec succès.
                         </div>';
        } else {
            $sms['sms'] = '<div class="alert alert-background fade show mt-1 message" role="alert">
                             <strong class="text-danger">Oups!</strong> Une erreur inconnue, contactez l\'administrateur!.
                         </div>';
        }
        $this->session->set_flashdata($sms);
        redirect(base_url('Courses'));
    }


    function DeleteCourse(){
        $id_course = $this->input->post('id_course');
        $rsp = $this->Model->delete('courses', ['id_course' => $id_course]);

        if ($rsp) {
            $sms['sms'] = '<div class="alert alert-background fade show mt-1 message" role="alert">
                             Cours supprimé avec succès.
                         </div>';
        } else {
            $sms['sms'] = '<div class="alert alert-background fade show mt-1 message" role="alert">
                             <strong class="text-danger">Oups!</strong> Une erreur inconnue, contactez l\'administrateur!.
                         </div>';
        }
        $this->session->set_flashdata($sms);
        redirect(base_url('Courses'));
    }
}