<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Post extends MZS_Controller {

	public function index()
	{
		//TODO 文章列表
	}

	public function edit()
	{
		//TODO 编辑文章
		$this->m_data['title'] = '编辑日志 - Dashboard';

		$this->load->helper('form');

		$this->load->view('admin/post_edit', $this->m_data);
	}

	public function do_edit()
	{
		//TODO 提交文章
	}

	public function del()
	{
		//TODO 删除文章
	}
}
