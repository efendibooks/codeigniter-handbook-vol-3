<?php

class Value_model extends MY_Model
{
	public function getManyForTracker($tracker_id)
	{
		$result = $this->db->where('tracker_id', $tracker_id)
						   ->get($this->_table)
						   ->result_array();

		return array_map(function($row)
		{
			return array($row['created_at'], $row['value']);
		}, (array)$result);
	}
}