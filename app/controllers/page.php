<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends MZS_Controller
{
	public $page;

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if( $this->uri->segment(3) ) {
			die('404');
		}

		$slug = $this->uri->segment(2);

		if(! $slug) {
			die('404');
		}

		$this->page = $this->post_m->fetch_by_slug($slug, 'page');

		if(! $this->page) {
			die('404');
		}

		$this->page_name = $this->page_header = $this->page['title'];

		$this->load->view('page');
	}
}

/* End of file page.php */
/* Location: ./app/controllers/page.php */