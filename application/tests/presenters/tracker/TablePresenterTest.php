<?php

class Tracker_TablePresenterTest extends PHPUnit_Framework_TestCase
{
	public function testGrabsValues()
	{
		$data = array( 1, 2, 3 );
		$obj = (object)array( 'id' => 'website_visits' );
		$pre = new Tracker_TablePresenter($obj, 'tracker');

		$pre->ci =& get_instance();
		$pre->ci->value = Mockery::mock('Value_model');
		$pre->ci->value->shouldReceive('getManyForTracker')
					   ->once()
					   ->with('website_visits')
					   ->andReturn($data);

		$this->assertEquals($data, $pre->values());
		$this->assertEquals($data, $pre->values());
	}

	public function testDisplay()
	{
		$data = array( 
					array( '2012-09-25 13:41:11', '127.0.0.1' ),
					array( '2012-09-25 13:43:28', '127.0.0.1' ) );
		$html = get_instance()->load->view('presenters/table', array( 'data' => $data ), TRUE);

		$obj = (object)array( 'id' => 'website_visits' );
		$pre = Mockery::mock(new Tracker_TablePresenter($obj, 'tracker'));
		$pre->shouldReceive('values')
			->andReturn($data);

		$this->assertEquals($html, $pre->display());
	}
}