<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Post extends MZS_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('post_m');
	}

	public function index()
	{
		//TODO 文章列表
		$this->m_data['page_name'] = '日志列表';

		$this->m_data['posts'] = $this->post_m->get_by_page();

		$this->load->view('admin/post', $this->m_data);
	}

	public function edit()
	{
		if( $this->input->post() ) {
		}

		//TODO 编辑文章
		$this->m_data['page_name'] = '写新日志';

		$this->load->model('meta_m');
		$categories = $this->meta_m->get_all();

		foreach($categories as $category) {
			$this->m_data['categories'][$category['mid']] = $category['name'];
		}

		$this->load->helper('form');

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
