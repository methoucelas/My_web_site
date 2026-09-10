<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Project_technologies Model
 *
 * Gestion des associations projet / technologie (table project_technologies)
 */
class Project_technologies_model extends CI_Model
{
    public function get_all()
    {
        return $this->Model->readQuery(
            'SELECT pt.id, pt.project_id, pt.technology_id,
                    p.title AS project_title, t.name AS technology_name
             FROM project_technologies pt
             INNER JOIN projects p ON p.id = pt.project_id
             INNER JOIN technologies t ON t.id = pt.technology_id
             ORDER BY pt.id DESC'
        );
    }

    public function get_by_id($id)
    {
        return $this->Model->readOne('project_technologies', array('id' => (int) $id));
    }

    public function get_projects()
    {
        return $this->Model->read('projects', array(), 'title', 'ASC');
    }

    public function get_technologies()
    {
        return $this->Model->read('technologies', array(), 'name', 'ASC');
    }

    public function pair_exists($project_id, $technology_id, $id = 0)
    {
        $this->db->where('project_id', (int) $project_id);
        $this->db->where('technology_id', (int) $technology_id);
        if ((int) $id > 0) {
            $this->db->where('id !=', (int) $id);
        }
        return $this->db->get('project_technologies')->num_rows() > 0;
    }

    public function insert($data)
    {
        return $this->Model->createLastId('project_technologies', $data);
    }

    public function update($id, $data)
    {
        return $this->Model->update('project_technologies', array('id' => (int) $id), $data);
    }

    public function delete($id)
    {
        return $this->Model->delete('project_technologies', array('id' => (int) $id));
    }
}