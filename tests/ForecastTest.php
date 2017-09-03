<?php

use WeatherORama\Display\Forecast as Forecast;
use WeatherORama\Subject\WeatherData as WeatherData;

/**
 * Test class for Forecast
 */
class ForecastTest extends \PHPUnit_Framework_TestCase {

	public function setUp() {
		$this->WeatherData = new WeatherData();
		$this->Forecast = new Forecast($this->WeatherData);
	}

	/**
	 * Verifies that any concrete Display is instantiated correctly
	 */
	public function testInstantiateForecast() {
		$this->assertTrue($this->Forecast instanceof WeatherORama\Display\Forecast);
	}

	/**
	 * Verifies that the Current Condtions display accurately updates the temperature and humidity
	 */
	public function testSetProperties() {
		$this->Forecast->update(
			.70,
			.33,
			.34
		);

		$reflection = new ReflectionClass($this->Forecast);
		$reflectionCurrentPressure = $reflection->getProperty('currentPressure');
		$reflectionCurrentPressure->setAccessible(TRUE);
		$reflectionLastPressure = $reflection->getProperty('lastPressure');
		$reflectionLastPressure->setAccessible(TRUE);

		$this->assertSame(
			$reflectionCurrentPressure->getValue($this->Forecast),
			.34
		);
		$this->assertSame(
			$reflectionLastPressure->getValue($this->Forecast),
			29.92
		);
	}
}