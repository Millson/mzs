<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Post extends MZS_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('post_m');
	}

	public function index($category = 0, $page = 0)
	{
		//TODO 文章列表
		$this->m_data['page_name'] = '日志列表';

		$this->m_data['posts'] = $this->post_m->fetch($category, $page);

		$this->load->view('admin/post', $this->m_data);
	}

	public function edit($pid = 0)
	{
		$this->m_data['page_name'] = '写新日志';
		$this->m_data['button_name'] = '提交';
		
		$this->load->model('meta_m');
		$categories = $this->meta_m->fetch_all();

		foreach($categories as $category) {
			$this->m_data['categories'][$category['mid']] = $category['name'];
		}

		$this->m_data['category_select'] = array();

		$this->load->helper('form');

		$this->m_data['hidden']['type'] = 'post';

		if($pid != 0) {
			$this->m_data['post'] = $this->post_m->fetch_by_pid($pid);

			if( ! $this->m_data['post'] ) {
				redirect('admin/post/edit');
			}

			$this->m_data['hidden']['pid'] = $pid;
			$this->m_data['page_name'] = '编辑日志';
			$this->m_data['button_name'] = '更新';

			foreach($this->m_data['post']['categories'] as $category) {
				$this->m_data['category_select'][] = $category['mid'];
			}
		}

		$this->load->view('admin/post_edit', $this->m_data);
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
