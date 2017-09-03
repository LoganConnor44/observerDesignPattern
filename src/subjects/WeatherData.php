<?php
namespace WeatherORama\Subject;

/**
 * A concrete subject that pulles from the ISubject interface
 */
class WeatherData implements ISubject {

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
	 * The atmospheric pressure level
	 * @var float
	 */
	private $pressure;

	/**
	 * An array of objects that contain all Observers
	 * @var array
	 */
	public $Observers;

	/**
	 * Creates an empty array 
	 */
	public function __construct() {
		$this->Observers = array();
	}

	/**
	 * Adds an Observer object to the class array property
	 * @return void
	 */
	public function addObserver(IObserver $Observer) {
		array_push($this->Observers, $Observer);
	}

	/**
	 * Removes an Observer object to the class array property 
	 * @return void
	 */
	public function removeObserver(IObserver $Observer) {
		$index = array_search($this->Observers, $Observer);
		if ($index !== FALSE) {
			unset($this->Observers[$index]);
		}
	}

	/**
	 * Iterates through the array of Oberver objects and executes the method update()
	 * @return void
	 */
	public function notifyObservers() {
		foreach ($this->Observers as $Observer) {
			$Observer->update();
		}
	}

	/**
	 * @return void
	 */
	public function measurementsChanged() {
		$this->notifyObservers();
	}

	/**
	 * @return void
	 */
	public function setMeasurements(float $temp, float $humid, float $press) {
		$this->temperature = $temp;
		$this->humidity = $humid;
		$this->pressure = $press;
		$this->measurementsChanged();
	}
}