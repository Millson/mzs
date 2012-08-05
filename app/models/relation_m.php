<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Relation_m extends CI_Model
{
	private $table = 'relation';

	public function __construct()
	{
		parent::__construct();
	}

	public function fetch_by_mid($mid)
	{
		$query = $this->db->get_where($this->table, array('mid'=>$mid));

		if($query->num_rows() == 0) {
			return false;
		}

		return $query->result_array();
	}

	public function fetch_by_pid($pid)
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

		return $query->row_array();
	}

	public function add($pid, $mid)
	{
		$this->db->insert($this->table, array('pid'=>$pid, 'mid'=>$mid));
	}

	public function del($pid, $mid)
	{
		$this->db->delete($this->table, array('pid'=>$pid, 'mid'=>$mid));
	}

	public function del_by_mids($mids)
	{
		if(! $mids) {
			return ;
		}
		
		if(! is_array($mids) ) {
			$mids = array($mids);
		}

		$this->db->where_in('mid', $mids);
		$this->db->delete($this->table);
	}

	public function merge($mid, $to_mid)
	{
		$r = $this->fetch_by_mid($mid);

		if(! $r) {
			retrun ;
		}

		foreach($r as $val) {
			$this->del($val['pid'], $mid);
			
			if( $this->exist($val['pid'], $to_mid) ) {
				continue;
			}

			$this->add($val['pid'], $to_mid);
			$this->meta_m->add_count($to_mid, 1);
		}
	}
}

/* End of file relation_m.php */
/* Location ./app/models/relation_m.php */
