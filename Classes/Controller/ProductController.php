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
 * Product controller
 *
 * @version $Id:$
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 */
class Tx_HypeStore_Controller_ProductController extends Tx_Extbase_MVC_Controller_ActionController {
	
	/**
	 * @var Tx_HypeStore_Domain_Repository_ProductRepository
	 */
	protected $productRepository;
	
	/**
	 * Initializes the current action
	 *
	 * @return void
	 */
	public function initializeAction() {
		
		# initialize product repository
		$this->productRepository = t3lib_div::makeInstance('Tx_HypeStore_Domain_Repository_ProductRepository');
		
		# initialize product repository
		$this->discountRepository = t3lib_div::makeInstance('Tx_HypeStore_Domain_Repository_DiscountRepository');
		
		# prepare category pid (flexform hack)
		$this->settings['view']['category']['pid'] = (strpos($this->settings['view']['category']['pid'], '_')) > 0
			? substr($this->settings['view']['category']['pid'], strpos($this->settings['view']['category']['pid'], '_') + 1)
			: $this->settings['view']['category']['pid'];
		
		# prepare cart pid (flexform hack)
		$this->settings['view']['cart']['pid'] = (strpos($this->settings['view']['cart']['pid'], '_')) > 0
			? substr($this->settings['view']['cart']['pid'], strpos($this->settings['view']['cart']['pid'], '_') + 1)
			: $this->settings['view']['cart']['pid'];
		
		# prepare wishlist pid (flexform hack)
		$this->settings['view']['wishlist']['pid'] = (strpos($this->settings['view']['wishlist']['pid'], '_')) > 0
			? substr($this->settings['view']['wishlist']['pid'], strpos($this->settings['view']['wishlist']['pid'], '_') + 1)
			: $this->settings['view']['wishlist']['pid'];
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
	 * @param Tx_HypeStore_Domain_Model_Product $product
	 * @dontvalidate $product
	 * @return string
	 */
	public function indexAction(Tx_HypeStore_Domain_Model_Product $product = NULL) {
		
		# set a default/fallback product
		if(!$product && $this->settings['view']['product']['uid']) {
			$product = $this->productRepository->findByUid((int)$this->settings['view']['product']['uid']);
		}
		
		# overload document title
		if($this->settings['view']['product']['common']['overrideDocumentTitle']) {
			Tx_Hype_Utility_Document::setTitle($product->getTitle());
		}
		
		# assign the product to the view
		$this->view->assign('product', $product);
	}
}
?>