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
 * Manufacturer
 *
 * @package HypeStore
 * @subpackage Domain
 * @version $Id:$
 * @copyright Copyright belongs to the respective authors
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 * @scope prototype
 * @entity
 */
class Tx_HypeStore_Domain_Model_Manufacturer extends Tx_Extbase_DomainObject_AbstractEntity {
	
	/**
	 * @var string
	 */
	protected $title;
	
	/**
	 * @var string
	 */
	protected $street;
	
	/**
	 * @var int
	 */
	protected $postcode;
	
	/**
	 * @var string
	 */
	protected $city;
	
	/**
	 * @var string
	 */
	protected $country;
	
	/**
	 * @var string
	 */
	protected $telephone;
	
	/**
	 * @var string
	 */
	protected $telefax;
	
	/**
	 * @var string
	 */
	protected $email;
	
	/**
	 * @var string
	 */
	protected $website;
	
	/**
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_HypeStore_Domain_Model_Product>
	 * @lazy
	 */
	protected $products;
	
	/**
	 * Constructor
	 */
	public function __construct() {
		$this->products = new Tx_Extbase_Persistence_ObjectStorage();
	}
	
	/**
	 * Initialization
	 *
	 * return void
	 */
	public function initializeObject() {
		
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
	 * Setter for telephone
	 *
	 * @param string $telephone
	 * @return void
	 */
	public function setTelephone($telephone) {
		$this->telephone = $telephone;
	}
	
	/**
	 * Getter for telephone
	 *
	 * @return string
	 */
	public function getTelephone() {
		return $this->telephone;
	}
	
	/**
	 * Setter for telefax
	 *
	 * @param string $telefax
	 * @return void
	 */
	public function setTelefax($telefax) {
		$this->telefax = $telefax;
	}
	
	/**
	 * Getter for telefax
	 *
	 * @return string
	 */
	public function getTelefax() {
		return $this->telefax;
	}
	
	/**
	 * Setter for email
	 *
	 * @param string $email
	 * @return void
	 */
	public function setEmail($email) {
		$this->email = $email;
	}
	
	/**
	 * Getter for email
	 *
	 * @return string
	 */
	public function getEmail() {
		return $this->email;
	}
	
	/**
	 * Setter for website
	 *
	 * @param string $website
	 * @return void
	 */
	public function setWebsite($website) {
		$this->website = $website;
	}
	
	/**
	 * Getter for website
	 *
	 * @return string
	 */
	public function getWebsite() {
		return $this->website;
	}
	
	/**
	 * Setter for products
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage $products
	 * @return void
	 */
	public function setProducts(Tx_Extbase_Persistence_ObjectStorage $products) {
		$this->products = clone $products;
	}
	
	/**
	 * Adds a product
	 *
	 * @param Tx_HypeStore_Domain_Model_Product $product
	 * @return void
	 */
	public function addProduct(Tx_HypeStore_Domain_Model_Product $product) {
		$this->products->attach($product);
	}
	
	/**
	 * Removes a product
	 *
	 * @param Tx_HypeStore_Domain_Model_Product $product
	 * @return void
	 */
	public function removeProduct(Tx_HypeStore_Domain_Model_Product $product) {
		$this->products->detach($product);
	}
	
	/**
	 * Remove all products
	 *
	 * @return void
	 */
	public function removeProducts() {
		$this->products = new Tx_Extbase_Persistence_ObjectStorage();
	}
	
	/**
	 * Getter for products
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage
	 */
	public function getProducts() {
		return clone $this->products;
	}
}
?>