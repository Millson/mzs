<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Post_m extends CI_Model
{
	private $table = 'post';

	public function __construct()
	{
		parent::__construct();
	}

	public function fetch($type = 'post', $limit = 0, $offset = 0)
	{
		$this->db->where($this->table.'.type', $type);
		$this->db->order_by($this->table.'.pid', 'desc');

		if($limit != 0) {
			$this->db->limit($limit, $offset);
		}

		$query = $this->db->get($this->table);

		$result = $query->result_array();
		
		if( ! $result ) {
			return false;
		}

		foreach($result as &$value) {
			$this->filter($value);
		}

		return $result;
	}

	public function get_total($type = 'post')
	{
		$query = $this->db->get_where($this->table, array('type'=>$type));

		return $query->num_rows();
	}
	
	public function fetch_by_mid($mid)
	{
		$this->db->join('relation', 'relation.pid = ' . $this->table . '.pid');
		$this->db->where('relation.mid', $mid);
		$this->db->where($this->table . '.type', 'post');
		$this->db->order_by($this->table . '.pid', 'desc');

		$query = $this->db->get($this->table);

		if( $query->num_rows() == 0 ) {
			return false;
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

	public function fetch_related($pid, $tags)
	{
		$posts = array();

		foreach($tags as $mid) {
			$result = $this->fetch_by_mid($mid);

			if($result) {
				foreach($result as $r) {
					if($r['pid'] != $pid) {
						$posts[ $r['pid'] ] = $r;
					}
				}
			}
		}

		return $posts;
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
			$post['permalink'] = site_url('post/' .$post['slug']);
		}

		$post['date'] = date("Y/m/d H:i:s", $post['created']);
	}

	public function publish($type = 'post')
	{
		$this->load->library('util');

		if( $this->input->post('pid') ) {
			$pid = $this->input->post('pid');
			$this->update_post($pid, $type);
		}else{
			$pid = $this->new_post($type);
		}

		//处理分类
		$categories = $this->input->post('category');
		
		if( empty($categories) ) {
			$categories = array('23');
		}

		$this->set_meta($pid, $categories, 'category');
		$this->set_meta($pid, $this->input->post('tags'), 'tag');
	}

	public function del($pid)
	{
		$this->db->where('pid', $pid);
		$this->db->delete($this->table);

		$this->set_meta($pid, null);
		$this->set_meta($pid, null, 'tag');
	}

	private function new_post($type)
	{
		$data = array(
			'title'		=> $this->input->post('title'),
			'content'	=> $this->input->post('content'),
			'slug'		=> $this->util->make_slug( $this->input->post('slug') ),
			'created'	=> time(),
			'modified'	=> time(),
			'type'		=> $type,
			'views'		=> 0,
			'comments'	=> 0
		);

		if(! $data['title']) {
			$data['title'] = '未命名文档';
		}

		$this->db->insert($this->table, $data);

		$pid = $this->db->insert_id();

		if(! $data['slug']) {
			$this->db->where('pid', $pid);
			$this->db->update($this->table, array('slug'=>$pid));
		}

		return $pid;
	}

	private function update_post($pid, $type)
	{
		$data = array(
			'title'		=> $this->input->post('title'),
			'content'	=> $this->input->post('content'),
			'slug'		=> $this->util->make_slug( $this->input->post('slug') ),
			'modified'	=> time(),
			'type'		=> $type
		);

		if(! $data['title']) {
			$data['title'] = '未命名文档';
		}

		if(! $data['slug']) {
			$data['slug'] = $pid;
		}

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
