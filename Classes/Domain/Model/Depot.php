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
 * Depot
 *
 * @package HypeStore
 * @subpackage Domain/Model
 * @version $Id:$
 * @copyright Copyright belongs to the respective authors
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 * @scope prototype
 * @entity
 */
class Tx_HypeStore_Domain_Model_Depot extends Tx_HypeStore_Domain_Model_Contact {

	/**
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_HypeStore_Domain_Model_ProductStock>
	 * @lazy
	 * @cascade remove
	 */
	protected $stocks;

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->stocks = t3lib_div::makeInstance('Tx_Extbase_Persistence_ObjectStorage');
	}

	/**
	 * Setter for stocks
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage $stocks
	 * @return void
	 */
	public function setStocks(Tx_Extbase_Persistence_ObjectStorage $stocks) {
		$this->stocks = $stocks;
	}

	/**
	 * Getter for stocks
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage
	 */
	public function getStocks() {
		return $this->stocks;
	}

	/**
	 * Adds a stock
	 *
	 * @param Tx_HypeStore_Domain_Model_ProductStock $stock
	 * @return void
	 */
	public function addStock(Tx_HypeStore_Domain_Model_ProductStock $stock) {
		$this->stocks->attach($stock);
	}

	/**
	 * Removes a stock
	 *
	 * @param Tx_HypeStore_Domain_Model_ProductStock $stock
	 * @return void
	 */
	public function removeStock(Tx_HypeStore_Domain_Model_ProductStock $stock) {
		$this->stocks->detach($stock);
	}

	/**
	 * Remove all stocks
	 *
	 * @return void
	 */
	public function removeStocks() {
		$this->stocks = t3lib_div::makeInstance('Tx_Extbase_Persistence_ObjectStorage');
	}



	/* Magic methods */

	/**
	 * Returns as a formatted string
	 *
	 * @return string
	 */
	public function __toString() {
		return $this->getName();
	}
}
?>