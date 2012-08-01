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
		$this->db->order_by('mid');
		$query = $this->db->get_where($this->table, array('type'=>$type));

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

	public function edit_meta($name, $type = 'category', $mid)
	{
		$slug = $this->meta_slug($name);
		
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

			$row = $this->fetch_by_name($tag, 'tag');

			if ($row) {
				$result[] = $row['mid'];
			} else {
				$mid = $this->edit_meta($tag, 'tag');
				
				if($mid) {
					$result[] = $mid;
				}
			}
		}

		return is_array($input_tags) ? $result : current($result);
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
