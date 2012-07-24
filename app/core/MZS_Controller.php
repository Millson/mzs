<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MZS_Controller extends CI_Controller {

	protected $m_data;

	public function __construct()
	{
		parent::__construct();

		$this->load->database();

		$this->load->library('session');
		
		$this->output->enable_profiler(TRUE);
	}
}
