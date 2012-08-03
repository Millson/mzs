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
