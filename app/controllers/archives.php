<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Archives extends MZS_Controller
{
	public $posts;

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->output->cache(1);

		$this->page_name = '归档';
		$this->page_header = '归档';

		$this->posts = $this->post_m->fetch();

		if(! $this->posts) {
			die('404');
		}

		$this->load->view('archives');
	}
}

/* End of file archives.php */
/* Location: ./app/controllers/archives.php */
