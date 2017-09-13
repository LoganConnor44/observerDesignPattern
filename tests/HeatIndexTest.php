<?php

use WeatherORama\Display\HeatIndex as HeatIndex;
use WeatherORama\Subject\WeatherData as WeatherData;

/**
 * Test class for HeatIndex
 */
class HeatIndexTest extends \PHPUnit_Framework_TestCase {

	public function setUp() {
		$this->WeatherData = new WeatherData();
		$this->HeatIndex = new HeatIndex($this->WeatherData);
	}

	/**
	 * Verifies that any concrete Display is instantiated correctly
	 */
	public function testInstantiateHeatIndex() {
		$this->assertTrue($this->HeatIndex instanceof WeatherORama\Display\HeatIndex);
	}

	/**
	 * Verifies that the Heat Index display accurately updates the heat index
	 */
	public function testSetProperties() {
		$this->HeatIndex->update(
			.70,
			.33,
			.34
		);

		$reflection = new ReflectionClass($this->HeatIndex);
		$reflectionHeatIndex = $reflection->getProperty('heatIndex');
		$reflectionHeatIndex->setAccessible(TRUE);

		$this->assertTrue(is_float($reflectionHeatIndex->getValue($this->HeatIndex)));
	}

	/**
	 * Verifies the display method returns a string
	 */
	public function testDisplay() {
		$this->HeatIndex->update(
			.70,
			.33,
			.34
		);
		$this->assertTrue(is_string($this->HeatIndex->display()));
	}
}