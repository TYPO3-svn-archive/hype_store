<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2010 Thomas "Thasmo" Deinhamer <thasmo@gmail.com>
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
 * A customer address
 *
 * @package HypeStore
 * @subpackage Domain\Model
 * @version $Id: Customer.php$
 * @scope prototype
 * @entity
 */
class Tx_HypeStore_Domain_Model_CustomerAddress extends Tx_Extbase_DomainObject_AbstractEntity {
	
	/**
	 * @var Tx_HypeStore_Domain_Model_Customer
	 * @lazy
	 */
	protected $customer;
	
	/**
	 * @var string
	 * @validate String
	 */
	protected $title;
	
	/**
	 * @var string
	 * @validate String
	 */
	protected $name;
	
	/**
	 * @var string
	 * @validate String
	 */
	protected $company;
	
	/**
	 * @var string
	 * @validate String
	 */
	protected $street;
	
	/**
	 * @var string
	 * @validate String
	 */
	protected $stair;
	
	/**
	 * @var string
	 * @validate String
	 */
	protected $floor;
	
	/**
	 * @var string
	 * @validate String
	 */
	protected $door;
	
	/**
	 * @var string
	 * @validate String
	 */
	protected $postcode;
	
	/**
	 * @var string
	 * @validate String
	 */
	protected $city;
	
	/**
	 * @var string
	 * @validate String
	 */
	protected $country;
	
	/**
	 * @var string
	 * @validate String
	 */
	protected $telephoneNumber;
	
	/**
	 * Setter for customer
	 *
	 * @param Tx_HypeStore_Domain_Model_Customer $customer
	 */
	public function setCustomer(Tx_HypeStore_Domain_Model_Customer $customer) {
		$this->customer = clone $customer;
	}
	
	/**
	 * Getter for customer
	 *
	 * @return Tx_HypeStore_Domain_Model_Customer
	 */
	public function getCustomer() {
		if($this->customer instanceof Tx_Extbase_Persistence_LazyLoadingProxy) {
			$this->customer->_loadRealInstance();
		}
		
		return clone $this->customer;
	}
	
	/**
	 * Setter for title
	 *
	 * @param string $var
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
	 * Setter for name
	 *
	 * @param string $name
	 */
	public function setName($name) {
		$this->name = $name;
	}
	
	/**
	 * Getter for name
	 *
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}
	
	/**
	 * Setter for company
	 *
	 * @param string $company
	 */
	public function setCompany($company) {
		$this->company = $var;
	}
	
	/**
	 * Getter for company
	 *
	 * @return string
	 */
	public function getCompany() {
		return $this->company;
	}
	
	/**
	 * Setter for street
	 *
	 * @param string $street
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
	 * Setter for stair
	 *
	 * @param string $stair
	 */
	public function setStair($stair) {
		$this->stair = $stair;
	}
	
	/**
	 * Getter for stair
	 *
	 * @return string
	 */
	public function getStair() {
		return $this->stair;
	}
	
	/**
	 * Setter for floor
	 *
	 * @param string $floor
	 */
	public function setFloor($floor) {
		$this->floor = $floor;
	}
	
	/**
	 * Getter for floor
	 *
	 * @return string
	 */
	public function getFloor() {
		return $this->floor;
	}
	
	/**
	 * Setter for door
	 *
	 * @param string $door
	 */
	public function setDoor($door) {
		$this->door = $door;
	}
	
	/**
	 * Getter for door
	 *
	 * @return string
	 */
	public function getDoor() {
		return $this->door;
	}
	
	/**
	 * Setter for postcode
	 *
	 * @param string $postcode
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
	 * Setter for telephoneNumber
	 *
	 * @param string $number
	 */
	public function setTelephoneNumber($number) {
		$this->telephoneNumber = $number;
	}
	
	/**
	 * Getter for telephoneNumber
	 *
	 * @return string
	 */
	public function getTelephoneNumber() {
		return $this->telephoneNumber;
	}
}
?>