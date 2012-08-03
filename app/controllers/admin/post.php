<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Post extends MZS_Controller {

	public $pid;
	public $type = 'post';
	public $categories;
	public $posts;
	public $hidden;
	public $post;

	public $select_mids = array();
	public $tags = '';
	public $slug = '';

	public function __construct()
	{
		parent::__construct();
	}

	public function index($page = 0)
	{
		$page = intval($page);

		$this->page_name = $this->page_header = '日志列表';

		$this->posts = $this->post_m->fetch($this->type, 0, $page);

		$this->load->view('admin/post');
	}

	public function edit($pid = 0)
	{
		$pid = intval($pid);

		$this->page_name = '写新日志';

		$categories = $this->meta_m->fetch_all();

		foreach($categories as $category) {
			$this->categories[ $category['mid'] ] = $category['name'];
		}

		$this->hidden['type'] = $this->type;
		$this->category_select = array();

		if($pid != 0) {
			$this->pid = $pid;

			$this->post = $this->post_m->fetch_by_pid($pid);

			if( ! $this->post ) {
				show_404();
			}

			$this->hidden['pid'] = $pid;
			$this->page_name = '编辑日志';

			if($this->post['categories']) {
				foreach($this->post['categories'] as $category) {
					$this->select_mids[] = $category['mid'];
				}
			}

			$this->tags = '';
			if($this->post['tags']) {
				foreach($this->post['tags'] as $tag) {
					$this->tags .= $tag['name'] . ',';
				}
				$this->tags = substr($this->tags, 0, -1);
			}

			$this->slug = $this->post['slug'];
		}

		$this->page_header = $this->page_name;

		$this->load->view('admin/post_edit');
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
