<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Post_m extends CI_Model
{
	private $table = 'post';

	public function __construct()
	{
		parent::__construct();
	}

	public function fetch($type = 'post', $limit = 0, $page = 0)
	{
		$this->db->where($this->table.'.type', $type);
		$this->db->order_by($this->table.'.pid', 'desc');

		if( $limit != 0 ){
			$this->db->limit($limit, $page);
		}

		$query = $this->db->get($this->table);

		$result = $query->result_array();
		
		if( ! $result ) {
			die('404');
		}

		foreach($result as &$value) {
			$this->filter($value);
		}

		return $result;
	}
	
	public function fetch_by_mid($mid)
	{
		$this->db->join('relation', 'relation.pid = ' . $this->table . '.pid');
		$this->db->where('relation.mid', $mid);
		$this->db->where($this->table . '.type', 'post');
		$this->db->order_by($this->table . '.pid', 'desc');

		$query = $this->db->get($this->table);

		if( $query->num_rows() == 0 ) {
			die('404');
		}

		$result = $query->result_array();

		foreach($result as &$value) {
			$this->filter($value);
		}

		return $result;
	}

	public function fetch_by_slug($slug, $type = 'post')
	{
		$this->db->where('slug', $slug);
		$this->db->where('type', $type);
		$this->db->limit(1);

		$query = $this->db->get($this->table);

		if($query->num_rows() == 0) {
			return null;
		}

		$result = $query->row_array();

		$this->filter( $result );

		return $result;
	}

	public function fetch_neighbor($pid, $type = 'prev')
	{
		if($type == 'prev') {
			$this->db->order_by('pid', 'desc');
			$this->db->where('pid <', $pid);
		}else{
			$this->db->order_by('pid', 'asc');
			$this->db->where('pid >', $pid);
		}
		$this->db->where('type', 'post');
		$this->db->limit(1);

		$query = $this->db->get($this->table);

		if($query->num_rows() == 0) {
			return null;
		}

		$result = $query->row_array();
		
		$this->filter( $result );

		return $result;
	}

	public function fetch_by_pid($pid)
	{
		$this->db->where('pid', $pid);
		$query = $this->db->get($this->table);

		if($query->num_rows() == 0) {
			return null;
		}
		
		$result = $query->row_array();
	
		$this->filter( $result );

		return $result;
	}

	private function filter( &$post)
	{
		if($post['type'] == 'post') {
			$post['categories'] = $this->meta_m->fetch_by_pid($post['pid'], 'category');
			$post['tags'] = $this->meta_m->fetch_by_pid($post['pid'], 'tag');
		}

		$post['date'] = date("Y/m/d H:i:s", $post['created']);
	}

	public function publish()
	{
		if( $this->input->post('pid') ) {
			$pid = $this->input->post('pid');
			
			$this->update_post($pid);
		}else{
			$pid = $this->new_post();
		}

		//处理分类
		$categories = $this->input->post('category');
		
		if( empty($categories) ) {
			$categories = array('23');
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
			'type'		=> $this->input->post('type')
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
				$this->relation_m->del($pid, $meta['mid']);
				$this->meta_m->add_count($mid, -1);
			}
		}

		if($type == 'tag') {
			$metas = $this->meta_m->insert_tags($metas); //插入新tag
		}

		if($metas) {
			foreach($metas as $mid) {
				if($type == 'category' && $this->relation_m->exist($pid, $mid) ) {
					continue;
				}

				$this->relation_m->add($pid, $mid);
				$this->meta_m->add_count($mid);
			}
		}
	}
}

/* End of file post_m.php */
/* Location: ./app/models/post_m.php */
