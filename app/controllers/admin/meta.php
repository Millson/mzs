<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Meta extends MZS_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('meta_m');
	}

	public function index()
	{
		$this->category();
	}

	public function category($mid = 0)
	{
		$this->m_data['page_name'] = '分类';
		$this->m_data['button_name'] = '添加分类';
		
		$this->show('category', $mid);
	}

	public function tag($mid = 0)
	{
		$this->m_data['page_name'] = '标签';
		$this->m_data['button_name'] = '添加标签';

		$this->show('tag', $mid);
	}

	private function show($type, $mid)
	{
		$mid = intval( $mid );

		$this->m_data['hidden']['type'] = $type;

		$this->m_data['metas'] = $this->meta_m->fetch_all($type);

		$this->m_data['meta_name'] = '';

		if($mid != 0) {
			foreach($this->m_data['metas'] as $meta) {
				if($meta['mid'] == $mid) {
					$this->m_data['hidden']['mid'] = $mid;
					$this->m_data['meta_name'] = $meta['name'];

					$this->m_data['button_name'] = str_replace('添加', '更新', $this->m_data['button_name']);
					break;
				}
			}
		}

		$this->load->view('admin/'.$type.'.php', $this->m_data);
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
