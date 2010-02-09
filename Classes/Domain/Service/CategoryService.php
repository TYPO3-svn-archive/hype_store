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
	 * Determines the existing rootlines for a given category
	 *
	 * @param Tx_HypeStore_Domain_Model_Category $category
	 * @return array
	 */
	public function getRootlines(Tx_HypeStore_Domain_Model_Category $category) {
		
		if(count($category->getParentCategories()) > 0) {
			
			$rootlines = array($category->getUid() => $category);
			
			foreach($category->getParentCategories() as $category) {
				$rootlines = array($category->getUid() => $this->getRootlines($category)) + $rootlines;
			}
			
			return new Tx_HypeStore_Rootline($rootlines);
		} else {
			return $category;
		}
	}
	
	/**
	 * Returns the descendent products of the given and all child categories
	 *
	 * @param Tx_HypeStore_Domain_Model_Category $category
	 * @return array
	 */
	public function getDescendentProducts(Tx_HypeStore_Domain_Model_Category $category) {

		# get direct products
		$products = $category->getProducts()->toArray();

		if(count($category->getCategories()) > 0) {

			foreach($category->getCategories() as $childCategory) {
				$products = $this->getDescendentProducts($childCategory) + $products;
			}

			return $products;
		} else {
			return $products;
		}
	}
}
?>