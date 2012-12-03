<?php

class TrackersTest extends PHPUnit_Framework_TestCase
{
	public function setUp()
	{
		$this->trackers = new Trackers();
	}

	public function testModelsAreAutoloaded()
	{
		$this->assertContains('tracker', $this->trackers->models);
		$this->assertContains('value', $this->trackers->models);
	}

	public function testInheritsFromBaseController()
	{
		$this->assertTrue(is_subclass_of($this->trackers, 'MY_Controller'));
	}

	public function testTrackersAreRetrieved()
	{
		$data = array( array( 'id' => 'website_visits', 'name' => 'Website Visits' ) );
		$this->trackers->tracker = Mockery::mock('Tracker_model', array( 'get_all' => $data ));
		
		$this->trackers->index();

		$this->assertTrue(isset($this->trackers->data['trackers']), "isset(data['trackers']) is FALSE");
		$this->assertEquals($data, $this->trackers->data['trackers']);
	}

	public function testASpecificTrackerCanBeRetrieved()
	{
		$data = array( 'id' => 'website_visits', 'name' => 'Website Visits' );

		$this->trackers->tracker = Mockery::mock('Tracker_model');
		$this->trackers->tracker->shouldReceive('get')
								->with($data['id'])
								->andReturn($data);

		$this->trackers->show($data['id']);

		$this->assertTrue(isset($this->trackers->data['tracker']), "isset(data['tracker']) is FALSE");
		$this->assertEquals($data, $this->trackers->data['tracker']);
	}

	public function testValuesAreRetrieved()
	{
		$data = array( '127.0.0.1', '::1', '127.0.0.1', '127.0.0.1' );
		$tracker_id = 'website_visits';

		$this->trackers->tracker = Mockery::mock('Tracker_model', array('get' => 1));
		$this->trackers->value = Mockery::mock('Value_model');
		$this->trackers->value->shouldReceive('get_many_by')
							  ->with('tracker_id', $tracker_id)
							  ->andReturn($data);

		$this->trackers->show($tracker_id);

		$this->assertTrue(isset($this->trackers->data['values']), "isset(data['values']) is FALSE");
		$this->assertEquals($data, $this->trackers->data['values']);
	}
}