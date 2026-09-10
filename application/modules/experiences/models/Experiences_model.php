<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Experiences Model
 *
 * Gestion des expériences professionnelles (table experiences)
 */
class Experiences_model extends CI_Model
{
    public function get_all()
    {
        return $this->Model->read('experiences', array(), 'id', 'DESC');
    }

    public function get_by_id($id)
    {
        return $this->Model->readOne('experiences', array('id' => (int) $id));
    }

    public function insert($data)
    {
        return $this->Model->createLastId('experiences', $data);
    }

    public function update($id, $data)
    {
        return $this->Model->update('experiences', array('id' => (int) $id), $data);
    }

    public function delete($id)
    {
        return $this->Model->delete('experiences', array('id' => (int) $id));
    }
}