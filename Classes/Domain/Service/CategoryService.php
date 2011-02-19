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
 * Category service
 */
class Tx_HypeStore_Domain_Service_CategoryService implements t3lib_singleton {

	/**
	 * @var Tx_HypeStore_Domain_Repository_ProductRepository
	 */
	protected $productRepository;

	/**
	 * Constructor
	 */
	public function __construct() {
		# instantiate the product repository
		$this->productRepository = t3lib_div::makeInstance('Tx_HypeStore_Domain_Repository_ProductRepository');
	}

	/**
	 * Determines the rootline for a given category
	 *
	 * @param Tx_HypeStore_Domain_Model_Category $category
	 * @return array
	 */
	public function getRootline(Tx_HypeStore_Domain_Model_Category $category) {

		$rootline = array($category->getUid() => $category);

		if($precedingCategories = $this->getPrecedingCategories($category)) {
			$rootline = array_merge($precedingCategories, $rootline);
		}

		return  t3lib_div::makeInstance('Tx_HypeStore_Rootline', $rootline);
	}

	/**
	 * Returns all preceding categories for a given category
	 *
	 * @param Tx_HypeStore_Domain_Model_Category $category
	 * @return array
	 */
	public function getPrecedingCategories(Tx_HypeStore_Domain_Model_Category $category) {

		$categories = array();

		if($parentCategory = $category->getParentCategory()) {
			$categories = array_merge($this->getPrecedingCategories($parentCategory), $categories);
		}

		return $categories;
	}

	/**
	 * Returns all succeeding categories for a given category
	 *
	 * @param Tx_HypeStore_Domain_Model_Category $category
	 * @return array
	 */
	public function getSucceedingCategories(Tx_HypeStore_Domain_Model_Category $category) {

		$categories = array();

		if($categories = $category->getCategories()->toArray()) {
			foreach($categories as $succeedingCategory) {
				$categories = array_merge($this->getSucceedingCategories($succeedingCategory), $categories);
			}
		}

		return $categories;
	}

	/**
	 * Returns all products for a given and all it's succeeding categories
	 *
	 * @param Tx_HypeStore_Domain_Model_Category $category
	 * @return array
	 */
	public function getDescendentProducts(Tx_HypeStore_Domain_Model_Category $category) {

		# get all categories
		$categories = array_merge(array($category), $this->getSucceedingCategories($category));

		if(count($categories) > 0) {
			return $this->productRepository->findWithCategories($categories);
		}

		return NULL;
	}
}
?>