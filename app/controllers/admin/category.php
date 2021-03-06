<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends MZS_Controller
{
	public $mid;
	public $hidden;
	public $metas;
	public $meta_name = '';
	public $meta_slug = '';

	public $type = 'category';

	public function __construct()
	{
		parent::__construct();
	}

	public function index($mid = 0)
	{
		$this->page_name = '分类';

		$this->page_header = $this->page_name;
		$this->page_tagline = anchor('admin/category', '创建');

		$mid = intval( $mid );

		$this->metas = $this->meta_m->fetch_all($this->type);

		$this->meta_name = '';

		if($mid != 0) {
			$this->mid = $mid;

			foreach($this->metas as $meta) {
				if($meta['mid'] == $mid) {
					$this->hidden['mid'] = $mid;
					$this->meta_name = $meta['name'];
					$this->meta_slug = $meta['slug'];

					break;
				}
			}
			if(! $this->meta_name) {
				show_404();
			}
		}

		$this->load->view('admin/category.php');
	}

	public function change_order($mid, $way = 'up')
	{
		$this->meta_m->change_order($mid, $way);

		redirect('admin/category');
	}

	public function del($mid = 0)
	{
		$mid = intval($mid);

		if($mid == 0) {
			show_404();
		}

		$this->meta_m->del_category($mid);

		redirect('admin/category');
	}

	public function publish()
	{
		$mid = $this->meta_m->edit_meta($this->input->post('meta_name'), $this->input->post('meta_slug'), 'category', $this->input->post('mid'));

		if($mid) {
			redirect('admin/category/'.$mid);
		}else{
			redirect('admin/category');
		}
	}
}

/* End of file meta.php */
/* Localtion: ./app/controller/admin/meta.php */
