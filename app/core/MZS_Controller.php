<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MZS_Controller extends CI_Controller {

	public $page_name;
	public $page_header;
	public $page_tagline;

	public $menu_category;
	public $menu_pages;

	public function __construct()
	{
		parent::__construct();

		$this->output->enable_profiler(TRUE);

		if( $this->uri->segment(1) != 'admin') {
			$this->init_menu();
		}
	}

	private function init_menu()
	{
		$this->load->model('meta_m');

		$this->menu_category = $this->meta_m->fetch_all();

		$this->load->model('post_m');

		$this->menu_pages = $this->post_m->fetch('page');
	}
}
