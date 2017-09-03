<?php

use WeatherORama\Display\CurrentConditions as CurrentConditions;
use WeatherORama\Subject\WeatherData as WeatherData;

/**
 * Test class for CurrentConditions
 */
class CurrentConditionsTest extends \PHPUnit_Framework_TestCase {

	public function setUp() {
		$this->WeatherData = new WeatherData();
		$this->CurrentConditions = new CurrentConditions($this->WeatherData);
	}

	/**
	 * Verifies that any concrete Displays are instantiated correctly
	 */
	public function testInstantiateCurrentConditions() {
		$this->assertTrue($this->CurrentConditions instanceof WeatherORama\Display\CurrentConditions);
	}

	/**
	 * Verifies that the Current Condtions display accurately updates the temperature and humidity
	 */
	public function testSetProperties() {
		$this->CurrentConditions->update(
			.70,
			.33,
			.34
		);

		$reflection = new ReflectionClass($this->CurrentConditions);
		$reflectionTemperature = $reflection->getProperty('temperature');
		$reflectionTemperature->setAccessible(TRUE);
		$reflectionHumidity = $reflection->getProperty('humidity');
		$reflectionHumidity->setAccessible(TRUE);

		$this->assertSame(
			$reflectionTemperature->getValue($this->CurrentConditions),
			.70
		);
		$this->assertSame(
			$reflectionHumidity->getValue($this->CurrentConditions),
			.33
		);
	}
}