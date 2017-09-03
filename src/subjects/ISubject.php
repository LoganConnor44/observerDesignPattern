<?php
namespace WeatherORama\Subject;

/**
 * An interface for all subjects to pull from
 */
interface ISubject {

	/**
	 * An abstract method to add observers for any object that implements ISubject
	 * @param object IObserver
	 */
	public function addObserver(IObserver $Observer);

	/**
	 * An abstract method to remove observers for any object that implements ISubject
	 * @param object IObserver
	 */
	public function removeObserver(IObserver $Observer);

	/**
	 * An abstract method to notify observers for any object that implements ISubject
	 */
	public function notifyObservers();
}