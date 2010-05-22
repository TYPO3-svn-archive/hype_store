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
 * Tca
 */
class tx_HypeStore_Utility_Tca {
	public function getArticleType($data, $form) {
		
		//ob_start();
		//print_r($data);
		//$content = ob_get_contents();
		//ob_end_clean();
		
		//mail('thasmo@gmail.com', 'DEBUG', $content);
		
		# get the product uid, if available
		$uid = $form->inline->inlineStructure['stable'][0]['uid'];
		
		# manipulate items if a parent product was found
		if($uid > 0) {
			
			# set product
			$product = t3lib_BEfunc::getRecord('tx_hypestore_domain_model_product', $uid);
			
			# update items
			foreach($data['items'] as $key => $item) {
				
				# determine the product type
				if($item[1] == $product['type']) {
					$data['items'] = array($item);
					break;
				}
			}
			
			//ob_start();
			//print_r($data);
			//$content = ob_get_contents();
			//ob_end_clean();
			
			//mail('thasmo@gmail.com', 'DEBUG', $content);
		}
	}
}
?>