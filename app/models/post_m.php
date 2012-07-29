<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Post_m extends CI_Model
{
	private $table = 'post';

	public function __construct()
	{
		parent::__construct();

		$this->load->model('meta_m');
	}

	public function get_by_page($page = 0)
	{
	}

	public function get_by_pid($pid)
	{
		$this->db->where('pid', $pid);
		$query = $this->db->get($this->table);

		if($query->num_rows() == 0) {
			return false;
		}

		return $query->row_array();
	}

	public function publish()
	{
		if( $this->input->post('pid') ) {
			$pid = $this->input->post('pid');
			
			$this->update_post();
		}else{
			$pid = $this->new_post();
		}

		//处理分类
		$categories = $this->input->post('category');

		if( empty($categories) ) {
			$categories = array('1');
		}

		$this->set_categories($pid, $categories);

		//处理标签
		$this->set_tags($pid, $this->input->post('tags'));
	}

	public function del_post($pid)
	{
		$this->db->where('pid', $pid);
		$this->db->delete( array($this->table, 'comment', 'relation') );

		$this->set_categories($pid, null);
		$this->set_tags($pid, null);
	}

	private function new_post()
	{
		$data = array(
			'title'		=> $this->input->post('title'),
			'content'	=> $this->input->post('content'),
			'slug'		=> $this->input->post('slug'),
			'created'	=> time(),
			'modified'	=> time(),
			'type'		=> 'post',
			'views'		=> 0,
			'comments'	=> 0
		);

		$this->db->insert($this->table, $data);

		return $this->db->insert_id();
	}

	private function update_post($pid)
	{
		$data = array(
			'title'		=> $this->input->post('title'),
			'content'	=> $this->input->post('content'),
			'slug'		=> $this->input->post('slug'),
			'modified'	=> time(),
			'type'		=> 'post'
		);

		$this->db->where('pid', $pid);
		$this->db->update($this->table, $data);
	}

	private function set_categories($pid, array $categories)
	{
		$categories = array_unique(array_map('trim', $categories));

		//取出已有category
		$exist_categories = $this->meta_m->get_by_pid($pid);

		//删除已有category
		if($exist_categories) {
			foreach($exist_categories as $category) {
				$this->meta_m->del_relation($pid, $category);
			}
		}

		//插入新category
		if( $categories ) {
			foreach($categories as $category) {
				if(! $this->meta_m->get_by_mid($category) ) {
					continue;
				}

				$this->meta_m->add_relation($pid, $category);
			}
		}
	}

	private function set_tags($pid, $tags)
	{
		$tags = str_replace('，', ',', $tags);
		$tags = array_unique(array_map('trim', explode(',', $tags)));

		//取出已有tags
		$exist_tags = $this->meta_m->get_by_pid($pid, 'tag');

		//删除已有tags
		if( $exist_tags ) {
			foreach( $exist_tags as $tag ) {
				$this->meta_m->del_relation($pid, $tag);
			}
		}

		$insert_tags = $this->meta_m->insert_tags($tags);

		//添加tags
		if($insert_tags) {
			foreach($insert_tags as $tag) {
				$this->meta_m->add_relation($pid, $tag);
			}
		}
	}
}
