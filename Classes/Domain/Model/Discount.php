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
 * Discount
 *
 * @package HypeStore
 * @subpackage Domain
 * @version $Id:$
 * @copyright Copyright belongs to the respective authors
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 * @scope prototype
 * @entity
 */
class Tx_HypeStore_Domain_Model_Discount extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * @var string
	 * @validate StringLength(minimum = 1, maximum = 255)
	 */
	protected $title;

	/**
	 * @var integer
	 * @validate Integer
	 */
	protected $rate;

	/**
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_HypeStore_Domain_Model_Category>
	 */
	protected $includedCategories;

	/**
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_HypeStore_Domain_Model_Category>
	 */
	protected $excludedCategories;

	/**
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_HypeStore_Domain_Model_Product>
	 */
	protected $includedProducts;

	/**
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_HypeStore_Domain_Model_Product>
	 */
	protected $excludedProducts;

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->includedCategories = new Tx_Extbase_Persistence_ObjectStorage();
		$this->excludedCategories = new Tx_Extbase_Persistence_ObjectStorage();
		$this->includedProducts = new Tx_Extbase_Persistence_ObjectStorage();
		$this->excludedProducts = new Tx_Extbase_Persistence_ObjectStorage();
	}

	/**
	 * Initialization
	 *
	 * return void
	 */
	public function initializeObject() {

		# initialize the category service
		//$this->categoryService = t3lib_div::makeInstance('Tx_HypeStore_Domain_Service_CategoryService');
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
	 * Setter for rate
	 *
	 * @param integer $rate
	 * @return void
	 */
	public function setRate($rate) {
		$this->rate = $rate;
	}

	/**
	 * Getter for rate
	 *
	 * @return integer
	 */
	public function getRate() {
		return $this->rate;
	}

	/**
	 * Setter for includedCategories
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage $includedCategories
	 * @return void
	 */
	public function setIncludedCategories(Tx_Extbase_Persistence_ObjectStorage $includedCategories) {
		$this->includedCategories = clone $includedCategories;
	}

	/**
	 * Adds an includedCategory
	 *
	 * @param Tx_HypeStore_Domain_Model_Category $includedCategory
	 * @return void
	 */
	public function addIncludedCategory(Tx_HypeStore_Domain_Model_Category $includedCategory) {
		$this->includedCategories->attach($includedCategory);
	}

	/**
	 * Removes an includedCategory
	 *
	 * @param Tx_HypeStore_Domain_Model_Category $includedCategory
	 * @return void
	 */
	public function removeIncludedCategory(Tx_HypeStore_Domain_Model_Category $includedCategory) {
		$this->includedCategories->detach($includedCategory);
	}

	/**
	 * Remove all includedCategories
	 *
	 * @return void
	 */
	public function removeIncludedCategories() {
		$this->includedCategories = new Tx_Extbase_Persistence_ObjectStorage();
	}

	/**
	 * Getter for includedCategories
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage
	 */
	public function getIncludedCategories() {
		return clone $this->includedCategories;
	}

	/**
	 * Setter for excludedCategories
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage $excludedCategories
	 * @return void
	 */
	public function setExcludedCategories(Tx_Extbase_Persistence_ObjectStorage $excludedCategories) {
		$this->excludedCategories = clone $excludedCategories;
	}

	/**
	 * Adds an excludedCategory
	 *
	 * @param Tx_HypeStore_Domain_Model_Category $excludedCategory
	 * @return void
	 */
	public function addExcludedCategory(Tx_HypeStore_Domain_Model_Category $excludedCategory) {
		$this->excludedCategories->attach($excludedCategory);
	}

	/**
	 * Removes an excludedCategory
	 *
	 * @param Tx_HypeStore_Domain_Model_Category $excludedCategory
	 * @return void
	 */
	public function removeExcludedCategory(Tx_HypeStore_Domain_Model_Category $excludedCategory) {
		$this->excludedCategories->detach($excludedCategory);
	}

	/**
	 * Remove all excludedCategories
	 *
	 * @return void
	 */
	public function removeExcludedCategories() {
		$this->excludedCategories = new Tx_Extbase_Persistence_ObjectStorage();
	}

	/**
	 * Getter for excludedCategories
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage
	 */
	public function getExcludedCategories() {
		return clone $this->excludedCategories;
	}

	/**
	 * Setter for includedProducts
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage $includedProducts
	 * @return void
	 */
	public function setIncludedProducts(Tx_Extbase_Persistence_ObjectStorage $includedProducts) {
		$this->includedProducts = clone $includedProducts;
	}

	/**
	 * Adds an includedProduct
	 *
	 * @param Tx_HypeStore_Domain_Model_Product $includedProduct
	 * @return void
	 */
	public function addIncludedProduct(Tx_HypeStore_Domain_Model_Product $includedProduct) {
		$this->includedProducts->attach($includedProduct);
	}

	/**
	 * Removes an includedProduct
	 *
	 * @param Tx_HypeStore_Domain_Model_Product $includedProduct
	 * @return void
	 */
	public function removeIncludedProduct(Tx_HypeStore_Domain_Model_Product $includedProduct) {
		$this->includedProducts->detach($includedProduct);
	}

	/**
	 * Remove all includedProducts
	 *
	 * @return void
	 */
	public function removeIncludedProducts() {
		$this->includedProducts = new Tx_Extbase_Persistence_ObjectStorage();
	}

	/**
	 * Getter for includedProducts
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage
	 */
	public function getIncludedProducts() {
		return clone $this->includedProducts;
	}

	/**
	 * Setter for excludedProducts
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage $excludedProducts
	 * @return void
	 */
	public function setExcludedProducts(Tx_Extbase_Persistence_ObjectStorage $excludedProducts) {
		$this->excludedProducts = clone $excludedProducts;
	}

	/**
	 * Adds an excludedProduct
	 *
	 * @param Tx_HypeStore_Domain_Model_Product $excludedProduct
	 * @return void
	 */
	public function addExcludedProduct(Tx_HypeStore_Domain_Model_Product $excludedProduct) {
		$this->excludedProducts->attach($excludedProduct);
	}

	/**
	 * Removes an excludedProduct
	 *
	 * @param Tx_HypeStore_Domain_Model_Product $excludedProduct
	 * @return void
	 */
	public function removeExcludedProduct(Tx_HypeStore_Domain_Model_Product $excludedProduct) {
		$this->excludedProducts->detach($excludedProduct);
	}

	/**
	 * Remove all excludedProducts
	 *
	 * @return void
	 */
	public function removeExcludedProducts() {
		$this->excludedProducts = new Tx_Extbase_Persistence_ObjectStorage();
	}

	/**
	 * Getter for excludedProducts
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage
	 */
	public function getExcludedProducts() {
		return clone $this->excludedProducts;
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