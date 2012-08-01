<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Post_m extends CI_Model
{
	private $table = 'post';

	public function __construct()
	{
		parent::__construct();

		$this->load->model('meta_m');
	}

	public function fetch($mid = 0, $page = 0)
	{
		if($mid != 0) {
			$this->db->join('relation', 'relation.pid = ' . $this->table . '.pid');
			$this->db->where('relation.mid', $mid);
		}

		$this->db->where('type', 'post');
		$this->db->order_by('pid', 'desc');
		$this->db->limit(20, $page);

		$query = $this->db->get($this->table);

		$result = $query->result_array();
		
		if( ! $result ) {
			redirect('admin/post');
		}

		foreach($result as &$value) {
			$this->filter($value);
		}

		return $result;
	}

	public function fetch_by_pid($pid)
	{
		$this->db->where('pid', $pid);
		$query = $this->db->get($this->table);

		if($query->num_rows() == 0) {
			return false;
		}

		$result = $query->row_array();

		$this->filter( $result );

		return $result;
	}

	private function filter( &$post )
	{
		$post['categories'] = $this->meta_m->fetch_by_pid($post['pid'], 'category');
		$post['tags'] = $this->meta_m->fetch_by_pid($post['pid'], 'tag');
		$post['date'] = date("Y-m-d H:i:s", $post['modified']);
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

		$this->set_meta($pid, $categories, 'category');
		$this->set_meta($pid, $this->input->post('tags'), 'tag');
	}

	public function del_post($pid)
	{
		$this->db->where('pid', $pid);
		$this->db->delete( array($this->table, 'comment', 'relation') );

		$this->set_meta($pid, null);
		$this->set_meta($pid, null, 'tag');
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

	private function set_meta($pid, $metas, $type = 'category')
	{
		//category $metas为数组; tag $metas为逗号分隔的字符串
		if($type == 'category') {
			$metas = array_unique(array_map('trim', $metas));
		}else{
			$metas = str_replace(', ', ',', $metas);
			$metas = array_unique(array_map('trim', explode(',', $metas)));
		}

		$exist_metas = $this->meta_m->fetch_by_pid($pid, $type);

		if($exist_metas) {
			foreach($exist_metas as $meta) {
				$this->meta_m->del_relation($pid, $meta['mid']);
			}
		}

		if($type == 'tag') {
			$metas = $this->meta_m->insert_tags($metas); //插入新tag
		}

		if($metas) {
			foreach($metas as $mid) {
				if($type == 'category' && $this->meta_m->fetch_by_mid($mid) ) {
					continue;
				}

				$this->meta_m->add_relation($pid, $mid);
			}
		}
	}
}
