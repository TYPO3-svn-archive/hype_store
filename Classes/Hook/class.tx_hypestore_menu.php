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
	
	private $level = -1;
	private $path = array();
	private $parameters;
	
	public function menu($content, $settings) {
		//print_r($content);
		//print_r($settings);
		
		$this->loadSettings($settings);
		
		$categories = $this->getMainCategories();
		$tree = $this->getTree($categories);
		
		//print_r($tree);
		
		return $tree;
	}
	
	public function path($content, $settings) {
		
		$this->loadSettings($settings);
		
		$path = array();
		
		foreach($this->parameters['tx_hypestore_category']['path'] as $uid) {
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
		
		# set modified path depending on the controller
		if($this->parameters['tx_hypestore_category']['path']) {
			$path = explode(',', $this->parameters['tx_hypestore_category']['path']);
		} else if($this->parameters['tx_hypestore_product']['path']) {
			$path = explode(',', $this->parameters['tx_hypestore_product']['path']);
		} else {
			$path = array();
		}
		
		if(!is_array($path)) {
			$path = array_merge(array(), $path);
		}
		
		$this->parameters['tx_hypestore_category']['path'] = $path;
	}
	
	private function getProduct($uid) {
		$category = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', 'tx_hypestore_domain_model_product', 'uid = ' . (int)$uid);
		$record = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($category);
		
		# set correct page uid
		$record['_uid'] = $record['uid'];
		$record['uid'] = $GLOBALS['TSFE']->id;
		
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
		$category = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', 'tx_hypestore_domain_model_category', 'uid = ' . (int)$uid);
		$record = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($category);
		
		# add path entry
		array_push($this->path, $record['uid']);
		
		# set correct page uid
		$record['_uid'] = $record['uid'];
		$record['uid'] = $this->settings['pid'] ? (int)$this->settings['pid'] : $GLOBALS['TSFE']->id;
		
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
		if($this->parameters['tx_hypestore_category']['path'][count($this->parameters['tx_hypestore_category']['path']) - 1] == $record['_uid']) {
			# set state to current
			$record['ITEM_STATE'] = 'CUR';
		}
		
		# set render flag for squishing a bug
		$record['_RENDER'] = TRUE;
		
		return $record;
	}
	
	private function getMainCategories() {
		$rows = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('*', 'tx_hypestore_domain_model_category', '', '', '', '', '');
		
		$categories = array();
		foreach($rows as $row) {
			$categories[$row['uid']] = $row;
		}
		
		foreach($categories as $key => $category) {

			$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', 'tx_hypestore_relation_category_category', 'uid_local = ' . $category['uid']);
			
			if($GLOBALS['TYPO3_DB']->sql_num_rows($res) > 0) {
				
				$subcategories = array();
				while($mm = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)) {
					
					$subcategory = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', 'tx_hypestore_domain_model_category', 'uid = ' . $mm['uid_foreign']);
					$subcategory = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($subcategory);
					
					unset($categories[$subcategory['uid']]);
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
			
			# add path entry
			array_push($this->path, $record['uid']);
			
			# set correct page uid
			$record['_uid'] = $record['uid'];
			$record['uid'] = $this->settings['pid'] ? (int)$this->settings['pid'] : $GLOBALS['TSFE']->id;
			
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
			if($this->parameters['tx_hypestore_category']['path'][count($this->parameters['tx_hypestore_category']['path']) - 1] == $record['_uid']) {
				# set state to current
				$record['ITEM_STATE'] = 'CUR';
			}
			
			# set subitems
			if($this->settings['expAll'] || ($this->parameters['tx_hypestore_category']['path'][$this->level] == $record['_uid'])) {
				
				$result = $GLOBALS['TYPO3_DB']->exec_SELECTquery('a.*', 'tx_hypestore_domain_model_category AS b, tx_hypestore_relation_category_category AS r, tx_hypestore_domain_model_category AS a', 'b.uid = r.uid_local AND r.uid_foreign = a.uid AND r.uid_local = ' . $record['_uid']);
				
				if($GLOBALS['TYPO3_DB']->sql_num_rows($result) > 0) {
					$categories = array();
					while($category = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($result)) {
						
						# update state
						if($this->parameters['tx_hypestore_category']['path'][count($this->parameters['tx_hypestore_category']['path']) - 1] == $category['uid']) {
							# set state to active
							$record['ITEM_STATE'] = 'ACT';
						}
						
						# add subitem
						array_push($categories, $category);
					}
					
					# set submenu
					$record['_SUB_MENU'] = $this->getTree($categories);
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
}

?>