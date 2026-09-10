<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Technologies Model
 *
 * Gestion des technologies (table technologies)
 */
class Technologies_model extends CI_Model
{
    public function get_all()
    {
        return $this->Model->read('technologies', array(), 'id', 'DESC');
    }

    public function get_by_id($id)
    {
        return $this->Model->readOne('technologies', array('id' => (int) $id));
    }

    public function name_exists($name, $id = 0)
    {
        $this->db->where('name', $name);
        if ((int) $id > 0) {
            $this->db->where('id !=', (int) $id);
        }
        return $this->db->get('technologies')->num_rows() > 0;
    }

    public function insert($data)
    {
        return $this->Model->createLastId('technologies', $data);
    }

    public function update($id, $data)
    {
        return $this->Model->update('technologies', array('id' => (int) $id), $data);
    }

    public function delete($id)
    {
        return $this->Model->delete('technologies', array('id' => (int) $id));
    }
}