<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Link extends MZS_Controller
{
	public $links;

	public function __construct()
	{
		parent::__construct();
	}

	public function index($lid = 0)
	{
		if( $this->uri->segment(2) ) {
			show_404();
		}

		$this->input->cache(60 * 24);
		
		$this->page_name = '链接';
		$this->page_header = '链接';

		$all_links = $this->link_m->fetch_all();

		foreach($all_links as $link) {
			$this->links[ $link['sort'] ][] = $link;
		}

		$this->load->view('link');
	}
}

/* End of file link.php */
/* Location: ./app/controllers/link.php */
