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
 * Address controller
 *
 * @version $Id:$
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 */
class Tx_HypeStore_Controller_AddressController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * @var Tx_HypeStore_Domain_Repository_CustomerRepositoryInterface
	 */
	protected $customerRepository;

	/**
	 * @var Tx_HypeStore_Domain_Model_Customer
	 */
	protected $customer = NULL;

	/**
	 * Injects the customer repository
	 *
	 * @var Tx_HypeStore_Domain_Repository_CustomerRepositoryInterface $customerRepository
	 * @return void
	 */
	public function injectCustomerRepository(Tx_HypeStore_Domain_Repository_CustomerRepositoryInterface $customerRepository) {
		$this->customerRepository = $customerRepository;
	}

	/**
	 * Initializes the current action
	 *
	 * @return void
	 */
	public function initializeAction() {

		# load extension configuration
		$this->settings['extension'] = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['hype_store']);

		# prepare product pid (flexform hack)
		$this->settings['view']['product']['pid'] = (strpos($this->settings['view']['product']['pid'], '_')) > 0
			? substr($this->settings['view']['product']['pid'], strpos($this->settings['view']['product']['pid'], '_') + 1)
			: $this->settings['view']['product']['pid'];

		# prepare watchlist pid (flexform hack)
		$this->settings['view']['watchlist']['pid'] = (strpos($this->settings['view']['watchlist']['pid'], '_')) > 0
			? substr($this->settings['view']['watchlist']['pid'], strpos($this->settings['view']['watchlist']['pid'], '_') + 1)
			: $this->settings['view']['watchlist']['pid'];

		# load a known user
		if($GLOBALS['TSFE']->fe_user->user) {
			$this->customer = $this->customerRepository->findByUid((int)$GLOBALS['TSFE']->fe_user->user['uid']);
		}
	}

	/**
	 * Initializes the view before invoking an action method.
	 *
	 * @param Tx_Extbase_View_ViewInterface $view The view to be initialized
	 * @return void
	 */
	public function initializeView(Tx_Extbase_MVC_View_ViewInterface $view) {
		$view->assign('settings', $this->settings);
	}

	/**
	 * Index action for this controller.
	 *
	 * @return void
	 */
	public function indexAction() {

		if($this->customer) {
			$this->view->assign('addresses', $this->customer->getAddresses());
		}
	}

	/**
	 * Create action for this controller.
	 *
	 * @return void
	 */
	public function createAction() {
		//$this->request->setArgument('address', '_NEW');
		$this->forward('edit');
	}

	/**
	 * Edit action for this controller.
	 *
	 * @param Tx_HypeStore_Domain_Model_CustomerAddress $address
	 * @return void
	 */
	public function editAction(Tx_HypeStore_Domain_Model_CustomerAddress $address = NULL) {
		if($address) {
			$this->view->assign('address', $address);
		}
	}

	/**
	 * Save action for this controller.
	 *
	 * @param Tx_HypeStore_Domain_Model_CustomerAddress $address
	 * @dontvalidate $address
	 * @return void
	 */
	public function saveAction(Tx_HypeStore_Domain_Model_CustomerAddress $address) {

		# save the address
		$address->setCustomer($this->customer);
		$this->customer->addAddress($address);

		# set an appropriate message
		$this->flashMessages->add('The address ' . $address->getTitle() . ' was saved.');

		# redirect to the index action
		$this->redirect('index');
	}

	/**
	 * Delete action for this controller.
	 *
	 * @param Tx_HypeStore_Domain_Model_CustomerAddress $address
	 * @return void
	 */
	public function deleteAction(Tx_HypeStore_Domain_Model_CustomerAddress $address) {

		# remove the address
		$this->customer->removeAddress($address);

		# set an appropriate message
		$this->flashMessages->add('The address ' . $address->getTitle() . ' was removed.');

		# redirect to the index action
		$this->redirect('index');
	}
}
?>