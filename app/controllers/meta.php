<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Meta extends MZS_Controller
{
	public $archives;
	public $metas;

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if( $this->uri->segment(2) ) {
			die('404');
		}

		$type = $this->uri->segment(1);

		$this->metas = $this->meta_m->fetch_all($type);

		if(! $this->metas) {
			die('404');
		}

		if($type == 'tag') {
			$type = 'tags';
			$this->page_name = $this->page_header = '标签';
		}else{
			$type = 'categories';
			$this->page_name = $this->page_header = '分类';
		}

		$posts = $this->post_m->fetch('post');

		foreach($posts as $post) {
			$post['permalink'] = site_url('post/'.$post['slug']);

			if($post[ $type ]) {
				foreach($post[ $type ] as $meta) {
					$this->archives[ $meta['name'] ][] = $post;
				}
			}
		}

		$this->load->view('meta');
	}
}

/* End of file meta.php */
/* Location: ./app/controllers/meta.php */
