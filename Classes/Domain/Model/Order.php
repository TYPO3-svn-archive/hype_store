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
 * Order
 *
 * @package HypeStore
 * @subpackage Domain/Model
 * @version $Id:$
 * @copyright Copyright belongs to the respective authors
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 * @scope prototype
 * @entity
 */
class Tx_HypeStore_Domain_Model_Order extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * @var Tx_HypeStore_Domain_Model_Customer
	 */
	protected $customer;

	/**
	 * Setter for customer
	 *
	 * @param Tx_HypeStore_Domain_Model_Customer
	 * @return void
	 */
	public function setCustomer(Tx_HypeStore_Domain_Model_Customer $customer) {
		$this->customer = $customer;
	}

	/**
	 * Getter for customer
	 *
	 * @return Tx_HypeStore_Domain_Model_Customer
	 */
	public function getCustomer() {
		return $this->customer;
	}



	/* Magic methods */

	/**
	 * Returns as a formatted string
	 *
	 * @return string
	 */
	public function __toString() {
		return $this->getUid();
	}
}
?>