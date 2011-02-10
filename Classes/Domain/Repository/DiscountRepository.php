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
 * A repository for Discounts
 */
class Tx_HypeStore_Domain_Repository_DiscountRepository extends Tx_Extbase_Persistence_Repository {

	/**
	 * Finds all valid discounts for a given product
	 *
	 * @param Tx_HypeStore_Domain_Model_Product $product
	 * @return array
	 */
	public function findByProduct(Tx_HypeStore_Domain_Model_Product $product) {

		# create a new query
		$query = $this->createQuery();
		$query->setOrderings(array('rate' => Tx_Extbase_Persistence_QueryInterface::ORDER_DESCENDING));

		# get all preceded categories
		$categories = $product->getPrecedingCategories();

		# chain constraints
		$constraints = array();
		foreach($categories as $category) {
			array_push($constraints, $query->contains('includedCategories', $category));
		}
		array_push($constraints, $query->contains('includedProducts', $product));

		$andConstraints = array($query->logicalOr($constraints));
		reset($categories);

		foreach($categories as $category) {
			array_push($andConstraints, $query->logicalNot($query->contains('excludedCategories', $category)));
		}
		array_push($andConstraints, $query->logicalNot($query->contains('excludedProducts', $product)));

		# apply constraints
		$query->matching($query->logicalAnd($andConstraints));

		# return results
		return $query->execute();
	}
}
?>