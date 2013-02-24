<?php

class Trackers extends MY_Controller
{
	public $models = array( 'tracker', 'value' );
	public $data = array();

	public function index()
	{
		$this->data['dropdown'] = $this->tracker->dropdown('name');
	}

	public function show($id)
	{
		$this->data['tracker'] = $this->tracker->presented()->get($id);
		$this->data['dropdown'] = $this->tracker->dropdown('name');
	}

	public function add()
	{
		$this->data['dropdown'] = $this->tracker->dropdown('name');
		$this->data['trackerData'] = array( 'id' => '', 'type' => '', 'name' => '' );

		if ($tracker = $this->input->post('tracker'))
		{
			if ($this->tracker->insert($tracker) === FALSE)
			{
				$this->data['trackerData'] = $tracker;
				$this->data['validation_errors'] = validation_errors();
			}
			else
			{
				$this->_redirect('trackers/show/' . $tracker['id']);
			}
		}
	}

	public function _redirect($slug)
	{
		redirect(site_url($slug));
	}
}