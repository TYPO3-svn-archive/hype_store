<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2009 Thomas "Thasmo" Deinhamer <thasmo@gmail.com>
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
	 * Initializes the view before invoking an action method.
	 *
	 * @param Tx_Extbase_View_ViewInterface $view The view to be initialized
	 * @return void
	 */
	public function initializeView(Tx_Extbase_MVC_View_ViewInterface $view) {
		$this->view->assign('settings', $this->settings);
	}
	
	/**
	 * Initializes the current action
	 *
	 * @return void
	 */
	public function initializeAction() {
		$this->productRepository = t3lib_div::makeInstance('Tx_HypeStore_Domain_Repository_ProductRepository');
	}
	
	/**
	 * Index action for this controller.
	 *
	 * @param Tx_HypeStore_Domain_Model_Product $product
	 * @return string
	 * @dontvalidate $product
	 */
	public function indexAction(Tx_HypeStore_Domain_Model_Product $product = NULL) {
		$this->view->assign('product', $product);
	}
}
?>