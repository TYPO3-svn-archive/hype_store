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

class user_hypestore_menu extends tx_hypestore_menu{};
class tx_hypestore_menu {

	private $prefix;
	private $level = -1;
	private $path = array();
	private $parameters;

	public function menu($content, $settings) {
		$this->loadSettings($settings);
		return $this->getDefaultMenu();
	}

	public function path($content, $settings) {
		$this->loadSettings($settings);
		return $this->getDefaultPath();
	}

	public function getDefaultMenu() {
		$categories = $this->getMainCategories();
		return $this->getTree($categories);
	}

	public function getDefaultPath() {
		$path = array();

		foreach($this->parameters['path'] as $uid) {
			array_push($path, $this->getCategory($uid));
		}

		if($uid = $this->parameters['tx_hypestore_product']['product']) {
			array_push($path, $this->getProduct($uid));
		}

		return $path;
	}

	public function item($items, $conf) {

		# process render flag for squishing a bug
		if(!$items[0]['_RENDER']) {
			$items = array();
		}

		return $items;
	}

	private function loadSettings($settings) {

		# set global settings
		$this->settings = $settings;

		# reset the path
		$this->path = array();

		# get post and get parameters
		$this->parameters = t3lib_div::_GET();

		# set controller prefix
		if($this->parameters['tx_hypestore_category']) {
			$this->plugin = 'tx_hypestore_category';
		} else if($this->parameters['tx_hypestore_product']) {
			$this->plugin = 'tx_hypestore_product';
		} else {
			$this->plugin = 'tx_hypestore_category';
		}

		# override controller prefix
		if($this->settings['prefix']) {
			$this->prefix = $this->settings['prefix'];
		} else {
			$this->prefix = $this->plugin;
		}

		# set controller based on prefix
		if($this->prefix == 'tx_hypestore_category') {
			$this->controller = 'Category';
		} else if($this->prefix == 'tx_hypestore_product') {
			$this->controller = 'Product';
		}

		# set modified path depending on the controller
		if($this->parameters[$this->plugin]['path']) {
			$path = explode(',', $this->parameters[$this->plugin]['path']);

			if(!is_array($path)) {
				$path = array_merge(array(), $path);
			}
		} else {
			$path = array();
		}

		$this->parameters['path'] = $path;

		# set storage
		$this->storage = array();

		if(is_string($settings['storagePage']) && strlen($settings['storagePage']) > 0 && $settings['storageRecursive'] > 0) {
			$list = array();
			$explodedPages = t3lib_div::trimExplode(',', $settings['storagePage']);
			foreach($explodedPages as $pid) {
				$list[] = trim($GLOBALS['TSFE']->cObj->getTreeList($pid, $settings['storageRecursive']), ',');
			}

			$this->storage = array_filter(array_merge(array($settings['storagePage']), $list));
		}
	}

	private function getProduct($uid) {
		$category = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', 'tx_hypestore_domain_model_product', 'uid = ' . (int)$uid . ' AND pid IN(' . implode(',', $this->storage) . ')');
		$record = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($category);

		# set correct page uid
		$record['_uid'] = $record['uid'];
		$record['uid'] = $this->settings['product.']['pid'] ? (int)$this->settings['product.']['pid'] : $GLOBALS['TSFE']->id;

		# set address
		$record['_ADD_GETVARS'] = '&tx_hypestore_product[product]=' . (int)$record['_uid'] . '&tx_hypestore_product[controller]=Product';

		if(!$this->settings['expAll']) {
			$record['_ADD_GETVARS'] .= '&tx_hypestore_product[path]=' . implode(',', $this->path);
		}

		# add chash
		$record['_ADD_GETVARS'] .= '&cHash=' . md5(serialize(t3lib_div::cHashParams($record['_ADD_GETVARS'])));

		# set state to current
		$record['ITEM_STATE'] = 'CUR';

		# set render flag for squishing a bug
		$record['_RENDER'] = TRUE;

		return $record;
	}

