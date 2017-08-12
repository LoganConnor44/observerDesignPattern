<?php
namespace WeatherORama;

/**
 * An interface for all observers to pull from
 */
interface IObserver {

	/**
	 * An abstract method to update the observers for any object that implements IObserver
	 * @todo possibly pass in properties from the subject
	 */
	public function update();
}