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
 * Address step
 *
 * @version $Id:$
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 */
class Tx_HypeStore_Controller_Checkout_AddressStep extends Tx_HypeStore_Controller_Checkout_AbstractStep {

	/**
	 * @var Tx_HypeStore_Domain_Repository_CustomerRepository
	 */
	protected $customerRepository;

	public function isValid() {
		return ($GLOBALS['TSFE']->fe_user->getKey('ses', 'tx_hypestore_checkout.address'));
	}

	public function needsValidation() {
		return TRUE;
	}

	/**
	 * Initializes the current action
	 *
	 * @return void
	 */
	public function initializeAction() {

		# initialize the customer repository
		$this->customerRepository = t3lib_div::makeInstance('Tx_HypeStore_Domain_Repository_CustomerRepository');

		# load a known user
		if($GLOBALS['TSFE']->fe_user->user) {
			$this->customer = $this->customerRepository->findByUid((int)$GLOBALS['TSFE']->fe_user->user['uid']);
		# load an unknown user
		} else {

		}
	}

	public function indexAction() {
		$this->view->assign('customer', $this->customer);
	}

	/**
	 * Validates the current step
	 *
	 * @param Tx_HypeStore_Domain_Model_CustomerAddress $address
	 * @return void
	 */
	public function validateAction(Tx_HypeStore_Domain_Model_CustomerAddress $address = NULL) {

		 if($address) {
			$GLOBALS['TSFE']->fe_user->setKey('ses', 'tx_hypestore_checkout.address', serialize($address));
			$GLOBALS['TSFE']->fe_user->storeSessionData();
		 }

		 $this->redirect('index');
	}
}
?>