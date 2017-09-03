<?php
namespace WeatherORama\Observer;

/**
 * An interface for all observers to pull from
 */
interface IObserver {

	/**
	 * An abstract method to update the observers for any object that implements IObserver
	 * @param float $temperature
	 * @param float $humidity
	 * @param float $pressure
	 */
	public function update(float $temperature, float $humidity, float $pressure);
}