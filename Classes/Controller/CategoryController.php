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
class Tx_HypeStore_Controller_CategoryController extends Tx_Extbase_MVC_Controller_ActionController {
	
	/**
	 * @var Tx_HypeStore_Domain_Repository_CategoryRepository
	 */
	protected $categoryRepository;
	
	/**
	 * Initializes the current action
	 *
	 * @return void
	 */
	public function initializeAction() {
		
		# instantiate the category repository
		$this->categoryRepository = t3lib_div::makeInstance('Tx_HypeStore_Domain_Repository_CategoryRepository');
		
		# prepare product pid (flexform hack)
		$this->settings['view']['product']['pid'] = (strpos($this->settings['view']['product']['pid'], '_')) > 0
			? substr($this->settings['view']['product']['pid'], strpos($this->settings['view']['product']['pid'], '_') + 1)
			: $this->settings['view']['product']['pid'];
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
		
		# get categories
		if($this->settings['view']['category']['uid']) {
			$categories = $this->categoryRepository->findByUid((int)$this->settings['view']['category']['uid'])->getCategories();
		} else {
			$categories = $this->categoryRepository->findMainCategories();
		}
		
		# assign categories
		$this->view->assign('categories', $categories);
	}
	
	/**
	 * List action for this controller.
	 *
	 * @param Tx_HypeStore_Domain_Model_Category $category
	 * @dontvalidate $category
	 * @return string
	 */
	public function listAction(Tx_HypeStore_Domain_Model_Category $category) {
		
		# overload document title
		if($this->settings['view']['category']['common']['overrideDocumentTitle']) {
			Tx_Hype_Utility_Document::setTitle($category->getTitle());
		}
		
		# assign the path if available
		if($this->request->hasArgument('path')) {
			$this->view->assign('path', $this->request->getArgument('path'));
		}
		
		# assign the category
		$this->view->assign('category', $category);
	}
}
?>