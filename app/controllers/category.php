<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends MZS_Controller
{
	public $posts;

	public function __construct()
	{
		parent::__construct();
	}

	public function index($slug)
	{
		if($this->uri->segment(3)) {
			die('404');
		}

//		$this->output->cache(24*60);
		
		$slug = urldecode($slug);

		if(! $slug) {
			die('404');
		}

		$meta = $this->meta_m->fetch_by_slug($slug);

		if(! $meta) {
			die('404');
		}

		$this->page_name = $meta['name'];
		$this->page_header = "{" . $meta['name'] . "}";
		
		$posts = $this->post_m->fetch_by_mid($meta['mid']);
		
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

		$this->load->view('category');
	}
}

/* End of file category.php */
/* Location: ./app/controllers/category.php */
