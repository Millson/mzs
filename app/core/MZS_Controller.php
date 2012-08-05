<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MZS_Controller extends CI_Controller {

	public $page_name;
	public $page_header;
	public $page_tagline;

	public $menu_pages;
	public $permanent_pages;

	public function __construct()
	{
		parent::__construct();

	//	$this->output->enable_profiler(TRUE);

		if( $this->uri->segment(1) != 'admin') {
			$this->init_menu();
		}else{
			if($this->session->userdata('username') != 'Millson') {
				show_404();
			}
		}
	}

	private function init_menu()
	{
		$this->permanent_pages = array(
			array('slug'=>'archive', 'title'=>'归档'),
			array('slug'=>'category', 'title'=>'分类'),
			array('slug'=>'tag', 'title'=>'标签'),
			array('slug'=>'link', 'title'=>'链接'),
		);

		$this->load->model('post_m');

		$this->menu_pages = $this->post_m->fetch('page');
	}
}
