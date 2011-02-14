<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2009 Thomas "Thasmo" Deinhamer <thasmo@gmail.com>
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
 * Category
 *
 * @package HypeStore
 * @subpackage Domain/Model
 * @version $Id:$
 * @copyright Copyright belongs to the respective authors
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 * @scope prototype
 * @entity
 */
class Tx_HypeStore_Domain_Model_Category extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * @var string
	 * @validate StringLength(minimum = 1, maximum = 255)
	 */
	protected $title;

	/**
	 * @var string
	 * @validate StringLength(minimum = 0, maximum = 255)
	 */
	protected $subtitle;

	/**
	 * @var string
	 * @validate StringLength(minimum = 0, maximum = 65000)
	 */
	protected $introduction;

	/**
	 * @var string
	 * @validate StringLength(minimum = 0, maximum = 65000)
	 */
	protected $description;

	/**
	 * @var string
	 * @validate StringLength(minimum = 0, maximum = 65000)
	 */
	protected $images;

	/**
	 * @var Tx_HypeStore_Domain_Model_Category
	 */
	protected $parentCategory;

	/**
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_HypeStore_Domain_Model_Category>
	 * @lazy
	 */
	protected $categories;

	/**
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_HypeStore_Domain_Model_Product>
	 * @lazy
	 */
	protected $products;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();

		$this->categories = t3lib_div::makeInstance('Tx_Extbase_Persistence_ObjectStorage');
		$this->products = t3lib_div::makeInstance('Tx_Extbase_Persistence_ObjectStorage');
	}

	/**
	 * Initialization
	 *
	 * return void
	 */
	public function initializeObject() {

		# initialize the category service
		$this->categoryService = t3lib_div::makeInstance('Tx_HypeStore_Domain_Service_CategoryService');
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
	 * Setter for subtitle
	 *
	 * @param string $subtitle
	 * @return void
	 */
	public function setSubtitle($subtitle) {
		$this->subtitle = $subtitle;
	}

	/**
	 * Getter for subtitle
	 *
	 * @return string
	 */
	public function getSubtitle() {
		return $this->subtitle;
	}

	/**
	 * Setter for introduction
	 *
	 * @param string $introduction
	 * @return void
	 */
	public function setIntroduction($introduction) {
		$this->introduction = $introduction;
	}

	/**
	 * Getter for introduction
	 *
	 * @return string
	 */
	public function getIntroduction() {
		return $this->introduction;
	}

	/**
	 * Setter for description
	 *
	 * @param string $description
	 * @return void
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * Getter for description
	 *
	 * @return string
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * Setter for images
	 *
	 * @param array $images
	 * @return void
	 */
	public function setImages(array $images) {
		$this->images = implode(',', $images);
	}

	/**
	 * Getter for images
	 *
	 * @return array
	 */
	public function getImages() {
		if(!$this->images) {
			return NULL;
		}

		return explode(',', $this->images);
	}

	/**
	 * Adds an image
	 *
	 * @param string $image
	 * @return void
	 */
	public function addImage($image) {
		$this->images = implode(',', array_push(explode(',', $this->images), $image));
	}

	/**
	 * Removes an image
	 *
	 * @param string $image
	 * @return void
	 */
	public function removeImage($image) {
		$this->images = implode(',', array_diff(explode(',', $this->images), array($image)));
	}

	/**
	 * Removes all images
	 *
	 * @return void
	 */
	public function removeImages() {
		$this->images = '';
	}

	/**
	 * Setter for parentCategory
	 *
	 * @param Tx_HypeStore_Domain_Model_Category $parentCategory
	 * @return void
	 */
	public function setParentCategory(Tx_HypeStore_Domain_Model_Category $parentCategory) {
		$this->parentCategory = $parentCategory;
	}

	/**
	 * Getter for parentCategory
	 *
	 * @return Tx_HypeStore_Domain_Model_Category
	 */
	public function getParentCategory() {
		return $this->parentCategory;
	}

	/**
	 * Setter for categories
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage $categories
	 * @return void
	 */
	public function setCategories(Tx_Extbase_Persistence_ObjectStorage $categories) {
		$this->categories = $categories;
	}

	/**
	 * Getter for categories
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage
	 */
	public function getCategories() {
		return $this->categories;
	}

	/**
	 * Adds a category
	 *
	 * @param Tx_HypeStore_Domain_Model_Category $category
	 * @return void
	 */
	public function addCategory(Tx_HypeStore_Domain_Model_Category $category) {
		$this->categories->attach($category);
	}

	/**
	 * Removes a category
	 *
	 * @param Tx_HypeStore_Domain_Model_Category $category
	 * @return void
	 */
	public function removeCategory(Tx_HypeStore_Domain_Model_Category $category) {
		$this->categories->detach($category);
	}

	/**
	 * Remove all categories
	 *
	 * @return void
	 */
	public function removeCategories() {
		$this->categories = t3lib_div::makeInstance('Tx_Extbase_Persistence_ObjectStorage');
	}

	/**
	 * Setter for products
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage $products
	 * @return void
	 */
	public function setProducts(Tx_Extbase_Persistence_ObjectStorage $products) {
		$this->products = $products;
	}

	/**
	 * Getter for products
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage
	 */
	public function getProducts() {
		return $this->products;
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
		$this->products = t3lib_div::makeInstance('Tx_Extbase_Persistence_ObjectStorage');
	}



	/* Custom getter methods */

	/**
	 * Returns all descendent products
	 *
	 * @return array
	 */
	public function getDescendentProducts() {

		# get the desdendent products from the service
		return $this->categoryService->getDescendentProducts($this);
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