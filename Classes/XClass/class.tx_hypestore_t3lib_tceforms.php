<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Thomas "Thasmo" Deinhamer <thasmo@gmail.com>
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

	/**
	 * Returns true, if the evaluation of the required-field code is OK.
	 *
	 * @param	string		The required-field code
	 * @param	array		The record to evaluate
	 * @param	string		FlexForm value key, eg. vDEF
	 * @return	boolean
	 */
	public function isDisplayCondition($displayCond, $row, $ffValueKey = '') {

		# split multiple conditions
		$conditions = explode('|', $displayCond);

		# process every condition
		foreach($conditions as $condition) {

			# split condition
			$parts = explode(':', $condition);

			# match condition
			switch((string) $parts[0]) {
				case 'PARENT':
					$output = !($row['__inline'] == TRUE);
					break;

				default:
					$output = parent::isDisplayCondition($condition, $row, $ffValueKey);
					break;
			}

			# return if false
			if(!$output) {
				return $output;
			}
		}

		return $output;
	}
}

?>