<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Link extends MZS_Controller
{
	public $links;

	public $lid;
	public $name;
	public $url;
	public $sort;
	public $order;

	public function __construct()
	{
		parent::__construct();
	}

	public function index($lid = 0)
	{
		if( $this->uri->segment(4) ) {
			show_404();
		}

		$this->page_name = '链接';
		$this->page_header = '链接';
		$this->page_tagline = anchor('admin/link', '创建');

		$this->links = $this->link_m->fetch_all();

		if($lid != 0) {
			$curr_link = $this->link_m->fetch_by_lid($lid);

			$this->lid = $lid;
			$this->name = $curr_link['name'];
			$this->url = $curr_link['url'];
			$this->sort = $curr_link['sort'];
			$this->order = $curr_link['order'];
		}

		$this->load->view('admin/link');
	}

	public function publish()
	{
		$this->link_m->publish();

		redirect('admin/link');
	}

	public function del($lid = 0)
	{
		$lid = intval($lid);

		if($lid == 0) {
			show_404();
		}

		$this->link_m->del_link($lid);

		redirect('admin/link');
	}
}

/* End of file link.php */
/* Location: ./app/controllers/admin/link.php */
