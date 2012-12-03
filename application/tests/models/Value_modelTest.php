<?php

class Value_modelTest extends PHPUnit_Framework_TestCase
{
	public function testGetManyForTracker()
	{
		$dbdata = array( array( 'tracker_id' => 'website_visits', 'value' => '127.0.0.1' ),
						 array( 'tracker_id' => 'website_visits', 'value' => '66.121.684.92' ),
						 array( 'tracker_id' => 'website_visits', 'value' => '84.124.152.11' ) );

		$model = new Value_model();
		$model->db = Mockery::mock($model->db);
		$result = Mockery::mock(new CI_DB_result());

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
			return $row['value'];
		}, 
		$dbdata),
		$result);

		Mockery::close();
	}
}