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
 * Category service
 */
class Tx_HypeStore_Domain_Service_CategoryService implements t3lib_singleton {
	
	/**
	 * Constructor
	 */
	public function __construct() {
		# instantiate the product repository
		$this->productRepository = t3lib_div::makeInstance('Tx_HypeStore_Domain_Repository_ProductRepository');
	}
	
	/**
	 * Determines the existing rootlines for a given category
	 *
	 * @param Tx_HypeStore_Domain_Model_Category $category
	 * @return array
	 */
	public function getRootlines(Tx_HypeStore_Domain_Model_Category $category) {
		
		$rootlines = array($category->getUid() => $category);
		
		if(count($category->getParentCategories()) > 0) {
			foreach($category->getParentCategories() as $subcategory) {
				if(count($subcategory->getParentCategories()) > 0) {
					$rootlines = array($subcategory->getUid() => $this->getRootlines($subcategory)) + $rootlines;
				}
			}
		}
		
		return new Tx_HypeStore_Rootline($rootlines);
	}
	
	/**
	 * Returns all preceded categories for a given category
	 *
	 * @param Tx_HypeStore_Domain_Model_Category $category
	 * @return array
	 */
	public function getPrecededCategories(Tx_HypeStore_Domain_Model_Category $category) {
		
		# get direct categories
		$categories = $category->getParentCategories()->toArray();
		
		if(count($categories) > 0) {
			foreach($categories as $parentCategory) {
				$categories = array_merge($this->getPrecededCategories($parentCategory), $categories);
			}
			
			return $categories;
		} else {
			return $categories;
		}
	}
	
	/**
	 * Returns all descendent categories for the given category
	 *
	 * @param Tx_HypeStore_Domain_Model_Category $category
	 * @return array
	 */
	public function getDescendentCategories(Tx_HypeStore_Domain_Model_Category $category) {
		
		# get direct categories
		$categories = $category->getCategories()->toArray();
		
		if(count($categories) > 0) {
			foreach($categories as $childCategory) {
				$categories = $this->getDescendentCategories($childCategory) + $categories;
			}
			
			return $categories;
		} else {
			return $categories;
		}
	}
	
	/**
	 * Returns all products for the given and all descendent categories
	 *
	 * @param Tx_HypeStore_Domain_Model_Category $category
	 * @return array
	 */
	public function getDescendentProducts(Tx_HypeStore_Domain_Model_Category $category) {
		
		# get all categories
		$categories = array($category) + $this->getDescendentCategories($category) ;
		
		if(count($categories) > 0) {
			return $this->productRepository->findWithCategories($categories);
		}
		
		return NULL;
	}
}
?>