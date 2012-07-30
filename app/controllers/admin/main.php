<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends MZS_Controller {

	public function index()
	{
		$this->m_data['page_name'] = '管理首页';

		$this->load->view('admin/main', $this->m_data);
	}
}

/* End of file main.php */
/* Location: ./app/controllers/main.php */
