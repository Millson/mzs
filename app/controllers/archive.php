<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Archive extends MZS_Controller
{
	public $archives;

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if( $this->uri->segment(2) ) {
			die('404');
		}

		$this->page_name = '归档';
		$this->page_header = '归档';

		$posts = $this->post_m->fetch();

		if(! $posts) {
			die('404');
		}

		foreach($posts as $post) {
			$year = date('Y', $post['created']);
			$month = date('m月', $post['created']);

			$post['permalink'] = site_url('post/' . $post['slug']);

			$this->archives[$year][$month][] = $post;
		}

		$this->load->view('archive');
	}
}

/* End of file archives.php */
/* Location: ./app/controllers/archives.php */
