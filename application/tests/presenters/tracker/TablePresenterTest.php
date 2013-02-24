<?php

class Tracker_TablePresenterTest extends PHPUnit_Framework_TestCase
{
	public function testInheritsFromBase()
	{
		$pre = new Tracker_TablePresenter(new stdClass);
		$this->assertTrue(is_subclass_of($pre, 'TrackerPresenter'));
	}

	public function testDisplay()
	{
		$data = array(
					array( '2012-09-25 13:41:11', '127.0.0.1' ),
					array( '2012-09-25 13:43:28', '127.0.0.1' ) );
		$html = get_instance()->load->view('presenters/table', array( 'data' => $data ), TRUE);

		$obj = (object)array( 'id' => 'website_visits' );

		$pre = Mockery::mock('Tracker_TablePresenter[values]');
		$pre->__construct($obj, 'tracker');

		$pre->shouldReceive('values')
			->andReturn($data);

		$this->assertEquals($html, $pre->display());
	}
}