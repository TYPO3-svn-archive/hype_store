<?php

class ux_t3lib_TCEforms extends t3lib_TCEforms {
	public function addSelectOptionsToItemArray($items, $fieldValue, $TSconfig, $field) {
		global $TCA;
		
		if($fieldValue['config']['user_type'] == 'tree') {
			if($fieldValue['config']['foreign_table']) {
				return $this->foreignTableTree($items, $fieldValue, $TSconfig, $field);
			}
		}
		
		return parent::addSelectOptionsToItemArray($items, $fieldValue, $TSconfig, $field);
	}
	
	public function foreignTableTree($items, $fieldValue, $TSconfig, $field, $pFFlag = 0) {
		global $TCA;
		
		// Init:
		$pF = $pFFlag ? 'neg_' : '';
		$f_table = $fieldValue['config'][$pF . 'foreign_table'];
		$uidPre = $pFFlag ? '-' : '';
		
		// Get query:
		$res = t3lib_BEfunc::exec_foreign_table_where_query($fieldValue, $field, $TSconfig, $pF);
		
		$records = array();
		while($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)) {
			$record = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', $f_table, 'uid = ' . $row['uid']);
			$record = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($record);
			
			$records[$record['uid']] = $record;
		}
		
		$records = $this->getMainRecords($fieldValue, $field, $records);
		
		$items = $this->buildTableTree($fieldValue, $field, $records);
		
		return $items;
	}
	
	public function getMainRecords($fieldValue, $field, $records) {
		
		foreach($records as $key => $record) {
			if($record[$field] > 0) {
				$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', 'tx_hypestore_relation_category_category', 'uid_local = ' . $record['uid']);
				
				if($GLOBALS['TYPO3_DB']->sql_num_rows($res) > 0) {
					
					$subcategories = array();
					while($mm = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)) {
						
						$subcategory = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', $fieldValue['config']['foreign_table'], 'uid = ' . $mm['uid_foreign']);
						$subcategory = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($subcategory);
						
						unset($records[$subcategory['uid']]);
					}
				}
			}
		}
		
		return $records;
	}
	
	public function buildTableTree($fieldValue, $field, $records, $level = 0) {
		global $TCA;
		
		// Init:
		$f_table = $fieldValue['config']['foreign_table'];
		
		// Get label prefix.
		$lPrefix = $this->sL($fieldValue['config'][$pF . 'foreign_table_prefix']);
		
		// Get icon field + path if any:
		$iField = $TCA[$f_table]['ctrl']['selicon_field'];
		$iPath = trim($TCA[$f_table]['ctrl']['selicon_field_path']);
		
		$items = array();
		foreach($records as $key => $record) {
			
			t3lib_BEfunc::workspaceOL($f_table, $row);
			
			// Prepare the icon if available:
			if ($iField && $iPath && $row[$iField])	{
				$iParts = t3lib_div::trimExplode(',',$row[$iField],1);
				$icon = '../'.$iPath.'/'.trim($iParts[0]);
			} elseif (t3lib_div::inList('singlebox,checkbox',$fieldValue['config']['renderMode'])) {
				$icon = '../'.TYPO3_mainDir.t3lib_iconWorks::skinImg($this->backPath,t3lib_iconWorks::getIcon($f_table, $row),'',1);
			} else $icon = '';
			
			$prefix = '';
			for($i = 0; $i < $level; $i++)
				$prefix .= $fieldValue['config']['indent_sign'];
			
			$prefix .= ' ';
			
			$items[] = array(
				$prefix . $lPrefix . $record['title'],
				$record['uid'],
				$icon
			);
			
			if($record[$field] > 0) {
				$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', 'tx_hypestore_relation_category_category', 'uid_local = ' . $record['uid']);
				
				if($GLOBALS['TYPO3_DB']->sql_num_rows($res) > 0) {
					
					$subcategories = array();
					while($mm = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)) {
						
						$subcategory = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', $fieldValue['config']['foreign_table'], 'uid = ' . $mm['uid_foreign']);
						$subcategory = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($subcategory);
						
						array_push($subcategories, $subcategory);
					}
					
					$items = array_merge($items, $this->buildTableTree($fieldValue, $field, $subcategories, $level + 1));
				}
			}
		}
		
		return $items;
	}
	
}

?>