	private function getCategory($uid) {
		$category = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', 'tx_hypestore_domain_model_category', 'uid = ' . (int)$uid . ' AND pid IN(' . implode(',', $this->storage) . ')');
		$record = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($category);

		# add path entry
		array_push($this->path, $record['uid']);

		# set correct page uid
		$record['_uid'] = $record['uid'];
		$record['uid'] = $this->settings['category.']['pid'] ? (int)$this->settings['category.']['pid'] : $GLOBALS['TSFE']->id;

		# set address
		$record['_ADD_GETVARS'] = '&tx_hypestore_category[category]=' . (int)$record['_uid'] . '&tx_hypestore_category[action]=list&tx_hypestore_category[controller]=Category';

		if(!$this->settings['expAll']) {
			$record['_ADD_GETVARS'] .= '&tx_hypestore_category[path]=' . implode(',', $this->path);
		}

		# add chash
		$record['_ADD_GETVARS'] .= '&cHash=' . md5(serialize(t3lib_div::cHashParams($record['_ADD_GETVARS'])));

		# set state to normal
		$record['ITEM_STATE'] = 'NO';

		# update state
		if($this->parameters['path'][count($this->parameters['path']) - 1] == $record['_uid']) {
			# set state to current
			$record['ITEM_STATE'] = 'CUR';
		}

		# set render flag for squishing a bug
		$record['_RENDER'] = TRUE;

		return $record;
	}

