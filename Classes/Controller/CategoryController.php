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
 * Category controller
 *
 * @version $Id:$
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 */
class Tx_HypeStore_Controller_CategoryController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * @var Tx_HypeStore_Domain_Repository_CategoryRepositoryInterface
	 */
	protected $categoryRepository;

	/**
	 * @var Tx_HypeStore_Domain_Repository_AttributeRepositoryInterface
	 */
	protected $attributeRepository;

	/**
	 * Injects the category repository
	 *
	 * @var Tx_HypeStore_Domain_Repository_CategoryRepositoryInterface $categoryRepository
	 * @return void
	 */
	public function injectCategoryRepository(Tx_HypeStore_Domain_Repository_CategoryRepositoryInterface $categoryRepository) {
		$this->categoryRepository = $categoryRepository;
	}

	/**
	 * Injects the attribute repository
	 *
	 * @var Tx_HypeStore_Domain_Repository_AttributeRepositoryInterface $attributeRepository
	 * @return void
	 */
	public function injectAttributeRepository(Tx_HypeStore_Domain_Repository_AttributeRepositoryInterface $attributeRepository) {
		$this->attributeRepository = $attributeRepository;
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
	 * @param mixed $filter
	 * @return string
	 */
	public function indexAction($filter = NULL) {

		# set categories
		if($this->settings['view']['category']['uid']) {
			$category = $this->categoryRepository->findByUid((int)$this->settings['view']['category']['uid']);
			$categories = $category->getCategories();
		} else {
			$categories = $this->categoryRepository->findMainCategories();
		}

		# skip overview
		if($this->settings['view']['category']['action']['index']['common']['skip']) {

			# get first category
			$category = $categories->getFirst();

			# redirect if available
			if($category) {
				$this->redirect('list', NULL, NULL, array('category' => $category, 'path' => $category->getUid()));
			}
		}

		# assign categories
		$this->view->assign('categories', $categories);

		# set attributes
		if($this->settings['view']['category']['filters']['useAllAttributes']) {
			$attributes = $this->attributeRepository->findAll();
		} else {
			$uids = explode(',', $this->settings['view']['category']['filters']['attributes']);

			$attributes = array();
			foreach($uids as $uid) {
				$attribute = $this->attributeRepository->findByUid($uid);

				if($attribute) {
					array_push($attributes, $attribute);
				}
			}
		}

		$this->view->assign('attributes', $attributes);

		# set filter
		if(is_array($filter)) {
			$this->view->assign('filter', $filter);
		}
	}

	/**
	 * List action for this controller.
	 *
	 * @param Tx_HypeStore_Domain_Model_Category $category
	 * @param mixed $filter
	 * @dontvalidate $category
	 * @dontvalidate $filter
	 * @return string
	 */
	public function listAction(Tx_HypeStore_Domain_Model_Category $category, $filter = NULL) {

		# set document title
		if($this->settings['view']['category']['common']['overrideDocumentTitle']) {
			Tx_Hype_Utility_Document::setTitle(implode(' — ', array_filter(array($category->getTitle(), $category->getSubtitle()))));
		}

		# set the path if available
		if($this->request->hasArgument('path')) {
			$this->view->assign('path', $this->request->getArgument('path'));
		}

		# set the category
		$this->view->assign('category', $category);

		# set attributes
		if($this->settings['view']['category']['filters']['useAllAttributes']) {
			$attributes = $this->attributeRepository->findAll();
		} else {
			$uids = explode(',', $this->settings['view']['category']['filters']['attributes']);

			$attributes = array();
			foreach($uids as $uid) {
				$attribute = $this->attributeRepository->findByUid($uid);

				if($attribute) {
					array_push($attributes, $attribute);
				}
			}
		}

		$this->view->assign('attributes', $attributes);

		# set filter
		if(is_array($filter)) {
			$this->view->assign('filter', $filter);
		}
	}
}
?>