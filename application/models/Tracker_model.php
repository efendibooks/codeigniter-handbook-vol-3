<?php

class Tracker_model extends MY_Model
{
	public $after_get = array();

	const TABLE = 1;
	const GRAPH = 2;
	const VISITS = 3;

	public function presented()
	{
		$this->after_get[] = 'present';
		$this->after_get[] = 'removePresentation';

		return $this;
	}

	public function present($obj)
	{
		if (isset($obj->type))
		{
			switch ($obj->type)
			{
				case self::GRAPH: $type = 'Graph'; break;
				case self::VISITS: $type = 'Visits'; break;
				case self::TABLE: default: $type = 'Table'; break;
			}

			$className = 'Tracker_' . $type . 'Presenter';
			$obj = new $className($obj, 'tracker');
		}

		return $obj;
	}

	public function removePresentation($obj, $last)
	{
		if ($last)
		{
			unset($this->after_get[array_search('present', $this->after_get)]);
			unset($this->after_get[array_search('removePresentation', $this->after_get)]);
		}

		return $obj;
	}
}