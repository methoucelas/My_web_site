<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Dashboard Controller
 *
 * Personal Portfolio Admin Dashboard
 *
 * Toutes les statistiques proviennent des tables réelles :
 * projects, competances, messages, profile, users, categories, technologies
 */
class Dashboard extends MY_Controller {

    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('logged_in')) {
            redirect(base_url('Admin'));
            exit;
        }
    }

    public function index()
    {
        $data = array();

        $data['page_title'] = 'Dashboard';

        // Statistiques principales
        $data['total_projects']   = $this->countRows('projects');
        $data['it_projects']      = $this->countRows('projects', "project_type = 'IT'");
        $data['music_projects']   = $this->countRows('projects', "project_type = 'MUSIC'");
        $data['other_projects']   = $this->countRows('projects', "project_type = 'OTHER'");
        $data['total_skills']     = $this->countRows('competances');
        $data['unread_messages']  = $this->countRows('messages', "status = 'unread'");
        $data['total_messages']   = $this->countRows('messages');
        $data['total_users']      = $this->countRows('users');
        $data['total_categories'] = $this->countRows('categories');
        $data['total_technologies'] = $this->countRows('technologies');

        // Statuts des projets (données réelles)
        $data['published_projects'] = $this->countRows('projects', "status = 'published'");
        $data['draft_projects']     = $this->countRows('projects', "status = 'draft'");

        // Activité musique (uniquement ce qui existe réellement en base)
        $data['music_tracks'] = $this->countRows('projects', "audio_url IS NOT NULL AND audio_url != ''");
        $data['music_videos'] = $this->countRows('projects', "video_url IS NOT NULL AND video_url != ''");

        // Derniers projets avec leurs technologies (relation project_technologies)
        $data['recent_projects'] = $this->Model->readQuery(
            "SELECT p.*,
                    (SELECT GROUP_CONCAT(t.name SEPARATOR ', ')
                     FROM project_technologies pt
                     INNER JOIN technologies t ON t.id = pt.technology_id
                     WHERE pt.project_id = p.id) AS technologies
             FROM projects p
             ORDER BY p.created_at DESC
             LIMIT 5"
        );

        // Derniers messages
        $data['recent_messages'] = $this->Model->readQuery(
            "SELECT *
             FROM messages
             ORDER BY created_at DESC
             LIMIT 5"
        );

        // Profil personnel
        $data['profile'] = $this->Model->readQueryOne(
            'SELECT * FROM profile ORDER BY id ASC LIMIT 1'
        );

        $this->load->view('Dashboard_view', $data);
    }

    /**
     * Compter les lignes d'une table avec une condition optionnelle
     */
    private function countRows($table, $where = '')
    {
        $sql = 'SELECT COUNT(*) AS nb FROM ' . $table;

        if ($where !== '') {
            $sql .= ' WHERE ' . $where;
        }

        $row = $this->Model->readQueryOne($sql);

        return (!empty($row)) ? (int) $row['nb'] : 0;
    }
}

/* End of file Dashboard.php */
/* Location: ./application/modules/Dashboard/controllers/Dashboard.php */
