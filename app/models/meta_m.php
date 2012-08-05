<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Meta_m extends CI_Model
{
	private $table = 'meta';

	public function __construct()
	{
		parent::__construct();
	}

	public function fetch_all($type = 'category')
	{
		$this->db->order_by('order', 'asc');
		$this->db->order_by('count', 'asc');
		$query = $this->db->get_where($this->table, array('type'=>$type));

		if($query->num_rows() == 0) {
			return false;
		}

		return $query->result_array();
	}

	public function fetch_by_mid($mid, $type = 'category')
	{
		$query = $this->db->get_where($this->table, array('mid'=>$mid, 'type'=>$type));

		if( $query->num_rows() == 0 ) {
			return false;
		}

		return $query->row_array();
	}

	public function fetch_by_name($name, $type = 'category')
	{
		$query = $this->db->get_where($this->table, array('name'=>$name, 'type'=>$type));

		if($query->num_rows() == 0) {
			return false;
		}

		return $query->row_array();
	}

	public function fetch_by_slug($slug, $type = 'category')
	{
		$query = $this->db->get_where($this->table, array('slug'=>$slug, 'type'=>$type));

		if($query->num_rows() == 0) {
			return false;
		}

		return $query->row_array();
	}

	public function fetch_by_pid($pid, $type = 'category')
	{
		$this->db->join('relation', 'relation.mid = ' . $this->table . '.mid');
		$this->db->where('relation.pid', $pid);
		$this->db->where($this->table . '.type', $type);

		$query = $this->db->get($this->table);

		return $query->result_array();
	}

	public function add_count($mid, $value = 1)
	{
		$this->db->set('count', 'count + ' . $value, false);
		$this->db->where('mid', $mid);
		$this->db->update($this->table);
	}

	public function edit_meta($name, $slug = '', $type = 'category', $mid = 0)
	{
		if(! $slug) {
			$slug = $name;
		}

		$this->load->library('util');

		$slug = $this->util->make_slug($slug);

		if(! $slug) {
			return null;
		}

		//更新现有数据
		if( $mid != 0 ) {
			$row = $this->fetch_by_mid($mid, $type);

			if($row) {
				$this->db->set('name', $name);
				$this->db->set('slug', $slug);
				$this->db->where('mid', $mid);
				$this->db->update($this->table);

				return $mid;
			}

			return null;
		}

		//新数据
		$data = array(
			'slug' 		=> $slug,
			'name'		=> $name,
			'type'		=> $type,
			'count'		=> 0,
			'order'		=> count($this->fetch_all($type)) + 1
		);

		$this->db->insert($this->table, $data);

		return $this->db->insert_id();
	}

	public function del_category($mid)
	{
		if( $this->relation_m->fetch_by_mid($mid) ) {
			return false;
		}

		$curr_meta = $this->fetch_by_mid($mid);

		if(! $curr_meta || $curr_meta['count'] > 0) {
			return false;
		}

		$this->db->delete($this->table, array('mid'=>$mid));

		$this->db->set('order', '`order` - 1', false);
		$this->db->where('order >', $curr_meta['order']);
		$this->db->where('type', 'category');
		$this->db->update($this->table);

		return true;
	}

	public function del_tags($mids)
	{
		if(! $mids) {
			return ;
		}

		if(! is_array($mids)) {
			$mids = array($mids);
		}

		$this->db->where_in('mid', $mids);
		$this->db->delete($this->table);

		$this->relation_m->del_by_mids($mids);
	}

	public function merge_tag($mids, $to_mid)
	{
		if(! $mids) {
			return ;
		}

		if(! is_array($mids)) {
			$mids = array($mids);
		}

		if(! $to_mid) {
			return ;
		}

		foreach($mids as $mid) {
			$curr_meta = $this->fetch_by_mid($mid, 'tag');

			if(! $curr_meta) {
				continue;
			}

			$this->db->delete($this->table, array('mid'=>$mid));

			$this->relation_m->merge($mid, $to_mid);
		}
	}

	public function insert_tags($input_tags)
	{
		$tags = is_array($input_tags) ? $input_tags : array($input_tags);
		$result = array();

		foreach ($tags as $tag) {
			if (empty($tag)) {
				continue;
			}

			$row = $this->fetch_by_name($tag, 'tag');

			if ($row) {
				$result[] = $row['mid'];
			} else {
				$mid = $this->edit_meta($tag, '', 'tag');

				if($mid) {
					$result[] = $mid;
				}
			}
		}

		return is_array($input_tags) ? $result : current($result);
	}

	public function change_order($mid, $way, $type = 'category')
	{
		$curr_meta = $this->fetch_by_mid($mid, $type);

		if(! $curr_meta) {
			show_404();
		}

		$from_order = $curr_meta['order'];

		if($way == 'up') {
			$to_order = $from_order - 1;
		}else{
			$to_order = $from_order + 1;
		}

		$this->db->set('order', $from_order);
		$this->db->where('order', $to_order);
		$this->db->update($this->table);

		$this->db->set('order', $to_order);
		$this->db->where('mid', $mid);
		$this->db->update($this->table);

	}

	private function meta_slug($str, $default = null, $max_length = 200)
	{
		$str = str_replace(array("'", ":", "\\", "/", '"'), "", $str);
		$str = str_replace(array("+", ",", ' ', '，', ' ', ".", "?", "=", "&", "!", "<", ">", "(", ")", "[", "]", "{", "}"), "-", $str);
		$str = trim($str, '-');
		$str = empty($str) ? $default : $str;

		return function_exists('mb_get_info') ? mb_strimwidth($str, 0, 128, '', $this->config->item("charset")) : substr($str, 0, $max_length);
	}
}

/* End of file meta_m.php */
/* Location ./app/models/meta_m.php */
