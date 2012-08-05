<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clean extends MZS_Controller {

	public function index()
	{
		$this->load->helper('file');

		$string = read_file('./app/cache/index.html');

		delete_files('./app/cache/');

		write_file('./app/cache/index.html', $string);

		redirect('admin');
	}
}

/* End of file clean.php */
/* Location: ./app/controllers/clean.php */
