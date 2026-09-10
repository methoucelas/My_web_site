<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Profile Model
 *
 * Gestion des profils personnels
 */
class Profile_model extends CI_Model
{
    public function get_all()
    {
        return $this->Model->read('profile', array(), 'id', 'DESC');
    }

    public function get_by_id($id)
    {
        return $this->Model->readOne('profile', array('id' => (int) $id));
    }

    public function insert($data)
    {
        return $this->Model->createLastId('profile', $data);
    }

    public function update($id, $data)
    {
        return $this->Model->update('profile', array('id' => (int) $id), $data);
    }

    public function delete($id)
    {
        return $this->Model->delete('profile', array('id' => (int) $id));
    }
}