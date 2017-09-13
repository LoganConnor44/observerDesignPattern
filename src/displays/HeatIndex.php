<?php
namespace WeatherORama\Display;

use WeatherORama\Observer\IObserver as IObserver;
use WeatherORama\Subject\ISubject as ISubject;

/**
 * A concrete display which also implements an Observer and Display
 */
class HeatIndex implements IDisplay, IObserver {

	/**
	 * @var float
	 */
	private $heatIndex;

	/**
	 * @var ISubject
	 */
	private $Subject;

	public function __construct(ISubject $Subject) {
		$this->Subject = $Subject;
		$this->Subject->addObserver($this);
	}

	/**
	 * Returns a message to the user with the heat index displayed
	 * 
	 * @return string
	 */
	public function display() : string {
		return "The heat index is: $this->heatIndex";
	}

	/**
	 * Sets the $heatIndex property
	 * 
	 * @return void
	 */
	public function update(float $temperature, float $humidity, float $pressure) {
		$this->heatIndex = $this->computeHeatIndex($temperature, $humidity);
	}

	/**
	 * Returns a float value for the heat index
	 * 
	 * @param float $temperature
	 * @param float $humidity
	 * @return float
	 */
	public function computeHeatIndex(float $temperature, float $humidity) : float {
		$computedHI = (	(16.923 + (0.185212 * $temperature) + 
						(5.37941 * $humidity) - 
						(0.100254 * $temperature * $humidity) + 
						(0.00941695 * ($temperature * $temperature)) + 
						(0.00728898 * ($humidity * $humidity)) + 
						(0.000345372 * ($temperature * $temperature * $humidity)) -
						(0.000814971 * ($temperature * $humidity * $humidity)) +
						(0.0000102102 * ($temperature * $temperature * $humidity * $humidity)) -
						(0.000038646 * ($temperature * $temperature * $temperature)) +
						(0.0000291583 * ($humidity * $humidity * $humidity)) +
						(0.00000142721 * ($temperature * $temperature * $temperature * $humidity)) +
						(0.000000197483 * ($temperature * $humidity * $humidity * $humidity)) -
						(0.0000000218429 * ($temperature * $temperature * $temperature * $humidity * $humidity)) +
							0.000000000843296 * ($temperature * $temperature * $humidity * $humidity * $humidity)) -
						(0.0000000000481975 * ($temperature * $temperature * $temperature * $humidity * $humidity * $humidity))
					  );
		return $computedHI;
	}
}