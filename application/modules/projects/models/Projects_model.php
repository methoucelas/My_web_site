<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Projects Model
 *
 * Gestion des projets (table projects)
 */
class Projects_model extends CI_Model
{
    public function get_all()
    {
        return $this->Model->readQuery(
            'SELECT p.*, c.name AS category_name
             FROM projects p
             LEFT JOIN categories c ON c.id = p.category_id
             ORDER BY p.id DESC'
        );
    }

    public function get_by_id($id)
    {
        return $this->Model->readOne('projects', array('id' => (int) $id));
    }

    public function get_categories()
    {
        return $this->Model->read('categories', array(), 'name', 'ASC');
    }

    public function slug_exists($slug, $id = 0)
    {
        $this->db->where('slug', $slug);
        if ((int) $id > 0) {
            $this->db->where('id !=', (int) $id);
        }
        return $this->db->get('projects')->num_rows() > 0;
    }

    public function insert($data)
    {
        return $this->Model->createLastId('projects', $data);
    }

    public function update($id, $data)
    {
        return $this->Model->update('projects', array('id' => (int) $id), $data);
    }

    public function delete($id)
    {
        return $this->Model->delete('projects', array('id' => (int) $id));
    }
}