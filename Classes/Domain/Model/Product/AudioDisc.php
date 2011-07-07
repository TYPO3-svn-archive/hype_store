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
 * Audio Disc
 *
 * @package HypeStore
 * @subpackage Domain/Model/Product
 * @version $Id:$
 * @copyright Copyright belongs to the respective authors
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 * @scope prototype
 * @entity
 */
class Tx_HypeStore_Domain_Model_Product_AudioDisc extends Tx_HypeStore_Domain_Model_Product {

	/**
	 * @var Tx_HypeStore_Domain_Model_Contact_Artist
	 */
	protected $artist;

	/**
	 * @var Tx_HypeStore_Domain_Model_Contact_Publisher
	 */
	protected $publisher;

	/**
	 * @var integer
	 * @validate Integer
	 */
	protected $publicationYear;

	/**
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_HypeStore_Domain_Model_ProductTrack>
	 * @lazy
	 */
	protected $tracks;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();

		$this->tracks = t3lib_div::makeInstance('Tx_Extbase_Persistence_ObjectStorage');
	}

	/**
	 * Setter for artist
	 *
	 * @param Tx_HypeStore_Domain_Model_Contact_Artist $artist
	 * @return void
	 */
	public function setArtist(Tx_HypeStore_Domain_Model_Contact_Artist $artist) {
		$this->artist = $artist;
	}

	/**
	 * Getter for artist
	 *
	 * @return Tx_HypeStore_Domain_Model_Contact_Artist
	 */
	public function getArtist() {
		return $this->artist;
	}

	/**
	 * Setter for publisher
	 *
	 * @param Tx_HypeStore_Domain_Model_Contact_Publisher $publisher
	 * @return void
	 */
	public function setPublisher(Tx_HypeStore_Domain_Model_Contact_Publisher $publisher) {
		$this->publisher = $publisher;
	}

	/**
	 * Getter for publisher
	 *
	 * @return Tx_HypeStore_Domain_Model_Contact_Publisher
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
	 * Setter for tracks
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage $tracks
	 * @return void
	 */
	public function setTracks(Tx_Extbase_Persistence_ObjectStorage $tracks) {
		$this->tracks = $tracks;
	}

	/**
	 * Getter for tracks
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage
	 */
	public function getTracks() {
		return $this->tracks;
	}

	/**
	 * Adds a track
	 *
	 * @param Tx_HypeStore_Domain_Model_ProductTrack $track
	 * @return void
	 */
	public function addTrack(Tx_HypeStore_Domain_Model_ProductTrack $track) {
		$this->tracks->attach($track);
	}

	/**
	 * Removes a track
	 *
	 * @param Tx_HypeStore_Domain_Model_ProductTrack $track
	 * @return void
	 */
	public function removeTrack(Tx_HypeStore_Domain_Model_ProductTrack $track) {
		$this->tracks->detach($track);
	}

	/**
	 * Remove all tracks
	 *
	 * @return void
	 */
	public function removeTracks() {
		$this->tracks = t3lib_div::makeInstance('Tx_Extbase_Persistence_ObjectStorage');
	}
}
?>