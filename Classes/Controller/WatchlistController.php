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
 * Watchlist controller
 *
 * @version $Id:$
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 */
class Tx_HypeStore_Controller_WatchlistController extends Tx_Extbase_MVC_Controller_ActionController {
	
	/**
	 * @var Tx_HypeStore_Domain_Repository_CustomerRepository
	 */
	protected $customerRepository;
	
	/**
	 * @var Tx_HypeStore_Domain_Model_Customer
	 */
	protected $customer;
	
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
			$this->customer = NULL;
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
	 * @return string
	 */
	public function indexAction() {
		
		if($this->customer) {
			$this->view->assign('watchlistItems', $this->customer->getWatchlistItems());
		}
	}
	
	/**
	 * Add action for this controller.
	 *
	 * @param Tx_HypeStore_Domain_Model_Product $product
	 * @dontvalidate $product
	 * @return void
	 */
	public function addAction(Tx_HypeStore_Domain_Model_Product $product) {
		
		if($this->customer) {
			
			# check if the product to add is already on the watchlist
			$existingWatchlistItem = NULL;
			foreach($this->customer->getWatchlistItems() as $watchlistItem) {
				if($watchlistItem->getProduct() == $product) {
					$existingWatchlistItem = $watchlistItem;
					break;
				}
			}
			
			# add the product to the watchlist
			if(!$existingWatchlistItem) {
				
				# create a new watchlist item
				$watchlistItem = new Tx_HypeStore_Domain_Model_WatchlistItem;
				$watchlistItem->setProduct($product);
				$watchlistItem->setCustomer($this->customer);
				
				# add the new watchlist item
				$this->customer->addWatchlistItem($watchlistItem);
			}
			
			# display a success message
			$this->flashMessages->add('The product ' . $product->getTitle() . ' was added to the watchlist.');
		}
		
		# redirect to the watchlist
		$this->redirect('index');
	}
}
?>