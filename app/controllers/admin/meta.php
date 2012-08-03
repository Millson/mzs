<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Meta extends MZS_Controller
{
	public $button_name;
	public $hidden;
	public $metas;
	public $meta_name;

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->category();
	}

	public function category($mid = 0)
	{
		$this->page_name = '分类';
		$this->button_name = '添加分类';
		
		$this->show('category', $mid);
	}

	public function tag($mid = 0)
	{
		$this->page_name = '标签';
		$this->button_name = '添加标签';

		$this->show('tag', $mid);
	}

	private function show($type, $mid)
	{
		$this->page_header = $this->page_name;

		$mid = intval( $mid );

		$this->hidden['type'] = $type;

		$this->metas = $this->meta_m->fetch_all($type);

		$this->meta_name = '';

		if($mid != 0) {
			foreach($this->metas as $meta) {
				if($meta['mid'] == $mid) {
					$this->hidden['mid'] = $mid;
					$this->meta_name = $meta['name'];

					$this->button_name = str_replace('添加', '更新', $this->button_name);
					break;
				}
			}
		}

		$this->load->view('admin/'.$type.'.php');
	}

	public function publish()
	{
		$type = $this->input->post('type');

		if($type != 'category' && $type != 'tag') {
			redirect('admin/meta/'.$type);
		}

		$mid = $this->meta_m->edit_meta($this->input->post('meta_name'), $type, $this->input->post('mid'));

		if($mid) {
			redirect('admin/meta/'.$type.'/'.$mid);
		}else{
			redirect('admin/meta/'.$type);
		}
	}
}

/* End of file meta.php */
/* Localtion: ./app/controller/admin/meta.php */
