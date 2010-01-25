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
 * Product state
 *
 * @package HypeStore
 * @subpackage Domain
 * @version $Id:$
 * @copyright Copyright belongs to the respective authors
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 * @scope prototype
 * @entity
 */
class Tx_HypeStore_Domain_Model_ProductState extends Tx_Extbase_DomainObject_AbstractEntity {
	
	/**
	 * @var Tx_HypeStore_Domain_Model_Depot
	 * @lazy
	 */
	protected $depot;
	
	/**
	 * @var Tx_HypeStore_Domain_Model_Product
	 * @lazy
	 */
	protected $product;
	
	/**
	 * @var int
	 * @validate Integer
	 */
	protected $quantity;
	
	/**
	 * @var DateTime
	 */
	protected $disposalDate;
	
	/**
	 * @var DateTime
	 */
	protected $returnDate;
	
	/**
	 * @var int
	 * @validate Integer
	 */
	protected $type;
	
	/**
	 * Constructor
	 */
	public function __construct() {
		$this->disposalDate = new DateTime;
		$this->returnDate = new DateTime;
	}
	
	/**
	 * Setter for product
	 *
	 * @param Tx_HypeStore_Domain_Model_Product $product
	 * @return void
	 */
	public function setProduct(Tx_HypeStore_Domain_Model_Product $product) {
		$this->product = $product;
	}
	
	/**
	 * Getter for product
	 *
	 * @return Tx_HypeStore_Domain_Model_Product
	 */
	public function getProduct() {
		return $this->product;
	}
	
	/**
	 * Setter for depot
	 *
	 * @param Tx_HypeStore_Domain_Model_Depot $depot
	 * @return void
	 */
	public function setDepot(Tx_HypeStore_Domain_Model_Depot $depot) {
		$this->depot = $depot;
	}
	
	/**
	 * Getter for depot
	 *
	 * @return Tx_HypeStore_Domain_Model_Depot
	 */
	public function getDepot() {
		return $this->depot;
	}
	
	/**
	 * Setter for quantity
	 *
	 * @param int $quantity
	 * @return void
	 */
	public function setQuantity($quantity) {
		$this->quantity = $quantity;
	}
	
	/**
	 * Getter for quantity
	 *
	 * @return int
	 */
	public function getQuantity() {
		return $this->quantity;
	}
	
	/**
	 * Setter for disposal date
	 *
	 * @param DateTime $date
	 * @return void
	 */
	public function setDisposalDate(DateTime $date) {
		$this->disposalDate = $date;
	}
	
	/**
	 * Getter for disposal date
	 *
	 *
	 * @return DateTime
	 */
	public function getDisposalDate() {
		return $this->disposalDate;
	}
	
	/**
	 * Setter for return date
	 *
	 * @param DateTime $date
	 * @return void
	 */
	public function setReturnDate(DateTime $date) {
		$this->returnDate = $date;
	}
	
	/**
	 * Getter for returnDate date
	 *
	 *
	 * @return DateTime
	 */
	public function getReturnDate() {
		return $this->returnDate;
	}
	
	/**
	 * Setter for type
	 *
	 * @param int $type
	 * @return void
	 */
	public function setType($type) {
		$this->type = $type;
	}
	
	/**
	 * Getter for type
	 *
	 * @return int
	 */
	public function getType() {
		return $this->type;
	}
	
	/**
	 * Returns as a formatted string
	 *
	 * @return string
	 */
	public function __toString() {
		//return (string)$this->getValue();
	}
}
?>