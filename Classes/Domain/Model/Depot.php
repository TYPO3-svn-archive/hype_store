<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2011 Thomas "Thasmo" Deinhamer <thasmo@gmail.com>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Depot
 *
 * @package HypeStore
 * @subpackage Domain/Model
 * @version $Id:$
 * @copyright Copyright belongs to the respective authors
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 * @scope prototype
 * @entity
 */
class Tx_HypeStore_Domain_Model_Depot extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * @var string
	 * @validate StringLength(minimum = 1, maximum = 255)
	 */
	protected $title;

	/**
	 * @var string
	 * @validate StringLength(minimum = 1, maximum = 255)
	 */
	protected $street;

	/**
	 * @var int
	 * @validate Integer
	 */
	protected $postcode;

	/**
	 * @var string
	 * @validate StringLength(minimum = 1, maximum = 255)
	 */
	protected $city;

	/**
	 * @var string
	 * @validate StringLength(minimum = 1, maximum = 255)
	 */
	protected $country;

	/**
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_HypeStore_Domain_Model_ProductStock>
	 * @lazy
	 * @cascade remove
	 */
	protected $stocks;

	/**
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_HypeStore_Domain_Model_ProductState>
	 * @lazy
	 * @cascade remove
	 */
	protected $states;

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->stocks = t3lib_div::makeInstance('Tx_Extbase_Persistence_ObjectStorage');
		$this->states = t3lib_div::makeInstance('Tx_Extbase_Persistence_ObjectStorage');
	}

	/**
	 * Setter for title
	 *
	 * @param string $title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * Getter for title
	 *
	 * @return string
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Setter for street
	 *
	 * @param string $street
	 * @return void
	 */
	public function setStreet($street) {
		$this->street = $street;
	}

	/**
	 * Getter for street
	 *
	 * @return string
	 */
	public function getStreet() {
		return $this->street;
	}

	/**
	 * Setter for postcode
	 *
	 * @param string $postcode
	 * @return void
	 */
	public function setPostcode($postcode) {
		$this->postcode = $postcode;
	}

	/**
	 * Getter for postcode
	 *
	 * @return string
	 */
	public function getPostcode() {
		return $this->postcode;
	}

	/**
	 * Setter for city
	 *
	 * @param string $city
	 * @return void
	 */
	public function setCity($city) {
		$this->city = $city;
	}

	/**
	 * Getter for city
	 *
	 * @return string
	 */
	public function getCity() {
		return $this->city;
	}

	/**
	 * Setter for country
	 *
	 * @param string $country
	 * @return void
	 */
	public function setCountry($country) {
		$this->country = $country;
	}

	/**
	 * Getter for country
	 *
	 * @return string
	 */
	public function getCountry() {
		return $this->country;
	}

	/**
	 * Setter for stocks
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage $stocks
	 * @return void
	 */
	public function setStocks(Tx_Extbase_Persistence_ObjectStorage $stocks) {
		$this->stocks = $stocks;
	}

	/**
	 * Getter for stocks
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage
	 */
	public function getStocks() {
		return $this->stocks;
	}

	/**
	 * Adds a stock
	 *
	 * @param Tx_HypeStore_Domain_Model_ProductStock $stock
	 * @return void
	 */
	public function addStock(Tx_HypeStore_Domain_Model_ProductStock $stock) {
		$this->stocks->attach($stock);
	}

	/**
	 * Removes a stock
	 *
	 * @param Tx_HypeStore_Domain_Model_ProductStock $stock
	 * @return void
	 */
	public function removeStock(Tx_HypeStore_Domain_Model_ProductStock $stock) {
		$this->stocks->detach($stock);
	}

	/**
	 * Remove all stocks
	 *
	 * @return void
	 */
	public function removeStocks() {
		$this->stocks = t3lib_div::makeInstance('Tx_Extbase_Persistence_ObjectStorage');
	}

	/**
	 * Setter for states
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage $states
	 * @return void
	 */
	public function setStates(Tx_Extbase_Persistence_ObjectStorage $states) {
		$this->states = $states;
	}

	/**
	 * Getter for states
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage
	 */
	public function getStates() {
		return $this->states;
	}

	/**
	 * Adds a state
	 *
	 * @param Tx_HypeStore_Domain_Model_ProductState $state
	 * @return void
	 */
	public function addState(Tx_HypeStore_Domain_Model_ProductState $state) {
		$this->states->attach($state);
	}

	/**
	 * Removes a state
	 *
	 * @param Tx_HypeStore_Domain_Model_ProductState $state
	 * @return void
	 */
	public function removeState(Tx_HypeStore_Domain_Model_ProductState $state) {
		$this->states->detach($state);
	}

	/**
	 * Remove all states
	 *
	 * @return void
	 */
	public function removeStates() {
		$this->states = t3lib_div::makeInstance('Tx_Extbase_Persistence_ObjectStorage');
	}



	/* Magic methods */

	/**
	 * Returns as a formatted string
	 *
	 * @return string
	 */
	public function __toString() {
		return $this->getTitle();
	}
}
?>