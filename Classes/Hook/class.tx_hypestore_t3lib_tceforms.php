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

class ux_t3lib_TCEforms extends t3lib_TCEforms {

	protected $table;

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

		//print $field;
		foreach($records as $key => $record) {
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

			if($level > 0) {
				for($i = 0; $i < $level; $i++) {
					$prefix .= $fieldValue['config']['indent_sign'];
				}

				$prefix .= '› ';
			}

			$items[] = array(
				$prefix . $lPrefix . $record['title'],
				$record['uid'],
				$icon
			);

			$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', 'tx_hypestore_relation_category_category', 'uid_local = ' . $record['uid'], 'sorting ASC');

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

		return $items;
	}

	/**
	 * Returns the form HTML code for a database table field.
	 *
	 * @param	string		The table name
	 * @param	string		The field name
	 * @param	array		The record to edit from the database table.
	 * @param	string		Alternative field name label to show.
	 * @param	boolean		Set this if the field is on a palette (in top frame), otherwise not. (if set, field will render as a hidden field).
	 * @param	string		The "extra" options from "Part 4" of the field configurations found in the "types" "showitem" list. Typically parsed by $this->getSpecConfFromString() in order to get the options as an associative array.
	 * @param	integer		The palette pointer.
	 * @return	mixed		String (normal) or array (palettes)
	 */
	public function getSingleField($table, $field, $row, $altName = '', $palette = 0, $extra = '', $pal = 0) {
		$this->table = $table;
		return parent::getSingleField($table, $field, $row, $altName, $palette, $extra, $pal);
	}

	/**
	 * Returns true, if the evaluation of the required-field code is OK.
	 *
	 * @param	string		The required-field code
	 * @param	array		The record to evaluate
	 * @param	string		FlexForm value key, eg. vDEF
	 * @return	boolean
	 */
	public function isDisplayCondition($displayCond, $row, $ffValueKey = '') {
		global $TCA;

		$output = FALSE;

		$parts = explode(':', $displayCond);

		switch((string) $parts[0]) {

			case 'RELATION':

				list($fieldName, $relationFieldName) = explode('.', $parts[1]);

				$table = $TCA[$this->table]['columns'][$fieldName]['config']['foreign_table'];
				$record = t3lib_BEfunc::getRecord($table, $row[$fieldName]);
				$theFieldValue = $record[$relationFieldName];

				switch ((string) $parts[2]) {
					case 'REQ':
						if (strtolower($parts[3]) == 'true') {
							$output = $theFieldValue ? TRUE : FALSE;
						} elseif (strtolower($parts[3]) == 'false') {
							$output = !$theFieldValue ? TRUE : FALSE;
						}
					break;
					case '>':
						$output = $theFieldValue > $parts[3];
					break;
					case '<':
						$output = $theFieldValue < $parts[3];
					break;
					case '>=':
						$output = $theFieldValue >= $parts[3];
					break;
					case '<=':
						$output = $theFieldValue <= $parts[3];
					break;
					case '-':
					case '!-':
						$cmpParts = explode('-', $parts[3]);
						$output = $theFieldValue >= $cmpParts[0] && $theFieldValue <= $cmpParts[1];
						if ($parts[2]{0} == '!') {
							$output = !$output;
						}
					break;
					case 'IN':
					case '!IN':
						$output = t3lib_div::inList($parts[3], $theFieldValue);
						if ($parts[2]{0} == '!') {
							$output = !$output;
						}
					break;
					case '=':
					case '!=':
						$output = t3lib_div::inList($parts[3], $theFieldValue);
						if ($parts[2]{0} == '!') {
							$output = !$output;
						}
					break;
				}

				return $output;

				break;

			default:
				return parent::isDisplayCondition($displayCond, $row, $ffValueKey);
				break;
		}
	}
}

?>