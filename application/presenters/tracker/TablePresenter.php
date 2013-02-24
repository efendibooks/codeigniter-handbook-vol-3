<?php

class Tracker_TablePresenter extends TrackerPresenter
{
	public function display()
	{
		return $this->ci->load->view('presenters/table', array( 'data' => $this->values() ), TRUE);
	}
}