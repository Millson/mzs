<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MZS_Controller
{
	public function index()
	{
		$this->page_name = '管理首页';

		$this->load->view('admin/main');
	}
}

/* End of file user.php */
/* Location: ./app/controllers/user.php */
