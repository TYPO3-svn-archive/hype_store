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
 * Product Track
 *
 * @package HypeStore
 * @subpackage Domain/Model
 * @version $Id:$
 * @copyright Copyright belongs to the respective authors
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 * @scope prototype
 * @entity
 */
class Tx_HypeStore_Domain_Model_ProductTrack extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * @var integer
	 */
	protected $number;

	/**
	 * @var string
	 * @validate StringLength(minimum = 1, maximum = 255)
	 */
	protected $title;

	/**
	 * @var integer
	 */
	protected $length;

	/**
	 * @var string
	 */
	protected $sample;

	/**
	 * @var Tx_HypeStore_Domain_Model_Product
	 */
	protected $product;

	/**
	 * Setter for number
	 *
	 * @param integer $number
	 * @return void
	 */
	public function setNumber($number) {
		$this->number = $number;
	}

	/**
	 * Getter for number
	 *
	 * @return integer
	 */
	public function getNumber() {
		return $this->number;
	}

	/**
	 * Setter for title
	 *
	 * @param string $title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * Getter for title
	 *
	 * @return string
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Setter for length
	 *
	 * @param integer $length
	 * @return void
	 */
	public function setLength($length) {
		$this->length = $length;
	}

	/**
	 * Getter for length
	 *
	 * @return integer
	 */
	public function getLength() {
		return $this->length;
	}

	/**
	 * Setter for sample
	 *
	 * @param array $sample
	 * @return void
	 */
	public function setSample(array $sample) {
		$this->sample = implode(',', $sample);
	}

	/**
	 * Getter for sample
	 *
	 * @return array
	 */
	public function getSample() {
		if(!$this->sample) {
			return NULL;
		}

		return explode(',', $this->sample);
	}

	/**
	 * Adds a sample
	 *
	 * @param string $sample
	 * @return void
	 */
	public function addSample($sample) {
		$this->sample = implode(',', array_push(explode(',', $this->sample), $sample));
	}

	/**
	 * Removes a sample
	 *
	 * @param string $sample
	 * @return void
	 */
	public function removeSample($sample) {
		$this->sample = implode(',', array_diff(explode(',', $this->sample), array($sample)));
	}

	/**
	 * Removes all sample
	 *
	 * @return void
	 */
	//public function removeSample() {
	//	$this->sample = '';
	//}

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



	/* Magic methods */

	/**
	 * Returns as a formatted string
	 *
	 * @return string
	 */
	public function __toString() {
		return $this->getTitle();
	}
}
?>