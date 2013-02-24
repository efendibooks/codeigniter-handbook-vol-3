<?php

class Value_modelTest extends PHPUnit_Framework_TestCase
{
	public function testGetManyForTracker()
	{
		$dbdata = array( array( 'tracker_id' => 'website_visits', 'value' => '127.0.0.1', 'created_at' => '' ),
						 array( 'tracker_id' => 'website_visits', 'value' => '66.121.684.92', 'created_at' => '' ),
						 array( 'tracker_id' => 'website_visits', 'value' => '84.124.152.11', 'created_at' => '' ) );

		$model = new Value_model();
		$model->db = Mockery::mock($model->db);
		$result = Mockery::mock('db result');

		$result->shouldReceive('result_array')->once()->andReturn($dbdata);
		$model->db->shouldReceive('where')
				  ->once()
				  ->with('tracker_id', 'website_visits')
				  ->andReturn($model->db);
		$model->db->shouldReceive('get')
				  ->once()
				  ->with('values')
				  ->andReturn($result);

		$result = $model->getManyForTracker('website_visits');

		$this->assertEquals(array_map(function($row)
		{
			return array($row['created_at'], $row['value']);
		}, 
		$dbdata),
		$result);
	}

	public function tearDown()
	{
		Mockery::close();
	}
}