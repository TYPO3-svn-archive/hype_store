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
 * Category controller
 *
 * @version $Id:$
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 */
class Tx_HypeStore_Controller_CartController extends Tx_Extbase_MVC_Controller_ActionController {
	
	/**
	 * @var Tx_HypeStore_Domain_Repository_CartItemRepository
	 */
	protected $cartItemRepository;
	
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
		
		# initialize the cart item repository
		$this->cartItemRepository = t3lib_div::makeInstance('Tx_HypeStore_Domain_Repository_CartItemRepository');
		
		# initialize the customer repository
		$this->customerRepository = t3lib_div::makeInstance('Tx_HypeStore_Domain_Repository_CustomerRepository');
		
		# initialize the price calculation service
		$this->cartService = t3lib_div::makeInstance('Tx_HypeStore_Domain_Service_CartService');
		
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
			$this->view->assign('cartItems', $this->customer->getCartItems());
			$this->view->assign('totalPrice', $this->cartService->getTotalPrice($this->customer->getCartItems()));
		}
	}
	
	/**
	 * Update action for this controller.
	 *
	 * @dontverifyrequesthash
	 * @param array $cartItems
	 * @return void
	 */
	public function updateAction(array $cartItems) {
		
		if($this->customer) {
			
			# map the new cart items onto the existing ones
			$this->propertyMapper->map(array('cartItems'), array('cartItems' => $cartItems), $this->customer);
			
			# loop through all cart items
			foreach($this->customer->getCartItems() as $cartItem) {
				
				# delete cart item with zero quantity
				if($cartItem->getQuantity() <= 0) {
					
					# remove cart item
					$this->customer->removeCartItem($cartItem);
					
					# add message: cart item was removed
					$this->flashMessages->add('The product ' . $cartItem->getProduct()->getTitle() . ' was removed due to a quantity of zero or less.');
					
				# reset the quantity to the minimum if too low
				} else if($cartItem->getQuantity() < $cartItem->getProduct()->getMinimumOrderQuantity()) {
					
					# set the minimum order quantity for the cart item
					$cartItem->setQuantity($cartItem->getProduct()->getMinimumOrderQuantity());
					
					# add message: raised to minimum quantity
					$this->flashMessages->add('The quantity of the product ' . $cartItem->getProduct()->getTitle() . ' was raised to the minimum order quantity.');
				}
			}
			
			# display a default message if none was set yet
			if(count($this->flashMessages->getAll()) == 0) {
				$this->flashMessages->add('The cart was updated.');
			}
		}
		
		# redirect to the cart
		$this->redirect('index');
	}
	
	/**
	 * Add action for this controller.
	 *
	 * @param Tx_HypeStore_Domain_Model_Product $product
	 * @param integer $quantity
	 * @dontvalidate $product
	 * @return void
	 */
	public function addAction(Tx_HypeStore_Domain_Model_Product $product, $quantity = NULL) {
		
		if($this->customer) {
			
			# check if the product to add is already in the cart
			$existingCartItem = NULL;
			foreach($this->customer->getCartItems() as $cartItem) {
				if($cartItem->getProduct() == $product) {
					$existingCartItem = $cartItem;
					break;
				}
			}
			
			# if the cart item exists, increase the quantity
			if($existingCartItem) {
				
				# determine the quantity to add to the cart
				$quantity = max($quantity, 1) + $existingCartItem->getQuantity();
				
				# calculate new quantity
				$existingCartItem->setQuantity($quantity);
				
			# if it doesnt, add a new cart item
			} else {
				
				# determine the quantity to add to the cart
				$quantity = max($product->getMinimumOrderQuantity(), $quantity, 1);
				
				# create a new cart item
				$cartItem = t3lib_div::makeInstance('Tx_HypeStore_Domain_Model_CartItem');
				$cartItem->setProduct($product);
				$cartItem->setQuantity($quantity);
				$cartItem->setCustomer($this->customer);
				
				# add the new cart item
				$this->customer->addCartItem($cartItem);
			}
			
			# display a success message
			$this->flashMessages->add('The product ' . $product->getTitle() . ' was added to the cart.');
		}
		
		# redirect the user
		if($referrer = t3lib_div::getIndpEnv('HTTP_REFERER')) {
			
			# redirect to the last visited page
			$this->redirectToURI($referrer);
			
		} else {
			
			# redirect to the cart
			$this->redirect('index');
		}
	}
	
	/**
	 * Move action for this controller.
	 *
	 * @param Tx_HypeStore_Domain_Model_CartItem $cartItem
	 * @dontvalidate $cartItem
	 * @return void
	 */
	public function moveAction(Tx_HypeStore_Domain_Model_CartItem $cartItem) {
		
		if($this->customer) {
			
			# remove the watchlist item
			$this->customer->removeCartItem($cartItem);
			
			# and add it to the cart
			$uri = $this->uriBuilder
				->reset()
				->setTargetPageUid($this->settings['view']['watchlist']['pid'])
				->uriFor('add', array('product' => $cartItem->getProduct()), 'Watchlist', 'HypeStore', 'Watchlist');
			
			$this->redirectToURI($uri);
		}
		
		$this->redirect('index');
	}
	
	/**
	 * Remove action for this controller.
	 *
	 * @param Tx_HypeStore_Domain_Model_CartItem $item
	 * @dontvalidate $cartItem
	 * @return void
	 */
	public function removeAction(Tx_HypeStore_Domain_Model_CartItem $cartItem) {
		
		if($this->customer) {
			$this->customer->removeCartItem($cartItem);
			$this->flashMessages->add('The product ' . $cartItem->getProduct()->getTitle() . ' was removed from the cart.');
		}
		
		$this->redirect('index');
	}
}
?>