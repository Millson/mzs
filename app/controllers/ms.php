<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ms extends MZS_Controller
{
	public function index()
	{
		if( $this->uri->segment(2) ) {
			show_404();
		}

		$this->page_name = '登录';
		$this->page_header = 'Login';

		$this->load->view('login');
	}

	public function login()
	{
		$uid = $this->input->post('username');
		$password = $this->input->post('password');

		$query = $this->db->get_where('user', array('uid'=>$uid));

		if($query->num_rows() == 0) {
			redirect();
		}

		$user = $query->row();

		if($user->password == md5($password)) {
			$this->session->set_userdata('username', $user->name);
			redirect('admin');
		}

		redirect();
	}
}

/* End of file main.php */
/* Location: ./app/controllers/main.php */
