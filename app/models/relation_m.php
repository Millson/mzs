<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Relation_m extends CI_Model
{
	private $table = 'relation';

	public function __construct()
	{
		parent::__construct();
	}

	public function exist_meta($mid)
	{
		$query = $this->db->get_where($this->table, array('mid'=>$mid));

		if($query->num_rows() == 0) {
			return false;
		}

		return $query->result_array();
	}

	public function exist_pid($pid)
	{
		$query = $this->db->get_where($this->table, array('pid'=>$pid));

		if($query->num_rows() == 0) {
			return false;
		}

		return $query->result_array();
	}

	public function exist($pid, $mid)
	{
		$query = $this->db->get_where($this->table, array('pid'=>$pid, 'mid'=>$mid));

		if( $query->num_rows() == 0 ) {
			return false;
		}

		return $query->result_row();
	}

	public function add($pid, $mid)
	{
		$this->db->insert($this->table, array('pid'=>$pid, 'mid'=>$mid));
	}

	public function del($pid, $mid)
	{
		$this->db->delete($this->table, array('pid'=>$pid, 'mid'=>$mid));
	}

	public function merge($from, $to)
	{
		$relation = $this->exist_meta($from);

		foreach($relation as $r) {
			$this->db->set('mid', $to);
			$this->db->update($this->table, array('mid'=>$r['mid'], 'pid'=>$r['pid']));
		}
	}
}

/* End of file relation_m.php */
/* Location ./app/models/relation_m.php */
