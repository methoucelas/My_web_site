<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
    * @author:   Jean de Dieu Ntirampeba
    * Email:     jeandedieuntirampeba@gmail.com
    * Gitgub:    https://github.com/porochen
 */
/* load the MX_Router class */
require APPPATH . "third_party/MX/Controller.php";

class MY_Controller extends MX_Controller
{	

	var $permission = array();
	var $group_name="";

	public function __construct() 
	{
		parent::__construct();
		$this->_hmvc_fixes();

		$group_data = array();

		if(empty($this->session->userdata('logged_in'))) {
			$session_data = array('logged_in' => FALSE);
			$this->session->set_userdata($session_data);
		}else {
			$id = $this->session->userdata('id');
			$user = $this->Model->readOne('users', array('id' => $id));

			if (empty($user) || $user['status'] != 'active') {
				$this->session->sess_destroy();
				redirect(base_url('Admin'));
				return;
			}

			$this->group_name = $user['role'];
		}
	}
	
	function _hmvc_fixes()
	{		
		//fix callback form_validation		
		//https://bitbucket.org/wiredesignz/codeigniter-modular-extensions-hmvc
		$this->load->library('form_validation');
		$this->form_validation->CI =& $this;
	}

	public function not_logged_in()
	{
		$session_data = $this->session->userdata();

		if ($this->session->userdata('logged_in')==FALSE) {
			redirect(base_url('Admin'));
		}
	}

}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */
