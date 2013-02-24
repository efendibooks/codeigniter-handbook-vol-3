<?php

class TrackersTest extends PHPUnit_Framework_TestCase
{
	public function setUp()
	{
		$this->trackers = new Trackers();
		$this->dropdown = array( 'website_visits' => 'Website Visits' );
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
		$this->trackers->tracker = Mockery::mock('tracker model', array( 'dropdown' => $this->dropdown ));
		
		$this->trackers->index();

		$this->assertTrue(isset($this->trackers->data['dropdown']), 'isset(data["dropdown"]) is FALSE');
		$this->assertEquals($this->trackers->data['dropdown'], $this->dropdown);
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
		$this->trackers->tracker = Mockery::mock($this->trackers->tracker);
		$this->trackers->tracker->shouldReceive('dropdown')
								->once()
								->andReturn($this->dropdown);

		$this->trackers->show($data->id);

		$this->assertTrue(isset($this->trackers->data['tracker']), "isset(data['tracker']) is FALSE");
		$this->assertThat($this->trackers->data['tracker'], $this->isInstanceOf('Tracker_TablePresenter'));
		$this->assertEquals($data, $this->trackers->data['tracker']->tracker);
	}

	public function testAddWillRespondToValidation()
	{
		$this->trackers->load->library('form_validation');

		$oldModel = $this->trackers->tracker;
		$this->trackers->tracker = Mockery::mock($this->trackers->tracker);
		$this->trackers->form_validation = Mockery::mock($this->trackers->form_validation);

		$error = 'Trackers error message';
		$_POST['tracker'] = array( 'id' => 'some incorrect id', 'name' => '' );

		$this->trackers->tracker->shouldReceive('insert')
							 	->once()
							 	->with($_POST['tracker'])
							 	->andReturn(FALSE);
		$this->trackers->form_validation->shouldReceive('error_string')
										->once()
										->andReturn($error);

		$this->trackers->add();

		$this->trackers->tracker = $oldModel;

		$this->assertEquals($error, $this->trackers->data['validation_errors']);
		$this->assertEquals($_POST['tracker'], $this->trackers->data['trackerData']);
	}

	public function testAddWillRedirectWhenSuccessful()
	{
		$trackers = Mockery::mock('Trackers[_redirect]');
		$trackers->__construct();

		$trackers->tracker = Mockery::mock(new Tracker_model());
		
		$_POST['tracker'] = array( 'id' => 'some-correct-id', 'name' => 'Some Correct Name' );

		$trackers->tracker->shouldReceive('insert')
		    	->once()
				->andReturn(TRUE);

		$trackers->shouldReceive('_redirect')
				 ->once()
				 ->with('trackers/show/some-correct-id');
		
		$trackers->add();
	}

	public function tearDown()
	{
		Mockery::close();
	}
}