<?php
/*                                                                        *
 * This script belongs to the FLOW3 package "Fluid".                      *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License as published by the *
 * Free Software Foundation, either version 3 of the License, or (at your *
 * option) any later version.                                             *
 *                                                                        *
 * This script is distributed in the hope that it will be useful, but     *
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHAN-    *
 * TABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Lesser       *
 * General Public License for more details.                               *
 *                                                                        *
 * You should have received a copy of the GNU Lesser General Public       *
 * License along with the script.                                         *
 * If not, see http://www.gnu.org/licenses/lgpl.html                      *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

/**
 * View helper for filtering products
 */
class Tx_HypeStore_ViewHelpers_Product_FilterViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

	/**
	 * @var Tx_HypeStore_Domain_Repository_AttributeRepository
	 */
	protected $attributeRepository;

	/**
	 * @var Tx_HypeStore_Domain_Service_ProductService
	 */
	protected $productService;

	/**
	 *
	 */
	public function __construct() {

		# initialize attribute repository
		$this->attributeRepository = t3lib_div::makeInstance('Tx_HypeStore_Domain_Repository_AttributeRepository');

		# initialize the product service
		$this->productService = t3lib_div::makeInstance('Tx_HypeStore_Domain_Service_ProductService');
	}

	/**
	 * Filters the products
	 *
	 * @param mixed $products
	 * @param array $filter
	 * @return Tx_Extbase_Persistence_ObjectStorage
	 * @author Thomas "Thasmo" Deinhamer <thasmo@gmail.com>
	 * @api
	 */
	public function render($products, array $filter = NULL) {

		# return all products if no filter was set
		if(is_null($filter)) {
			return $products;
		}

		# load attribute
		$attribute = $this->attributeRepository->findByUid($filter['uid']);

		# filter products
		$filteredProducts = array();

		foreach($products as $product) {
			if($this->productService->hasAttribute($product, $attribute, $filter['value'])) {
				array_push($filteredProducts, $product);
			}
		}

		return $filteredProducts;
	}
}
?>