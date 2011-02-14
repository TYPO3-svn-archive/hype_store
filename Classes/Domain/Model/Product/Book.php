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
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_HypeDirectory_Domain_Model_Contact>
	 * @lazy
	 */
	protected $authors;

	/**
	 * @var Tx_HypeDirectory_Domain_Model_Contact
	 */
	protected $publisher;

	/**
	 * @var integer
	 * @validate Integer
	 */
	protected $publicationYear;

	/**
	 * @var Tx_HypeDirectory_Domain_Model_Contact
	 */
	protected $editor;

	/**
	 * @var integer
	 * @validate Integer
	 */
	protected $edition;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();

		$this->authors = t3lib_div::makeInstance('Tx_Extbase_Persistence_ObjectStorage');
	}

	/*
	Example:  0-123456-47-9

	1. Begin with prefix of “978”
	2. Use the first nine numeric characters of the ISBN (include dashes)
	  978-0-123456-47-
	3. Calculate the EAN check digit using the “Mod 10 Algorithm”
	  978-0-123456-47-2

	ISBN-10     0-123456-47-9
	ISBN-13 978-0-123456-47-2
	*/

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
	 * Setter for authors
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage $authors
	 * @return void
	 */
	public function setAuthors(Tx_Extbase_Persistence_ObjectStorage $authors) {
		$this->authors = $authors;
	}

	/**
	 * Getter for authors
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage
	 */
	public function getAuthors() {
		return $this->authors;
	}

	/**
	 * Adds an author
	 *
	 * @param Tx_HypeDirectory_Domain_Model_Contact $author
	 * @return void
	 */
	public function addAuthor(Tx_HypeDirectory_Domain_Model_Contact $author) {
		$this->authors->attach($author);
	}

	/**
	 * Removes an author
	 *
	 * @param Tx_HypeDirectory_Domain_Model_Contact $author
	 * @return void
	 */
	public function removeAuthor(Tx_HypeDirectory_Domain_Model_Contact $author) {
		$this->authors->detach($author);
	}

	/**
	 * Remove all authors
	 *
	 * @return void
	 */
	public function removeAuthors() {
		$this->authors = t3lib_div::makeInstance('Tx_Extbase_Persistence_ObjectStorage');
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