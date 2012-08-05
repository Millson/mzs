<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Link_m extends CI_Model
{
	private $table = 'link';

	public function fetch_all($sort = '')
	{
		if($sort) {
			$this->db->where('sort', $sort);
		}

		$this->db->order_by('sort', 'asc');
		$this->db->order_by('order', 'asc');
		$query = $this->db->get($this->table);

		if($query->num_rows() == 0) {
			return false;
		}

		return $query->result_array();
	}

	public function fetch_by_lid($lid)
	{
		$query = $this->db->get_where($this->table, array('lid'=>$lid));

		if($query->num_rows() == 0) {
			return false;
		}

		return $query->row_array();
	}

	public function publish()
	{
		if($this->input->post('lid')) {
			$lid = intval($this->input->post('lid'));

			$this->update_link( $lid );
		}else{
			$this->new_link();
		}
	}

	public function new_link()
	{
		$data = array(
			'name'		=> $this->input->post('name'),
			'url'		=> $this->input->post('url'),
			'sort'		=> $this->input->post('sort'),
			'order'		=> $this->input->post('order')
		);

		$this->db->insert($this->table, $data);

		return $this->db->insert_id();
	}

	public function update_link( $lid )
	{
		$link = $this->fetch_by_lid( $lid );

		if(! $link) {
			return false;
		}

		$data = array(
			'name'		=> $this->input->post('name'),
			'url'		=> $this->input->post('url'),
			'sort'		=> $this->input->post('sort'),
			'order'		=> $this->input->post('order')
		);

		$this->db->where('lid', $lid);
		$this->db->update($this->table, $data);
	}

	public function del_link($lid)
	{
		$this->db->delete($this->table, array('lid'=>$lid));
	}
}

/* End of file link_m.php */
/* Location ./app/models/link_m.php */
