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
 * A repository for Categories
 */
class Tx_HypeStore_Domain_Repository_CategoryRepository extends Tx_Extbase_Persistence_Repository {

	protected $referencedCategories = array();

	public function findMainCategories() {
		$categories = $this->findAll();

		foreach($categories as $category) {
			$subcategories = $category->getCategories();

			foreach($subcategories as $subcategory) {
				if(!in_array($subcategory->getUid(), $this->referencedCategories)) {
					array_push($this->referencedCategories, $subcategory->getUid());
				}
			}
		}

		foreach($categories as $key => $category) {
			if(in_array($category->getUid(), $this->referencedCategories)) {
				unset($categories[$key]);
			}
		}

		return $categories;
	}
}
?>