	private function getMainCategories() {

		if($this->settings['category.']['uid'] > 0) {
			$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', 'tx_hypestore_relation_category_category', 'uid_local = ' . $this->settings['category.']['uid'], '', 'sorting');

			$categories = array();

			if($GLOBALS['TYPO3_DB']->sql_num_rows($res) > 0) {

				while($mm = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)) {

					$category = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', 'tx_hypestore_domain_model_category', 'uid = ' . $mm['uid_foreign'] . ' AND pid IN(' . implode(',', $this->storage) . ')', '', 'sorting');
					$category = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($category);

					$categories[$category['uid']] = $category;
				}
			}
		} else {
			$rows = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('*', 'tx_hypestore_domain_model_category', 'hidden = 0 AND deleted = 0 AND pid IN(' . implode(',', $this->storage) . ')', '', '', '', '');

			$categories = array();
			foreach($rows as $row) {
				$categories[$row['uid']] = $row;
			}

			foreach($categories as $key => $category) {

				$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', 'tx_hypestore_relation_category_category', 'uid_local = ' . $category['uid']);

				if($GLOBALS['TYPO3_DB']->sql_num_rows($res) > 0) {

					$subcategories = array();
					while($mm = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)) {

						$subcategory = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', 'tx_hypestore_domain_model_category', 'uid = ' . $mm['uid_foreign'] . ' AND pid IN(' . implode(',', $this->storage) . ')');
						$subcategory = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($subcategory);

						unset($categories[$subcategory['uid']]);
					}
				}
			}
		}

		return $categories;
	}

	private function getTree(array $records) {

		# increase level
		$this->level++;

		$tree = array();
		foreach($records as $record) {

			# skip if no products available
			$products = $this->getDescendentProducts($record);

			if(count($products) == 0) {
				continue;
			}

			# add path entry
			array_push($this->path, $record['uid']);

			# set correct page uid
			$record['_uid'] = $record['uid'];
			$record['uid'] = $this->settings['category.']['pid'] ? (int)$this->settings['category.']['pid'] : $GLOBALS['TSFE']->id;

			# set address
			$record['_ADD_GETVARS'] = '&tx_hypestore_category[category]=' . (int)$record['_uid'] . '&tx_hypestore_category[action]=list&tx_hypestore_category[controller]=Category';

			if(!$this->settings['expAll']) {
				$record['_ADD_GETVARS'] .= '&tx_hypestore_category[path]=' . implode(',', $this->path);
			}

			# add chash
			$record['_ADD_GETVARS'] .= '&cHash=' . md5(serialize(t3lib_div::cHashParams($record['_ADD_GETVARS'])));

			# set state to normal
			$record['ITEM_STATE'] = 'NO';

			# update state
			if($this->parameters['path'][count($this->parameters['path']) - 1] == $record['_uid']) {
				# set state to current
				$record['ITEM_STATE'] = 'CUR';
			}

			# set subitems
			if($this->settings['expAll'] || ($this->parameters['path'][$this->level] == $record['_uid'])) {

				$result = $GLOBALS['TYPO3_DB']->exec_SELECTquery('a.*', 'tx_hypestore_domain_model_category AS b, tx_hypestore_relation_category_category AS r, tx_hypestore_domain_model_category AS a', 'b.uid = r.uid_local AND r.uid_foreign = a.uid AND r.uid_local = ' . $record['_uid'] . ' AND b.pid IN(' . implode(',', $this->storage) . ')');

				if($GLOBALS['TYPO3_DB']->sql_num_rows($result) > 0) {
					$categories = array();
					while($category = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($result)) {

						# update state
						if($this->parameters['path'][count($this->parameters['path']) - 1] == $category['uid']) {
							# set state to active
							$record['ITEM_STATE'] = 'ACT';
						}

						# add subitem
						array_push($categories, $category);
					}

					# set submenu
					$record['_SUB_MENU'] = $this->getTree($categories);

					# set item state
					if($record['ITEM_STATE'] == 'CUR') {
						$record['ITEM_STATE'] = 'CURIFSUB';
					} else if($record['ITEM_STATE'] == 'ACT') {
						$record['ITEM_STATE'] = 'ACTIFSUB';
					} else {
						$record['ITEM_STATE'] = 'IFSUB';
					}
				}
			}

			# set render flag for squishing a bug
			$record['_RENDER'] = TRUE;

			# add node to tree
			array_push($tree, $record);

			# remove path entry
			array_pop($this->path);
		}

		# decrease level
		$this->level--;

		return $tree;
	}

	public function hasDescendentProducts($category) {

		# get direct products
		$products = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('*', 'tx_hypestore_relation_category_product', 'uid_foreign = ' . $category['uid'], '', '', '', '');

		if(count($products) > 0) {
			return TRUE;
		}

		# get subcategories
		$records = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('*', 'tx_hypestore_relation_category_category', 'uid_local = ' . $category['uid'], '', '', '', '');

		if(count($records) == 0) {
			return FALSE;
		}

		$categories = array();
		foreach($records as $record) {
			$category = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('*', 'tx_hypestore_domain_model_category', 'uid = ' . $record['uid_foreign'] . ' AND hidden = 0 AND deleted = 0 AND pid IN(' . implode(',', $this->storage) . ')', '', '', '', '');

			if(count($category) == 1) {
				array_push($categories, $category[0]);
			}
		}

		foreach($categories as $category) {
			if($this->hasDescendentProducts($category)) {
				return TRUE;
			}
		}

		return FALSE;
	}

	public function getDescendentProducts($category) {

		$products = array();

		# get direct products
		$records = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('*', 'tx_hypestore_relation_category_product', 'uid_foreign = ' . $category['uid'], '', '', '', '');

		if(count($records) > 0) {

			foreach($records as $record) {
				$product = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('*', 'tx_hypestore_domain_model_product', 'uid = ' . $record['uid_local'] . ' AND hidden = 0 AND deleted = 0 AND pid IN(' . implode(',', $this->storage) . ')', '', '', '', '');

				if(count($product) == 1) {
					array_push($products, $product[0]);
				}
			}
		}

		# get subcategories
		$records = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('*', 'tx_hypestore_relation_category_category', 'uid_local = ' . $category['uid'], '', '', '', '');

		if(count($records) > 0) {

			$categories = array();
			foreach($records as $record) {
				$category = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('*', 'tx_hypestore_domain_model_category', 'uid = ' . $record['uid_foreign'] . ' AND hidden = 0 AND deleted = 0 AND pid IN(' . implode(',', $this->storage) . ')', '', '', '', '');

				if(count($category) == 1) {
					array_push($categories, $category[0]);
				}
			}

			foreach($categories as $category) {
				$temp = $this->getDescendentProducts($category);

				foreach($temp as $tmp) {
					array_push($products, $tmp);
				}
			}
		}

		return $products;
	}
}

?>