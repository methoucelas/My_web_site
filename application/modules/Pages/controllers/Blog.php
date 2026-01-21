<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends MY_Controller {

	function __construct()
    {
        parent::__construct();
        //$this->not_logged_in();
    }

    
	public function index()
	{   
        $data['news_media']=$this->Model->read('news_media',null,'id_news_media');
        $data['events'] = $this->Model->read('events', null, 'id');
		$this->load->view('Blog_View',$data);
	}


  public function events_detail($id)
{
    $data['events'] = $this->Model->read(
        'events',
        ['id' => $id],
        'id'
    );

    if (empty($data['events'])) {
        show_404(); // événement introuvable
    }

    $this->load->view('events_View', $data);
}


   public function News_detail($id){


       $data['news_media'] = $this->Model->read(
        'news_media',
        ['id_news_media' => $id],
        'id_news_media'
    );

    if (empty($data['news_media'])) {
        show_404(); // si l'article n'existe pas
    }

   	 $this->load->view('News_View',$data);
   }
	
}

