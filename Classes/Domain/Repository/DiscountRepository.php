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
 * A repository for Discounts
 */
class Tx_HypeStore_Domain_Repository_DiscountRepository extends Tx_Extbase_Persistence_Repository
	implements Tx_HypeStore_Domain_Repository_DiscountRepositoryInterface {

	/**
	 * Finds all valid discounts for a given product
	 *
	 * @param Tx_HypeStore_Domain_Model_Product $product
	 * @return array
	 */
	public function old_findByProduct(Tx_HypeStore_Domain_Model_Product $product) {

		# create a new query
		$query = $this->createQuery();
		$query->setOrderings(array('rate' => Tx_Extbase_Persistence_QueryInterface::ORDER_DESCENDING));

		# get products
		$categories = $product->getCategories();

		# build constraints
		$includedCategories = array();
		$excludedCategories = array();
		foreach($categories as $category) {
			array_push($includedCategories, $query->contains('includedCategories', $category));
			array_push($excludedCategories, $query->logicalNot($query->contains('excludedCategories', $category)));
		}
		$includedProducts = $query->contains('includedProducts', $product);
		$excludedProducts = $query->logicalNot($query->contains('excludedProducts', $product));

		# final constraint
		$constraint = $query->logicalOr(
			$query->logicalAnd(
				$query->logicalOr($includedCategories),
				$query->logicalAnd($excludedCategories)
			),
			$query->logicalAnd(
				$includedProducts,
				$excludedProducts
			)
		);

		# apply constraints
		$query->matching($constraint);

		# return results
		return $query->execute();
	}

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

		# get products
		$categories = $product->getCategories();

		# final constraint
		$constraint = $query->logicalAnd(
			$query->logicalOr(
				$query->in('includedCategories.uid', $categories),
				$query->contains('includedProducts', $product)
			),
			$query->logicalNot(
				$query->logicalOr(
					$query->in('excludedCategories.uid', $categories),
					$query->contains('excludedProducts', $product)
				)
			)
		);

		# apply constraints
		$query->matching($constraint);

		# return results
		return $query->execute();
	}
}
?>