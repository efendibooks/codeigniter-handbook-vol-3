<?php

class Tracker_VisitsPresenterTest extends PHPUnit_Framework_TestCase
{
    public function testInheritsFromBase()
    {
        $pre = new Tracker_VisitsPresenter(new stdClass);
        $this->assertTrue(is_subclass_of($pre, 'TrackerPresenter'));
    }

    public function testDisplay()
    {
        $data = array(
                    array( '2012-09-25 13:41:11', '127.0.0.1' ),
                    array( '2012-09-25 13:43:28', '127.0.0.1' ) );

        $obj = (object)array( 'id' => 'website_visits' );

        $pre = Mockery::mock('Tracker_VisitsPresenter[values]');
        $pre->__construct($obj, 'tracker');

        $pre->shouldReceive('values')
            ->andReturn($data);
        $pre->shouldReceive('name')
            ->andReturn('Website Visits');

        $html = get_instance()->load->view('presenters/visits', array( 'data' => $data, 'tracker' => $pre ), TRUE);

        $this->assertEquals($html, $pre->display());
    }

    public function testDataTableHeader()
    {
        $pre = new Tracker_VisitsPresenter(new stdClass);
        $pre->dataTableHeaders = array( 'Day', 'Visits' );

        $this->assertEquals("[ 'Day', 'Visits' ],", $pre->dataTableHeader());
    }

    public function testDataTableHeadersExistByDefault()
    {
        $pre = new Tracker_VisitsPresenter(new stdClass);
        $this->assertEquals(array( 'Day', 'Visits' ), $pre->dataTableHeaders);
    }

    public function testDataTableData()
    {
        $data = array(
                    array( '2012-09-25 13:41:11', '127.0.0.1' ),
                    array( '2012-09-25 13:43:28', '127.0.0.1' ),
                    array( '2012-09-25 13:43:28', '127.0.0.1' ),
                    array( '2012-09-26 13:43:28', '127.0.0.1' ),
                    array( '2012-09-26 13:43:28', '127.0.0.1' ) );

        $obj = (object)array( 'id' => 'website_visits' );

        $pre = Mockery::mock('Tracker_VisitsPresenter[values]');
        $pre->__construct($obj, 'tracker');

        $pre->shouldReceive('values')
            ->andReturn($data);

        $this->assertEquals("[ '2012-09-25', 3 ],[ '2012-09-26', 2 ]", $pre->dataTableData());
    }
}