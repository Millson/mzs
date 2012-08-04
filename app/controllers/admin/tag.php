<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tag extends MZS_Controller
{
	public $mid;
	public $hidden;
	public $metas;
	public $meta_name = '';
	public $meta_slug = '';

	public $type = 'tag';
	
	public function __construct()
	{
		parent::__construct();
	}

	public function index($mid = 0)
	{
		$this->page_name = '标签';

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
		}

		$this->load->view('admin/tag.php');
	}

	public function publish()
	{
		$mid = $this->meta_m->edit_meta($this->input->post('meta_name'), $this->input->post('meta_slug'), 'tag', $this->input->post('mid'));

		if($mid) {
			redirect('admin/tag/'.$mid);
		}else{
			redirect('admin/tag');
		}
	}

	public function del()
	{
		if(! $this->input->is_ajax_request()) {
			show_404();
		}

		$tags = $this->input->post('tags');
		$tags = explode(",", $tags);

		$deleted = array();

		foreach($tags as $mid) {
			$result = $this->meta_m->del($mid, 'tag');

			if($result) {
				$deleted[] = $mid;
			}
		}

		echo json_encode($deleted);
	}

	public function merge()
	{
		if(! $this->input->is_ajax_request()) {
			show_404();
		}

		$to_tag = $this->input->post('to_tag');
		
		$to_mid = $this->meta_m->insert_tags($to_tag);
		
		$tags = $this->input->post('tags');
		$tags = explode(",", $tags);

		$deleted = array();

		foreach($tags as $mid) {
			$this->relation_m->merge($mid, $to_mid);
			$this->meta_m->del($mid, 'tag');

			$deleted[] = $mid;
		}

		echo json_encode($deleted);
	}
}

/* End of file tag.php */
/* Localtion: ./app/controller/admin/tag.php */
