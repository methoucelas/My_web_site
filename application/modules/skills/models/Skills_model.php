<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Skills Model
 *
 * Gestion des compétences (table competances)
 */
class Skills_model extends CI_Model
{
    public function get_all()
    {
        return $this->Model->read('competances', array(), 'id', 'DESC');
    }

    public function get_by_id($id)
    {
        return $this->Model->readOne('competances', array('id' => (int) $id));
    }

    public function insert($data)
    {
        return $this->Model->createLastId('competances', $data);
    }

    public function update($id, $data)
    {
        return $this->Model->update('competances', array('id' => (int) $id), $data);
    }

    public function delete($id)
    {
        return $this->Model->delete('competances', array('id' => (int) $id));
    }
}