<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Categories Model
 *
 * Gestion des catégories (table categories)
 */
class Categories_model extends CI_Model
{
    public function get_all()
    {
        return $this->Model->read('categories', array(), 'id', 'DESC');
    }

    public function get_by_id($id)
    {
        return $this->Model->readOne('categories', array('id' => (int) $id));
    }

    public function name_exists($name, $id = 0)
    {
        $this->db->where('name', $name);
        if ((int) $id > 0) {
            $this->db->where('id !=', (int) $id);
        }
        return $this->db->get('categories')->num_rows() > 0;
    }

    public function slug_exists($slug, $id = 0)
    {
        $this->db->where('slug', $slug);
        if ((int) $id > 0) {
            $this->db->where('id !=', (int) $id);
        }
        return $this->db->get('categories')->num_rows() > 0;
    }

    public function insert($data)
    {
        return $this->Model->createLastId('categories', $data);
    }

    public function update($id, $data)
    {
        return $this->Model->update('categories', array('id' => (int) $id), $data);
    }

    public function delete($id)
    {
        return $this->Model->delete('categories', array('id' => (int) $id));
    }
}