<?php
namespace WeatherORama\Display;

use WeatherORama\Observer\IObserver as IObserver;
use WeatherORama\Subject\ISubject as ISubject;

/**
 * A concrete display which also implements an observer
 */
class CurrentConditions implements IDisplay, IObserver {

	/**
	 * The fahrenheit degree of the weather
	 * @var float
	 */
	private $temperature;

	/**
	 * The humidity index level
	 * @var float
	 */
	private $humidity;

	/**
	 * 
	 * @var interface
	 */
	private $Subject;

	/**
	 * Takes a subject interface and assigns it to the class property then registers itself
	 */
	public function __construct(ISubject $Subject) {
		$this->Subject = $Subject;
		$this->Subject->addObserver($this);
	}

	/**
	 * Returns the temperature and humidity in a string
	 * @return string
	 */
	public function display() : string {
		return "Current Conditions: $this->temperature F degrees and $this->humidity";
	}

	/**
	 * Sets the given properties to their newly updated values passed arguments
	 * @return void
	 */
	public function update(float $temp, float $humid, float $press) {
		$this->temperature = $temp;
		$this->humidity = $humid;
		$this->display();
	}
}