<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Post extends MZS_Controller {

	public $type = 'page';
	public $posts;
	public $button_name;
	public $hidden;
	public $post;
	public $category_select;
	public $tags;

	public function __construct()
	{
		parent::__construct();
	}

	public function index($page = 0)
	{
		//TODO 文章列表
		$this->page_name = '日志列表';

		$this->posts = $this->post_m->fetch($this->type, 20, $page);

		$this->load->view('admin/page');
	}

	public function edit($type = 'post', $pid = 0)
	{
		$this->page_name = '创建新页面';

		$this->button_name = '提交';
		
		$categories = $this->meta_m->fetch_all();

		foreach($categories as $category) {
			$this->categories[$category['mid']] = $category['name'];
		}

		$this->category_select = array();

		$this->load->helper('form');

		$this->hidden['type'] = $this->type;

		if($pid != 0) {
			$this->post = $this->post_m->fetch_by_pid($pid);

			if( ! $this->post ) {
				redirect('admin/post/edit/'.$type);
			}

			$this->hidden['pid'] = $pid;
			$this->page_name = str_replace('写新', '编辑', $this->page_name);
			$this->button_name = '更新';

			if($type == 'post') {
				if($this->post['categories']) {
					foreach($this->post['categories'] as $category) {
						$this->category_select[] = $category['mid'];
					}
				}

				$this->tags = '';
				if($this->post['tags']) {
					foreach($this->post['tags'] as $tag) {
						$this->tags .= $tag['name'] . ',';
					}
					$this->tags = substr($this->tags, 0, -1);
				}
			}
		}

		$this->load->view('admin/'.$type.'_edit');
	}

	public function publish()
	{
		//TODO 提交文章
		
		$this->post_m->publish();

		redirect('admin/page');
	}

	public function del()
	{
		//TODO 删除文章
	}
}

/* End of file post.php */
/* Location: ./app/controller/admin/post.php */
