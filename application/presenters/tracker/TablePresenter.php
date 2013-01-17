<?php

class Tracker_TablePresenter extends Presenter
{
	public function values()
	{
		$this->ci =& get_instance();

		if (!isset($this->values))
		{
			$this->ci->load->model('value_model', 'value');
			$this->values = $this->ci->value->getManyForTracker($this->tracker->id);
		}

		return $this->values;
	}

	public function display()
	{
		$html = "<table>\n\t";
			$html .= "<thead>\n\t\t";
				$html .= "<tr><th>Value</th><th>When</th></tr>\n\t";
			$html .= "</thead>\n\t";
			$html .= "<tbody>\n\t\t";

		$values = $this->values();

		foreach ($values as $value)
		{
			$html .= "<tr><td>" . $value[1] . "</td><td>" . $value[0] . "</td></tr>\n\t\t";
		}

			$html .= "</tbody>\n";
		$html .= "</table>";

		return $html;
	}
}