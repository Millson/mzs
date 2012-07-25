<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Post extends MZS_Controller {

	public function index()
	{
		//TODO 文章列表
		$this->m_data['site_title'] = '日志列表 - MZSAdmin';
	}

	public function edit()
	{
		if( $this->input->post() ) {
		}

		//TODO 编辑文章
		$this->m_data['site_title'] = '编辑日志 - MZSAdmin';

		$this->load->helper('form');

		$this->load->view('admin/post_edit', $this->m_data);
	}

	public function do_edit()
	{
		//TODO 提交文章
		$this->input->post('title');
	}

	public function del()
	{
		//TODO 删除文章
	}
}
