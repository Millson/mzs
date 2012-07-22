<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends MZS_Controller {

	public function index()
	{
		$this->m_data['title'] = 'MZS Admin';

		$this->load->view('admin/main', $this->m_data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
