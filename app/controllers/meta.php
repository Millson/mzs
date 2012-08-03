<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Meta extends MZS_Controller
{
	public $archives;
	public $all_metas;
	public $used_metas;

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

		$metas = $this->meta_m->fetch_all($type);

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
					$this->archives[ $meta['mid'] ][] = $post;
				}
			}
		}

		foreach($metas as $val) {
			$this->all_metas[ $val['mid'] ] = $val;
		}
		
		foreach($this->archives as $mid=>$val) {
			$this->used_metas[] = $mid;
		}

		$this->load->view('meta');
	}
}

/* End of file meta.php */
/* Location: ./app/controllers/meta.php */
