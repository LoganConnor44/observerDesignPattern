<?php
namespace WeatherORama\Display;

use WeatherORama\Observer\IObserver as IObserver;
use WeatherORama\Subject\ISubject as ISubject;

/**
 * A concrete display which also implements an Observer and Display
 */
class Forecast implements IDisplay, IObserver {

	/**
	 * @var float
	 */
    private $currentPressure;

    /**
     * @var float
     */
    private $lastPressure;

	/**
	 * 
	 * @var interface
	 */
	private $Subject;

	/**
	 * Takes a subject interface and assigns it to the class property then registers itself
	 * @param ISubject $Subject
	 */
	public function __construct(ISubject $Subject) {
		$this->currentPressure = floatval(29.92);
		$this->Subject = $Subject;
		$this->Subject->addObserver($this);
	}

	/**
	 * Returns a brief overview based on the weather pressure
	 * @return string
	 */
	public function display() : string {
		$displayText = "Forecast: ";
		if ($this->currentPressure > $this->lastPressure) {
			$displayText .= "Improving weather on the way!";
		} else if ($this->currentPressure === $this->lastPressure) {
			$displayText .= "More of the same";
		} else if ($this->currentPressure < $this->lastPressure) {
			$displayText .= "Watch out for cooler, rainy weather";
		}
		return $displayText;
	}

	/**
	 * Updates the $lastPressure and $pressure property
	 * 
	 * @param float $temperature
	 * @param float $humidity
	 * @param float $pressure
	 * @return void
	 */ 
	public function update(float $temperature, float $humidity, float $pressure) {
		$this->lastPressure = $this->currentPressure;
		$this->currentPressure = $pressure;
		$this->display();
	}
}