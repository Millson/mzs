<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends MZS_Controller
{
	public $posts;

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if( $this->uri->segment(1) ) {
			show_404();
		}

		if($this->cached) {
			$this->output->cache(60);
		}
		
		$this->page_name = '首页';
		$this->page_header = 'Recent Posts';

		$posts = $this->post_m->fetch('post', 10);

		foreach($posts as &$post) {
			$post['permalink'] = site_url('post/'.$post['slug']);

			$post['category'] = '';
			if($post['categories']) {
				foreach($post['categories'] as $category) {
					$post['category'] .= anchor('category/'.$category['slug'], $category['name'], array('title'=>$category['name'])) . ',';
				}
				$post['category'] = substr($post['category'], 0, -1);
			}
		}
		
		$this->posts = $posts;

		$this->load->view('main');
	}
}

/* End of file main.php */
/* Location: ./app/controllers/main.php */
