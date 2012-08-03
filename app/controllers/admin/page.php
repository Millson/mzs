<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends MZS_Controller {

	public $pid;
	public $type = 'page';
	public $posts;
	public $hidden;
	public $post;
	public $slug = '';

	public function __construct()
	{
		parent::__construct();
	}

	public function index($page = 0)
	{
		$page = intval($page);

		$this->page_name = $this->page_header = '页面列表';

		$this->posts = $this->post_m->fetch($this->type, 0, $page);

		$this->load->view('admin/page');
	}

	public function edit($pid = 0)
	{
		$pid = intval($pid);

		$this->page_name = '创建新页面';

		$this->hidden['type'] = $this->type;

		if($pid != 0) {
			$this->pid = $pid;

			$this->post = $this->post_m->fetch_by_pid($pid);

			if( ! $this->post ) {
				show_404();
			}

			$this->hidden['pid'] = $pid;
			$this->page_name = '编辑页面';
			
			$this->slug = $this->post['slug'];
		}

		$this->page_header = $this->page_name;

		$this->load->view('admin/page_edit');
	}

	public function publish()
	{
		//TODO 提交文章

		$this->post_m->publish();

		redirect('admin/post');
	}

	public function del()
	{
		//TODO 删除文章
	}
}

/* End of file post.php */
/* Location: ./app/controller/admin/post.php */
