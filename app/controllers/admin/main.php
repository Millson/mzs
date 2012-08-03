<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends MZS_Controller {

	public function index()
	{
		$this->page_name = $this->page_header = '管理首页';

		$this->load->view('admin/main');
	}
}

/* End of file main.php */
/* Location: ./app/controllers/main.php */
