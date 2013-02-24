<?php

class Tracker_modelTest extends PHPUnit_Framework_TestCase
{
	public $expectedConstants = array(
		'TABLE' => 1,
		'VISITS' => 2
	);
	
	public function testConstantValues()
	{
		foreach ($this->expectedConstants as $constant => $value)
		{
			$this->assertEquals($value, constant('Tracker_model::' . $constant));
		}
	}

	public function testPresentedAddsAfterGetObservers()
	{
		$tracker = new Tracker_model();

		$tracker->presented();

		$this->assertContains('present', $tracker->after_get);
		$this->assertContains('removePresentation', $tracker->after_get);
		$this->assertEquals('present', $tracker->after_get[0]);
		$this->assertEquals('removePresentation', $tracker->after_get[1]);
	}

	public function testPresent()
	{
		$tracker = new Tracker_model();

		$tableObj = (object)array( 'type' => $this->expectedConstants['TABLE'] );
		$visitsObj = (object)array( 'type' => $this->expectedConstants['VISITS'] );

		$tableObj = $tracker->present($tableObj);
		$visitsObj = $tracker->present($visitsObj);

		$this->assertThat($tableObj, $this->isInstanceOf('Tracker_TablePresenter'));
		$this->assertThat($visitsObj, $this->isInstanceOf('Tracker_VisitsPresenter'));
	}

	public function testRemovePresentationRemovesAssociatedCallbacks()
	{
		$tracker = new Tracker_model();
		
		$tracker->presented();
		$tracker->trigger('after_get', new stdClass(), TRUE);

		$this->assertNotContains('present', $tracker->after_get);
		$this->assertNotContains('removePresentation', $tracker->after_get);
	}

	public function tearDown()
	{
		Mockery::close();
	}
}