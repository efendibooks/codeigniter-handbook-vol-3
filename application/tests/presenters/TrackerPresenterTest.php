<?php

class TrackerPresenterTest extends PHPUnit_Framework_TestCase
{
    public function testConstructorFetchesCI()
    {
        $pre = new TrackerPresenter(new stdClass);

        $this->assertEquals(get_instance(), $pre->ci);
    }

    public function testGrabsValues()
    {
        $data = array( 1, 2, 3 );
        $obj = (object)array( 'id' => 'website_visits' );
        $pre = new TrackerPresenter($obj, 'tracker');

        $pre->ci =& get_instance();
        $pre->ci->value = Mockery::mock('Value_model');
        $pre->ci->value->shouldReceive('getManyForTracker')
                       ->once()
                       ->with('website_visits')
                       ->andReturn($data);

        $this->assertEquals($data, $pre->values());
        $this->assertEquals($data, $pre->values());
    }
}