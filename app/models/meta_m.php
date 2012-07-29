<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Meta_m extends CI_Model
{
	private $table = 'meta';

	public function __construct()
	{
		parent::__construct();
	}

	public function get_all($type = 'category')
	{
		$this->db->order_by('mid');
		$query = $this->db->get_where($this->table, array('type'=>$type));

		return $query->result_array();
	}

	public function get_by_mid($mid, $type = 'category')
	{
		$query = $this->db->get_where($this->table, array('mid'=>$mid, 'type'=>$type));

		if( $query->num_rows() == 0 ) {
			return false;
		}

		return $query->row_array();
	}

	public function get_by_name($name, $type = 'category')
	{
		$query = $this->db->get_where($this->table, array('name'=>$name, 'type'=>$type));

		if($query->num_rows() == 0) {
			return false;
		}

		return $query->row_array();
	}

	public function get_by_pid($pid, $type = 'category')
	{
		$this->db->select($this->table . '.mid');
		$this->db->from($this->table);
		$this->db->join('relation', 'relation.mid = ' . $this->table . '.mid');
		$this->db->where('relation.pid', $pid);
		$this->db->where($this->table . '.type', $type);

		$query = $this->db->get();

		return $query->result_array();
	}

	public function add_relation($pid, $mid)
	{
		$this->db->insert('relation', array('pid'=>$pid, 'mid'=>$mid));

		$this->meta_count_add($mid);

		return $this->db->insert_id();
	}

	public function del_relation($pid, $mid)
	{
		$this->db->delete('relation', array('pid'=>$pid, 'mid'=>$mid));
	}

	public function meta_count_add($mid, $value = 1)
	{
		$this->db->set('count', 'count + ' . $value, false);
		$this->db->where('mid', $mid);
		$this->db->update($this->table);
	}

	public function add_meta($name, $type = 'category', $mid = 0)
	{
		$slug = url_title($name);
	
		if(! $slug) {
			return null;
		}
	
		if( $mid != 0 ) {
			$row = $this->get_by_mid($mid, $type);

			if($row) {
				$this->db->set('name', $name);
				$this->db->set('slug', $slug);
				$this->db->where('mid', $mid);
				$this->db->update($this->table);

				return $mid;
			}
		}

		$data = array(
			'slug' 		=> $slug,
			'name'		=> $name,
			'type'		=> $type,
			'count'		=> 0,
			'order'		=> 0
		);

		$this->db->insert($this->table, $data);

		return $this->db->insert_id();
	}

	public function insert_tags($input_tags)
	{
		$tags = is_array($input_tags) ? $input_tags : array($input_tags);
		$result = array();

		foreach ($tags as $tag) {
			if (empty($tag)) {
				continue;
			}

			$row = $this->get_by_name($tag, 'tag');

			if ($row) {
				$result[] = $row['mid'];
			} else {
				$mid = $this->add_meta($tag, 'tag');
				
				if($mid) {
					$result[] = $mid;
				}
			}
		}

		return is_array($input_tags) ? $result : current($result);
	}
}

/* End of file meta_m.php */
/* Location ./app/models/meta_m.php */
