<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends MZS_Controller
{
	public $post;
	public $prev;
	public $next;

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$slug = $this->uri->segment(2);

		if(! $slug) {
			die('404');
		}

		$this->post = $this->post_m->fetch_by_slug($slug);

		if(! $this->post) {
			die('404');
		}

		$this->page_name = $this->page_header = $this->post['title'];

		$this->prev = $this->post_m->fetch_neighbor($this->post['pid'], 'prev');
		$this->next = $this->post_m->fetch_neighbor($this->post['pid'], 'next');

		$this->load->view('post');
	}
}

/* End of file post.php */
/* Location: ./app/controllers/post.php */
