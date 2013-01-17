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
		$data = (object)array( 'id' => 'website_visits', 'type' => Tracker_model::TABLE, 'name' => 'Website Visits' );

		$result = Mockery::mock('db result');
		$result->shouldReceive('row')->once()->andReturn($data);

		$this->trackers->tracker->db = Mockery::mock($this->trackers->tracker->db);
		$this->trackers->tracker->db->shouldReceive('where')
								    ->once()
								    ->with('id', 'website_visits')
								    ->andReturn($this->trackers->tracker->db);
		$this->trackers->tracker->db->shouldReceive('get')
									->once()
									->with('trackers')
									->andReturn($result);

		$this->trackers->show($data->id);

		$this->assertTrue(isset($this->trackers->data['tracker']), "isset(data['tracker']) is FALSE");
		$this->assertThat($this->trackers->data['tracker'], $this->isInstanceOf('Tracker_TablePresenter'));
		$this->assertEquals($data, $this->trackers->data['tracker']->tracker);
	}
}