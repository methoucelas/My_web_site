<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Education Model
 *
 * Gestion de la formation (table education)
 */
class Education_model extends CI_Model
{
    public function get_all()
    {
        return $this->Model->read('education', array(), 'id', 'DESC');
    }

    public function get_by_id($id)
    {
        return $this->Model->readOne('education', array('id' => (int) $id));
    }

    public function insert($data)
    {
        return $this->Model->createLastId('education', $data);
    }

    public function update($id, $data)
    {
        return $this->Model->update('education', array('id' => (int) $id), $data);
    }

    public function delete($id)
    {
        return $this->Model->delete('education', array('id' => (int) $id));
    }
}