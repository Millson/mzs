<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Relation_m extends CI_Model
{
	private $table = 'relation';

	public function __construct()
	{
		parent::__construct();
	}

	public function exist($pid, $mid)
	{
		$query = $this->db->get_where($this->table, array('pid'=>$pid, 'mid'=>$mid));

		if( $query->num_rows() == 0 ) {
			return false;
		}

		return true;
	}

	public function add($pid, $mid)
	{
		$this->db->insert($this->table, array('pid'=>$pid, 'mid'=>$mid));
	}

	public function del($pid, $mid)
	{
		$this->db->delete($this->table, array('pid'=>$pid, 'mid'=>$mid));
	}
}

/* End of file relation_m.php */
/* Location ./app/models/relation_m.php */
