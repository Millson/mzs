<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends MZS_Controller {

	public $type = 'page';
	public $posts;
	public $post;
	public $pagination_links;
	
	public $pid;
	public $slug = '';

	private $per_page = 10;

	public function __construct()
	{
		parent::__construct();
	}

	public function index($page = 0)
	{
		$page = intval($page);

		$this->page_name = $this->page_header = '页面列表';

		$this->posts = $this->post_m->fetch($this->type, $this->per_page, $page);

		$this->load->library('pagination');

		$config['base_url'] = site_url('admin/post');
		$config['total_rows'] = $this->post_m->get_total($this->type);
		$config['per_page'] = $this->per_page;

		$this->pagination->initialize($config);

		$this->pagination_links = $this->pagination->create_links();

		$this->load->view('admin/page');
	}

	public function edit($pid = 0)
	{
		$pid = intval($pid);

		$this->page_name = '创建新页面';

		if($pid != 0) {
			$this->pid = $pid;

			$this->post = $this->post_m->fetch_by_pid($pid);

			if( ! $this->post ) {
				show_404();
			}

			$this->page_name = '编辑页面';
			
			$this->slug = $this->post['slug'];
		}

		$this->page_header = $this->page_name;

		$this->load->view('admin/page_edit');
	}

	public function publish()
	{
		$this->post_m->publish('page');

		redirect('admin/page');
	}

	public function del($pid = 0)
	{
		$pid = intval($pid);

		if($pid == 0) {
			show_404();
		}

		$this->post_m->del($pid);

		redirect('admin/page');
	}
}

/* End of file page.php */
/* Location: ./app/controller/admin/page.php */
