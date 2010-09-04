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
 * Book
 *
 * @package HypeStore
 * @subpackage Domain/Model/Product
 * @version $Id:$
 * @copyright Copyright belongs to the respective authors
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 * @scope prototype
 * @entity
 */
class Tx_HypeStore_Domain_Model_Product_Book extends Tx_HypeStore_Domain_Model_Product {
	
	/**
	 * @var string
	 * @validate StringLength(minimum = 0, maximum = 10)
	 */
	protected $isbn10Number;
	
	/**
	 * @var string
	 * @validate StringLength(minimum = 0, maximum = 13)
	 */
	protected $isbn13Number;
	
	/**
	 * @var Tx_HypeDirectory_Domain_Model_Contact
	 * @lazy
	 */
	protected $author;
	
	/**
	 * @var Tx_HypeDirectory_Domain_Model_Contact
	 * @lazy
	 */
	protected $publisher;
	
	/**
	 * @var integer
	 * @validate Integer
	 */
	protected $publicationYear;
	
	/**
	 * @var Tx_HypeDirectory_Domain_Model_Contact
	 * @lazy
	 */
	protected $editor;
	
	/**
	 * @var integer
	 * @validate Integer
	 */
	protected $edition;
	
	/**
	 * Setter for isbn10Number
	 *
	 * @param string $isbn10Number
	 * @return void
	 */
	public function setIsbn10Number($isbn10Number) {
		$this->isbn10Number = $isbn10Number;
	}
	
	/**
	 * Getter for isbn10Number
	 *
	 * @return string
	 */
	public function getIsbn10Number() {
		return $this->isbn10Number;
	}
	
	/**
	 * Setter for isbn13Number
	 *
	 * @param string $isbn13Number
	 * @return void
	 */
	public function setIsbn13Number($isbn13Number) {
		$this->isbn13Number = $isbn13Number;
	}
	
	/**
	 * Getter for isbn13Number
	 *
	 * @return string
	 */
	public function getIsbn13Number() {
		return $this->isbn13Number;
	}
	
	/**
	 * Setter for author
	 *
	 * @param Tx_HypeDirectory_Domain_Model_Contact $author
	 * @return void
	 */
	public function setAuthor(Tx_HypeDirectory_Domain_Model_Contact $author) {
		$this->author = $author;
	}
	
	/**
	 * Getter for author
	 *
	 * @return Tx_HypeDirectory_Domain_Model_Contact
	 */
	public function getAuthor() {
		return $this->author;
	}
	
	/**
	 * Setter for publisher
	 *
	 * @param Tx_HypeDirectory_Domain_Model_Contact $publisher
	 * @return void
	 */
	public function setPublisher(Tx_HypeDirectory_Domain_Model_Contact $publisher) {
		$this->publisher = $publisher;
	}
	
	/**
	 * Getter for publisher
	 *
	 * @return Tx_HypeDirectory_Domain_Model_Contact
	 */
	public function getPublisher() {
		return $this->publisher;
	}
	
	/**
	 * Setter for publicationYear
	 *
	 * @param integer $publicationYear
	 * @return void
	 */
	public function setPublicationYear($publicationYear) {
		$this->publicationYear = $publicationYear;
	}
	
	/**
	 * Getter for publicationYear
	 *
	 * @return integer
	 */
	public function getPublicationYear() {
		return $this->publicationYear;
	}
	
	/**
	 * Setter for editor
	 *
	 * @param Tx_HypeDirectory_Domain_Model_Contact $editor
	 * @return void
	 */
	public function setEditor(Tx_HypeDirectory_Domain_Model_Contact $editor) {
		$this->editor = $editor;
	}
	
	/**
	 * Getter for editor
	 *
	 * @return Tx_HypeDirectory_Domain_Model_Contact
	 */
	public function getEditor() {
		return $this->editor;
	}
	
	/**
	 * Setter for edition
	 *
	 * @param integer $edition
	 * @return void
	 */
	public function setEdition($edition) {
		$this->edition = $edition;
	}
	
	/**
	 * Getter for edition
	 *
	 * @return integer
	 */
	public function getEdition() {
		return $this->edition;
	}
}
?>