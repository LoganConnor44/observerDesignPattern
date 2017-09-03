<?php

use WeatherORama\Subject\WeatherData;

class WeatherDataTest extends \PHPUnit_Framework_TestCase {

	/**
	 * Verifies that any concrete Subjects are instantiated correctly
	 */
	public function testInstantiateSubjects() {
		$this->WeatherData = new WeatherData();

		$this->assertTrue($this->WeatherData instanceof WeatherORama\Subject\WeatherData);
		$this->assertTrue(is_array($this->WeatherData->Observers));
	}

	public function testSetProperties() {
		$this->WeatherData = new WeatherData();
		$this->WeatherData->setMeasurements(
			.35,
			.79,
			.88
		);

		$reflection = new ReflectionClass($this->WeatherData);
		$reflectionTemperature = $reflection->getProperty('temperature');
		$reflectionTemperature->setAccessible(TRUE);
		$reflectionHumidity = $reflection->getProperty('humidity');
		$reflectionHumidity->setAccessible(TRUE);
		$reflectionPressure = $reflection->getProperty('pressure');
		$reflectionPressure->setAccessible(TRUE);

		$this->assertSame(
			$reflectionTemperature->getValue($this->WeatherData),
			.35
		);
		$this->assertSame(
			$reflectionHumidity->getValue($this->WeatherData),
			.79
		);
		$this->assertSame(
			$reflectionPressure->getValue($this->WeatherData),
			.88
		);
	}
}